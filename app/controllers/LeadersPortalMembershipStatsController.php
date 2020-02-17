<?php
class LeadersPortalMembershipStatsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/MembershipStats');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/membershipstats');
		$view->title = 'BOE Portal - Membership Statistics';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStats()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQPositionListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStatsByRHQByPosition()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZonePositionListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStatsByZoneByPosition()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterPositionListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStatsByChapterByPosition()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictPositionListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStatsByDistrictByPosition()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getPositionAgeGroupListing()
	{
		try
		{
			$result = MembersmSSA::LPMembershipStatsByPositionAgeGroup()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Membership Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}