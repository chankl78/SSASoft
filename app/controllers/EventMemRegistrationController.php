<?php

class EventMemRegistrationController extends BaseController {
	public $restful = true;

	public function getIndex()
	{
		$view = View::make('eventregistration/eventregistration');
		$view->title = 'Event Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::MemRegEvent()->orderBy('description', 'ASC')->lists('description', 'uniquecode');
		$eventuniquecode = ConfigurationmDefault::NFMDefaultCode();
		$view->with('event_options', $event_options)->with('rhq_options', $rhq_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options)->with('eventuniquecode', $eventuniquecode)
			->with('division_options', $division_options);
		return $view;
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			if (Input::get('nricsearch') != "")
			{
				$searchresult = MembersmSSA::findorfail(MembersmSSA::getidbynrichash(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position', 'id', 'mobile', 'email'));
		    
				LogsfLogs::postLogs('Read', 28, $id, ' - Event - NRIC Search - ' . md5(Input::get('nricsearch')), NULL, NULL, 'Success');
				return Response::json($searchresult, 200);
			}
			else
			{
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, $id, ' - Event Mem Registration - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postSearchByNric()
	{
		$id = MembersmSSA::getIdByNric(Input::get('nric'));
		if (isset($id)) {
			# Member data exists
			$member = MembersmSSA::find($id, array('uniquecode', 'name', 'mobile', 'tel', 'email', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position', 'id'));
			return Response::json($member, 200);
		} else {
			LogsfLogs::postLogs('Read', 28, $id, ' - Event Mem Registration - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postRegisterForEvent()
	{
		$postdata = Input::all();
		
		# eventid is actually uniquecode in the EventmEvent model.
		# Change to the primary key of EventmEvent.
		$eventuniquecode = $postdata['eventid'];
		$postdata['eventid'] = EventmEvent::getid($eventuniquecode);
		
		# Workflow for adding registration:
		#
		# First, check if there is a memberid.
		# If there is, then search for duplicates.
		# 	If there are no duplicates, populate the event based on the keyed in details.
		# 	If there are duplicates, return duplicate error.
		# If there is no memberid, populate the event based on the keyed in details.
		
		$memberid = $postdata['memberid'];
		$eventid = $postdata['eventid'];
		$doAddToEvent = false;
		if (isset($memberid)) {
			# Search for duplicates
			if (EventmRegistration::getEventMemberDuplicate($memberid, $eventid) == false) {
				# No duplicates: Add to event.
				$doAddToEvent = true;
			} else {
				# Return duplicate error.
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		} else {
			# No memberid, add to event
			$doAddToEvent = true;
		}

		if ($doAddToEvent) {
			
			# Look up the remaining data in $postdata
			$postdata['eventname'] = EventmEvent::where('id', $eventid)->pluck('description');
			
			# Fill in missing data from MembersmSSA
			# If memberid exists,
			# 	For all common keys between EventmRegistration and MembersmSSA,
			# 	If the data is blank, pull the data from MembersmSSA
			if (isset($memberid)) {
				$member_keys = array('personid','name','chinesename','dateofbirth'
					,'rhq','zone','chapter','district','position','division','nric'
					,'tel','mobile','email','address','buildingname','unitno','postalcode'
					,'language','occupation','countryofbirth','nationality','race','bloodgroup'
					,'drugallergy','introducer','introducermobile'
					,'emergencyname','emergencyrelationship','emergencytel','emergencymobile','gender');
				$member_data = MembersmSSA::find($memberid, $member_keys)->toarray();
				
				foreach ($member_keys as $key) {
					if (array_key_exists($key, $postdata)) {
						if ($postdata[$key] = '') {
							$postdata[$key] = $member_data[$key];
						}
					} else {
						# The key does not exist in $postdata. We will add it in.
						$postdata[$key] = $member_data[$key];
					}
					
				}
			}

			$post = new EventmRegistration($postdata);
			$post->uniquecode = uniqid('',TRUE);
			$post->role = "Participant";
			$post->status = "Interested";
			$post->save();
		}
	}

	public function postAddMember($id)
	{
		try
		{
			$mid = MembersmSSA::getid1(Input::get('memberid'));
			if (Input::get('memberid') == "") { $member = 0; }
			else {$member = MembersmSSA::find($mid)->toarray();}
			
			if (Input::get('memberid') == "")
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->eventname = EventmEvent::geteventdescription(Input::get('eventid'));
				$post->personid = 0;
				$post->memberid = 0;
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = $member['positionlevel'];
				$post->division = Input::get('division');
				$post->nric = Input::get('nric');

				if(Input::get('tel') == ''){$post->tel = 'NIL';} else {$post->tel = Input::get('tel');}
				if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
				if(Input::get('email') == ''){$post->email = 'NIL';} else {$post->email = Input::get('email');}

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';

				$post->address = 'NIL';
				$post->buildingname = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';

				$post->introducermemberid = Input::get('introducermemberid');
				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Participant";
				$post->ssagroupid = 0;
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = 'Interested';
				$post->uniquecode = uniqid('',TRUE);
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration (Student Division) - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else if(EventmRegistration::getEventMemberDuplicate($mid, EventmEvent::getid($id)) == false)
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->eventname = EventmEvent::geteventdescription(Input::get('eventid'));
				$post->personid = $member['personid'];
				$post->memberid = $mid;
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->positionlevel = $member['positionlevel'];
				$post->division = $member['division'];
				$post->nric = $member['nric'];
				$post->dateofbirth = $member['dateofbirth'];

				$post->tel = $member['tel'];
				$post->mobile = $member['mobile'];
				$post->email = $member['email'];

				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				$post->emergencytel = $member['emergencytel'];
				$post->emergencymobile = $member['emergencymobile'];

				$post->drugallergy = $member['drugallergy'];
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				
				$post->race = $member['race'];
				$post->gender = $member['gender'];

				$post->countryofbirth = $member['countryofbirth'];

				$post->address = $member['address'];
				$post->buildingname = $member['buildingname'];
				$post->unitno = $member['unitno'];
				$post->postalcode = $member['postalcode'];

				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Participant";
				$post->ssagroupid = 0;
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = 'Interested';
				$post->uniquecode = uniqid('',TRUE);
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getFriendshipMeetingIndex()
	{
		$view = View::make('eventregistration/eventfriendshipmeetingregistration');
		$view->title = 'Friendship Meeting Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$nfm_default=ConfigurationmDefault::where('key','Like','NFM')->lists('value','key');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$eventuniquecode = ConfigurationmDefault::NFMDefaultCode();
		$event_options = array('' => 'Please Select an Event') + EventmEvent::MemRegEvent()->orderBy('description', 'ASC')->lists('description', 'uniquecode');
		$view->with('event_options', $event_options)->with('rhq_options', $rhq_options)->with('nfm_default', $nfm_default)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options)->with('eventuniquecode', $eventuniquecode);
		return $view;
	}

	public function getStudentDivisionIndex()
	{
		$view = View::make('eventregistration/eventstudentdivisionregistration');
		$view->title = 'Student Division Event Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$groupcontact_options = array('' => 'N/A') + GroupzContactGroup::where('groupid', 3)->orderBy('valuename', 'ASC')->lists('valuename', 'value');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::MemRegEvent()->orderBy('description', 'ASC')->lists('description', 'uniquecode');
		$eventuniquecode = ConfigurationmDefault::SDRPDefaultCode();
		$view->with('event_options', $event_options)->with('rhq_options', $rhq_options)->with('eventuniquecode', $eventuniquecode)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options)->with('groupcontact_options', $groupcontact_options);
		return $view;
	}

	public function postAddMemberSD($id)
	{
		try
		{
			$mid = MembersmSSA::getid1(Input::get('memberid'));
			if (Input::get('memberid') == "") { $member = 0; }
			else {$member = MembersmSSA::find($mid)->toarray();}
			
			if (Input::get('memberid') == "")
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->eventname = EventmEvent::geteventdescription(Input::get('eventid'));
				$post->personid = 0;
				$post->memberid = 0;
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = $member['positionlevel'];
				$post->division = Input::get('division');
				$post->nric = Input::get('nric');

				if(Input::get('tel') == ''){$post->tel = 'NIL';} else {$post->tel = Input::get('tel');}
				if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
				if(Input::get('email') == ''){$post->email = 'NIL';} else {$post->email = Input::get('email');}

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';

				$post->address = 'NIL';
				$post->buildingname = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';

				$post->introducermemberid = Input::get('introducermemberid');
				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Participant";
				$post->ssagroupid = 3;
				$post->ssagroup = "Student Division";
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = 'Interested';
				$post->uniquecode = uniqid('',TRUE);
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration (Student Division) - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else if(EventmRegistration::getEventMemberDuplicate($mid, EventmEvent::getid($id)) == false)
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventid'));
				$post->eventname = EventmEvent::geteventdescription(Input::get('eventid'));
				$post->personid = $member['personid'];
				$post->memberid = $mid;
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->positionlevel = $member['positionlevel'];
				$post->division = $member['division'];
				$post->nric = $member['nric'];
				$post->dateofbirth = $member['dateofbirth'];

				$post->tel = $member['tel'];
				$post->mobile = $member['mobile'];
				$post->email = $member['email'];

				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				$post->emergencytel = $member['emergencytel'];
				$post->emergencymobile = $member['emergencymobile'];

				$post->drugallergy = $member['drugallergy'];
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				
				$post->race = $member['race'];
				$post->gender = $member['gender'];

				$post->countryofbirth = $member['countryofbirth'];

				$post->address = $member['address'];
				$post->buildingname = $member['buildingname'];
				$post->unitno = $member['unitno'];
				$post->postalcode = $member['postalcode'];

				$post->introducer = Input::get('introducername');
				if(Input::get('introducermobile') == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = Input::get('introducermobile');}

				$post->role = "Participant";
				$post->ssagroupid = 3;
				$post->ssagroup = "Student Division";
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->status = 'Interested';
				$post->uniquecode = uniqid('',TRUE);
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getConcertIndex()
	{
		$view = View::make('eventregistration/eventconcertregistration');
		$view->title = 'Concert Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$groupcontact_options = array('' => 'N/A') + GroupzContactGroup::where('groupid', 3)->orderBy('valuename', 'ASC')->lists('valuename', 'value');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::MemRegEvent()->orderBy('description', 'ASC')->lists('description', 'uniquecode');
		$eventuniquecode = ConfigurationmDefault::NFMDefaultCode();
		$view->with('event_options', $event_options)->with('rhq_options', $rhq_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('eventuniquecode', $eventuniquecode)
			->with('memposition_options', $memposition_options)->with('groupcontact_options', $groupcontact_options);
		return $view;
	}

	public function getndp2021Index()
	{
		$view = View::make('eventregistration/eventndpregistration');
		$view->title = 'NDP 2021 Registration';
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::orderBy('code', 'ASC')->lists('name', 'code');
		$country_options = array('' => 'Please Select a Country') + EventzCountry::lists('value', 'value');
		$view->with('rhq_options', $rhq_options)->with('country_options', $country_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options);
		return $view;
	}

	public function postAuthorizationCheck()
	{
		try
		{
			$eventid = ConfigurationmDefault::NDPDefaultCode();
			
			if (EventmRegistration::getEventAuthorizationCheckCount(EventmEvent::getid($eventid), Input::get('auditioncode'), Input::get('mobile')) == 1)
			{
				$eventregid = EventmRegistration::getEventAuthorizationCheckCountEventRegID(EventmEvent::getid($eventid), Input::get('auditioncode'), Input::get('mobile'));
				$searchresult = EventmRegistration::findorfail($eventregid, array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'positionlevel', 'dateofbirth', 'tel', 'mobile', 'email', 'address', 'buildingname', 'unitno', 'postalcode', 'occupation', 'bloodgroup', 'countryofbirth', 'nationality'));
				return Response::json($searchresult, 200);
			}
			else 
			{ 
				$eventid = ConfigurationmDefault::NDPDefaultCode();

				LogsfLogs::postLogs('Create', 28, EventmEvent::getid($eventid), ' - Event NDP Registration - Authorization Check Failed - ' . Input::get('auditioncode'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Failed'), 400); 
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event NDP Registration - Authorization Check Failed - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postPostalSearch()
	{
		try
		{
			$searchresult = ConfigurationmBuildingPostal::findorfail(ConfigurationmBuildingPostal::getid(Input::get('postalcode')), array('bldgno', 'streetname', 'bldgname'));
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event NDP Registration - Postal Code Search Failed - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postNDPMember()
	{
		try
		{
			if(EventmRegistration::getCheckSignature(EventmRegistration::getid(Input::get('memberid'))) == false)
			{
				$post = EventmRegistration::find(EventmRegistration::getid(Input::get('memberid')));
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = Input::get('positionlevel');
				$post->division = Input::get('division');

				$post->nric = Input::get('nric');
				$post->dateofbirth = Input::get('dateofbirth');
				$post->address = Input::get('address');
				if(Input::get('buildingname') == ''){$post->buildingname = 'NIL';} else {$post->buildingname = Input::get('buildingname');}
				$post->unitno = Input::get('unitno');
				$post->postalcode = Input::get('postalcode');

				$post->tel = Input::get('tel');
				$post->mobile = Input::get('mobile');
				$post->email = Input::get('email');

				$post->emergencyname = Input::get('emergencyname');
				$post->emergencyrelationship = Input::get('emergencyrelationship');
				$post->emergencymobile = Input::get('emergencymobile');
				
				$post->countryofbirth = Input::get('countryofbirth');
				$post->nationality = Input::get('nationality');

				$post->danceexperience = Input::get('danceexperience');
				$post->dancetype = Input::get('dancetype');
				$post->height = Input::get('height');

				$post->drugallergy = Input::get('drugallergy');
				$post->hypertension = Input::get('hypertension');
				$post->heartdisease = Input::get('heartdisease');
				$post->longtermmedication = Input::get('longtermmedication');
				$post->asthmahistory = Input::get('asthmahistory');
				$post->goodhealth = Input::get('goodhealth');

				$post->vaccinewillingtake = Input::get('vaccinewillingtake');
				$post->vaccinetaken = Input::get('vaccinetaken');
				$post->vaccineschedule = Input::get('vaccineschedule');
				$post->vaccinefirstdose = Input::get('vaccinefirstdose');
				$post->vaccineseconddose = Input::get('vaccineseconddose');
				$post->vaccineotherpast = Input::get('vaccineotherpast');
				$post->vaccineotherdate = Input::get('vaccineotherdate');
				$post->vaccineseverlyimmunocompromised = Input::get('vaccineseverlyimmunocompromised');
				$post->vaccinehistoryofanaphylaxissevereallergise = Input::get('vaccinehistoryofanaphylaxissevereallergise');
				$post->vaccineconsent = Input::get('vaccineconsent');
				
				$post->pregnant = Input::get('pregnant');
				$post->conceivenextsixmonths = Input::get('conceivenextsixmonths');
				
				$post->signature = Input::get('signature');
				$post->signaturesigned = date('Y-m-d H:i:s');

				$post->commitwedsat = Input::get('commitwedsat');
				$post->travelperiod = Input::get('travelperiod');
				$post->occupation = Input::get('occupation');

				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 28, 0, ' - Event Member Registration - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 28, EventmRegistration::getid(Input::get('memberid')), ' - Event Member Registration - Already Signed', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'AlreadySigned'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Member Registration - New Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}