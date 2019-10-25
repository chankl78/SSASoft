<?php
class Event20194ObjectsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/20194objects');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$view = View::make('event/eventfourobjects2019');
		$view->title = '2019 4 Objectives';
		$view->with('REEVGKA', $REEVGKA);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = zz20194objects::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, 0, ' - 2019 4 Objectives [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatistic()
	{
		DB::table(zz_2019_4objects)->truncate();

		
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'update') == 't')
		{
			try
			{
				$eventdetail = EventmRegistration::where('eventid', EventmEvent::getid($id))->get(array('id'))->toarray();

				foreach($eventdetail as $eventdetail)
				{
					$post = EventmRegistration::find($eventdetail['id']);
					$post->uniquecode = uniqid('', TRUE);
					$post->save();
				}

				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}
}