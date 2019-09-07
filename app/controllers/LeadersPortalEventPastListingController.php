<?php
class LeadersPortalEventPastListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/PastEvent');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/eventpastlisting');
		$view->title = 'BOE Portal - Past Event Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = EventmEvent::Role()->where('status', 'Closed')->whereNotIn('eventtype', array('Pre M and D Kenshu'))->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Event Past Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}