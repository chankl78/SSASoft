<?php
class GroupDetailController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'group/group');
		Session::put('current_resource', 'GRPS');
		$REGP03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'create');
		$REGP04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create');
		$REGP05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP05', 'read');
		$REGP01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP01', 'read');
		$REGP02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'read');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$pagetitle = GroupmGroup::getgroupnamepart($id);
		$view = View::make('group/groupdetail');
		$query = GroupmGroup::where('uniquecode', '=', $id)->get();
		$status_options = GroupzStatus::Role()->lists('value', 'value');
		$memberstatus_options = GroupzMemberStatus::Role()->lists('value', 'value');
		$grouptype_options = GroupzGroupType::Role()->lists('value', 'value');
		$divisiontype_options = GroupzDivisionType::Role()->lists('value', 'value');
		$position_options = GroupzPosition::Role()->Group($id)->lists('value', 'value');
		$contactgroup_options = GroupzContactGroup::Role()->Group($id)->lists('value', 'value');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()
			->orderBy('description', 'ASC')->lists('description', 'description');
		$group_options = array('' => 'Please Select an Group') + GroupmGroup::ActiveStatus()
			->orderBy('name', 'ASC')->lists('name', 'name');
		$role_options = array('' => 'Please Select an role') +  EventzRole::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$view->title = $pagetitle;
		$view->with('REGP03A', $REGP03A)->with('rid', $id)->with('result', $query)
			->with('REGP05R', $REGP05R)->with('REGP01R', $REGP01R)->with('REGP04A', $REGP04A)->with('divisiontype_options', $divisiontype_options)
			->with('REGP02R', $REGP02R)->with('memberstatus_options', $memberstatus_options)->with('role_options', $role_options)
			->with('status_options', $status_options)->with('position_options', $position_options)
			->with('grouptype_options', $grouptype_options)->with('REEVGKA', $REEVGKA)->with('event_options', $event_options)
			->with('pagetitle', $pagetitle)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)
			->with('chapter_options', $chapter_options)->with('memposition_options', $memposition_options)->with('group_options', $group_options)
			->with('contactgroup_options', $contactgroup_options)->with('division_options', $division_options);
		return $view;
	}

	public function getMemberListing($id)
	{
		try
		{
			$default =  GroupmMember::Group(GroupmGroup::getid($id))->StatusActive()->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Member Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberListingOthers($id)
	{
		try
		{
			$default =  GroupmMember::Group(GroupmGroup::getid($id))->StatusOthers()->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Member Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberGroupInfo($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupmMember::MemberGroup(GroupmMember::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupmMember::MemberGroup(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  GroupmMember::MemberGroup(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get()->toarray();
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
			$iTotalRecords = EventmRegistration::GroupMemberMedicalRemarksByIndividual(GroupmMember::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::GroupMemberMedicalRemarksByIndividual(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  EventmRegistration::GroupMemberMedicalRemarksByIndividual(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')
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
			$iTotalRecords = EventmRegistration::GroupMemberAllergyByIndividual(GroupmMember::getmemberid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::GroupMemberAllergyByIndividual(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  EventmRegistration::GroupMemberAllergyByIndividual(GroupmMember::getmemberid($id))->Search('%'.$sSearch.'%')
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

	public function getMemberGroupPositionHistory($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupmMemberPosition::where('groupmemberid', GroupmMember::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupmMemberPosition::where('groupmemberid', GroupmMember::getid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  GroupmMemberPosition::where('groupmemberid', GroupmMember::getid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'position', 'appointeddate', 'graduateddate', 'uniquecode'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Group Position History [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getGroupEventListing($id)
	{
		try
		{
			$eventgroup = EventmGroup::where('groupid', GroupmGroup::getid($id))->get(array('eventid'))->toarray();
			$eventgrouplist = array();
			foreach($eventgroup as $eventgroup){
				$eventgrouplist[] = $eventgroup['eventid'];
			}

			if (EventmGroup::where('groupid', GroupmGroup::getid($id))->count() == 0)
			{
				$eventgrouplist[] = 0;
			}

			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmEvent::Role()->whereIn('id', $eventgrouplist)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmEvent::Role()->whereIn('id', $eventgrouplist)->Search('%'.$sSearch.'%')->count();
		    $default = EventmEvent::Role()->whereIn('id', $eventgrouplist)->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Group Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getGroupAttendanceListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::Role()->where('groupid', GroupmGroup::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::Role()->where('groupid', GroupmGroup::getid($id))->SearchAll('%'.$sSearch.'%')->count();
		    $default = AttendancemAttendance::Role()->where('groupid', GroupmGroup::getid($id))->SearchAll('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)->orderBy($sOrderBy, $sOrderdir)->get(array('description', 'attendancetype', 'attendancedate', 'status', 'uniquecode'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Group Attendance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getGroupPreMADKebshuListing($id)
	{
		try {
			$default = MembersmSSA::MADGroupEligibleMembership($id)->get();
			return Response::json(array( 'data' => $default));
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Group Pre Kenshu Eligible Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putMemberInfo($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'update') == 't')
		{
			try
			{
				$post = MembersmSSA::find(GroupmMember::getmemberid($id));
				$post->emergencyname = Input::get('tbemergencyname');
				$post->emergencyrelationship = Input::get('tbemergencyrelationship');
				if(Input::get('tbemergencytel') == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = Input::get('tbemergencytel');}
				if(Input::get('tbemergencymobile') == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = Input::get('tbemergencymobile');}
				$post->bloodgroup = Input::get('tbbloodgroup');
				$post->nationality = Input::get('tbnationality');
				$post->countryofbirth = Input::get('tbcountryofbirth');
				$post->race = Input::get('tbrace');
				$post->occupation = Input::get('tboccupation');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 45, 0, ' - Group - Update Member Info SSA' + $id + ' ' + Input::get('ename'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 45, $id, ' - Group - Update Member Info SSA - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 45, 0, ' - Group Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getMemberInfo($id)
	{
		try
		{
			$member=MembersmSSA::find(GroupmMember::getmemberid($id))->toarray();
			$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);

			$memberemail = "";
			if ($member['email'] == 'NIL') { $memberemail = ""; } else { $memberemail = $member['email']; }
			return Response::json(array(
				'name' => $member['name'], 
				'rhq' => $member['rhq'], 
				'zone' => $member['zone'], 
				'chapter' => $member['chapter'], 
				'district' => $member['district'], 
				'position' => $member['position'], 
				'division' => $member['division'], 
				'discussionmeetingday' => $discussionmeetingday,
				'nric' => $member['nric'],
				'dateofbirth' => $member['dateofbirth'],
				'email' => $memberemail,
				'tel' => $member['tel'],
				'mobile' => $member['mobile'],
				'bloodgroup' => $member['bloodgroup'],
				'nationality' => $member['nationality'],
				'countryofbirth' => $member['countryofbirth'],
				'race' => $member['race'],
				'occupation' => $member['occupation'],
				'emergencyname' => $member['emergencyname'],
				'emergencyrelationship' => $member['emergencyrelationship'],
				'emergencytel' => $member['emergencytel'],
				'emergencymobile' => $member['emergencymobile']
				), 200);
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 45, 0, ' - Groups Members - ' . $id. $member['name'] . ' - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			$searchresult = MembersmSSA::findorfail(MembersmSSA::getid1(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    
		    LogsfLogs::postLogs('Read', 28, $id, ' - Group - NRIC Search - ' . md5(Input::get('nricsearch')), NULL, NULL, 'Success');
		    return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, $id, ' - Group - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postAddNewMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create') == 't')
		{
			try
			{
				// Add to Members_m_SSA
				$mssa = new MembersmSSA;
				$mssa->dateofbirth = Input::get('dateofbirth');
				$mssa->name = Input::get('membername');
				$mssa->nric = Input::get('nric');
				$mssa->nrichash = md5(Input::get('nric'));
				$mssa->searchcode = substr(Input::get('nric'), 1, 3);
				$mssa->position = Input::get('position');
				$mssa->personid = 0;
				$mssa->rhq = Input::get('rhq');
				$mssa->zone = Input::get('zone');
				$mssa->chapter = Input::get('chapter');
				$mssa->district = Input::get('district');
				$mssa->position = Input::get('position');
				$mssa->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
				$mssa->division = Input::get('division');
				$mssa->uniquecode = uniqid('',TRUE);
				$mssa->source = 'GRPS';
				$mssa->resourcefromid = GroupmGroup::getid(Input::get('groupid'));

				if(Input::get('tel') == ''){$mssa->tel = 'NIL';} else {$mssa->tel = Input::get('tel');}
				if(Input::get('mobile') == ''){$mssa->mobile = 'NIL';} else {$mssa->mobile = Input::get('mobile');}
				if(Input::get('email') == ''){$mssa->email = 'NIL';} else {$mssa->email = Input::get('email');}
				$mssa->introducermobile = 'NIL';

				$mssa->emergencytel = 'NIL';
				$mssa->emergencymobile = 'NIL';

				$mssa->address = 'NIL';
				$mssa->buildingname = 'NIL';
				$mssa->unitno = 'NIL';
				$mssa->postalcode = 'NIL';
				$mssa->save();

				if($mssa->save())
				{
					$member = MembersmSSA::find($mssa->id)->toarray();
					if(GroupmMember::getFindDuplicateValue($mssa->id, GroupmGroup::getid(Input::get('groupid'))) == false)
					{
						$post = new GroupmMember;
						$post->enrolleddate = date('Y-m-d');
						$post->name = Input::get('membername');
						$post->position = 'Member';
						$post->contactgroup = Input::get('contactgroup');
						$post->personid = $member['personid'];
						$post->memberid = $mssa->id;
						$post->rhq = $member['rhq'];
						$post->zone = $member['zone'];
						$post->chapter = $member['chapter'];
						$post->district = $member['district'];
						$post->positionorg = $member['position'];
						$post->division = $member['division'];
						$post->groupid = GroupmGroup::getid(Input::get('groupid'));
						$post->groupname = Input::get('name');
						$post->uniquecode = uniqid('',TRUE);
						$post->save();

						if($post->save())
						{
							$mssau = MembersmSSA::find($mssa->id);
							$mssau->uniquecode = uniqid('',TRUE);
							$mssau->resourcefromdetailid = $post->id;
							$mssau->save();

							try
							{
								if(GroupmMemberPosition::getFindDuplicateValue($mssa->id, 'Member') == false)
								{	
									$post1 = new GroupmMemberPosition;
									$post1->appointeddate = date('Y-m-d');
									$post1->groupmemberid = $post->id;
									$post1->position = 'Member';
									$post1->uniquecode = date('YmdHis');
									$post1->save();

									if($post1->save())
									{
										// LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('membername') . ' - ' . Input::get('position'), NULL, NULL, 'Success');
									}
									else
									{
										LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('position'), NULL, NULL, 'Failed');
									}
								}
								else
								{
									LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - Failed to Save (Duplicate)', NULL, NULL, 'Failed');
								}
							}
							catch(\Exception $e)
							{
								LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - ' . $e, NULL, NULL, 'Failed');
							}
							LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
							return Response::json(array('info' => 'Success'), 200);
						}
						else
						{
							LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - Failed to Save', NULL, NULL, 'Failed');
							return Response::json(array('info' => 'Duplicate'), 400);
						}
					}
					else
					{
						LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
					}
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getApplicationPrint($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'print') == 't')
			{
				$value = $id;
				$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
				$postdelete->Delete();

				$eventmemberlist = MembersmSSA::where('id', GroupmMember::getmemberid($id))->get()->toarray();
				
				foreach($eventmemberlist as $eventmemberlist)
				{	
					if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
					if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
					if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
					if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
					if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
					if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
					if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} 
					else 
					{
						$leng = strlen($eventmemberlist['nric']) - 4;
						$enric = 'XXXXX' . substr($eventmemberlist['nric'], $leng);
					}
					if ($eventmemberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $eventmemberlist['address'];}
					if ($eventmemberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $eventmemberlist['buildingname'];}
					if ($eventmemberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $eventmemberlist['unitno'];}
					if ($eventmemberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $eventmemberlist['postalcode'];}
					$insert[] = array(
				        'userid' => Auth::user()->id,
				        'resourceid' => GroupmMember::getid($id),
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
				
				LogsfLogs::postLogs('Print', 44, $id, ' - Group - Print Hardcopy - ' . $id, NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 44, 0, ' - Group - Print Hardcopy - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}

		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 44, 0, ' - Group - Print Hardcopy - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGroupMembersRegistrationFormActivePrint($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'print') == 't')
			{
				$value = $id;
				$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
				$postdelete->Delete();

				$groupmemberlist = GroupmMember::where('groupid', GroupmGroup::getid(Input::get('groupid')))->where('status', 'Active')->get()->toarray();
				
				foreach($groupmemberlist as $groupmemberlist)
				{	
					$eventmemberlist = MembersmSSA::where('id', $groupmemberlist['memberid'])->get()->toarray();

					foreach($eventmemberlist as $eventmemberlist)
					{
						if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
						if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
						if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
						if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
						if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
						if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
						if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} 
						else 
						{
							$leng = strlen($eventmemberlist['nric']) - 4;
							$enric = 'XXXXX' . substr($eventmemberlist['nric'], $leng);
						}
						if ($eventmemberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $eventmemberlist['address'];}
						if ($eventmemberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $eventmemberlist['buildingname'];}
						if ($eventmemberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $eventmemberlist['unitno'];}
						if ($eventmemberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $eventmemberlist['postalcode'];}
						
						$insert[] = array(
					        'userid' => Auth::user()->id,
					        'resourceid' => GroupmGroup::getid(Input::get('groupid')),
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
				}

				DB::table('Print_m_Print')->insert($insert);
				
				LogsfLogs::postLogs('Print', 44, $id, ' - Group - Print Hardcopy For All Active Members - ' . $id, NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 44, 0, ' - Group - Print Hardcopy For All Active Members - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}

		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 44, 0, ' - Group - Print Hardcopy For All Active Members - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getMemberNric()
	{
		$member=MembersmSSA::where('nric', Input::get('namesearch'))->get(array('nric'))->toarray();
		return Response::json($member, 200);
	}

	public function getNameSearch()
	{
		$membercode = Input::get('term');
		$member = MembersmSSA::where('name','LIKE','%'. $membercode .'%')->orwhere('nric', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'nric', 'name', 'alias', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode', 'mobile'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['nric'], 'label'=>$member['name'].' - '.$member['alias'].' - '.$member['uniquecode'].', '.$member['rhq'].', '.$member['zone'].', '.$member['chapter'].', '.$member['district'].', '.$member['position'].' - '.$member['mobile'], 'value' => $member['uniquecode']);
		}
		return Response::json($memberlist);
	}

	public function postAddMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('enrolleddate'));
				$mid = MembersmSSA::getid1(Input::get('memberid'));
				$member = MembersmSSA::find($mid)->toarray();
				if(GroupmMember::getFindDuplicateValue($mid, GroupmGroup::getid(Input::get('groupid'))) == false)
				{
					$post = new GroupmMember;
					$post->enrolleddate = $datDate;
					$post->name = Input::get('membername');
					$post->position = Input::get('position');
					$post->contactgroup = Input::get('contactgroup');
					$post->personid = $member['personid'];
					$post->memberid = $mid;
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->positionorg = $member['position'];
					$post->positionlevelorg = $member['positionlevel'];
					$post->division = $member['division'];
					$post->groupid = GroupmGroup::getid(Input::get('groupid'));
					$post->groupname = Input::get('name');
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						try
						{
							if(GroupmMemberPosition::getFindDuplicateValue($mid, Input::get('position')) == false)
							{	
								$post1 = new GroupmMemberPosition;
								$post1->appointeddate = $datDate;
								$post1->groupmemberid = $post->id;
								$post1->position = Input::get('position');
								$post1->uniquecode = uniqid('',TRUE);
								$post1->save();

								if($post1->save())
								{
									LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('membername') . ' - ' . Input::get('position'), NULL, NULL, 'Success');
								}
								else
								{
									LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('position'), NULL, NULL, 'Failed');
								}
								// LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - Step 1', NULL, NULL, 'Failed');
							}
							else
							{
								LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - Failed to Save (Duplicate)', NULL, NULL, 'Failed');
							}
						}
						catch(\Exception $e)
						{
							LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - ' . $e, NULL, NULL, 'Failed');
						}
						LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteMember($id)
	{
		try
		{
			$post = GroupmMember::find(GroupmMember::getid($id));
			$post->Delete();

			$post1 = GroupmMemberPosition::where('groupmemberid', GroupmMember::getid($id));
			$post1->Delete();

			LogsfLogs::postLogs('Delete', 45, $id, ' - Group - Member - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 45, $id, ' - Group - Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getMemberPositionListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupmMemberPosition::MemberGroup(GroupmMember::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupmMemberPosition::MemberGroup(GroupmMember::getid($id))->Search('%'.$sSearch.'%')->count();
		    $default =  GroupmMemberPosition::MemberGroup(GroupmMember::getid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get()->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Group - Member Position Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberDetailInfo($id)
	{
		try
		{
			$member=GroupmMember::find(GroupmMember::getid($id))->toarray();

			return Response::json(array(
				'graduationdate' => $member['graduationdate'],
				'remark' => $member['remark']
				), 200);
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Groups Members Detail - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putGroupMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('eenrolleddate'));
				$datGraduationDate = DateTime::createFromFormat('d-m-Y', Input::get('egraduationdate'));
				$post = GroupmMember::find(GroupmMember::getid(Input::get('emoduledetailid')));
				$post->enrolleddate = $datDate;
				if (Input::get('egraduationdate') == '') { $post->graduationdate = ''; }
				else { $post->graduationdate = $datGraduationDate; }
				$post->name = Input::get('ename');
				$post->position = Input::get('egrpposition');
				$post->contactgroup = Input::get('egrpcontactgroup');
				$post->status = Input::get('estatus');
				$post->remark = Input::get('eremarks');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 45, 0, ' - Group - Update Group Member' + $id + ' ' + Input::get('ename'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 45, $id, ' - Group - Update Group Member - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 45, 0, ' - Group Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getMemberDetailOthersInfo($id)
	{
		try
		{
			$member=GroupmMember::find(GroupmMember::getid($id))->toarray();

			return Response::json(array(
				'remark' => $member['remark']
				), 200);
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Groups Members Detail - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putGroupMemberOthers($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('eoenrolleddate'));
				$datGraduationDate = DateTime::createFromFormat('d-m-Y', Input::get('eograduationdate'));
				$post = GroupmMember::find(GroupmMember::getid($id));
				$post->enrolleddate = $datDate;
				if (Input::get('eograduationdate') == '') { $post->graduationdate = null; }
				else { $post->graduationdate = $datGraduationDate; }
				$post->name = Input::get('eoname');
				$post->position = Input::get('eogropposition');
				$post->status = Input::get('eostatus');
				$post->remark = Input::get('eoremarks');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 45, 0, ' - Group - Update Group Member (Others)' + $id + ' ' + Input::get('eoname'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 45, $id, ' - Group - Update Group Member (Others) - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 45, 0, ' - Group Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postforwardparticipanttoevent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create') == 't')
		{
			try // I need to create error trapping for duplicate same member in event
			{
				$mid = GroupmMember::getid($id);
				$member = MembersmSSA::find(GroupmMember::getmemberid($id))->toarray();
				$groupmember = GroupmMember::find(GroupmMember::getid($id))->toarray();
				$forwardeventid = EventmEvent::getforwardid(Input::get('eventforward'));
				$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
				if(EventmRegistration::getGroupMemberForwardDuplicate($member['id'], $forwardeventid) == false)
				{
					$post = new EventmRegistration;
					$post->eventid = $forwardeventid;
					$post->eventname = Input::get('eventforward');
					$post->personid = $member['personid'];
					$post->memberid = $member['id'];
					$post->name = $member['name'];
					$post->chinesename = $member['chinesename'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->discussionmeetingday = $discussionmeetingday;
					$post->nric = $member['nric'];
					$post->nrichash = md5($member['nric']);
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
					$post->occupation = $member['occupation'];
					
					$post->race = $member['race'];
					$post->gender = $member['gender'];

					$post->countryofbirth = $member['countryofbirth'];

					$post->address = $member['address'];
					$post->buildingname = $member['buildingname'];
					$post->unitno = $member['unitno'];
					$post->postalcode = $member['postalcode'];

					$post->introducermobile = $member['introducermobile'];

					$post->role = Input::get('role');
					$post->ssagroup = Input::get('name');
					$post->ssagroupid = $groupmember['groupid'];
					$post->ssagroupcontact = $groupmember['contactgroup'];
					$post->status = "Accepted";
					$post->uniquecode = uniqid('',TRUE);

					if (Input::get('grouptype') == 'Comm Svs')
					{
						$post->groupcode = $groupmember['position'];
						$post->auditioncode = $groupmember['contactgroup'];
					}

					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - Forward Member to Event - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 45, 0, ' - Group - Forward Member to Event - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 45, 0, ' - Group - Forward Member to Event Duplicate Value - ' . $member['name'], NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 45, 0, ' - Group - Forward Member to Event - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 45, 0, ' - Group - Forward Member to Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postforwardparticipanttogroup($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create') == 't')
		{
			try
			{
				$datDate = date('Y-m-d H:i:s');
				$forwardgroupid = GroupmGroup::getidbyname(Input::get('groupforward'));
				$member = MembersmSSA::find(GroupmMember::getmemberid(Input::get('groupdetailid')))->toarray();
				if(GroupmMember::getFindDuplicateValue($member['id'], $forwardgroupid) == false)
				{
					$post = new GroupmMember;
					$post->enrolleddate = $datDate;
					$post->name = $member['name'];
					$post->position = 'Member';
					$post->personid = $member['personid'];
					$post->memberid = $member['id'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->positionorg = $member['position'];
					$post->positionlevelorg = $member['positionlevel'];
					$post->division = $member['division'];
					$post->groupid = $forwardgroupid;
					$post->groupname = Input::get('groupforward');
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						try
						{
							if(GroupmMemberPosition::getFindDuplicateValue($member['id'], 'Member') == false)
							{	
								$post1 = new GroupmMemberPosition;
								$post1->appointeddate = $datDate;
								$post1->groupmemberid = $post->id;
								$post1->position = 'Member';
								$post1->uniquecode = uniqid('',TRUE);
								$post1->save();

								if($post1->save())
								{
									LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('membername') . ' - ' . Input::get('position'), NULL, NULL, 'Success');
								}
								else
								{
									LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member Position - ' . Input::get('position'), NULL, NULL, 'Failed');
								}
								// LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - Step 1', NULL, NULL, 'Failed');
							}
							else
							{
								LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - Failed to Save (Duplicate)', NULL, NULL, 'Failed');
							}
						}
						catch(\Exception $e)
						{
							LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Position - ' . $e, NULL, NULL, 'Failed');
						}
						LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member - ' . $member['name'], NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postUniqueCode($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'update') == 't')
		{
			try
			{
				$moduledetail = GroupmMember::where('groupid', GroupmGroup::getid($id))->get(array('id'))->toarray();

				foreach($moduledetail as $moduledetail)
				{
					$post = GroupmMember::find($moduledetail['id']);
					$post->uniquecode = uniqid('', TRUE);
					$post->save();
				}

				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Unique Code - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postMassImporttoEvent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'create') == 't') 
		{
			$modulelist = GroupmMember::where('groupid', GroupmGroup::getid($id))->where('status', 'Active')->get(array('id','memberid'))->toarray();
			$forwardeventid = EventmEvent::getforwardid(Input::get('eventforward'));
			$groupname = GroupmGroup::getnamebyid(GroupmGroup::getid($id));

			foreach ($modulelist as $modulelist) 
			{
				try {
					$member = MembersmSSA::find($modulelist['memberid'])->toarray();
					$groupmember = GroupmMember::find( $modulelist['id'])->toarray();
					$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
					if (EventmRegistration::getEventMemberDuplicate($modulelist['memberid'], $forwardeventid) == false)
					{
						$post = new EventmRegistration;
						$post->eventid = $forwardeventid;
						$post->eventname = Input::get('eventforward');
						$post->personid = $member['personid'];
						$post->memberid = $member['id'];
						$post->name = $member['name'];
						$post->chinesename = $member['chinesename'];
						$post->rhq = $member['rhq'];
						$post->zone = $member['zone'];
						$post->chapter = $member['chapter'];
						$post->district = $member['district'];
						$post->position = $member['position'];
						$post->positionlevel = $member['positionlevel'];
						$post->division = $member['division'];
						$post->discussionmeetingday = $discussionmeetingday;
						$post->nric = $member['nric'];
						$post->nrichash = $member['nrichash'];
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

						$post->introducermobile = $member['introducermobile'];

						$post->role = Input::get('role');
						$post->ssagroup = $groupname;
						$post->ssagroupid = $groupmember['groupid'];
						$post->ssagroupcontact = $groupmember['contactgroup'];
						$post->status = "Accepted";
						$post->uniquecode = uniqid('', TRUE);

						if (Input::get('grouptype') == 'Comm Svs') 
						{
							$post->groupcode = $groupmember['position'];
							$post->auditioncode = $groupmember['contactgroup'];
						}
						$post->save();
					} 
					else 
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
					}
				} catch (\Exception $e) 
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
				}
			}
		} 
		else 
		{
			LogsfLogs::postLogs('Update', 45, 0, ' - Event - Forward Member to Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postGroupMembersListingPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 45, Input::get('groupid'), ' - Group - Print Group Members Listing', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 45, 0, ' - Group - Print Group Members Listing - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGroupMembersListingWithContactsPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = GroupmMember::where('groupid', GroupmGroup::getid($id))
				->get(array('memberid'))->toarray();

			foreach($eventmemberlist as $eventmemberlist)
			{
				$groupmemberlist[] = $eventmemberlist['memberid'];
			}

			$string = implode(',', $groupmemberlist);
			$memberlist = MembersmSSA::whereIn('id', $groupmemberlist)->get();
			
			foreach($memberlist as $memberlist)
			{
				if ($memberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $memberlist['tel'];}
				if ($memberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $memberlist['mobile'];}
				if ($memberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $memberlist['email'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => GroupmGroup::getid($id),
			        'resourcecodeid' => $memberlist['id'],
			        'string1' => $etel,
			        'string2' => $emobile,
			        'string3' => $eemail,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 45, Input::get('groupid'), ' - Group - Print Group Members Listing With Contacts', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 45, 0, ' - Group - Print Group Members Listing With Contacts - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGroupMembersListingWithSensitiveDataPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = GroupmMember::where('groupid', GroupmGroup::getid($id))
				->get(array('memberid'))->toarray();

			foreach($eventmemberlist as $eventmemberlist)
			{
				$groupmemberlist[] = $eventmemberlist['memberid'];
			}

			$string = implode(',', $groupmemberlist);
			$memberlist = MembersmSSA::whereIn('id', $groupmemberlist)->get();
			
			foreach($memberlist as $memberlist)
			{
				if ($memberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $memberlist['tel'];}
				if ($memberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $memberlist['mobile'];}
				if ($memberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $memberlist['email'];}
				if ($memberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $memberlist['emergencytel'];}
				if ($memberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $memberlist['emergencymobile'];}
				if ($memberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $memberlist['introducermobile'];}
				if ($memberlist['nric'] == 'NIL') {$enric = NULL;} else {$enric = $memberlist['nric'];}
				if ($memberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $memberlist['address'];}
				if ($memberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $memberlist['buildingname'];}
				if ($memberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $memberlist['unitno'];}
				if ($memberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $memberlist['postalcode'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => GroupmGroup::getid($id),
			        'resourcecodeid' => $memberlist['id'],
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

			LogsfLogs::postLogs('Print', 45, Input::get('groupid'), ' - Group - Print Group Members Listing With Sensitive Data', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 45, 0, ' - Group - Print Group Members Listing With Sensitive Data - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}