<?php
class MemberStatisticController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'member/statistic');
		Session::put('current_resource', 'SSAM');
		$REME03R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'ME03', 'read');
		$divisiontype_options = array('All' => 'All') + CommonzDivisionType::Role()->lists('value', 'value');
		$positionlevel_options = array('All' => 'All') + MemberszPosition::PositionLevel()->lists('level', 'level');
		$view = View::make('member/memberstatistic');
		$view->title = 'Member Statistic';
		$view->with('REME03R', $REME03R)->with('positionlevel_options', $positionlevel_options)->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mRHQStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQPositionListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mRHQPositionStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ By Position Level Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZonePositionListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mZonePositionStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ By Position By Zone Level Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterPositionListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mChapterPositionStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ By Position By Chapter Level Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictPositionListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mDistrictPositionStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ By Position Level Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getPositionAgeGroupListing($divisiontype)
	{
		try
		{
			$default = MembersmSSA::mPositionAgeGroupStats($divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Members RHQ By Position Level By Age Group Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
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