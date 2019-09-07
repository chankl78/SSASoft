<?php
class EventzRoleController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/zrole');
		Session::put('current_resource', 'EVEN');
		$REEV02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV02', 'read');
		$view = View::make('event/zrole');
		$view->title = 'Roles - Events';
		$view->with('REEV02R', $REEV02R);
		return $view;
	}

	public function getRoleListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventzRole::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventzRole::Search('%'.$sSearch.'%')->count();
		    $default = EventzRole::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'abbv', 'value', 'id'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Role Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postRole()
	{
		try
		{
			$value = Input::get('role');
			if(EventzRole::getFindEventRole($value) == false)
			{
				$post = new EventzRole;
				$post->abbv = Input::get('abbv');
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 26, $post->id, ' - Event - Roles - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 26, 0, ' - Event - Roles - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 26, 0, ' - Event - Roles - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 26, 0, ' - Event - Roles - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putRole()
	{
		try
		{
			$value = Input::get('eroleid');
			$post = EventzRole::find(Input::get('eroleid'));
			$post->abbv = Input::get('eabbv'); 
			$post->value = Input::get('erole');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, Input::get('eroleid'), ' - Event - Update Role', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, Input::get('eroleid'), ' - Event - Update Roles - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('eroleid')), 400);
		}
	}

	public function deleteRole($id)
	{
		try
		{
			$post = EventzRole::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Roles - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Delete Role - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}