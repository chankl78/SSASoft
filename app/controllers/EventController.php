<?php
class EventController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/event');
		Session::put('current_resource', 'EVEN');
		$REEV03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'create');
		$eventtype_options = EventzEventType::Role()->lists('value', 'value');
		$divisiontype_options = CommonzDivisionType::Role()->lists('value', 'value');
		$view = View::make('event/event');
		$view->title = 'Events Listing';
		$view->with('REEV03A', $REEV03A)->with('eventtype_options', $eventtype_options)->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getEventListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmEvent::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmEvent::Role()->Search('%'.$sSearch.'%')->count();
		    $default = EventmEvent::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Event - Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEvent()
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('eventdate'));
				if(EventmEvent::getFindDuplicateValue(Input::get('description')) == false)
				{
					$post = new EventmEvent;
					$post->eventdate = $datDate;
					$post->location = Input::get('location');
					$post->description = Input::get('description');
					$post->eventtype = Input::get('eventtype');
					$post->divisiontype = Input::get('divisiontype');
					$post->createby = Auth::user()->name;
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - Event - ' . Input::get('description'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postEventACCheck($id)
	{
		if (AccessfCheck::getCheckEventAccess(EventmEvent::getid($id)) == true)
		{
			try
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteEvent($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'delete') == 't')
			{
				$post = EventmEvent::find(EventmEvent::getid($id));
				$post->Delete();

				LogsfLogs::postLogs('Delete', 28, $id, ' - Event - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 28, 0, ' - Event - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putEvent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('eventdate'));
				$post = EventmEvent::find(EventmEvent::getid($id));
				$post->eventdate = $datDate;
				$post->location = Input::get('location');
				$post->description = Input::get('description');
				$post->eventtype = Input::get('eventtype');
				$post->divisiontype = Input::get('divisiontype');
				$post->status = Input::get('status');
				$post->memregistration = Input::get('allowmemregistration');
				$post->shqregistration = Input::get('allowshqregistration');
				$post->regionregistration = Input::get('allowregionregistration');
				$post->zoneregistration = Input::get('allowzoneregistration');
				$post->chapterregistration = Input::get('allowchapterregistration');
				$post->districtregistration = Input::get('allowdistrictregistration');
				$post->special = Input::get('special');
				$post->readonly = Input::get('readonly');
				$post->addonly = Input::get('addonly');
				$post->editonly = Input::get('editonly');
				$post->deleteonly = Input::get('deleteonly');
				$post->viewattendance = Input::get('viewattendance');
				$post->sessionselect = Input::get('sessionselect');
				$post->languageselect = Input::get('languageselect');
				$post->nationalityselect = Input::get('nationalityselect');
				$post->moredetailselect = Input::get('moredetailselect');
				$post->addnontokang = Input::get('addnontokang');
				$post->directaccept = Input::get('directaccept');

				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 27, 0, ' - Event - Update Event ' + $id + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 27, $id, ' - Event - Update Event - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}
}