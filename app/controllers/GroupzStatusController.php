<?php
class GroupzStatusController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/zStatus');
		Session::put('current_resource', 'GRPS');
		$REGP02A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'create');
		$view = View::make('group/zStatus');
		$view->title = 'Status - Groups';
		$view->with('REGP02A', $REGP02A);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupzStatus::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupzStatus::Search('%'.$sSearch.'%')->count();
		    $default = GroupzStatus::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 43, 0, ' - Group - Status Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatus()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(GroupzStatus::getFindDuplicateValue($value) == false)
			{
				$post = new GroupzStatus;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 43, $post->id, ' - Group - Status - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 43, 0, ' - Group - Status - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 43, 0, ' - Group - Status - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 43, 0, ' - Group - Member Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putStatus($id)
	{
		try
		{
			$post = GroupzStatus::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 43, 0, ' - Group - Update Status ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 43, Input::get('evalueid'), ' - Group - Update Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteStatus($id)
	{
		try
		{
			$post = GroupzStatus::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Status - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Delete Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}