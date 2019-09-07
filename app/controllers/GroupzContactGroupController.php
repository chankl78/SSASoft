<?php
class GroupzContactGroupController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/zcontactgroup');
		Session::put('current_resource', 'GRPS');
		$REEV02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'read');
		$view = View::make('group/position');
		$view->title = 'Group - Position';
		$view->with('REGP02R', $REGP02R);
		return $view;
	}

	public function getListing($id) // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupzContactGroup::Group($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupzContactGroup::Group($id)->Search('%'.$sSearch.'%')->count();
		    $default = GroupzContactGroup::Group($id)->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();
		    return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 43, 0, ' - Group - zContactGroup Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postContactGroup($id)
	{
		try
		{
			$value = Input::get('txtcontactgroupvalue');
			$gid = GroupmGroup::getid($id);
			if(GroupzContactGroup::getFindDuplicateValue($value, $gid) == false)
			{
				$post = new GroupzContactGroup;
				$post->groupid = $gid;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 43, $post->id, ' - Group - zContactGroup - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 43, 0, ' - Group - zContactGroup - Unable to Save Record' . Input::get('txtpositionvalue1'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'CannotUpdate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 43, 0, ' - Group - zContactGroup - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 43, 0, ' - Group - zContactGroup - ' . Input::get('groupid') . ' exception: ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putContactGroup($id)
	{
		try
		{
			$post = GroupzContactGroup::find($id);
			$post->value = Input::get('econtactgroup');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 43, 0, ' - Group - Update ContactGroup ' + Input::get('econtactgroupid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 43, Input::get('evalueid'), ' - Group - Update ContactGroup - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('econtactgroupid')), 400);
		}
	}

	public function deleteContactGroup($id)
	{
		try
		{
			$post = GroupzContactGroup::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - ContactGroup - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Delete ContactGroup - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}