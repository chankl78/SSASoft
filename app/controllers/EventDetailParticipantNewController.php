<?php
class EventDetailParticipantNewController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'event/registration');
		Session::put('current_resource', 'EVEN');
		$REEV03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'create');
		$eventcode = $id;
		$eventname = EventmEvent::geteventnamepart($id);
		$status_options = EventzRegistrationStatus::Role()->lists('value', 'value');
		$role_options = EventzRole::Role()->lists('value', 'value');
		$rhq_options = array('' => 'Please Select RHQ') + MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$ssagroup_options = array('' => 'Please Select a Group') + EventmGroup::Role()->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitem_options = array('' => 'Please Select an Item') + EventmEventItem::Role()->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$memposition_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$country_options = array('' => 'Please Select a Country') + EventzCountry::Role()->lists('value', 'value');
		$language_options = array('' => 'Please Select a Language') + EventzLanguage::Role()->lists('value', 'value');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$view = View::make('event/eventdetailparticipantnew');
		$view->title = 'New Participant';
		$view->with('REEV03A', $REEV03A)->with('rid', $id)
			->with('status_options', $status_options)->with('role_options', $role_options)
			->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('eventname', $eventname)
			->with('chapter_options', $chapter_options)->with('ssagroup_options', $ssagroup_options)
			->with('eventitem_options', $eventitem_options)->with('eventuniquecode', $eventcode)
			->with('memposition_options', $memposition_options)->with('REEVGKA', $REEVGKA)
			->with('language_options', $language_options)->with('country_options', $country_options)
			->with('division_options', $division_options);
		return $view;
	}

	public function postParticipantDetail($id)
	{
		try
		{
			if (EventmRegistration::where('name', '=', Input::get('name'))->where('eventid', '=', Input::get('eventid'))->where('dateofbirth', '=', Input::get('dateofbirth'))->count() == 0)
			{
				$post = new EventmRegistration;
				$post->name = Input::get('name');
				$post->chinesename = Input::get('chinesename');
				$post->nric = Input::get('nric');
				$post->nrichash = md5(Input::get('nric'));
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
				$post->goodhealth = Input::get('goodhealth');
				$post->menstrual = Input::get('menstrual');

				$post->commitwedsat = Input::get('commitwedsat');
				$post->travelperiod = Input::get('travelperiod');

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
				$post->costume6 = Input::get('costume6');
				$post->costume7 = Input::get('costume7');
				$post->costume8 = Input::get('costume8');
				$post->costume9 = Input::get('costume9');
				$post->shoes = Input::get('shoes');

				$post->otherremarks = Input::get('otherremarks');
				$post->committeemember = Input::get('committeemember');

				$post->status = Input::get('status');
				$post->role = Input::get('role');

				$post->eventid = EventmEvent::getid($id);
				$post->eventname = EventmEvent::geteventdescription($id);
				$post->groupcode = Input::get('groupcode');
				$post->auditioncode = Input::get('auditioncode');
				$post->ssagroup = Input::get('essagroup');
				$post->eventitem = Input::get('eeventitem');
				$post->cardno = Input::get('cardno');
				$post->uniquecode = uniqid('',TRUE);

				$post->save();
				if($post->save())
				{
					//return Redirect::action('DashboardController@getIndex');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, $id, ' - Event New Participant Detail - ' . Input::get('name'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Exist'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 28, Auth::user()->id, ' - Event - Event New Participant Detail - Duplicate', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28,  Auth::user()->id, ' - Event New Participant Detail - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'unknown'), 400);
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