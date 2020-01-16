<?php
class AttendanceDMStatisticController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'attendance/dmstatistic');
		Session::put('current_resource', 'ATTE');
		$REAT03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'create');
		$dmyear_options = AttendancemAttendance::DMyear()->orderBy('year', 'desc')->lists('year', 'year');
		$currentyear = AttendancemAttendance::DMMaxYear();
		$view = View::make('attendance/attendancedmstatistic');
		$view->title = 'Discussion Meeting Statistic';
		$view->with('REAT03A', $REAT03A)->with('dmyear_options', $dmyear_options)->with('currentyear', $currentyear);
		return $view;
	}

	public function getListing($id)
	{
		try
		{
			$default = AttendancemAttendance::DMStatsListing($id)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}