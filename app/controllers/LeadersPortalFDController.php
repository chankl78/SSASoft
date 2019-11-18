<?php
class LeadersPortalFDController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/FD');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/fdlisting');
		$view->title = 'BOE Portal - Youth Listing (13 to 17 Years Old)';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::FDMembership()->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - FD Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}