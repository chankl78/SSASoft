<?php
class GroupzGroupTypeController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/zgrouptype');
		Session::put('current_resource', 'GRPS');
		$REGP02A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'create');
		$view = View::make('group/zgrouptype');
		$view->title = 'Group Type - Groups';
		$view->with('REGP02A', $REGP02A);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupzGroupType::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupzGroupType::Search('%'.$sSearch.'%')->count();
		    $default = GroupzGroupType::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 43, 0, ' - Group - Group Type Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postGroupType()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(GroupzGroupType::getFindDuplicateValue($value) == false)
			{
				$post = new GroupzGroupType;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 43, $post->id, ' - Group - Group Type - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 43, 0, ' - Group - Group Type - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 43, 0, ' - Group - Group Type - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 43, 0, ' - Group - Group Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putGroupType($id)
	{
		try
		{
			$post = GroupzGroupType::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 43, 0, ' - Group - Update Group Type ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 43, Input::get('evalueid'), ' - Group - Update Group Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteGroupType($id)
	{
		try
		{
			$post = GroupzGroupType::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Group Type - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Delete Group Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}