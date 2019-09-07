<?php
class EventRegistrationSearchController extends BaseController
{
	public $restful = true;
	
	public function getIndex()
	{
		Session::put('current_page', 'event/registration');
		Session::put('current_resource', 'EVEN');
		$view = View::make('event/registrationsearch');
		$view->title = 'Registration';
		return $view;
	}

	public function getNameSearch()
	{
		
	}

	public function getSSAMembersListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::Role()->Search('%'.$sSearch.'%')->count();
		    $default = MembersmSSA::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('name', 'rhq', 'zone', 'chapter', 'district', 'position', 
					'division', 'id', 'dateofbirth'))
				->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Registration Search By Name - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postSearch()
	{
		try
		{
			$value = Input::get('search');
			$memmax = DB::table('Members_m_SSA')->max('id');
			for($i=1; $i <= $memmax; $i++)
			{
				$comparenric = Crypt::decrypt(DB::table('Members_m_SSA')->where('id', $i)->pluck('nric'));
				if ($comparenric == $value)
				{
					return Response::json(array('info' => 'Success', 'rid' => $i), 200);
				}
			}

			// try
			// {
			// 	$items = MembersmSSA::all()->filter(function($record) use($value) {
			// 		if($record->nric == $value) {
			// 			Session::put('key', $record->id);
			// 			return $record;
			// 	    }
			// 	});

			// 	$i = Session::get('key');
			// 	Session::forget('key');

			// 	LogsfLogs::postLogs('Read', 30, 0, ' - Event - Registering Participant (Search) - ' . $i, NULL, NULL, 'Failed');
			// 	return Response::json(array('info' => 'Success', 'rid' => $i), 200);
			// }
			// catch(\Exception $e)
			// {
			// 	LogsfLogs::postLogs('Read', 30, 0, ' - Event - Registering Participant (Search) - ' . $e, NULL, NULL, 'Failed');
			// 	return Response::json(array('info' => 'Failed', 'ErrType' => $value), 400);
			// }

			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Registration Search By Nric - Data Doest not Exist - ' . $value, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Register Participant - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => $value), 400);
		}
	}
}