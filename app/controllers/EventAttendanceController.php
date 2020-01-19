<?php
class EventAttendanceController extends BaseController
{
	public $restful = true; 

	public function getIndex($id)
	{
		Session::put('current_page', 'event/event');
		Session::put('current_resource', 'EVEN');
		$REEV07A = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV08', 'create');
		$REEV08D = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV08', 'delete');
		$REEV07R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV07', 'read');
		$REEV08R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV08', 'read');
		$REEV08P = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV08', 'print');
		$REEV05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'EV05', 'read');
		$REEVROL = AccessfCheck::getResourceRoleTrainer();
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$view = View::make('event/eventattendance');
		$eventname = EventmEvent::geteventattname($id);
		$eventcode = EventmEvent::getattuniquecode($id);
		$pagetitle = AttendancemAttendance::getdescription($id);
		$query = AttendancemAttendance::Role()->where('uniquecode', '=', $id)->get();
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->orderBy('description', 'ASC')->lists('description', 'description');
		$commonstatus_options = CommonzStatus::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$attendancetype_options = AttendancezType::Role()->lists('value', 'value');
		$groups_options = array('' => 'Please Select a Group') + GroupmGroup::Role()->orderBy('name', 'ASC')->lists('name', 'name');
		$ssaeventgroup_options = array('' => 'Please Select a Group') + EventmGroup::where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$ssaeventgroupprint_options = array('' => 'Please Select a Group') + EventmGroup::Role()
			->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitem_options = array('' => 'Please Select an Item') + EventmEventItem::where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$eventitemprint_options = array('' => 'Please Select an Item') + EventmEventItem::Role()
			->where('eventid', EventmEvent::getid($id))->orderBy('name', 'ASC')->lists('name', 'name');
		$view->title = $pagetitle;
		$view->with('rid', $id)->with('result', $query)->with('eventname', $eventname)->with('pagetitle', $pagetitle)
			->with('eventuniquecode', $eventcode)->with('REEV07A', $REEV07A)->with('REEV07R', $REEV07R)->with('REEVROL', $REEVROL)->with('REEV08D', $REEV08D)->with('REEV08P', $REEV08P)->with('REEV08R', $REEV08R)->with('REEV05R', $REEV05R)->with('commonstatus_options', $commonstatus_options)->with('eventitem_options', $eventitem_options)->with('eventitemprint_options', $eventitemprint_options)->with('ssagroup_options', $ssaeventgroup_options)->with('ssagroupprint_options', $ssaeventgroupprint_options)->with('attendancetype_options', $attendancetype_options)->with('event_options', $event_options)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('memposition_options', $memposition_options)->with('division_options', $division_options);
		return $view;
	}

	public function getEventAttendanceNameSearch()
	{
		$membercode = Input::get('term');
		$member = MembersmSSA::where('name','LIKE','%'. $membercode .'%')->orwhere('alias','LIKE','%'. $membercode .'%')->orwhere('uniquecode', 'Like', '%'. $membercode .'%')->orwhere('mmsuuid', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'uniquecode', 'name', 'alias', 'mmsuuid', 'mobile', 'tel', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['uniquecode'], 'label'=>$member['name'].' - '.$member['alias'].' - '.$member['rhq'].' - '.$member['zone'].' - '.$member['chapter'].' - '.$member['district'].' - '.$member['division'].' - '.$member['position'].' - '.$member['mobile'].' - '.$member['tel'].' - '.$member['uniquecode'], 'value' => $member['uniquecode']);
		}
		return Response::json($memberlist);
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			$searchresult = MembersmSSA::findorfail(MembersmSSA::getidbynrichash(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    
		    LogsfLogs::postLogs('Read', 28, $id, ' - Event - NRIC Search - ' . md5(Input::get('nricsearch')), NULL, NULL, 'Success');
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
			if (MembersmSSA::getcheckuniquecode(Input::get('nricsearch')) == true)
			{
				$memberid = MembersmSSA::getid1(Input::get('nricsearch'));
			}
			elseif (MembersmSSA::getcheckmmsuuid(Input::get('nricsearch')) == true)
			{
				$memberid = MembersmSSA::getidbymmsuuid(Input::get('nricsearch'));
			}
			else 
			{ 
				$memberid = 0;
			}
		}
		catch(\Exception $e) { $memberid = 0; }
		
		// Step 2 - Check if member exist in event or not
		try
		{
			$eventregid = EventmRegistration::getregidbymemberid(AttendancemAttendance::geteventid(Input::get('attendanceid')), $memberid);
		}
		catch(\Exception $e){ $eventregid = 0; }

		// Step 3 - Insert Record into Attendance
		if($memberid != 0 and $eventregid != 0)
		{
			$member = EventmRegistration::findorfail($eventregid, array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'memberid'));
			$memberssa = MembersmSSA::findorfail($memberid, array('name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'id'));

			if(AttendancemPerson::getEventAttendanceDuplicate($memberid, AttendancemAttendance::getid(Input::get('attendanceid')), $eventregid) == false)
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('attendanceid'));
				$post->memberid = $memberid;
				$post->eventid = AttendancemAttendance::geteventid(Input::get('attendanceid'));
				$post->eventregid = $eventregid;
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

			if(AttendancemPerson::getEventAttendanceDuplicate($memberid, AttendancemAttendance::getid(Input::get('attendanceid')), $eventregid) == false)
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('attendanceid'));
				$post->memberid = $memberid;
				$post->eventid = AttendancemAttendance::geteventid(Input::get('attendanceid'));
				$post->eventregid = 0;
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
				$post->positionlevel = $memberssa['positionlevel'];
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
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$mid = MembersmSSA::getid1(Input::get('memberid'));
				$member = MembersmSSA::find($mid)->toarray();
				$eventregid = AttendancemPerson::geteventregid(MembersmSSA::getid(Input::get('memberid')), EventmEvent::getdescid(Input::get('eventattendance')));
				
				if(AttendancemPerson::getEventAttendanceDuplicate($mid, AttendancemAttendance::getid(Input::get('moduleid')), $eventregid) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid($id);
					$post->memberid = $mid;
					$post->eventid = EventmEvent::getdescid(Input::get('eventattendance'));
					$post->eventregid = $eventregid;
					$post->name = $member['name'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->noofnewfriend = Input::get('noofnewfriend');
					$post->remarks = Input::get('remarks');
					$post->uniquecode = uniqid('', TRUE);
					$post->attendancestatus = 'Attended';
					$post->save();

					if($post->save())
					{
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

	public function postAddNewFriend($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid($id);
				$post->memberid = 0;
				$post->eventid = EventmEvent::getdescid(Input::get('eventattendance'));
				$post->eventregid = 0;
				$post->name = Input::get('membername');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district =Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = Input::get('positionlevel');
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
					LogsfLogs::postLogs('Update', 26, 0, ' - Event - Event Attendance Member Failed to Update ' . $id . Input::get('eEIvalue'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 26, $id, ' - Event - Update  Attendance Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Attendance - Edit Member - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postSPSearch($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$eventid = EventmEvent::getdescid(Input::get('eventattendance'));
				$eventregid = EventmRegistration::getSecurityPass(Input::get('spsearch'), $eventid);

				$member = EventmRegistration::find($eventregid)->toarray();

				if(AttendancemPerson::getEventAttendanceDuplicate( $member['memberid'], AttendancemAttendance::getid(Input::get('attendanceid')), $eventregid) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid($id);
					$post->memberid = $member['memberid'];
					$post->eventregid = $member['id'];
					$post->name = $member['name'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->uniquecode = uniqid('', TRUE);
					$post->attendancestatus = 'Attended';
					$post->remarks = $member['status'];
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 34, $post->id, ' - Attendance Detail - New Member - ' . Input::get('membername'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success', 'participantname' => $member['name']), 200);
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

	public function getAttendeesListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemPerson::Detail(AttendancemAttendance::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemPerson::Detail(AttendancemAttendance::getid($id))->Search('%'.$sSearch.'%', AttendancemAttendance::getid($id))->count();
		    $default = AttendancemPerson::Detail(AttendancemAttendance::getid($id))->Search('%'.$sSearch.'%', AttendancemAttendance::getid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
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

    public function getpositionstatsListing($id)
    {
        try {
            $default = AttendancemPerson::PositionStats(AttendancemAttendance::getid($id))->get()->toarray();

            return Response::json(array('data' => $default));
            
        } catch(\Exception $e) {
            LogsfLogs::postLogs('Read', 34, 0, ' - Attendance - Position Statistic [DT] - ' . $e, null, null, 'Failed');
        }
	}

	public function getParticipantListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmRegistration::Event(EventmRegistration::getattendanceventid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmRegistration::Event(EventmRegistration::getattendanceventid($id))->Search('%'.$sSearch.'%')->count();
		    $default = EventmRegistration::Event(EventmRegistration::getattendanceventid($id))->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)
		    	->get(array('created_at', 'name', 'rhq', 'zone', 'chapter', 
					'nric', 'division', 'status', 'uniquecode', 'dateofbirth', 'role', 'groupcode', 'auditioncode', 
					'eventitem', 'costume9', 'cardno'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Event Attendance - Participant Listing [DT] - ' . $e, NULL, NULL, 'Failed');
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

	public function putAttendance($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('attendancedate'));
				$post = AttendancemAttendance::find(AttendancemAttendance::getid($id));
				$post->attendancedate = $datDate;
				$post->eventid = EventmEvent::getdescid(Input::get('eventattendance'));
				$post->event = Input::get('eventattendance');
				$post->eventitem = Input::get('atteventitem');
				$post->description = Input::get('description');
				$post->attendancetype = Input::get('attendancetype');
				$post->status = Input::get('status');
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

	public function deleteAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'delete') == 't')
			{
				LogsfLogs::postLogs('Delete', 53, $id, ' - Event Attendance - Delete Attendee - ' . $id, NULL, NULL, 'Failed');
				$post = AttendancemPerson::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 53, $id, ' - Event Attendance - Delete Attendee - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 53, 0, ' - Event Attendance - Delete Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 53, $id, ' - Event Attendance - Delete Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAbsentAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
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
					LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - Update Attendee ' + $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - Update Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Event Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAttendedAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
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
					LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - Update Attendee ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - Update Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Event Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postAbsentAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
			{
				$member = EventmRegistration::find(EventmRegistration::getid($id))->toarray();
				LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance Detail - ' . $member['id'] . AttendancemAttendance::getid(Input::get('moduleid')), NULL, NULL, 'Failed');
				if(AttendancemPerson::getEventAttendanceregidDuplicate($member['id'], AttendancemAttendance::getid(Input::get('moduleid'))) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid(Input::get('moduleid'));
					$post->memberid = $member['memberid'];
					$post->eventregid = $member['id'];
					$post->name = $member['name'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->uniquecode = uniqid('', TRUE);
					$post->attendancestatus = 'Absent';
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 53, $post->id, ' - Event Attendance Detail - New Member - ' . $member['name'], NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - New Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Event Attendance - New Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postAttendedAttendee($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'update') == 't')
			{

				$member = EventmRegistration::find(EventmRegistration::getid($id))->toarray();
				if(AttendancemPerson::getEventAttendanceregidDuplicate($member['id'], AttendancemAttendance::getid(Input::get('moduleid'))) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid(Input::get('moduleid'));
					$post->memberid = $member['memberid'];
					$post->eventregid = $member['id'];
					$post->name = $member['name'];
					$post->rhq = $member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->positionlevel = $member['positionlevel'];
					$post->division = $member['division'];
					$post->uniquecode = uniqid('', TRUE);
					$post->attendancestatus = 'Attended';
					$post->save();

					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance Detail - New Member - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance - New Member Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 53, 0, ' - Event Attendance - Update Attendee - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Event Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventAttended($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$eventAttendeelist = EventmRegistration::where('eventid', EventmEvent::getdescid(Input::get('eventattendance')))
					->whereIn('role', array('Participant', 'Performer', 'Trainer', 'Admin'))->where('status', 'Accepted')->get()->toArray();				foreach($eventAttendeelist as $eventAttendeelist)
				{
					$insert[] = array(
						'attendanceid' => AttendancemAttendance::getid($id),
						'eventid' => AttendancemAttendance::geteventid($id),
				        'memberid' => $eventAttendeelist['memberid'],
				        'name' => $eventAttendeelist['name'],
				        'eventregid' => $eventAttendeelist['id'],
				        'rhq' => $eventAttendeelist['rhq'],
				        'zone' => $eventAttendeelist['zone'],
				        'chapter' => $eventAttendeelist['chapter'],
				        'district' => $eventAttendeelist['district'],
				        'division' => $eventAttendeelist['division'],
						'position' => $eventAttendeelist['position'],
						'positionlevel' => $eventAttendeelist['positionlevel'],
				        'remarks' => 'Group Code - '. $eventAttendeelist['groupcode'] . ' Audition Code - '. $eventAttendeelist['auditioncode'],
				        'attendancestatus' => 'Attended',
				        'uniquecode' => uniqid('', TRUE),
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Attendance_m_Person')->insert($insert);

				LogsfLogs::postLogs('Create', 53, $id, ' - Event Attendance - Mass Insert Attended - ' . Input::get('eventattendance'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance - Mass Insert Attended - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Event Attendance - Event Item - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postEventAbsent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$eventAttendeelist = EventmRegistration::where('eventid', EventmEvent::getdescid(Input::get('eventattendance')))
					->whereIn('role', array('Participant', 'Performer', 'Trainer', 'Admin'))->where('status', 'Accepted')->get()->toarray();
			
				foreach($eventAttendeelist as $eventAttendeelist)
				{
					$insert[] = array(
						'attendanceid' => AttendancemAttendance::getid($id),
						'eventid' => AttendancemAttendance::geteventid($id),
				        'memberid' => $eventAttendeelist['memberid'],
				        'name' => $eventAttendeelist['name'],
				        'eventregid' => $eventAttendeelist['id'],
				        'rhq' => $eventAttendeelist['rhq'],
				        'zone' => $eventAttendeelist['zone'],
				        'chapter' => $eventAttendeelist['chapter'],
				        'district' => $eventAttendeelist['district'],
				        'division' => $eventAttendeelist['division'],
						'position' => $eventAttendeelist['position'],
						'position' => $eventAttendeelist['position'],
				        'remarks' => 'Group Code - '. $eventAttendeelist['groupcode'] . ' Audition Code - '. $eventAttendeelist['auditioncode'],
				        'attendancestatus' => 'Absent',
				        'uniquecode' => uniqid('', TRUE),
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Attendance_m_Person')->insert($insert);

				LogsfLogs::postLogs('Create', 53, $id, ' - Attendance - Event Item - ' . Input::get('eventattendance'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postEventItemAttended($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$eventAttendeelist = EventmRegistration::where('eventid', EventmEvent::getdescid(Input::get('eventattendance')))
					->whereIn('role', array('Performer', 'Trainer', 'Admin'))->where('status', 'Accepted')->where('eventitem', Input::get('atteventitem'))->get()->toarray();
			
				foreach($eventAttendeelist as $eventAttendeelist)
				{
					$insert[] = array(
						'attendanceid' => AttendancemAttendance::getid($id),
				        'memberid' => $eventAttendeelist['memberid'],
				        'name' => $eventAttendeelist['name'],
				        'eventregid' => $eventAttendeelist['id'],
				        'rhq' => $eventAttendeelist['rhq'],
				        'zone' => $eventAttendeelist['zone'],
				        'chapter' => $eventAttendeelist['chapter'],
				        'district' => $eventAttendeelist['district'],
				        'division' => $eventAttendeelist['division'],
						'position' => $eventAttendeelist['position'],
						'positionlevel' => $eventAttendeelist['positionlevel'],
				        'remarks' => 'Group Code - '. $eventAttendeelist['groupcode'] . ' Audition Code - '. $eventAttendeelist['auditioncode'],
				        'attendancestatus' => 'Attended',
				        'uniquecode' => uniqid('', TRUE),
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Attendance_m_Person')->insert($insert);

				LogsfLogs::postLogs('Create', 53, $id, ' - Attendance - Event Item - ' . Input::get('eventattendance'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postEventItemAbsent($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'EV08', 'create') == 't')
		{
			try
			{
				$eventAttendeelist = EventmRegistration::where('eventid', EventmEvent::getdescid(Input::get('eventattendance')))
					->whereIn('role', array('Performer', 'Trainer', 'Admin'))->where('status', 'Accepted')->where('eventitem', Input::get('atteventitem'))->get()->toarray();
			
				$i = 0;

				foreach($eventAttendeelist as $eventAttendeelist)
				{
					$insert[] = array(
						'attendanceid' => AttendancemAttendance::getid($id),
				        'memberid' => $eventAttendeelist['memberid'],
				        'name' => $eventAttendeelist['name'],
				        'eventregid' => $eventAttendeelist['id'],
				        'rhq' => $eventAttendeelist['rhq'],
				        'zone' => $eventAttendeelist['zone'],
				        'chapter' => $eventAttendeelist['chapter'],
				        'district' => $eventAttendeelist['district'],
				        'division' => $eventAttendeelist['division'],
						'position' => $eventAttendeelist['position'],
						'positionlevel' => $eventAttendeelist['positionlevel'],
				        'attendancestatus' => 'Absent',
				        'remarks' => 'Group Code - '. $eventAttendeelist['groupcode'] . ' Audition Code - '. $eventAttendeelist['auditioncode'],
				        'uniquecode' => uniqid('', TRUE),
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Attendance_m_Person')->insert($insert);

				LogsfLogs::postLogs('Create', 53, $id, ' - Attendance - Event Item - ' . Input::get('eventattendance'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Event Item - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteAllAttendee($id)
	{
		try
		{
			AttendancemPerson::deleteAllAttendee(AttendancemAttendance::getid($id));
			LogsfLogs::postLogs('Delete', 53, $id, ' - Event Attendance - Attendee Delete All - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 53, $id, ' - Event Attendance - Attendee Delete All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
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

	public function postAttendancePrint($id)
	{
		try
		{
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Attendance getAttendeesListing - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Attendance getAttendeesListing - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postStudentDivisionAttendancePrint($id)
	{
		try
		{
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Attendance getAttendeesListing (Student Division) - ', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Attendance getAttendeesListing (Student Division) - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postAttendanceByPerformerPrint($id)
	{
		try
		{
			LogsfLogs::postLogs('Print', 30, $id, ' - Event - Print Attendance getAttendeesListing By Performer', NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 30, 0, ' - Event - Print Attendance getAttendeesListing By Performer - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}