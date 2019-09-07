<?php
class LeadersPortalEventPastController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/PastEvent');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$eventname = EventmEvent::geteventdescription($id);
		$eventtype = EventmEvent::geteventtype($id);
		$special = EventmEvent::getspecial($id);
		$readonly = EventmEvent::getreadonly($id);
		$rhq = Session::get('gakkaiuserrhq');
		$zone = Session::get('gakkaiuserzone');
		$chapter = Session::get('gakkaiuserchapter');
		$district = Session::get('gakkaiuserdistrict');
		$query = EventmEvent::Role()->where('uniquecode', '=', $id)->get();
		$view = View::make('leaderportal/eventpast');
		$view->title = 'BOE Portal - ' . $eventname;

		return $view->with('gakkaishq', $gakkaishq)
			->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)
			->with('gakkaichapter', $gakkaichapter)->with('gakkaidistrict', $gakkaidistrict)
			->with('eventname', $eventname)->with('rid', $id)->with('result', $query)
			->with('rhq', $rhq)->with('zone', $zone)->with('chapter', $chapter)
			->with('special', $special)->with('readonly', $readonly);
	}

	public function getEventPastParticipant($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::where('eventid', EventmEvent::getid($id))->Role()->get(array('name', 'chinesename','division','rhq','zone','chapter','district', 'position', 'status', 'uniquecode', 'created_at', 'check1', 'check2', 'check3'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Participant Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}