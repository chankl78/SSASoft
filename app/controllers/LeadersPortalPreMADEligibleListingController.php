<?php
class LeadersPortalPreMADEligibleListingController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/PreMADEligible');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/premadeligiblelisting');
		$view->title = 'BOE Portal - Pre Mentor and Disciple Eligible Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$result = MembersmSSA::MADLPEligibleMembership()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Pre MAD Kenshu Eligible Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}