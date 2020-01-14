<?php
class AttendanceController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'attendance/attendance');
		Session::put('current_resource', 'ATTE');
		$REAT03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'create');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$currentyear = date('Y');
		$divisiontype_options = CommonzDivisionType::Role()->lists('value', 'value');
		$leveltype_options = CommonzLevelType::Role()->lists('value', 'value');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()->orderBy('description', 'ASC')->lists('description', 'description');
		$view = View::make('attendance/attendance');
		$view->title = 'Attendance Listing';
		$view->with('REAT03A', $REAT03A)->with('rhq_options', $rhq_options)
			->with('chapter_options', $chapter_options)->with('currentyear', $currentyear)
			->with('divisiontype_options', $divisiontype_options)
			->with('leveltype_options', $leveltype_options)->with('event_options', $event_options);
		return $view;
	}

	public function getAttendanceListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::Role()->SearchAll('%'.$sSearch.'%')->count();
		    $default = AttendancemAttendance::Role()->SearchAll('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate', 'attendancetype', 'description', 'uniquecode', 'event', 'eventitem', 'status'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Attendance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDiscussionMeetingNotSubmitted()
	{
		try
		{
			$default = AttendancemAttendance::DMNotSubmittedStats()->get(array('attendancedate', 'attendancetype', 'description', 'uniquecode', 'event', 'eventitem', 'status'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Not Attended [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteAttendance($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AT03', 'delete') == 't')
			{
				$post = AttendancemAttendance::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 33, $id, ' - Attendance - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 33, 0, ' - Attendance - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 33, $id, ' - Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postAttendanceACCheck($id)
	{
		if (AccessfCheck::getCheckAttendanceAccess(AttendancemAttendance::getid($id)) == true)
		{
			try
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 34, 0, ' - Attendance - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Attendance - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postCreateDMAttendance()
	{
		try
		{
			$dmattendancelist = MemberszOrgChart::where('rhqabbv', Input::get('ddrhq'))->orderby('rhqabbv')->orderby('zoneabbv')->orderby('chapabbv')->orderby('district')->get()->toarray();
			$monthselect = '';
			if (Input::get('ddmonth') == '01') { $monthselect = 'Jan'; }
			else if (Input::get('ddmonth') == '02') { $monthselect = 'Feb'; }
			else if (Input::get('ddmonth') == '03') { $monthselect = 'Mar'; }
			else if (Input::get('ddmonth') == '04') { $monthselect = 'Apr'; }
			else if (Input::get('ddmonth') == '05') { $monthselect = 'May'; }
			else if (Input::get('ddmonth') == '06') { $monthselect = 'Jun'; }
			else if (Input::get('ddmonth') == '07') { $monthselect = 'Jul'; }
			else if (Input::get('ddmonth') == '08') { $monthselect = 'Aug'; }
			else if (Input::get('ddmonth') == '09') { $monthselect = 'Sep'; }
			else if (Input::get('ddmonth') == '10') { $monthselect = 'Oct'; }
			else if (Input::get('ddmonth') == '11') { $monthselect = 'Nov'; }
			else if (Input::get('ddmonth') == '12') { $monthselect = 'Dec'; }

			foreach($dmattendancelist as $dmattendancelist)
			{
				$post = new AttendancemAttendance;
				$post->attendancedate = date('Y') . '-' . Input::get('ddmonth') . '-' . Input::get('ddday');
				$post->attendancetime = '00:00:00';
				$post->uniquecode = uniqid('',TRUE);
				$post->rhq = $dmattendancelist['rhqabbv'];
				$post->zone = $dmattendancelist['zoneabbv'];
				$post->chapter = $dmattendancelist['chapabbv'];
				$post->district = $dmattendancelist['district'];
				if (Input::get('txtdescription') == "")
				{
					$post->description = $monthselect . ' ' . date('Y') . ' Discussion Meeting - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'] . ' - ' . $dmattendancelist['district'];
				}
				else
				{
					$post->description = Input::get('txtdescription') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'] . ' - ' . $dmattendancelist['district'];
				}
				$post->createbyname = Auth::user()->name;
				$post->attendancetype = 'Discussion Meeting';
				
				$post->save();

				if($post->save())
				{
					$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->where('district', $dmattendancelist['district'])->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					
					foreach($dmattendancememberlist as $dmattendancememberlist)
					{
						try
						{
							$postm = new AttendancemPerson;
							$postm->attendanceid = $post->id;
							$postm->eventid = 0;
							$postm->eventregid = 0;
							$postm->uniquecode = uniqid('',TRUE);
							$postm->memberid = $dmattendancememberlist['id'];
							$postm->name = $dmattendancememberlist['name'];
							$postm->chinesename = $dmattendancememberlist['chinesename'];
							$postm->rhq = $dmattendancememberlist['rhq'];
							$postm->zone = $dmattendancememberlist['zone'];
							$postm->chapter = $dmattendancememberlist['chapter'];
							$postm->district = $dmattendancememberlist['district'];
							$postm->division = $dmattendancememberlist['division'];
							$postm->position = $dmattendancememberlist['position'];
							$postm->positionlevel = $dmattendancememberlist['positionlevel'];
							if ($dmattendancememberlist['position'] == 'NF')
							{
								$postm->noofnewfriend = 1;
							}
							$postm->attendancestatus = 'Absent';
							$postm->created_at = date('Y-m-d H:i:s');
							$postm->updated_at = date('Y-m-d H:i:s');

							$postm->save();
						}
						catch(\Exception $e)
						{
							LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance - ' . $dmattendancememberlist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
						}
					}
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCreateDMLevelDivisionAttendance()
	{
		try
		{
			$dmattendancelist = "";	$monthselect = '';
			if (Input::get('leveltype') == 'Chapter')
			{
				$dmattendancelist = MemberszOrgChart::where('rhqabbv', Input::get('rhq'))->orderby('rhqabbv')->orderby('zoneabbv')->orderby('chapabbv')->groupby('rhq')->groupby('zone')->groupby('chapter')->get()->toarray();
			}
			else
			{
				LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance - Refused to Add', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);				
			}
			
			foreach($dmattendancelist as $dmattendancelist)
			{
				$post = new AttendancemAttendance;
				$post->attendancedate = date('Y') . '-' . Input::get('month') . '-' . Input::get('day');
				$post->attendancetime = '00:00:00';
				$post->uniquecode = uniqid('',TRUE);
				$post->rhq = $dmattendancelist['rhqabbv'];
				$post->zone = $dmattendancelist['zoneabbv'];
				$post->chapter = $dmattendancelist['chapabbv'];
				if (Input::get('leveltype') == 'Chapter') 
				{ 
					$post->district = '-'; 
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}
				else 
				{
					$post->district = $dmattendancelist['district'];
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}

				
				$post->createbyname = Auth::user()->name;
				$post->attendancetype = 'Discussion Meeting';
				
				$post->save();

				if($post->save())
				{
					$dmattendancememberlist = "";
					if (Input::get('divisiontype') == 'Youth Division')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('PD', 'YM', 'YW'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'Adult Division')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('MD', 'WD'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == '4 Division')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'MD')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('MD'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'WD')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('WD'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'YM')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('YM'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'YW')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('YW'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					elseif (Input::get('divisiontype') == 'PD')
					{
						$dmattendancememberlist = MembersmSSA::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->whereIn('division', array('PD'))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					}
					else { }

					foreach($dmattendancememberlist as $dmattendancememberlist)
						{
							try
							{
								$postm = new AttendancemPerson;
								$postm->attendanceid = $post->id;
								$postm->eventid = 0;
								$postm->eventregid = 0;
								$postm->uniquecode = uniqid('',TRUE);
								$postm->memberid = $dmattendancememberlist['id'];
								$postm->name = $dmattendancememberlist['name'];
								$postm->chinesename = $dmattendancememberlist['chinesename'];
								$postm->rhq = $dmattendancememberlist['rhq'];
								$postm->zone = $dmattendancememberlist['zone'];
								$postm->chapter = $dmattendancememberlist['chapter'];
								$postm->district = $dmattendancememberlist['district'];
								$postm->division = $dmattendancememberlist['division'];
								$postm->position = $dmattendancememberlist['position'];
								if ($dmattendancememberlist['position'] == 'NF')
								{
									$postm->noofnewfriend = 1;
								}
								$postm->attendancestatus = 'Absent';
								$postm->created_at = date('Y-m-d H:i:s');
								$postm->updated_at = date('Y-m-d H:i:s');

								$postm->save();
							}
							catch(\Exception $e)
							{
								LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance - ' . $dmattendancememberlist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
							}
						}
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Discussion Meeting Attendance By Division By Level - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCreateEventTrainingAttendance()
	{
		try
		{
			$dmattendancelist = "";	$monthselect = '';
			if (Input::get('leveltype') == 'Chapter')
			{
				$dmattendancelist = MemberszOrgChart::where('rhqabbv', Input::get('rhq'))->orderby('rhqabbv')->orderby('zoneabbv')->orderby('chapabbv')->groupby('rhq')->groupby('zone')->groupby('chapter')->get()->toarray();
			}
			else
			{
				LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance - Refused to Add', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);				
			}
			
			foreach($dmattendancelist as $dmattendancelist)
			{
				$post = new AttendancemAttendance;
				$post->attendancedate = date('Y') . '-' . Input::get('month') . '-' . Input::get('day');
				$post->attendancetime = '00:00:00';
				$post->eventid = EventmEvent::getdescid(Input::get('event'));
				$post->event = Input::get('event');
				$post->uniquecode = uniqid('',TRUE);
				$post->rhq = $dmattendancelist['rhqabbv'];
				$post->zone = $dmattendancelist['zoneabbv'];
				$post->chapter = $dmattendancelist['chapabbv'];
				if (Input::get('leveltype') == 'Chapter') 
				{ 
					$post->district = '-'; 
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}
				else 
				{
					$post->district = $dmattendancelist['district'];
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}

				
				$post->createbyname = Auth::user()->name;
				$post->attendancetype = 'Training';
				
				$post->save();

				if($post->save())
				{
					$dmattendancememberlist = EventmRegistration::where('rhq', $dmattendancelist['rhqabbv'])->where('zone', $dmattendancelist['zoneabbv'])->where('chapter', $dmattendancelist['chapabbv'])->where('eventid', EventmEvent::getdescid(Input::get('event')))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'memberid', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					
					foreach($dmattendancememberlist as $dmattendancememberlist)
					{
						try
						{
							$postm = new AttendancemPerson;
							$postm->attendanceid = $post->id;
							$postm->eventid = EventmEvent::getdescid(Input::get('event'));
							$postm->eventregid = $dmattendancememberlist['id'];
							$postm->uniquecode = uniqid('',TRUE);
							$postm->memberid = $dmattendancememberlist['memberid'];
							$postm->name = $dmattendancememberlist['name'];
							$postm->chinesename = $dmattendancememberlist['chinesename'];
							$postm->rhq = $dmattendancememberlist['rhq'];
							$postm->zone = $dmattendancememberlist['zone'];
							$postm->chapter = $dmattendancememberlist['chapter'];
							$postm->district = $dmattendancememberlist['district'];
							$postm->division = $dmattendancememberlist['division'];
							$postm->position = $dmattendancememberlist['position'];
							if ($dmattendancememberlist['position'] == 'NF')
							{
								$postm->noofnewfriend = 1;
							}
							$postm->attendancestatus = 'Absent';
							$postm->created_at = date('Y-m-d H:i:s');
							$postm->updated_at = date('Y-m-d H:i:s');

							$postm->save();
						}
						catch(\Exception $e)
						{
							LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance - ' . $dmattendancememberlist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
						}
					}
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance By Event - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postCreateGroupCodePrefixTrainingAttendance()
	{
		try
		{
			$dmattendancelist = "";	$monthselect = '';
			if (Input::get('leveltype') == 'Chapter')
			{
				$dmattendancelist = MemberszOrgChart::where('rhqabbv', Input::get('rhq'))->orderby('rhqabbv')->orderby('zoneabbv')->orderby('chapabbv')->groupby('rhq')->groupby('zone')->groupby('chapter')->get()->toarray();
			}
			else
			{
				LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance - Refused to Add', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);				
			}
			
			foreach($dmattendancelist as $dmattendancelist)
			{
				$post = new AttendancemAttendance;
				$post->attendancedate = date('Y') . '-' . Input::get('month') . '-' . Input::get('day');
				$post->attendancetime = '00:00:00';
				$post->eventid = EventmEvent::getdescid(Input::get('event'));
				$post->event = Input::get('event');
				$post->uniquecode = uniqid('',TRUE);
				$post->groupcodeprefix = $dmattendancelist['rhqabbv'] . $dmattendancelist['zoneabbv']. $dmattendancelist['chapabbv'];
				$post->rhq = $dmattendancelist['rhqabbv'];
				$post->zone = $dmattendancelist['zoneabbv'];
				$post->chapter = $dmattendancelist['chapabbv'];
				if (Input::get('leveltype') == 'Chapter') 
				{ 
					$post->district = '-'; 
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}
				else 
				{
					$post->district = $dmattendancelist['district'];
					$post->description = Input::get('description') . ' - ' . $dmattendancelist['rhqabbv'] . ' - ' . $dmattendancelist['zoneabbv'] . ' - '. $dmattendancelist['chapabbv'];
				}

				
				$post->createbyname = Auth::user()->name;
				$post->attendancetype = 'Training';
				
				$post->save();

				if($post->save())
				{
					$dmattendancememberlist = EventmRegistration::where('groupcodeprefix', $dmattendancelist['rhqabbv'] . $dmattendancelist['zoneabbv']. $dmattendancelist['chapabbv'])->where('eventid', EventmEvent::getdescid(Input::get('event')))->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('id', 'memberid', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'))->toarray();
					
					foreach($dmattendancememberlist as $dmattendancememberlist)
					{
						try
						{
							$postm = new AttendancemPerson;
							$postm->attendanceid = $post->id;
							$postm->eventid = EventmEvent::getdescid(Input::get('event'));
							$postm->eventregid = $dmattendancememberlist['id'];
							$postm->uniquecode = uniqid('',TRUE);
							$postm->memberid = $dmattendancememberlist['memberid'];
							$postm->name = $dmattendancememberlist['name'];
							$postm->chinesename = $dmattendancememberlist['chinesename'];
							$postm->rhq = $dmattendancememberlist['rhq'];
							$postm->zone = $dmattendancememberlist['zone'];
							$postm->chapter = $dmattendancememberlist['chapter'];
							$postm->district = $dmattendancememberlist['district'];
							$postm->division = $dmattendancememberlist['division'];
							$postm->position = $dmattendancememberlist['position'];
							if ($dmattendancememberlist['position'] == 'NF')
							{
								$postm->noofnewfriend = 1;
							}
							$postm->attendancestatus = 'Absent';
							$postm->created_at = date('Y-m-d H:i:s');
							$postm->updated_at = date('Y-m-d H:i:s');

							$postm->save();
						}
						catch(\Exception $e)
						{
							LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance - ' . $dmattendancememberlist['name'] . ' - ' . $e, NULL, NULL, 'Failed');
						}
					}
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 34, 0, ' - Training Attendance By Event - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postClosedDMAttendance()
	{
		try
		{
			AttendancemAttendance::postAttendanceDMClosed(Input::get('txtyear'), Input::get('ddmonth'));
			
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Discussion Meeting Attendance Update - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postClosedDMAttendanceSubmitted()
	{
		try
		{
			AttendancemAttendance::postAttendanceDMClosedSubmitted(Input::get('txtyear'), Input::get('ddmonth'));
			
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Discussion Meeting Attendance Update - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postDMStatsUpdate()
	{
		try
		{
			$statement = 'UPDATE Attendance_m_Attendance aa, (SELECT aa.id, aa.uniquecode, aa.description, COUNT(ap.attendancestatus) as TokangMembership, SUM(CASE WHEN ap.division IN ("MD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srmd as "MD", SUM(CASE WHEN ap.division IN ("WD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srwd as "WD", SUM(CASE WHEN ap.division IN ("YM") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srymd as "YMD", SUM(CASE WHEN ap.division IN ("YW") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srymd as "YWD", SUM(CASE WHEN ap.division IN ("PD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "PD", SUM(CASE WHEN ap.division IN ("YC") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "YC", SUM(CASE WHEN ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + (srmd + srwd + srymd + srywd) as "DivisionAttendanceTotal", SUM(CASE WHEN ap.position NOT IN ("NF", "MEM", "BEL") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "LDR", SUM(CASE WHEN ap.position IN ("MEM") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "MEM", SUM(CASE WHEN ap.position IN ("BEL") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "BEL", SUM(CASE WHEN ap.position IN ("NF") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "NF", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division ="MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srmd as "ldrmd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memmd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belmd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfmd", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srwd as "ldrwd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memwd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belwd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfwd", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srymd as "ldrymd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memymd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belymd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfymd", 0 as PDm , 0 as YCm, SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srywd as "ldrywd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memywd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belywd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfywd" FROM Attendance_m_Attendance aa LEFT JOIN Attendance_m_Person ap on aa.id = ap.attendanceid LEFT JOIN Members_z_Position mp on mp.code = ap.position WHERE attendancetype IN ("Discussion Meeting") and aa.status = "Active" and year(aa.attendancedate) =' . Input::get('txtyear') . ' and month(aa.attendancedate) = ' . Input::get('ddmonth') . ' and ap.deleted_at IS NULL GROUP BY aa.description) ap SET aa.tokangmembership = ap.TokangMembership, aa.md = ap.md, aa.wd = ap.wd, aa.ymd = ap.ymd, aa.ywd = ap.ywd, aa.pd = ap.pd, aa.yc = ap.yc, aa.attendancetotal = ap.DivisionAttendanceTotal, aa.ldr = ap.LDR, aa.mem = ap.MEM, aa.bel = ap.BEL, aa.nf = ap.NF, aa.ldrmd = ap.ldrmd, aa.memmd = ap.memmd, aa.belmd = ap.belmd, aa.nfmd = ap.nfmd, aa.ldrwd = ap.ldrwd, aa.memwd = ap.memwd, aa.belwd = ap.belwd, aa.nfwd = ap.nfwd, aa.ldrymd = ap.ldrymd, aa.memymd = ap.memymd, aa.belymd = ap.belymd, aa.nfymd = ap.nfymd, aa.ldrywd = ap.ldrywd, aa.memywd = ap.memywd, aa.belywd = ap.belywd, aa.nfywd = ap.nfywd WHERE aa.id = ap.id;';
			DB::Statement($statement);

			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, 0, ' - Discussion Meeting Attendance Update Statistic - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}