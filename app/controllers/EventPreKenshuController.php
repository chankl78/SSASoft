<?php
class EventPreKenshuController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/prekenshu');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$REEV01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV01', 'read');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$view = View::make('event/eventprekenshu');
		$view->title = 'Event Pre Kenshu Listing';
		$view->with('REEV05R', $REEV05R)->with('REEVGKA', $REEVGKA)->with('REEV01R', $REEV01R);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = AttendancemPerson::PreKenshu()->get(array('attendancedate', 'name', 'rhq', 'zone', 'chapter', 'district', 'position', 'event', 'uniquecode'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 60, 0, ' - Pre Kenshu [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'delete') == 't')
			{
				$post = AttendancemPerson::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 34, $id, ' - Attendance - Delete Attendee - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 34, 0, ' - Attendance - Delete Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 34, $id, ' - Attendance - Delete Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}