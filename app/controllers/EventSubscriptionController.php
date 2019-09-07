<?php
class EventSubscriptionController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'event/subscription');
		Session::put('current_resource', 'EVEN');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$REEV01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV01', 'read');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$view = View::make('event/eventsubscription');
		$view->title = 'Event New Friend Subscription Listing';
		$view->with('REEV05R', $REEV05R)->with('REEVGKA', $REEVGKA)->with('REEV01R', $REEV01R);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::STSubscription()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::STSubscription()->Search('%'.$sSearch.'%')->count();
		    $default = EventmRegistration::STSubscription()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('ststartdate', 'stenddate', 'name', 'rhq', 'zone', 'chapter', 'district', 'position', 'eventname', 'subscriptionref'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 60, 0, ' - Event - Subscription [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEventSTSubscriptionMailer($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::STSubscriptionMailer(Input::get('cbMonth'))->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
				if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
				if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
				if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
				if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
				if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
				if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} else {$enric = $eventmemberlist['nric'];}
				if ($eventmemberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $eventmemberlist['address'];}
				if ($eventmemberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $eventmemberlist['buildingname'];}
				if ($eventmemberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $eventmemberlist['unitno'];}
				if ($eventmemberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $eventmemberlist['postalcode'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $eventmemberlist['eventid'],
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $etel,
			        'string2' => $emobile,
			        'string3' => $eemail,
			        'string4' => $eemergencytel,
			        'string5' => $eemergencymobile,
			        'string6' => $eintroducermobile,
			        'string7' => $enric,
			        'string8' => $eaddress,
			        'string9' => $ebuildingname,
			        'string10' => $eunitno,
			        'string11' => $epostalcode,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 60, 0, ' - Event - ST Subscription Mailer - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 60, 0, ' - Event - ST Subscription Mailer - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventSTSubscriptionMailerExcel()
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::STSubscription()->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
				if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
				if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
				if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
				if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
				if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
				if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} else {$enric = $eventmemberlist['nric'];}
				if ($eventmemberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $eventmemberlist['address'];}
				if ($eventmemberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $eventmemberlist['buildingname'];}
				if ($eventmemberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $eventmemberlist['unitno'];}
				if ($eventmemberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $eventmemberlist['postalcode'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $eventmemberlist['eventid'],
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $etel,
			        'string2' => $emobile,
			        'string3' => $eemail,
			        'string4' => $eemergencytel,
			        'string5' => $eemergencymobile,
			        'string6' => $eintroducermobile,
			        'string7' => $enric,
			        'string8' => $eaddress,
			        'string9' => $ebuildingname,
			        'string10' => $eunitno,
			        'string11' => $epostalcode,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 60, 0, ' - Event - ST Subscription Mailer Excel - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 60, 0, ' - Event - ST Subscription Mailer Excel - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}