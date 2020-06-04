<?php
class AttendanceDMStatisticController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'attendance/dmstatistic');
		Session::put('current_resource', 'ATTE');
		$REAT03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'create');
		$divisiontype_options = array('All' => 'All') +CommonzDivisionType::Role()->lists('value', 'value');
		$dmyear_options = AttendancemAttendance::DMyear()->orderBy('year', 'desc')->lists('year', 'year');
		$currentyear = AttendancemAttendance::DMMaxYear();
		$view = View::make('attendance/attendancedmstatistic');
		$view->title = 'Discussion Meeting Statistic';
		$view->with('REAT03A', $REAT03A)->with('dmyear_options', $dmyear_options)->with('currentyear', $currentyear)->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getListing($id, $divisiontype)
	{
		try
		{
			$default = AttendancemAttendance::DMStatsListing($id, $divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQFullStats($id, $divisiontype)
	{
		try
		{
			$default = AttendancemAttendance::DMFullStatsListing($id, $divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Full Statistic Listing RHQStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::RHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::RHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::RHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::RHQStats($id, $divisiontype)->get()->toarray();
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
				$default = zz2017members::RHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::RHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::RHQAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::RHQAgeGroupStats($id, $divisiontype)->get()->toarray();
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
				$default = zz2017members::NameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::NameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::NameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::NameList($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing NameList [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}