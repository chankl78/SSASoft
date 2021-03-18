<?php
class EventDetailParticipantController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'event/registration');
		Session::put('current_resource', 'EVEN');
		$REEV03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'create');
		$query = EventmRegistration::where('uniquecode', '=', $id)->get();
		$eventcode = EventmEvent::getuniquecode($id);
		$eventname = EventmEvent::geteventname($id);
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$status_options = EventzRegistrationStatus::Role()->lists('value', 'value');
		$gohonzonstatus_options = EventzGohonzonStatus::Role()->lists('value', 'value');
		$gohonzontype_options = EventzGohonzonType::Role()->lists('value', 'value');
		$role_options = EventzRole::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$memposition_options = MemberszPosition::Role()->orderBy('name', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$event_options = array('0' => 'Please Select an Event') + EventmEvent::Role()->orderBy('description', 'ASC')->lists('description', 'id');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$ssagroup_options = array('' => 'Please Select a Group') + EventmGroup::Role()->where('eventid', EventmEvent::geteventid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitem_options = array('' => 'Please Select an Item') + EventmEventItem::Role()->where('eventid', EventmEvent::geteventid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$country_options = array('' => 'Please Select a Country') + EventzCountry::Role()->lists('value', 'value');
		$language_options = array('' => 'Please Select a Language') + EventzLanguage::Role()->lists('value', 'value');
		$session_options = array('' => 'Please Select a Session') + EventmEventShow::Role()->where('eventid', EventmEvent::geteventid($id))->lists('value', 'value');
		$view = View::make('event/eventdetailparticipant');
		$view->title = 'Participant Detail';
		$view->with('REEV03A', $REEV03A)->with('rid', $id)->with('result', $query)
			->with('status_options', $status_options)->with('role_options', $role_options)
			->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('eventname', $eventname)
			->with('chapter_options', $chapter_options)->with('eventuniquecode', $eventcode)
			->with('ssagroup_options', $ssagroup_options)->with('eventitem_options', $eventitem_options)
			->with('memposition_options', $memposition_options)->with('REEVGKA', $REEVGKA)->with('event_options', $event_options)
			->with('gohonzonstatus_options', $gohonzonstatus_options)->with('gohonzontype_options', $gohonzontype_options)
			->with('language_options', $language_options)->with('country_options', $country_options)->with('session_options', $session_options)
			->with('division_options', $division_options);
		return $view;
	}

	public function putParticipantDetail($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'update') == 't')
			{
				$datDate = DateTime::createFromFormat('m/d/Y', Input::get('gohonzonapplicationrecddate'));
				if (Input::get('groupcode') != "")
				{
					// Find if any existing code inside the same event.
					if(EventmRegistration::getCheckEventGroupCode(EventmEvent::getid(Input::get('eventid')), Input::get('groupcode'), EventmRegistration::getid($id)) == false)
					{
						$post = EventmRegistration::find(EventmRegistration::getid($id));
						$post->name = ucwords(Input::get('name'));
						$post->chinesename = Input::get('chinesename');
						$post->nric = Input::get('nric');
						$post->dateofbirth = Input::get('dateofbirth');
						if(Input::get('email') == ''){$post->email = 'NIL';} else {$post->email = Input::get('email');}
						if(Input::get('tel') == ''){$post->tel = 'NIL';} else {$post->tel = Input::get('tel');}
						if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
						$post->bloodgroup = Input::get('bloodgroup');
						$post->nationality = Input::get('nationality');
						$post->countryofbirth = Input::get('countryofbirth');
						$post->race = Input::get('race');
						$post->occupation = Input::get('occupation');
						$post->language = Input::get('language');
						$post->session = Input::get('session');
						
						if(Input::get('buildingname') == ''){$post->buildingname = 'NIL';} else {$post->buildingname = Input::get('buildingname');}
						if(Input::get('address') == ''){$post->address = 'NIL';} else {$post->address = Input::get('address');}
						if(Input::get('unitno') == ''){$post->unitno = 'NIL';} else {$post->unitno = Input::get('unitno');}
						if(Input::get('postalcode') == ''){$post->postalcode = 'NIL';} else {$post->postalcode = Input::get('postalcode');}
						
						$post->rhq =Input::get('region');
						$post->zone = Input::get('zone');
						$post->chapter = Input::get('chapter');
						$post->district = Input::get('district');
						$post->position = Input::get('position');
						$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
						$post->division = Input::get('division');
						$post->discussionmeetingday = Input::get('discussionmeetingday');

						$post->emergencyname = Input::get('emergencyname');
						$post->emergencyrelationship = Input::get('emergencyrelationship');
						if(Input::get('emergencytel') == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = Input::get('emergencytel');}
						if(Input::get('emergencymobile') == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = Input::get('emergencymobile');}

						$post->drugallergy = Input::get('drugallergy');

						$post->medicalhistory = Input::get('medicalhistory');
						$post->hypertension = Input::get('hypertension');
						$post->heartdisease = Input::get('heartdisease');
						$post->longtermmedication = Input::get('longtermmedication');
						$post->asthmahistory = Input::get('asthmahistory');
						$post->goodhealth = Input::get('goodhealth');

						$post->menstrual = Input::get('menstrual');
						$post->pregnant = Input::get('pregnant');
						$post->conceivenextsixmonths = Input::get('conceivenextsixmonths');

						$post->vaccinewillingtake = Input::get('vaccinewillingtake');
						$post->vaccinetaken = Input::get('vaccinetaken');
						$post->vaccineschedule = Input::get('vaccineschedule');
						$post->vaccineotherpast = Input::get('vaccineotherpast');
						$post->vaccineotherdate = Input::get('vaccineotherdate');
						$post->vaccineseverlyimmunocompromised = Input::get('vaccineseverlyimmunocompromised');
						$post->vaccinehistoryofanaphylaxissevereallergise = Input::get('vaccinehistoryofanaphylaxissevereallergise');
						$post->vaccineconsent = Input::get('vaccineconsent');

						$post->commitwedsat = Input::get('commitwedsat');
						$post->travelperiod = Input::get('travelperiod');
						$post->danceexperience = Input::get('danceexperience');
						$post->dancetype = Input::get('dancetype');

						$post->introducer = Input::get('introducername');
						if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}
						if(Input::get('subscriptionref') == '')
						{
							if (Input::get('subscriptionst') == '1') {
								$post->subscriptionref = date('Y') . 'NF'. date('md') . RAND(0000, 9999); 
							}
							elseif (Input::get('subscriptioncl') == '1') {
								$post->subscriptionref = date('Y') . 'NF'. date('md') . RAND(0000, 9999);
							}
							else { $post->subscriptionref = null; }
						} 
						else { $post->subscriptionref = Input::get('subscriptionref'); }
						$post->pdpa = Input::get('pdpa');
						$post->subscriptionst = Input::get('subscriptionst');
						$post->ststartdate = Input::get('ststartdate');
						$post->stenddate = Input::get('stenddate');
						$post->subscriptioncl = Input::get('subscriptioncl');
						$post->clstartdate = Input::get('clstartdate');
						$post->clenddate = Input::get('clenddate');

						$post->gohonzontype = Input::get('gohonzontype');
						if(Input::get('gohonzonapplicationrecddate') == ''){$post->gohonzonapplicationrecddate = NULL;} else {$post->gohonzonapplicationrecddate = $datDate;}
						if(Input::get('gohonzonrecdmonth') == ''){$post->gohonzonrecdmonth = NULL;} else {$post->gohonzonrecdmonth = Input::get('gohonzonrecdmonth');}
						if(Input::get('gohonzonrecdyear') == ''){$post->gohonzonrecdyear = NULL;} else {$post->gohonzonrecdyear = Input::get('gohonzonrecdyear');}
						if(Input::get('gohonzonremarks') == ''){$post->gohonzonremarks = NULL;} else {$post->gohonzonremarks = Input::get('gohonzonremarks');}
						$post->gohonzonstatus = Input::get('gohonzonstatus');

						$post->BPReading1 = Input::get('BPReading1');
						$post->BPReading2 = Input::get('BPReading2');
						$post->BPReading3 = Input::get('BPReading3');
						$post->medicalstatus = Input::get('medicalstatus');
						$post->medicalremarks = Input::get('medicalremarks');
						$post->medicalofficer = Input::get('medicalofficer');

						$post->auditionstatus = Input::get('auditionstatus');
						$post->auditionremarks = Input::get('auditionremarks');
						$post->trainer = Input::get('trainer');

						$post->costume1 = Input::get('costume1');
						$post->costume2 = Input::get('costume2');
						$post->costume3 = Input::get('costume3');
						$post->costume4 = Input::get('costume4');
						$post->costume5 = Input::get('costume5');
						$post->height = Input::get('height');
						$post->costume7 = Input::get('costume7');
						$post->costume8 = Input::get('costume8');
						$post->costume9 = Input::get('costume9');
						$post->shoes = Input::get('shoes');

						$post->otherremarks = Input::get('otherremarks');
						$post->committeemember = Input::get('committeemember');

						$post->status = Input::get('status');
						$post->role = Input::get('role');

						$post->eventid = Input::get('eventid');
						$post->memberid = Input::get('memberid');
						$post->personid = Input::get('personid');
						$post->auditioncode = Input::get('auditioncode');
						$post->groupcodeprefix = Input::get('groupcodeprefix');
						$post->groupcode = Input::get('groupcode');
						$post->ssagroup = Input::get('essagroup');
						$post->ssagroupcontact = Input::get('essagroupcontact');
						$post->ssagroupalllist = Input::get('essagroupalllist');
						$post->eventitem = Input::get('eeventitem');
						$post->cardno = Input::get('cardno');

						$post->save();
						if($post->save())
						{
							return Response::json(array('info' => 'Success'), 200);
						}
						else
						{
							LogsfLogs::postLogs('Update', 28, $id, ' - Event Participant Detail - ' . Input::get('name'), NULL, NULL, 'Failed');
							return Response::json(array('info' => 'Duplicate'), 400);
						}
					}
					else
					{
						LogsfLogs::postLogs('Update', 28, $id, ' - Event Participant Detail - ' . Input::get('name') . ' ' . Input::get('groupcode'), NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'GroupCodeExist'), 400);
					}
				}
				else
				{
					$post = EventmRegistration::find(EventmRegistration::getid($id));
					$post->name = ucwords(Input::get('name'));
					$post->chinesename = Input::get('chinesename');
					$post->nric = Input::get('nric');
					$post->dateofbirth = Input::get('dateofbirth');
					if(Input::get('email') == ''){$post->email = 'NIL';} else {$post->email = Input::get('email');}
					if(Input::get('tel') == ''){$post->tel = 'NIL';} else {$post->tel = Input::get('tel');}
					if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
					$post->bloodgroup = Input::get('bloodgroup');
					$post->nationality = Input::get('nationality');
					$post->countryofbirth = Input::get('countryofbirth');
					$post->race = Input::get('race');
					$post->occupation = Input::get('occupation');
					$post->language = Input::get('language');
					$post->session = Input::get('session');
					
					if(Input::get('buildingname') == ''){$post->buildingname = 'NIL';} else {$post->buildingname = Input::get('buildingname');}
					if(Input::get('address') == ''){$post->address = 'NIL';} else {$post->address = Input::get('address');}
					if(Input::get('unitno') == ''){$post->unitno = 'NIL';} else {$post->unitno = Input::get('unitno');}
					if(Input::get('postalcode') == ''){$post->postalcode = 'NIL';} else {$post->postalcode = Input::get('postalcode');}
					
					$post->rhq =Input::get('region');
					$post->zone = Input::get('zone');
					$post->chapter = Input::get('chapter');
					$post->district = Input::get('district');
					$post->position = Input::get('position');
					$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
					$post->division = Input::get('division');
					$post->discussionmeetingday = Input::get('discussionmeetingday');

					$post->emergencyname = Input::get('emergencyname');
					$post->emergencyrelationship = Input::get('emergencyrelationship');
					if(Input::get('emergencytel') == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = Input::get('emergencytel');}
					if(Input::get('emergencymobile') == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = Input::get('emergencymobile');}

					$post->drugallergy = Input::get('drugallergy');

					$post->medicalhistory = Input::get('medicalhistory');
					$post->hypertension = Input::get('hypertension');
					$post->heartdisease = Input::get('heartdisease');
					$post->longtermmedication = Input::get('longtermmedication');
					$post->asthmahistory = Input::get('asthmahistory');
					$post->goodhealth = Input::get('goodhealth');

					$post->menstrual = Input::get('menstrual');
					$post->pregnant = Input::get('pregnant');
					$post->conceivenextsixmonths = Input::get('conceivenextsixmonths');

					$post->vaccinewillingtake = Input::get('vaccinewillingtake');
					$post->vaccinetaken = Input::get('vaccinetaken');
					$post->vaccineschedule = Input::get('vaccineschedule');
					$post->vaccineotherpast = Input::get('vaccineotherpast');
					$post->vaccineotherdate = Input::get('vaccineotherdate');
					$post->vaccineseverlyimmunocompromised = Input::get('vaccineseverlyimmunocompromised');
					$post->vaccinehistoryofanaphylaxissevereallergise = Input::get('vaccinehistoryofanaphylaxissevereallergise');
					$post->vaccineconsent = Input::get('vaccineconsent');

					$post->commitwedsat = Input::get('commitwedsat');
					$post->travelperiod = Input::get('travelperiod');
					$post->danceexperience = Input::get('danceexperience');
					$post->dancetype = Input::get('dancetype');

					$post->introducer = Input::get('introducername');
					if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

					if(Input::get('subscriptionref') == '')
					{
						if (Input::get('subscriptionst') == '1') {
							$post->subscriptionref = date('Y') . 'NF'. date('md') . RAND(0000, 9999);
						}
						elseif (Input::get('subscriptioncl') == '1') {
							$post->subscriptionref = date('Y') . 'NF'. date('md') . RAND(0000, 9999);
						}
						else { $post->subscriptionref = null; }
					} 
					else { $post->subscriptionref = Input::get('subscriptionref'); }
					$post->pdpa = Input::get('pdpa');
					$post->subscriptionst = Input::get('subscriptionst');
					$post->ststartdate = Input::get('ststartdate');
					$post->stenddate = Input::get('stenddate');
					$post->subscriptioncl = Input::get('subscriptioncl');
					$post->clstartdate = Input::get('clstartdate');
					$post->clenddate = Input::get('clenddate');

					$post->gohonzontype = Input::get('gohonzontype');
					if(Input::get('gohonzonapplicationrecddate') == ''){$post->gohonzonapplicationrecddate = NULL;} else {$post->gohonzonapplicationrecddate = $datDate;}
					if(Input::get('gohonzonrecdmonth') == ''){$post->gohonzonrecdmonth = NULL;} else {$post->gohonzonrecdmonth = Input::get('gohonzonrecdmonth');}
					if(Input::get('gohonzonrecdyear') == ''){$post->gohonzonrecdyear = NULL;} else {$post->gohonzonrecdyear = Input::get('gohonzonrecdyear');}
					if(Input::get('gohonzonremarks') == ''){$post->gohonzonremarks = NULL;} else {$post->gohonzonremarks = Input::get('gohonzonremarks');}
					$post->gohonzonstatus = Input::get('gohonzonstatus');
					
					$post->BPReading1 = Input::get('BPReading1');
					$post->BPReading2 = Input::get('BPReading2');
					$post->BPReading3 = Input::get('BPReading3');
					$post->medicalstatus = Input::get('medicalstatus');
					$post->medicalremarks = Input::get('medicalremarks');
					$post->medicalofficer = Input::get('medicalofficer');

					$post->auditionstatus = Input::get('auditionstatus');
					$post->auditionremarks = Input::get('auditionremarks');
					$post->trainer = Input::get('trainer');

					$post->costume1 = Input::get('costume1');
					$post->costume2 = Input::get('costume2');
					$post->costume3 = Input::get('costume3');
					$post->costume4 = Input::get('costume4');
					$post->costume5 = Input::get('costume5');
					$post->height = Input::get('height');
					$post->costume7 = Input::get('costume7');
					$post->costume8 = Input::get('costume8');
					$post->costume9 = Input::get('costume9');
					$post->shoes = Input::get('shoes');

					$post->otherremarks = Input::get('otherremarks');
					$post->committeemember = Input::get('committeemember');

					$post->status = Input::get('status');
					$post->role = Input::get('role');

					$post->eventid = Input::get('eventid');
					$post->memberid = Input::get('memberid');
					$post->personid = Input::get('personid');
					$post->auditioncode = Input::get('auditioncode');
					$post->ssagroup = Input::get('essagroup');
					$post->ssagroupcontact = Input::get('essagroupcontact');
					$post->ssagroupalllist = Input::get('essagroupalllist');
					$post->eventitem = Input::get('eeventitem');
					$post->groupcodeprefix = Input::get('groupcodeprefix');
					$post->groupcode = Input::get('groupcode');
					$post->cardno = Input::get('cardno');

					$post->save();
					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Update', 28, $id, ' - Event Participant Detail - ' . Input::get('name'), NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - Event Participant Detail - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 28,  Auth::user()->id, ' - Event Participant Detail - ' . $id . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'unknown'), 400);
		}
	}

	public function getMemberGroupInfo($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupmMember::MemberGroup(EventmRegistration::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupmMember::MemberGroup(EventmRegistration::getmemberid($id))->count();
		    $default = GroupmMember::MemberGroup(EventmRegistration::getmemberid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)->groupBy('groupname')->groupBy('enrolleddate')->groupBy('position')->groupBy('status')->orderBy($sOrderBy, $sOrderdir)->get(array('groupname', 'enrolleddate', 'position', 'status'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Individual Members in Group - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberEventMedicalInfo($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::GroupMemberMedicalRemarksByIndividual(EventmRegistration::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::GroupMemberMedicalRemarksByIndividual(EventmRegistration::getmemberid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  EventmRegistration::GroupMemberMedicalRemarksByIndividual(EventmRegistration::getmemberid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'eventid', 'eventname', 'medicalhistory', 'medicalremarks'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Individual Member for Medical [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberEventAllergyInfo($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::GroupMemberAllergyByIndividual(EventmRegistration::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::GroupMemberAllergyByIndividual(EventmRegistration::getmemberid($id))->count();
		    $default =  EventmRegistration::GroupMemberAllergyByIndividual(EventmRegistration::getmemberid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'eventid', 'eventname', 'drugallergy'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Individual Member for Allergy [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberEventParticipationInfo($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::MemberParticipationInEvent(EventmRegistration::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::MemberParticipationInEvent(EventmRegistration::getmemberid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  EventmRegistration::MemberParticipationInEvent(EventmRegistration::getmemberid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'eventid', 'eventname', 'role', 'status', DB::raw('(SELECT eventdate FROM Event_m_Event WHERE Event_m_Registration.eventid = Event_m_Event.id  AND Event_m_Event.deleted_at IS NULL) AS eventdate'), DB::raw('(SELECT eventtype FROM Event_m_Event WHERE Event_m_Registration.eventid = Event_m_Event.id  AND Event_m_Event.deleted_at IS NULL) AS eventtype')))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Individual Member for Event [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('event/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('event/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}
}