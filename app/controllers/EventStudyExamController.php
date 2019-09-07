<?php
class EventStudyExamController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/studyexam');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$REEV01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV01', 'read');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$view = View::make('event/eventstudyexam');
		$view->title = 'Event Study Exam Listing';
		$view->with('REEV05R', $REEV05R)->with('REEVGKA', $REEVGKA)->with('REEV01R', $REEV01R);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$result = EventmRegistration::StudyExamPassed()->Role()->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Study Exam [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}