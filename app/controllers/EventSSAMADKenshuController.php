<?php
class EventSSAMADKenshuController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/ssamadkenshu');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$REEV01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV01', 'read');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$view = View::make('event/eventssamadkenshu');
		$view->title = 'SSA Mentor and Disciple Training Course';
		$view->with('REEV05R', $REEV05R)->with('REEVGKA', $REEVGKA)->with('REEV01R', $REEV01R);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$default = EventmSSAMADKenshu::get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 60, 0, ' - SSA Mentor and Disciple Training Course [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatistic()
	{
		EventmSSAMADKenshu::transfermmstoboe();

		return Response::json(array('info' => 'Success'), 200);
	}
}