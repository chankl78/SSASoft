<?php
class EventzRegistrationStatusController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/zregistrationstatus');
		Session::put('current_resource', 'EVEN');
		$REEV02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV02', 'read');
		$view = View::make('event/zregistrationstatus');
		$view->title = 'Registration Status - Events';
		$view->with('REEV02R', $REEV02R);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventzRegistrationStatus::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventzRegistrationStatus::Search('%'.$sSearch.'%')->count();
		    $default = EventzRegistrationStatus::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 26 , 0, ' - Event - Registration Status Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postRegistrationStatus()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(EventzRegistrationStatus::getFindDuplicateValue($value) == false)
			{
				$post = new EventzRegistrationStatus;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 26, $post->id, ' - Event - Registration Status - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 26, 0, ' - Event - Registration Status - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 26, 0, ' - Event - Registration Status - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 26, 0, ' - Event - Registration Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putRegistrationStatus($id)
	{
		try
		{
			$post = EventzRegistrationStatus::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Event - Update Registration Status ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, Input::get('evalueid'), ' - Event - Update Registration Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteRegistrationStatus($id)
	{
		try
		{
			$post = EventzRegistrationStatus::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Registration Status - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Registration Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}