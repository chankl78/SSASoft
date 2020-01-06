<?php
class LeadersPortalSSAMADKenshuController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/SSAMADKenshu');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/ssamadkenshu');
		$view->title = 'BOE Portal - SSA Mentor and Disciple Training Course Listing';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$result = MembersmSSA::SSAMADListing()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode', 'trainingdate', 'language'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - SSA Mentor and Disciple Training Course Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}