<?php
class GroupzPositionController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/zposition');
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
			$iTotalRecords = GroupzPosition::Group($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupzPosition::Group($id)->Search('%'.$sSearch.'%')->count();
		    $default = GroupzPosition::Group($id)->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'lineno', 'value', 'id'))->toarray();
		    return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 43, 0, ' - Group - zPosition Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postPosition($id)
	{
		try
		{
			$value = Input::get('txtpositionvalue');
			$gid = GroupmGroup::getid($id);
			if(GroupzPosition::getFindDuplicateValue($value, $gid) == false)
			{
				$post = new GroupzPosition;
				$post->groupid = $gid;
				$post->lineno = Input::get('txtpositionvalue1');
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 43, $post->id, ' - Group - Position - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 43, 0, ' - Group - Position - Unable to Save Record' . Input::get('txtpositionvalue1'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'CannotUpdate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 43, 0, ' - Group - Position - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 43, 0, ' - Group - Position - ' . Input::get('groupid') . ' exception: ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putPosition($id)
	{
		try
		{
			$post = GroupzPosition::find($id);
			$post->lineno = Input::get('evalue');
			$post->value = Input::get('evalue1');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 43, 0, ' - Group - Update Position ' + Input::get('epositionid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 43, Input::get('evalueid'), ' - Group - Update Position - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deletePosition($id)
	{
		try
		{
			$post = GroupzPosition::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Position - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Delete Position - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}