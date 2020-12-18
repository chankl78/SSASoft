<?php
class LeadersPortalDMStatsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/DMStats');
		$divisiontype_options = array('All' => 'All') +CommonzDivisionType::Role()->lists('value', 'value');
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
			->with('gakkaidistrict', $gakkaidistrict)->with('dmyear_options', $dmyear_options)->with('currentyear', $currentyear)
			->with('divisiontype_options', $divisiontype_options);
		LogsfLogs::postLogs('Read', 1, 0, ' [ DM Statistic ] - Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - ' . Session::get('gakkaiuserpositionlevel'), NULL, NULL, 'Success');
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

	public function getRHQStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::LPRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::LPRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::LPRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::LPRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::LPRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing RHQStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQAgeGroupStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::LPRHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::LPRHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::LPRHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::LPRHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::LPRHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing RHQAgeGroupStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getNameList($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::LPNameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::LPNameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::LPNameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::LPNameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::LPNameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing Name List [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}