<?php
class EventzEventTypeController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/zeventtype');
		Session::put('current_resource', 'EVEN');
		$REEV02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV02', 'read');
		$view = View::make('event/eventtype');
		$view->title = 'Roles - Events';
		$view->with('REEV02R', $REEV02R);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventzEventType::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventzEventType::Search('%'.$sSearch.'%')->count();
		    $default = EventzEventType::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Event Type Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEventType()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(EventzEventType::getFindDuplicateValue($value) == false)
			{
				$post = new EventzEventType;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 26, $post->id, ' - Event - Event Type - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 26, 0, ' - Event - Event Type - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 26, 0, ' - Event - Event Type - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 26, 0, ' - Event - Event Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putEventType($id)
	{
		try
		{
			$post = EventzEventType::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Event - Update Event Type ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, Input::get('evalueid'), ' - Event - Update Event Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteEventType($id)
	{
		try
		{
			$post = EventzEventType::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Event Type - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 26, $id, ' - Event - Delete Event Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}