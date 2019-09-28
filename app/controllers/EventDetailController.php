<?php
class EventDetailController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'event/event');
		Session::put('current_resource', 'EVEN');
		$REEV06A = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV06', 'create');
		$REEV04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV04', 'create');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$REEV01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV01', 'read');
		$REEV02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV02', 'read');
		$REEVRAR = AccessfCheck::getResourceAdministratorReport();
		$REEVRRR = AccessfCheck::getResourceEventRoleReport();
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$REEVIRR = AccessfCheck::getResourceEventItemRoleReport();
		$REGPRRR = AccessfCheck::getResourceGroupRoleReport();
		$REEV07R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV07', 'read');
		$REEV07A = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV07', 'create');
		$REEV08R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV08', 'read');
		$view = View::make('event/eventdetail');
		$pagetitle = EventmEvent::geteventnamepart($id);
		$query = EventmEvent::Role()->where('uniquecode', '=', $id)->get();
		$role_options = EventzRole::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$roleabbv_options = EventzRole::Role()->orderBy('value', 'ASC')->lists('value', 'abbv');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()->orderBy('description', 'ASC')->lists('description', 'description');
		$commonstatus_options = CommonzStatus::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$eventtype_options = EventzEventType::Role()->lists('value', 'value');
		$divisiontype_options = CommonzDivisionType::Role()->lists('value', 'value');
		$eventregstatus_options = EventzRegistrationStatus::Role()->lists('value', 'value');
		$attendancetype_options = AttendancezType::Role()->lists('value', 'value');
		$groups_options = array('' => 'Please Select a Group') + GroupmGroup::Role()->orderBy('name', 'ASC')->lists('name', 'name');
		$ssaeventgroup_options = array('' => 'Please Select a Group') + EventmGroup::where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$ssaeventgroupprint_options = array('' => 'Please Select a Group') + EventmGroup::Role()
			->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitem_options = array('' => 'Please Select an Item') + EventmEventItem::where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitemprint_options = array('' => 'Please Select an Item') + EventmEventItem::Role()
			->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$view->title = $pagetitle;
		$view->with('REEV06A', $REEV06A)->with('rid', $id)->with('result', $query)->with('REEV02R', $REEV02R)
			->with('REEV05R', $REEV05R)->with('REEV01R', $REEV01R)->with('REEV04A', $REEV04A)->with('REEVRRR', $REEVRRR)
			->with('REEV07A', $REEV07A)->with('REEV07R', $REEV07R)->with('REEV08R', $REEV08R)->with('REEVRAR', $REEVRAR)
			->with('REGPRRR', $REGPRRR)->with('REEVIRR', $REEVIRR)->with('REEVGKA', $REEVGKA)
			->with('pagetitle', $pagetitle)->with('roleabbv_options', $roleabbv_options)
			->with('role_options', $role_options)->with('commonstatus_options', $commonstatus_options)
			->with('eventtype_options', $eventtype_options)->with('groups_options', $groups_options)
			->with('eventitem_options', $eventitem_options)->with('eventitemprint_options', $eventitemprint_options)
			->with('ssagroup_options', $ssaeventgroup_options)->with('ssagroupprint_options', $ssaeventgroupprint_options)
			->with('attendancetype_options', $attendancetype_options)->with('event_options', $event_options)
			->with('eventregstatus_options', $eventregstatus_options)->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getEventAccessRightsListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccessmUsers::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccessmUsers::Event($id)->Search('%'.$sSearch.'%', EventmEvent::getid($id))->count();
		    $default = AccessmUsers::Event($id)->Search('%'.$sSearch.'%', EventmEvent::getid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - User Access Rights Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postAccessRightsTrainer($id)
	{
		if (AccessfCheck::getResourceAccess(Auth::user()->roleid, 'EVEN', 'EV01', 'create') == 't')
		{
			try
			{
				$mid = EventmRegistration::getmemberid($id);
				$member = MembersmSSA::find($mid)->toarray();
				$er = EventmRegistration::find(EventmRegistration::getid($id))->toarray();
				if(AccessmUsers::getFindDuplicateValue($member['email']) == false)
				{
					$post = new AccessmUsers;
					$post->memberid = $member['id'];
					$post->username = $member['email'];
					$post->password = Hash::make($member['mobile']);
					$post->name = $member['name'];
					$post->tel = $member['tel'];
					$post->mobile = $member['mobile'];
					$post->email = $member['email'];
					$post->roleid = 'Event Trainer';
					$post->uniquecode = date('YmdHis');
					$post->firstlogin = 0;

					$post->save();

					if($post->save())
					{
						$q = $post->id;
						$post1 = new AccessmAccessRights;
						$post1->resourcegroup = 'EVEN'; $post1->resourcecode = 'EV03';
						$post1->userid = $q; $post1->uniquecode = date('YmdH') . RAND(0000, 9999);
						$post1->eventid = $er['eventid']; $post1->eventitem = $er['eventitem'];
						$post1->accesstypeid = 2; $post1->resourceid = 27;
						$post1->create = 0; $post1->read = 1; $post1->update = 0; $post1->delete = 0;
						$post1->void = 0; $post1->unvoid = 0; $post1->print = 0;
						$post1->startdate = '0000-00-00'; $post1->enddate = '0000-00-00';
						$post1->starttime = '00:00:00'; $post1->endtime = '00:00:00';
						$post1->save();

						$post1 = new AccessmAccessRights;
						$post1->resourcegroup = 'EVEN'; $post1->resourcecode = 'EV04';
						$post1->userid = $q; $post1->uniquecode = date('YmdH') . RAND(0000, 9999);
						$post1->eventid = $er['eventid']; $post1->eventitem = $er['eventitem'];
						$post1->accesstypeid = 2; $post1->resourceid = 28;
						$post1->create = 0; $post1->read = 1; $post1->update = 0; $post1->delete = 0;
						$post1->void = 0; $post1->unvoid = 0; $post1->print = 0;
						$post1->startdate = '0000-00-00'; $post1->enddate = '0000-00-00';
						$post1->starttime = '00:00:00'; $post1->endtime = '00:00:00';
						$post1->save();

						$post1 = new AccessmAccessRights;
						$post1->resourcegroup = 'EVEN'; $post1->resourcecode = 'EV07';
						$post1->userid = $q; $post1->uniquecode = date('YmdH') . RAND(0000, 9999);
						$post1->eventid = $er['eventid']; $post1->eventitem = $er['eventitem'];
						$post1->accesstypeid = 2; $post1->resourceid = 52;
						$post1->create = 0; $post1->read = 1; $post1->update = 0; $post1->delete = 0;
						$post1->void = 0; $post1->unvoid = 0; $post1->print = 0;
						$post1->startdate = '0000-00-00'; $post1->enddate = '0000-00-00';
						$post1->starttime = '00:00:00'; $post1->endtime = '00:00:00';
						$post1->save();

						$post1 = new AccessmAccessRights;
						$post1->resourcegroup = 'EVEN'; $post1->resourcecode = 'EV08';
						$post1->userid = $q; $post1->uniquecode = date('YmdH') . RAND(0000, 9999);
						$post1->eventid = $er['eventid']; $post1->eventitem = $er['eventitem'];
						$post1->accesstypeid = 2; $post1->resourceid = 53;
						$post1->create = 0; $post1->read = 1; $post1->update = 1; $post1->delete = 0;
						$post1->void = 0; $post1->unvoid = 0; $post1->print = 0;
						$post1->startdate = '0000-00-00'; $post1->enddate = '0000-00-00';
						$post1->starttime = '00:00:00'; $post1->endtime = '00:00:00';
						$post1->save();

						LogsfLogs::postLogs('Create', 8, $post->id, ' - Access Rights - New User - ' . Input::get('attdescription'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - New User - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - New User - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - New User - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - New User - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			if (MembersmSSA::getcheckuniquecode(Input::get('nricsearch')) == true)
			{
				$searchresult = MembersmSSA::findorfail(MembersmSSA::getid1(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position', 'mmsuuid'));
			}
			elseif (MembersmSSA::getcheckmmsuuid(Input::get('nricsearch')) == true)
			{
				$searchresult = MembersmSSA::findorfail(MembersmSSA::getid1(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position', 'mmsuuid'));
			}
			else 
			{ 
				LogsfLogs::postLogs('Read', 28, $id, ' - Event - uniquecode / uuid Search - ' . Input::get('nricsearch'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
			}
			
		    LogsfLogs::postLogs('Read', 28, $id, ' - Event - uniquecode / uuid Search - ' . Input::get('nricsearch'), NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, $id, ' - Event - uniquecode / uuid Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
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
		$member = MembersmSSA::where('name','LIKE','%'. $membercode .'%')->orwhere('alias','LIKE','%'. $membercode .'%')->orwhere('uniquecode', 'Like', '%'. $membercode .'%')->orwhere('mmsuuid', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'uniquecode', 'name', 'alias', 'mmsuuid', 'mobile', 'tel', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['uniquecode'], 'label'=>$member['name'].' - '.$member['alias'].' - '.$member['rhq'].' - '.$member['zone'].' - '.$member['chapter'].' - '.$member['district'].' - '.$member['division'].' - '.$member['position'].' - '.$member['mobile'].' - '.$member['tel'].' - '.$member['uniquecode'], 'value' => $member['uniquecode']);
		}
		return Response::json($memberlist);
	}

	public function postAddMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV06', 'create') == 't')
		{
			try
			{
				$mid = MembersmSSA::getid1(Input::get('memberid'));
				$member = MembersmSSA::find($mid)->toarray();
				$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
				if(EventmRegistration::getEventMemberDuplicate($mid, EventmEvent::getid($id)) == false)
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

					$post->role = Input::get('arole');
					$post->ssagroupid = GroupmGroup::getidbyname(Input::get('assaeventgroup'));
					$post->ssagroup = Input::get('assaeventgroup');
					$post->ssagroupalllist = GroupmMember::getmembergroupall($mid);
					$post->auditioncode = Input::get('aauditioncode');
					$post->eventitem = Input::get('aeventitem');
					$post->uniquecode = uniqid('', TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postforwardparticipanttoevent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'create') == 't')
		{
			try
			{
				$mid = EventmRegistration::getid($id);
				$eventregistrationrecord = EventmRegistration::find($mid)->toarray();
				$member = MembersmSSA::find($eventregistrationrecord['memberid'])->toarray();
				$forwardeventid = EventmEvent::getforwardid(Input::get('eventforward'));
				if(EventmRegistration::getEventMemberDuplicate($member['id'], $forwardeventid) == false)
				{
					$post = new EventmRegistration;
					$post->eventid = $forwardeventid;
					$post->eventname= Input::get('eventforward');
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
					$post->occupation = $member['occupation'];
					
					$post->race = $member['race'];
					$post->gender = $member['gender'];

					$post->countryofbirth = $member['countryofbirth'];

					$post->address = $member['address'];
					$post->buildingname = $member['buildingname'];
					$post->unitno = $member['unitno'];
					$post->postalcode = $member['postalcode'];

					$post->introducer = $member['introducer'];
					$post->introducermobile = $member['introducermobile'];

					$post->role = "Participant";
					$post->ssagroupid = $eventregistrationrecord['ssagroupid'];
					$post->ssagroup = $eventregistrationrecord['ssagroup'];
					$post->eventregidforward = $eventregistrationrecord['id'];
					$post->eventidforward = $eventregistrationrecord['eventid'];
					if (Input::get('eventitemforward') == 1) { $post->eventitem = $eventregistrationrecord['eventname']; }
					else { $post->auditioncode = $eventregistrationrecord['eventitem']; }
					$post->status = "Accepted";
					$post->uniquecode = uniqid('', TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postUniqueCode($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'update') == 't')
		{
			try
			{
				$eventdetail = EventmRegistration::where('eventid', EventmEvent::getid($id))->get(array('id'))->toarray();

				foreach($eventdetail as $eventdetail)
				{
					$post = EventmRegistration::find($eventdetail['id']);
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

	public function postAttendanceAccessRights($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'update') == 't')
		{
			try
			{
				$moduledetail = AccessmAccessRights::where('userid', AccessmUsers::getuserid(Input::get('user')))->get(array('id'))->toarray();

				foreach($moduledetail as $moduledetail)
				{
					$post = AccessmAccessRights::find($moduledetail['id']);
					$post->eventid = EventmEvent::getid(Input::get('uniquecode'));
					$post->save();
				}

				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Access Rights - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Event - Update Access Rights - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postAllLeaders($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'create') == 't')
		{
			try
			{
				$eventreglist = MembersmSSA::whereIn('position', array('C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'C6', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'D6', 'DA', 'H1', 'H1+', 'H2', 'H3', 'H5', 'H_E1', 'S1', 'S11', 'S1_D', 'S2', 'S2N', 'S3', 'S32', 'S3A', 'S_1', 'S_2', 'S_D1', 'S_D1A', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'Z1', 'Z2', 'Z3', 'Z5', 'Z_E1'))->get(array('id'))->toarray();
				
				$eventid = EventmEvent::getid($id);
				$eventname = EventmEvent::geteventdescription($id);
				
				foreach($eventreglist as $eventreglist)
				{
					try
					{
						$member = MembersmSSA::find($eventreglist['id'])->toarray();
						$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
						if(EventmRegistration::getEventMemberDuplicate($eventreglist['id'], EventmEvent::getid($id)) == false)
						{
							$post = new EventmRegistration;
							$post->eventid = $eventid;
							$post->eventname = $eventname;
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

							$post->role = 'Participant';
							$post->uniquecode = uniqid('', TRUE);
							$post->save();
						}
						else
						{
							LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
					}
				}
				
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postYouthLeaders($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'create') == 't')
		{
			try
			{
				$eventreglist = MembersmSSA::whereIn('division', array('YM','YW'))->whereIn('position', array('C1', 'C1V', 'C2', 'C2V', 'C3', 'C5', 'C6', 'D1', 'D1V', 'D2', 'D2V', 'D3', 'D5', 'D6', 'DA', 'H1', 'H1+', 'H2', 'H3', 'H5', 'H_E1', 'S1', 'S11', 'S1_D', 'S2', 'S2N', 'S3', 'S32', 'S3A', 'S_1', 'S_2', 'S_D1', 'S_D1A', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'Z1', 'Z2', 'Z3', 'Z5', 'Z_E1'))->get(array('id'))->toarray();
				
				$eventid = EventmEvent::getid($id);
				$eventname = EventmEvent::geteventdescription($id);

				foreach($eventreglist as $eventreglist)
				{
					try
					{
						$member = MembersmSSA::find($eventreglist['id'])->toarray();
						$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
						if(EventmRegistration::getEventMemberDuplicate($eventreglist['id'], EventmEvent::getid($id)) == false)
						{
							$post = new EventmRegistration;
							$post->eventid = $eventid;
							$post->eventname = $eventname;
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

							$post->role = 'Participant';
							$post->eventitem = 'Youth Leader';
							$post->uniquecode = uniqid('', TRUE);
							$post->save();
						}
						else
						{
							LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
					}
				}

				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - Insert Youth Leaders - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - Insert Youth Leaders  - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postYouthSRLeaders($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'create') == 't')
		{
			try
			{
				$eventreglist = MembersmSSA::whereIn('division', array('YM','YW'))->whereIn('position', array('H1', 'H1+', 'H2', 'H3', 'H5', 'H_E1', 'S1', 'S11', 'S1_D', 'S2', 'S2N', 'S3', 'S32', 'S3A', 'S_1', 'S_2', 'S_D1', 'S_D1A', 'S_D1H', 'S_D2', 'S_E1', 'S_E2', 'Z_E1'))->get(array('id'))->toarray();
				
				$eventid = EventmEvent::getid($id);
				$eventname = EventmEvent::geteventdescription($id);

				foreach($eventreglist as $eventreglist)
				{
					try
					{
						$member = MembersmSSA::find($eventreglist['id'])->toarray();
						$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
						if(EventmRegistration::getEventMemberDuplicate($eventreglist['id'], EventmEvent::getid($id)) == false)
						{
							$post = new EventmRegistration;
							$post->eventid = $eventid;
							$post->eventname = $eventname;
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

							$post->role = 'Participant';
							$post->eventitem = 'Youth SR Leader';
							$post->uniquecode = uniqid('', TRUE);
							$post->save();
						}
						else
						{
							LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member Duplicate Value', NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - ' . $e, NULL, NULL, 'Failed');
					}
				}

				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - Insert Youth SR Leaders - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event - Insert Youth SR Leaders  - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getApplicationPrint($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'print') == 't')
			{
				$value = $id;
				$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
				$postdelete->Delete();

				$eventmemberlist = EventmRegistration::where('id', EventmRegistration::getid($id))->get()->toarray();
				
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
					$insert[] = array(
				        'userid' => Auth::user()->id,
				        'resourceid' => $id,
				        'resourcecodeid' => $eventmemberlist['id'],
				        'uniquecode' => $eventmemberlist['uniquecode'],
				        'string1' => $etel,
				        'string2' => $emobile,
				        'string3' => $eemail,
				        'string4' => $enric,
				        'string5' => $eemergencytel,
				        'string6' => $eemergencymobile,
				        'string7' => $eintroducermobile,
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Print_m_Print')->insert($insert);
				
				LogsfLogs::postLogs('Print', 28, $id, ' - Event - Print Hardcopy - ' . $id, NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event - Print Hardcopy - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}

		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 28, 0, ' - Event - Print Hardcopy - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getApplicationPrintByGroup($id)
	{
		try
		{
			$value = $id;
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', EventmEvent::getid($id))
				->where('ssagroup', Input::get('pssaeventgroup'))->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{	
				if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
				if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
				if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
				if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
				if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
				if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
				if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} else {$enric = $eventmemberlist['nric'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'uniquecode' => $eventmemberlist['uniquecode'],
			        'string1' => $etel,
			        'string2' => $emobile,
			        'string3' => $eemail,
			        'string4' => $enric,
			        'string5' => $eemergencytel,
			        'string6' => $eemergencymobile,
			        'string7' => $eintroducermobile,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);
			
			LogsfLogs::postLogs('Print', 28, $id, ' - Event - Print Hardcopy - ' . $id, NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 28, 0, ' - Event - Print Hardcopy - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getEventAttendanceListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::Event(EventmEvent::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::Event(EventmEvent::getid($id))->Search('%'.$sSearch.'%', EventmEvent::getid($id))->count();
		    $default = AttendancemAttendance::Event(EventmEvent::getid($id))->Search('%'.$sSearch.'%', EventmEvent::getid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate', 'description', 'uniquecode', 'event', 'eventitem'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 33, 0, ' - Attendance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getEventProgPerformer($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::ProgPerformer(EventmEvent::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::ProgPerformer(EventmEvent::getid($id))->count();
		    $default = EventmRegistration::ProgPerformer(EventmEvent::getid($id))->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 33, 0, ' - Event Progrom Performer Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getEventRoleByStatus($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::ProgRoleByStatus(EventmEvent::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::ProgRoleByStatus(EventmEvent::getid($id))->count();
		    $default = EventmRegistration::ProgRoleByStatus(EventmEvent::getid($id))->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 33, 0, ' - Event Progrom Role By Status Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getEventProgPerformerOnly($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::ProgPerformerOnly(EventmEvent::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::ProgPerformerOnly(EventmEvent::getid($id))->count();
		    $default = EventmRegistration::ProgPerformerOnly(EventmEvent::getid($id))->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 33, 0, ' - Event Progrom Performer Only Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

    public function getEventProgPerformerOnlyAllStatus($id)
    {
        try {
            $default = EventmRegistration::ProgPerformerOnlyAllStatus(EventmEvent::getid($id))->get()->toarray();

            return Response::json(array('data' => $default));
            
        } catch(\Exception $e) {
            LogsfLogs::postLogs('Read', 33, 0, ' - Event Progrom Performer Only (All Status) Statistic [DT] - ' . $e, null, null, 'Failed');
        }
	}

	public function postEventAttendance($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV07', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('attendancedate'));
				if(AttendancemAttendance::getFindDuplicateValue(Input::get('attdescription'), EventmEvent::getid($id), Input::get('attendancedate')) == false)
				{
					$post = new AttendancemAttendance;
					$post->eventid = EventmEvent::getid($id);
					$post->event = EventmEvent::geteventnamepart($id);
					$post->attendancedate = $datDate;
					$post->eventitem = Input::get('atteventitem');
					$post->description = Input::get('attdescription');
					$post->attendancetype = Input::get('attendancetype');
					$post->createbyname = Auth::user()->name;
					$post->uniquecode = uniqid('', TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 33, $post->id, ' - Attendance - New Attendance - ' . Input::get('attdescription'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 33, 0, ' - Attendance - New Attendance - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 33, 0, ' - Attendance - New Attendance - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 33, 0, ' - Attendance - New Attendance - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 33, 0, ' - Attendance - New Attendance - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteEventAttendance($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'delete') == 't')
			{
				$post = AttendancemAttendance::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 33, $id, ' - Event - Event Attendance - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 33, 0, ' - Event - Delete Event Attendance - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 33, $id, ' - Event - Event Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getEventItemListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmEventItem::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmEventItem::Event($id)->Search('%'.$sSearch.'%', $id)->count();
		    $default = EventmEventItem::Event($id)->Search('%'.$sSearch.'%', $id)
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Item Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteEventItem($id)
	{
		try
		{
			$post = EventmEventItem::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Item - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Item - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventItem()
	{
		try
		{
			if(EventmEventItem::getFindDuplicateValue(Input::get('txtEIvalue'), EventmEvent::getid(Input::get('txtEIeventid'))) == false)
			{
				$post = new EventmEventItem;
				$post->eventid = EventmEvent::getid(Input::get('txtEIeventid'));
				$post->name = Input::get('txtEIvalue');
				$post->uniquecode = uniqid('', TRUE);
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - Event Item - ' . Input::get('txtEIvalue'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Item - Failed to Update - ' . Input::get('txtEIvalue'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Item - Duplicate Value - ' . Input::get('txtEIvalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Item - '. Input::get('txtEIeventid') . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putEventItem($id)
	{
		try
		{
			$post = EventmEventItem::find(EventmEventItem::getid($id));
			$post->name = Input::get('eEIvalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Event - Event Item Failed to Update ' . $id . Input::get('eEIvalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, $id, ' - Event - Update Event Item - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function getEventShowListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmEventShow::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmEventShow::Event($id)->Search('%'.$sSearch.'%', $id)->count();
		    $default = EventmEventShow::Event($id)->Search('%'.$sSearch.'%', $id)
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'lineno', 'value', 'uniquecode'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Show Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteEventShow($id)
	{
		try
		{
			$post = EventmEventShow::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Show - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Show - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventShow()
	{
		try
		{
			if(EventmEventShow::getFindDuplicateValue(Input::get('txtESvalue'), EventmEvent::getid(Input::get('txtESeventid'))) == false)
			{
				$post = new EventmEventShow;
				$post->eventid = EventmEvent::getid(Input::get('txtESeventid'));
				$post->lineno = Input::get('txtESlineno');
				$post->value = Input::get('txtESvalue');
				$post->uniquecode = uniqid('', TRUE);
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - Event Show - ' . Input::get('txtESvalue'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Show - Failed to Update - ' . Input::get('txtESvalue'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Show - Duplicate Value - ' . Input::get('txtESvalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Item - '. Input::get('txtESeventid') . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putEventShow($id)
	{
		try
		{
			$post = EventmEventShow::find(EventmEventShow::getid($id));
			$post->lineno = Input::get('eESlineno');
			$post->value = Input::get('eESvalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Event - Event Show Failed to Update ' . $id . Input::get('eESvalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, $id, ' - Event - Update Event Show - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function getEventGroupListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmGroup::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmGroup::Event($id)->Search('%'.$sSearch.'%', EventmEvent::getid($id))->count();
		    $default = EventmGroup::Event($id)->Search('%'.$sSearch.'%', EventmEvent::getid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Group Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteEventGroup($id)
	{
		try
		{
			$post = EventmGroup::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Group - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 28, $id, ' - Event - Event Group - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventGroup()
	{
		try
		{
			if(EventmGroup::getFindDuplicateValue(Input::get('txtEGvalue'), EventmEvent::getid(Input::get('txtEGeventid'))) == false)
			{
				$post = new EventmGroup;
				$post->eventid = EventmEvent::getid(Input::get('txtEGeventid'));
				$post->groupid = GroupmGroup::getidbyname(Input::get('txtEGvalue'));
				$post->name = Input::get('txtEGvalue');
				$post->uniquecode = uniqid('', TRUE);
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - Event Group - ' . Input::get('txtEGvalue'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 28, 0, ' - Event Group - Failed to Update - ' . Input::get('txtEGvalue'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Event Group - Duplicate Value - ' . Input::get('txtEGvalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Event Group - '. Input::get('txtEGeventid') . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getParticipantListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::Event(EventmEvent::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::Event(EventmEvent::getid($id))->Search('%'.$sSearch.'%')->count();
		    $default = EventmRegistration::Event(EventmEvent::getid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)
		    	->get(array('created_at', 'name', 'rhq', 'zone', 'chapter', 
					'nric', 'division', 'status', 'uniquecode', 'dateofbirth', 'role', 'groupcode', 'auditioncode', 
					'eventitem', 'costume9'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Participant Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteParticipant($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV04', 'delete') == 't')
			{
				$post = EventmRegistration::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Participant - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 30, 0, ' - Event - Delete Participants - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Pariticpant- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getEventCardListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = CardmCardDetail::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = CardmCardDetail::Event($id)->Search('%'.$sSearch.'%', $id)->count();
		    $default = CardmCardDetail::Event($id)->Search('%'.$sSearch.'%', $id)
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode', 'returndatetime', 'cardno', 'status', 'updated_at'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 54, 0, ' - Event - Card Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEventCardAssign($id)
	{
		try
		{
			$searchnric = Input::get('anricsearch');
			$searchcode = substr(Input::get('anricsearch'), 1, 3);

			try
			{
				$search = MembersmSSA::SearchCode($searchcode)->get(array('id', 'nric'));
				$searchfilter = $search->filter(function($search) use ($searchnric)
			    {
			        if ($search->nric == $searchnric) {
			        	Session::put('key', $search->id);
			            return $search;
			        }
			    });
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - '. Input::get('anricsearch') . ' - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
			}

			if (Session::get('key') != "")
			{
				$memberid = MembersmSSA::getmemberid(Session::get('key'));
			    $eventregid = EventmRegistration::getcdregid(EventmEvent::getid(Input::get('eventid')), $memberid);
			    Session::forget('key');

			    if(CardmCardDetail::getFindDuplicateValue(Input::get('acardno'), EventmEvent::getid(Input::get('eventid')), $eventregid) == false)
				{
					$member = EventmRegistration::find($eventregid)->toarray();
					$post = new CardmCardDetail;
					$post->eventid = EventmEvent::getid(Input::get('eventid'));
					$post->eventdetailid = $eventregid;
					$post->cardno = Input::get('acardno');
					$post->name = $member['name'];
					$post->memberid = $member['memberid'];
					$post->personid = $member['personid'];
					$post->status = 'Assigned';
					$post->uniquecode = date('Y'). $eventregid . $member['memberid'] . date('i');
					$post->save();

					if($post->save())
					{
						$post1 = EventmRegistration::find($eventregid);
						$post1->cardno = Input::get('acardno');

						$post1->save();

						LogsfLogs::postLogs('Create', 54, $post->id, ' - Event Card - ' . Input::get('acardno'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Failed to Update - ' . Input::get('acardno'), NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Duplicate Value - ' . Input::get('acardno'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Does Not Exist - ' . Input::get('acardno'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - '. Input::get('anricsearch') . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postAddEventCard($id)
	{
		try
		{
			$eventregid = EventmRegistration::getid(Input::get('cardmemberid'));
			$cardid = CardmCard::getcardid(Input::get('cacardno'));
			if(CardmCardDetail::getFindDuplicateCard(Input::get('cacardno'), EventmEvent::getid(Input::get('eventid'))) == false)
			{
				if(CardmCardDetail::getFindDuplicateName($eventregid, EventmEvent::getid(Input::get('eventid'))) == false)
				{
					$member = EventmRegistration::find($eventregid)->toarray();
					$card = CardmCard::find($cardid)->toarray();
					$post = new CardmCardDetail;
					$post->eventid = EventmEvent::getid(Input::get('eventid'));
					$post->eventdetailid = $eventregid;
					$post->cardname = $card['cardno'];
					$post->cardno = $card['name'];
					$post->cardid = $card['id'];
					$post->name = $member['name'];
					$post->memberid = $member['memberid'];
					$post->personid = $member['personid'];
					$post->status = 'Assigned';
					$post->uniquecode = uniqid('', TRUE);
					$post->save();

					if($post->save())
					{
						$post1 = EventmRegistration::find($eventregid);
						$post1->cardno = $card['name'];

						$post1->save();

						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Failed to Update - ' . Input::get('cacardno'), NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Duplicate Value (Name) - ' . Input::get('cacardno'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - Duplicate Value (Card) - ' . Input::get('cacardno'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 54, 0, ' - Event Card - '. Input::get('cacardno') . ' ' . $eventregid . ' ' . Input::get('cardmemberid') . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
		}
	}

	public function postEventCardReturn($id)
	{
		try
		{
			$post = CardmCardDetail::find(CardmCardDetail::getcardid(EventmEvent::getid(Input::get('eventid')), Input::get('rcardno')));
			$post->status = 'Returned';
			$post->returndatetime = date('Y-m-d H:i:s');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 54, 0, ' - Event - Card Failed to Update ' . $id . Input::get('rcardno'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 54, $id, ' - Event - Update Card - ' . EventmEvent::getid(Input::get('eventid')) . Input::get('rcardno') . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function getEventCardNameSearch()
	{
		$membercode = Input::get('term');
		$member = EventmRegistration::where('eventid', EventmEvent::getid(Input::get('eventid')))->where('name','LIKE','%'. $membercode .'%')->orwhere('nric', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'nric', 'name', 'uniquecode'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['nric'], 'label'=>$member['name'].' - '.$member['nric'], 'value' => $member['nric']);
		}
		return Response::json($memberlist);
	}

	public function deleteEventCard($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'delete') == 't')
			{
				$post1 = EventmRegistration::find(CardmCardDetail::getcardregid($id));
				$post1->cardno = NULL;

				$post1->save();

				$post = CardmCardDetail::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 58, 0, ' - Event - Delete Card - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteEventCardWithdrawn($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'delete') == 't')
			{
				$post1 = EventmRegistration::find(CardmCardDetail::getcardregid($id));
				$post1->cardno = NULL;

				$post1->save();

				$post = CardmCardDetail::find(CardmCardDetail::getid($id));
				$post->status = 'Returned';
				$post->returndatetime = date('Y-m-d H:i:s');
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card - ' . $id , NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 58, 0, ' - Event - Card Failed to Update ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Delete', 58, 0, ' - Event - Delete Card - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteEventCardLost($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'delete') == 't')
			{
				$post1 = EventmRegistration::find(CardmCardDetail::getcardregid($id));
				$post1->cardno = NULL;

				$post1->save();

				$post = CardmCardDetail::find(CardmCardDetail::getid($id));
				$post->status = 'Lost';
				$post->returndatetime = date('Y-m-d H:i:s');
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card - ' . $id , NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 58, 0, ' - Event - Card Failed to Update ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Delete', 58, 0, ' - Event - Delete Card - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 58, $id, ' - Event - Card- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postSecurityPass($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV03', 'print') == 't')
			{
				if(PrintmSecurityPass::getFindSPDuplicate(Auth::user()->id, EventmRegistration::getid($id)) == false)
				{
					$EventReg = EventmRegistration::where('uniquecode', '=', $id)->get()->toarray();
					foreach($EventReg as $EventReg)
					{
						$insert[] = array(
					        'userid' => Auth::user()->id,
					        'eventid' => $EventReg['eventid'],
					        'eventdetailid' => $EventReg['id'],
					        'name' => $EventReg['name'],
					        'rhq' => $EventReg['rhq'],
					        'zone' => $EventReg['zone'],
					        'chapter' => $EventReg['chapter'],
					        'district' => $EventReg['district'],
					        'created_at' => date('Y-m-d H:i:s'),
					        'updated_at' => date('Y-m-d H:i:s')
					    );
					}

					DB::table('Print_m_SecurityPass')->insert($insert);

					LogsfLogs::postLogs('Create', 30, $id, ' - Event - Add Security Pass - ' . $id , NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 30, 0, ' - Event - Add Security Pass - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 30, 0, ' - Event - Add Security Pass - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 30, $id, ' - Event - Add Security Pass - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function AccessRightsCheck($id)
	{
		try
		{
			if(PrintmSecurityPass::getFindSPDuplicate(Auth::user()->id, $id) == false)
			{
				$EventReg = EventmRegistration::where('id', '=', $id)->get()->toarray();
				foreach($EventReg as $EventReg)
				{
					$insert[] = array(
				        'userid' => Auth::user()->id,
				        'eventid' => $EventReg['eventid'],
				        'eventdetailid' => $id,
				        'name' => $EventReg['name'],
				        'rhq' => $EventReg['rhq'],
				        'zone' => $EventReg['zone'],
				        'chapter' => $EventReg['chapter'],
				        'district' => $EventReg['district'],
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Print_m_SecurityPass')->insert($insert);

				LogsfLogs::postLogs('Create', 30, $id, ' - Event - Add Security Pass - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 30, 0, ' - Event - Add Security Pass - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 30, $id, ' - Event - Add Security Pass - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
	
	public function getSecurityPassListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = PrintmSecurityPass::Event($id)->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = PrintmSecurityPass::Event(EventmEvent::getid($id))->where('userid', '=', Auth::user()->id)
		    	->Search('%'.$sSearch.'%')->count();
		    $default = PrintmSecurityPass::Event(EventmEvent::getid($id))->where('userid', '=', Auth::user()->id)->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'rhq', 'zone', 'chapter', 'district', 
		    		'id'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 30, 0, ' - Event - Security Pass Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteSecurityPass($id)
	{
		try
		{
			$post = PrintmSecurityPass::where('id', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Security Pass - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Security Pass - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteAllSecurityPass($id)
	{
		try
		{
			PrintmSecurityPass::deleteAllSecurityPass(Auth::user()->id);
			LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Security Pass Delete All - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 30, $id, ' - Event - Security Pass - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getRoleListingPrint($id)
	{
		try
		{
			$value = $id;
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();
			$value2 = Input::get('role');

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Role Listing - ' . $value2, NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Role Listing Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getRoleListingByDivisionPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Role Listing By Division - ' . Input::get('role2') . ' - ' . Input::get('dddivision'), NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Role Listing Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getRoleStatictisPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Statictis Print - ' . Input::get('role3'), NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Role Statictis Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postContactByDivisionPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $eventmemberlist['tel'],
			        'string2' => $eventmemberlist['mobile'],
			        'string3' => $eventmemberlist['email'],
			        'string4' => $eventmemberlist['nric'],
			        'string5' => $eventmemberlist['emergencytel'],
			        'string6' => $eventmemberlist['emergencymobile'],
			        'string7' => $eventmemberlist['introducermobile'],
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Contact Listing By Division - ' . Input::get('role4') . ' - ' . Input::get('dddivision2'), NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Contact Listing Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postSecurityPassesByDivisionPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', $id)->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $eventmemberlist['nric'],
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Security Pass By Division - ' . Input::get('role5') . ' - ' . Input::get('dddivision3'), NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Security Passes Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postSecurityPassesByIndividualPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', $id)->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $eventmemberlist['nric']
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Security Pass By Individual', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Security Passes Print By Individual - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postTemporanyPassPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$startnumber = Input::get('startnumber');
			$endnumber =Input::get('endnumber');

			for($i=$startnumber; $i <= $endnumber; $i++)
			{
				try
				{
					$post = new PrintmPrint;
					$post->userid = Auth::user()->id;
					$post->resourceid = 30;
					$post->resourcecodeid = $i;
					$post->string1 = $i;
					$post->save();
					// }
					
				}
				catch(\Exception $e) 
				{
					LogsfLogs::postLogs('Read', 30, 0, ' - Event Temporany Passes Print - ' . $e, NULL, NULL, 'Failed');
				}
			}
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Temporany Passes', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Temporany Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGroupsPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', $id)->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $eventmemberlist['tel'],
			        'string2' => $eventmemberlist['mobile']
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Groups', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Security Passes Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postAcceptedNoGroupCodePrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			EventmRegistration::putNullGroupCode($id);

			$eventmemberlist = EventmRegistration::where('eventid', '=', $id)->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => $id,
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string1' => $eventmemberlist['tel'],
			        'string2' => $eventmemberlist['mobile'],
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Acceptrd But No Group Code', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Accepted But No Group Code Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCostumeListingPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Costume Listing', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Costume Listing Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventAttendanceAllPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = AttendancemPerson::where('eventid', EventmEvent::getid($id))->where('remarks', '!=', '')->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$member = MembersmSSA::find($eventmemberlist['memberid'])->toarray();
				$emobile =  $member['mobile'];
				$etel =  $member['tel'];

				$post = new PrintmPrint;
				$post->userid = Auth::user()->id;
				$post->resourceid = EventmEvent::getid($id);
				$post->resourcecodeid = $eventmemberlist['id'];
				$post->string1 = $etel;
				$post->string2 = $emobile;
				$post->created_at = date('Y-m-d H:i:s');
				$post->updated_at = date('Y-m-d H:i:s');
				$post->save();
			}

			LogsfLogs::postLogs('Print', 30, EventmEvent::getid($id), ' - Event - Print Attendance All', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Attendance All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventAttendanceAllByChapterPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = AttendancemPerson::where('eventid', EventmEvent::getid($id))->where('noofnewfriend', '!=', 0)->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				$member = MembersmSSA::find($eventmemberlist['memberid'])->toarray();
				$emobile =  $member['mobile'];
				$etel =  $member['tel'];

				$post = new PrintmPrint;
				$post->userid = Auth::user()->id;
				$post->resourceid = EventmEvent::getid($id);
				$post->resourcecodeid = $eventmemberlist['id'];
				$post->string1 = $etel;
				$post->string2 = $emobile;
				$post->created_at = date('Y-m-d H:i:s');
				$post->updated_at = date('Y-m-d H:i:s');
				$post->save();
			}

			LogsfLogs::postLogs('Print', 30, EventmEvent::getid($id), ' - Event - Print Attendance By Chapter All', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Attendance All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCostumesSlipPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Costumes Slip', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - get Costumes Slip Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postContactByAllPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', EventmEvent::getid($id))->get()->toarray();
			
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
			        'resourceid' => EventmEvent::getid($id),
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

			LogsfLogs::postLogs('Print', 30, EventmEvent::getid($id), ' - Event - Print Contact Listing By All - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Contact Listing By All - ' . $id . " aaa " . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postContactByAllStudyExamPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', EventmEvent::getid($id))->where('status', 'Accepted')->get()->toarray();
			
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
			        'resourceid' => EventmEvent::getid($id),
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

			LogsfLogs::postLogs('Print', 30, EventmEvent::getid($id), ' - Event - Print Contact Listing By All Study Exam - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Contact Listing By All  Study Exam - ' . $id . " aaa " . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGohonzonStatisticPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();


			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Gohonzon Statictis - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Gohonzon Statictis - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postGohonzonStatisticByDivisionPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();


			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Gohonzon Statictis By Division - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Gohonzon Statictis By Division - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postContactByAllPrintNoSensitive($id)
	{
		try
		{
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Detail Listing By All With No Sensitive Info - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Detail Listing By All With No Sensitive Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postNewFriendContactByDivisionPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))->where('division', Input::get('dddivisionNF'))->get()->toarray();
			
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
			        'resourceid' => EventmEvent::getid($id),
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

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Contact Listing By All - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Contact Listing By All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByItemWithContactsPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))
				->where('eventitem', Input::get('seventitem'))->get()->toarray();
			
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
			        'resourceid' => EventmEvent::getid($id),
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

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Item With Contacts - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Item With Contacts - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByStatusWithContactsPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))
				->where('status', Input::get('seventregstatus'))->get()->toarray();
			
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
			        'resourceid' => EventmEvent::getid($id),
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

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Item With Contacts - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Item With Contacts - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByItemPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Item - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Item - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByGroupPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => EventmEvent::getid($id),
			        'resourcecodeid' => $eventmemberlist['id'],
			        'string2' => $emobile,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Group - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Group - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCostumeListingByGroupPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Costume Listing By Group - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Costume Listing By Group - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByGroupAttendancePrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Group Attendance - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Group Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postEventListingByGroupAttendancePerformerPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$eventmemberlist = EventmRegistration::where('eventid', '=', EventmEvent::getid($id))->get()->toarray();
			
			foreach($eventmemberlist as $eventmemberlist)
			{
				if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
				if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
				$insert[] = array(
			        'userid' => Auth::user()->id,
			        'resourceid' => EventmEvent::getid($id),
					'resourcecodeid' => $eventmemberlist['id'],
					'string1' => $etel,
			        'string2' => $emobile,
			        'created_at' => date('Y-m-d H:i:s'),
			        'updated_at' => date('Y-m-d H:i:s')
			    );
			}

			DB::table('Print_m_Print')->insert($insert);

			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Event Listing By Group Performer Attendance - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Event Listing By Group Performer Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postTemporanyPassNoLogoPrint($id)
	{
		try
		{
			$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
			$postdelete->Delete();

			$title = Input::get('title');
			$startnumber = Input::get('startnumber');
			$endnumber =Input::get('endnumber');

			for($i=$startnumber; $i <= $endnumber; $i++)
			{
				try
				{
					$post = new PrintmPrint;
					$post->userid = Auth::user()->id;
					$post->resourceid = 30;
					$post->resourcecodeid = $i;
					$post->string1 = $i;
					$post->string2 = $title;
					$post->save();
					// }
					
				}
				catch(\Exception $e) 
				{
					LogsfLogs::postLogs('Read', 30, 0, ' - Event Temporany Passes No Logo Print - ' . $e, NULL, NULL, 'Failed');
				}
			}
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Temporany Passes No Logo', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Temporany No Logo Print - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}