<?php
class LeadersPortalDMStatsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/DMStats');
		$dmyear_options = AttendancemAttendance::DMyear()->orderBy('year', 'desc')->lists('year', 'year');
		$currentyear = AttendancemAttendance::DMMaxYear();
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/dmstats');
		$view->title = 'BOE Portal - DM Statistics';
		$view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('dmyear_options', $dmyear_options)->with('currentyear', $currentyear);
		return $view;
	}

	public function getListing($id)
	{
		try
		{
			$result = AttendancemAttendance::LPDMStatsListing($id)->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Discussion Meeting Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQStats($id)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::LPRHQStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::LPRHQStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::LPRHQStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::LPRHQStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing RHQStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQAgeGroupStats($id)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::LPRHQAgeGroupStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::LPRHQAgeGroupStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::LPRHQAgeGroupStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::LPRHQAgeGroupStats($id)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing RHQAgeGroupStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}