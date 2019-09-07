<?php
class LeadersPortalCampaignListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Campaign');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/campaignlisting');
		$view->title = 'BOE Portal - Campaign Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = CampaignmCampaign::Role()->get(array('resourcedate', 'description', 'uniquecode', 'status'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Campaign Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}