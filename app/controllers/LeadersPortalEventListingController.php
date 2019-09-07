<?php
class LeadersPortalEventListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Event');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/eventlisting');
		$view->title = 'BOE Portal - Event Registration Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getEventListing()
	{
		try
		{
			$default = EventmEvent::Role()->whereIn('status', array('Active', 'Closed'))
				->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}