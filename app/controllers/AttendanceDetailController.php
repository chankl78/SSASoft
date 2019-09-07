<?php
class AttendanceDetailController extends BaseController
{
	public $restful = true; 

	public function getIndex($id)
	{
		Session::put('current_page', 'attendance/attendance');
		Session::put('current_resource', 'ATTE');
		$REAT03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT03', 'create');
		$REAT03R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT03', 'read');
		$REAT04R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT04', 'read');
		$REAT04D = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT04', 'delete');
		$REAT05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT05', 'read');
		$view = View::make('attendance/attendancedetail');
		$pagetitle = AttendancemAttendance::getdescription($id);
		$query = AttendancemAttendance::Role()->where('uniquecode', '=', $id)->get();
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->orderBy('description', 'ASC')->lists('description', 'description');
		$commonstatus_options = CommonzStatus::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$attendancetype_options = AttendancezType::Role()->lists('value', 'value');
		$groups_options = array('' => 'Please Select a Group') + GroupmGroup::Role()->orderBy('name', 'ASC')->lists('name', 'name');
		$role_options = EventzRole::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::Role()->whereIn('name', array('New Friend'))->orderBy('code', 'ASC')->lists('name', 'code');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()->orderBy('description', 'ASC')->lists('description', 'description');
		$view->title = $pagetitle;
		$view->with('rid', $id)->with('result', $query)->with('pagetitle', $pagetitle)
			->with('REAT03A', $REAT03A)->with('REAT03R', $REAT03R)->with('REAT04D', $REAT04D)
			->with('REAT04R', $REAT04R)->with('REAT05R', $REAT05R)->with('commonstatus_options', $commonstatus_options)
			->with('groups_options', $groups_options)->with('attendancetype_options', $attendancetype_options)
			->with('event_options', $event_options)->with('memposition_options', $memposition_options)
			->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('role_options', $role_options)
			->with('chapter_options', $chapter_options)->with('event_options', $event_options);
		return $view;
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			$searchnric = Input::get('nricsearch');
			$searchcode = substr(Input::get('nricsearch'), 1, 3);


			$search = MembersmSSA::SearchCode($searchcode)->get(array('id', 'nric'));
			$searchfilter = $search->filter(function($search) use ($searchnric)
		    {
		        if ($search->nric == $searchnric) {
		        	Session::put('key', $search->id);
		            return $search;
		        }
		    });

		    $searchresult = MembersmSSA::findorfail(Session::get('key'), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    Session::forget('key');

			LogsfLogs::postLogs('Read', 28, $id, ' - Event - NRIC Search - ' . $searchcode . ' ' . $searchresult['name'], NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 28, $id, ' - Event - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postNricSearchExpress($id)
	{
		$memberid = 0; $eventregid = 0;
		// Step 1 - Search membership
		try
		{
			$memberid = MembersmSSA::getidbynrichash(Input::get('nricsearch'));
		}
		catch(\Exception $e) { $memberid = 0; }
		
		// Step 2 - Check if member exist in event or not
		try
		{
			$eventregid = EventmRegistration::getregidbynric(AttendancemAttendance::geteventid(Input::get('attendanceid')), Input::get('nricsearch'));
		}
		catch(\Exception $e){ $eventregid = 0; }

		// Step 3 - Insert Record into Attendance
		if($memberid != 0 and $eventregid != 0)
		{
			$member = EventmRegistration::findorfail($eventregid, array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'memberid'));
			$memberssa = MembersmSSA::findorfail($memberid, array('name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'id'));

			if(AttendancemPerson::getAttendancePersonDuplicate($memberid, AttendancemAttendance::getid(Input::get('attendanceid'))) == false)
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('attendanceid'));
				$post->memberid = $memberid;
				$post->name = $memberssa['name'];
				$post->chinesename = $memberssa['chinesename'];
				$post->rhq = $memberssa['rhq'];
				$post->zone = $memberssa['zone'];
				$post->chapter = $memberssa['chapter'];
				$post->district = $memberssa['district'];
				$post->position = $memberssa['position'];
				$post->positionlevel = $memberssa['positionlevel'];
				$post->division = $memberssa['division'];
				$post->noofnewfriend = 0;
				$post->remarks = NULL;
				$post->uniquecode = uniqid('', TRUE);
				$post->attendancestatus = 'Attended';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success', 'attendeename' => $memberssa['name']), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			} else { return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400); }
		}
		else if ($memberid != 0 and $eventregid == 0)
		{
			$memberssa = MembersmSSA::findorfail($memberid, array('name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'id'));

			if(AttendancemPerson::getAttendancePersonDuplicate($memberid, AttendancemAttendance::getid(Input::get('attendanceid'))) == false)
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('attendanceid'));
				$post->memberid = $memberid;
				$post->name = $memberssa['name'];
				$post->chinesename = $memberssa['chinesename'];
				$post->rhq = $memberssa['rhq'];
				$post->zone = $memberssa['zone'];
				$post->chapter = $memberssa['chapter'];
				$post->district = $memberssa['district'];
				$post->position = $memberssa['position'];
				$post->positionlevel = $memberssa['positionlevel'];
				$post->division = $memberssa['division'];
				$post->noofnewfriend = 0;
				$post->remarks = 'Attendee is not registered in the event.';
				$post->uniquecode = uniqid('', TRUE);
				$post->attendancestatus = 'Attended';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success', 'attendeename' => $memberssa['name']), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			} else { return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400); }
		} 
		else if ($memberid == 0 and $eventregid != 0)
		{
			$member = EventmRegistration::findorfail($eventregid, array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'id'));

			if(AttendancemPerson::getEventAttendanceDuplicate($memberid, AttendancemAttendance::getid(Input::get('attendanceid')), $eventregid) == false)
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('attendanceid'));
				$post->memberid = 0;
				$post->eventid = AttendancemAttendance::geteventid(Input::get('attendanceid'));
				$post->eventregid = $member['id'];
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->position = $memberssa['positionlevel'];
				$post->division = $member['division'];
				$post->noofnewfriend = 0;
				$post->remarks = 'Attendee is not in SSA Membership';
				$post->uniquecode = uniqid('', TRUE);
				$post->attendancestatus = 'Attended';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success', 'attendeename' => $member['name']), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			} else { return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400); }
		} 
		else if ($memberid == 0 and $eventregid == 0)
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NOT IN Database and Event'), 400);
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown Error'), 400);
		}
	}

	public function postAddMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'create') == 't')
		{
			try
			{
				$mid = MembersmSSA::getid1(Input::get('memberid'));
				$member = MembersmSSA::find($mid)->toarray();
				
				if(AttendancemPerson::getAttendancePersonDuplicate($mid, AttendancemAttendance::getid($id)) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid($id);
					$post->memberid = $mid;
					$post->name = $member['name'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->uniquecode = date('YmdHis');
					$post->attendancestatus = 'Attended';
					$post->noofnewfriend = Input::get('noofnewfriend');
					$post->remarks = Input::get('remarks');
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 34, $post->id, ' - Attendance Detail - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 28, 0, ' - Attendance - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Attendance - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postMassForwardtoEvent($id)
	{
		try
		{
			$dmattendancelist = AttendancemPerson::where('attendanceid',  AttendancemAttendance::getid(Input::get('moduleid')))->where('deleted_at', NULL)->where('attendancestatus', 'Attended')->get(array('memberid', 'name'))->toarray();
				
			foreach($dmattendancelist as $dmattendancelist)
			{
				try
				{
					$member = MembersmSSA::findorfail($dmattendancelist['memberid'])->toarray();
					$eventid = EventmEvent::getforwardid(Input::get('eventforward'));
					
					if(EventmRegistration::getEventMemberDuplicate($dmattendancelist['memberid'], $eventid) == false)
					{
						$post = new EventmRegistration;
						$post->eventid = $eventid;
						$post->eventname = EventmEvent::geteventnamebyid($eventid);
						$post->personid = $member['personid'];
						$post->memberid = $dmattendancelist['memberid'];
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
						
						$post->race = $member['race'];
						$post->gender = $member['gender'];

						$post->countryofbirth = $member['countryofbirth'];

						$post->address = $member['address'];
						$post->buildingname = $member['buildingname'];
						$post->unitno = $member['unitno'];
						$post->postalcode = $member['postalcode'];

						$post->introducermobile = $member['introducermobile'];

						$post->role = Input::get('eventroleforward');
						$post->eventitem = AttendancemAttendance::getdescription(Input::get('moduleid'));
						$post->uniquecode = uniqid('', TRUE);
						$post->save();

						if($post->save())
						{
							LogsfLogs::postLogs('Create', 28, $post->id, ' - Event - New Member - ' . $dmattendancelist['name'], NULL, NULL, 'Success');
						}
						else
						{
							LogsfLogs::postLogs('Create', 28, 0, ' - Event - New Member - Failed to Save', NULL, NULL, 'Failed');
						}
					}
					else
					{
						$post = EventmRegistration::find(EventmRegistration::getcdregid($eventid, $dmattendancelist['memberid']));
						$post->role = Input::get('eventroleforward');
						$post->save();
					}
				}
				catch(\Exception $e)
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - ' . $dmattendancelist['memberid'] . ' - ' . $dmattendancelist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postDMMassInsertByDistrict($id)
	{
		try {

			$dmattendancelist = AttendancemAttendance::where('id',  AttendancemAttendance::getid(Input::get('moduleid')))->get()->toarray();

			foreach ($dmattendancelist as $dmattendancelist) {
				try {
					$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhq'])->where('zone', $dmattendancelist['zone'])->where('chapter', $dmattendancelist['chapter'])->where('district', $dmattendancelist['district'])->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();

					foreach ($dmattendancememberlist as $dmattendancememberlist) {
						try {
							$postm = new AttendancemPerson;
							$postm->attendanceid = $dmattendancelist['id'];
							$postm->eventid = 0;
							$postm->eventregid = 0;
							$postm->uniquecode = uniqid('', TRUE);
							$postm->memberid = $dmattendancememberlist['id'];
							$postm->name = $dmattendancememberlist['name'];
							$postm->chinesename = $dmattendancememberlist['chinesename'];
							$postm->rhq = $dmattendancememberlist['rhq'];
							$postm->zone = $dmattendancememberlist['zone'];
							$postm->chapter = $dmattendancememberlist['chapter'];
							$postm->district = $dmattendancememberlist['district'];
							$postm->division = $dmattendancememberlist['division'];
							$postm->position = $dmattendancememberlist['position'];
							if ($dmattendancememberlist['position'] == 'NF') {
								$postm->noofnewfriend = 1;
							}
							$postm->attendancestatus = 'Absent';
							$postm->created_at = date('Y-m-d H:i:s');
							$postm->updated_at = date('Y-m-d H:i:s');

							$postm->save();
						} catch (\Exception $e) {
							LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance - ' . $dmattendancememberlist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
						}
					}
				} catch (\Exception $e) {
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - ' . $dmattendancelist['memberid'] . ' - ' . $dmattendancelist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postAddNewFriend($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'create') == 't')
		{
			try
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid($id);
				$post->memberid = 0;
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district =Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = 'nf';
				$post->division = Input::get('division');
				if (Input::get('position') == 'NF'){ $post->noofnewfriend = 1;} else { $post->noofnewfriend = 0; }
				$post->remarks = Input::get('remarks');
				$post->uniquecode = uniqid('', TRUE);
				$post->attendancestatus = 'Attended';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 34, 0, ' - Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 34, 0, ' - Attendance - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Attendance - New Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function putEditMember($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
		{
			try
			{
				$post = AttendancemPerson::find(AttendancemPerson::getid(Input::get('ememberid')));
				$post->noofnewfriend = Input::get('enoofnf');
				$post->remarks = Input::get('eremarks');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, AttendancemPerson::getid(Input::get('ememberid')), ' - Attendance - Attendance Member Failed to Update ' . AttendancemPerson::getid(Input::get('ememberid')), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 34, AttendancemPerson::getid(Input::get('ememberid')), ' - Attendance - Update  Attendance Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Attendance - Edit Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getAttendeesListing($id)
	{
		try
		{
			$default = AttendancemPerson::Detail(AttendancemAttendance::getid($id))->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Attendance - Attendance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getrhqstatsListing($id)
	{
		try
		{
			$default = AttendancemPerson::RHQStats(AttendancemAttendance::getid($id))->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Attendance - RHQ Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putAttendance($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('attendancedate'));
				$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
				$post->attendancedate = $datDate;
				$post->eventid = EventmEvent::getdescid(Input::get('eventattendance'));
				$post->event = Input::get('eventattendance');
				$post->groupid = GroupmGroup::getidbyname(Input::get('groupattendance'));
				$post->groupname = Input::get('groupattendance');
				$post->eventitem = Input::get('atteventitem');
				$post->description = Input::get('description');
				$post->attendancetype = Input::get('attendancetype');
				$post->status = Input::get('status');
				$post->srmd = Input::get('srmd');
				$post->srwd = Input::get('srwd');
				$post->srymd = Input::get('srymd');
				$post->srywd = Input::get('srywd');
				$post->hvmd = Input::get('hvmd');
				$post->hvwd = Input::get('hvwd');
				$post->hvymd = Input::get('hvymd');
				$post->hvywd = Input::get('hvywd');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, 0, ' - Attendance - Update Attendance ' + $id + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 34, $id, ' - Attendance - Update Attendance - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Attendance - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function putAttendance1($id)
	{
		$md = AttendancemPerson::getAttendancePersonMD(AttendancemAttendance::getid($id));
		$wd = AttendancemPerson::getAttendancePersonWD(AttendancemAttendance::getid($id));
		$ym = AttendancemPerson::getAttendancePersonYMD(AttendancemAttendance::getid($id));
		$yw = AttendancemPerson::getAttendancePersonYWD(AttendancemAttendance::getid($id));
		$pd = AttendancemPerson::getAttendancePersonPD(AttendancemAttendance::getid($id));
		$yc = AttendancemPerson::getAttendancePersonYC(AttendancemAttendance::getid($id));
		$total = AttendancemPerson::getAttendancePersonTotal(AttendancemAttendance::getid($id));
		$ldr = AttendancemPerson::getAttendancePersonLDR(AttendancemAttendance::getid($id));
		$mem = AttendancemPerson::getAttendancePersonMEM(AttendancemAttendance::getid($id));
		$bel = AttendancemPerson::getAttendancePersonBEL(AttendancemAttendance::getid($id));
		$nf = AttendancemPerson::getAttendancePersonNF(AttendancemAttendance::getid($id));

		try
		{
			$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
			$post->md = $md;
			$post->wd = $wd;
			$post->ymd = $ym;
			$post->ywd = $yw;
			$post->pd = $pd;
			$post->yc = $yc;
			$post->attendancetotal = $total;
			$post->ldr = $ldr;
			$post->mem = $mem;
			$post->bel = $bel;
			$post->nf = $nf;

			$post->save();
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, AttendancemAttendance::getid($id), ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
		}
		
		$searchresult = AttendancemAttendance::findorfail(AttendancemAttendance::getid($id), array('md', 'wd', 'ymd', 'ywd', 'ldr', 'mem', 'bel', 'nf', 'tokangmembership', 'attendancetotal'));

		return Response::json($searchresult, 200);
	}

	public function putAttendance2($id)
	{
		$md = AttendancemPerson::getAttendancePersonMD(AttendancemAttendance::getid($id));
		$wd = AttendancemPerson::getAttendancePersonWD(AttendancemAttendance::getid($id));
		$ym = AttendancemPerson::getAttendancePersonYMD(AttendancemAttendance::getid($id));
		$yw = AttendancemPerson::getAttendancePersonYWD(AttendancemAttendance::getid($id));
		$pd = AttendancemPerson::getAttendancePersonPD(AttendancemAttendance::getid($id));
		$yc = AttendancemPerson::getAttendancePersonYC(AttendancemAttendance::getid($id));
		$total = AttendancemPerson::getAttendancePersonTotal(AttendancemAttendance::getid($id));
		$ldr = AttendancemPerson::getAttendancePersonLDR(AttendancemAttendance::getid($id));
		$mem = AttendancemPerson::getAttendancePersonMEM(AttendancemAttendance::getid($id));
		$bel = AttendancemPerson::getAttendancePersonBEL(AttendancemAttendance::getid($id));
		$nf = AttendancemPerson::getAttendancePersonNF(AttendancemAttendance::getid($id));

		try
		{
			$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
			$post->md = $md;
			$post->wd = $wd;
			$post->ymd = $ym;
			$post->ywd = $yw;
			$post->pd = $pd;
			$post->yc = $yc;
			$post->attendancetotal = $total;
			$post->ldr = $ldr;
			$post->mem = $mem;
			$post->bel = $bel;
			$post->nf = $nf;

			$post->save();
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, AttendancemAttendance::getid($id), ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
		}
		
		$searchresult = AttendancemAttendance::findorfail(AttendancemAttendance::getid($id), array('md', 'wd', 'ymd', 'ywd', 'ldr', 'mem', 'bel', 'nf', 'tokangmembership', 'attendancetotal'));

		return Response::json($searchresult, 200);
	}

	public function putAttendancesr($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'update') == 't')
		{
			try
			{
				$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
				$post->srmd = Input::get('srmd');
				$post->srwd = Input::get('srwd');
				$post->srymd = Input::get('srymd');
				$post->srywd = Input::get('srywd');
				$post->save();

				if($post->save())
				{
					$md = AttendancemPerson::getAttendancePersonMD(AttendancemAttendance::getid($id));
					$wd = AttendancemPerson::getAttendancePersonWD(AttendancemAttendance::getid($id));
					$ym = AttendancemPerson::getAttendancePersonYMD(AttendancemAttendance::getid($id));
					$yw = AttendancemPerson::getAttendancePersonYWD(AttendancemAttendance::getid($id));
					$pd = AttendancemPerson::getAttendancePersonPD(AttendancemAttendance::getid($id));
					$yc = AttendancemPerson::getAttendancePersonYC(AttendancemAttendance::getid($id));
					$total = AttendancemPerson::getAttendancePersonTotal(AttendancemAttendance::getid($id));
					$ldr = AttendancemPerson::getAttendancePersonLDR(AttendancemAttendance::getid($id));
					$mem = AttendancemPerson::getAttendancePersonMEM(AttendancemAttendance::getid($id));
					$bel = AttendancemPerson::getAttendancePersonBEL(AttendancemAttendance::getid($id));
					$nf = AttendancemPerson::getAttendancePersonNF(AttendancemAttendance::getid($id));

					try
					{
						$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
						$post->md = $md;
						$post->wd = $wd;
						$post->ymd = $ym;
						$post->ywd = $yw;
						$post->pd = $pd;
						$post->yc = $yc;
						$post->attendancetotal = $total;
						$post->ldr = $ldr;
						$post->mem = $mem;
						$post->bel = $bel;
						$post->nf = $nf;

						$post->save();
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Update', 34, AttendancemAttendance::getid($id), ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
					}
					
					$searchresult = AttendancemAttendance::findorfail(AttendancemAttendance::getid($id), array('md', 'wd', 'ymd', 'ywd', 'ldr', 'mem', 'bel', 'nf', 'tokangmembership', 'attendancetotal'));

					return Response::json($searchresult, 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, AttendancemAttendance::getid($id), ' - Attendance - Update Attendance SR ' + AttendancemAttendance::getid($id) + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 34, $id, ' - Attendance - Update Attendance SR - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Attendance SR - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function putAttendancehv($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'update') == 't')
		{
			try
			{
				$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
				$post->hvmd = Input::get('hvmd');
				$post->hvwd = Input::get('hvwd');
				$post->hvymd = Input::get('hvymd');
				$post->hvywd = Input::get('hvywd');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, 0, ' - Attendance - Update Attendance HV ' + $id + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 34, $id, ' - Attendance - Update Attendance HV - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Attendance HV - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'delete') == 't')
			{
				$post = AttendancemPerson::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 34, AttendancemPerson::getid($id), ' - Attendance - Delete Attendee - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 34, AttendancemPerson::getid($id), ' - Attendance - Delete Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 34, AttendancemPerson::getid($id), ' - Attendance - Delete Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAbsentAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'update') == 't')
			{
				$post = AttendancemPerson::find(AttendancemPerson::getid($id));
				$post->attendancestatus = 'Absent';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, 0, ' - Attendance - Update Attendee ' + $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, 0, ' - Attendance - Update Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id, ' - Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAttendedAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT04', 'update') == 't')
			{
				$post = AttendancemPerson::find(AttendancemPerson::getid($id));
				$post->attendancestatus = 'Attended';
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 34, AttendancemPerson::getid($id), ' - Attendance - Update Attendee ' + $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, AttendancemPerson::getid($id), ' - Attendance - Update Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, AttendancemPerson::getid($id), ' - Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteAllAttendee($id)
	{
		try
		{
			AttendancemPerson::deleteAllAttendee(AttendancemAttendance::getid($id));
			LogsfLogs::postLogs('Delete', 34, AttendancemAttendance::getid($id), ' - Attendance - Delete All - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 34, AttendancemAttendance::getid($id), ' - Attendance - Delete All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => AttendancemAttendance::getid($id)), 400);
		}
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('attendance/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('attendance/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}
}