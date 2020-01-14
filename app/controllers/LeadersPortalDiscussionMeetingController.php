<?php
class LeadersPortalDiscussionMeetingController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/DiscussionMeeting');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$dmname = AttendancemAttendance::getdescription($id);
		$memposition_options = MemberszPosition::Role()->whereIn('name', array('Believer', 'New Friend', 'Member'))->orderBy('name', 'ASC')->lists('name', 'code');
		$position_options = MemberszPosition::Role()->whereIn('level', array('bel', 'nf', 'mem', 'district'))->orderBy('name', 'ASC')->lists('name', 'code');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$rhq = Session::get('gakkaiuserrhq');
		$zone = Session::get('gakkaiuserzone');
		$chapter = Session::get('gakkaiuserchapter');
		$district = Session::get('gakkaiuserdistrict');
		$query = AttendancemAttendance::Role()->where('uniquecode', '=', $id)->get();
		$view = View::make('leaderportal/discussionmeeting');
		$view->title = 'BOE Portal - ' . $dmname;
		return $view->with('gakkaishq', $gakkaishq)->with('gakkaidistrict', $gakkaidistrict)->with('gakkaichapter', $gakkaichapter)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('dmname', $dmname)->with('rid', $id)->with('result', $query)->with('memposition_options', $memposition_options)->with('position_options', $position_options)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('rhq', $rhq)->with('zone', $zone)->with('chapter', $chapter)->with('district', $district);
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function getDiscussionMeetingAttendees($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::where('attendanceid', AttendancemAttendance::getid($id))->get(array('name', 'chinesename','division','rhq','zone','chapter','district', 'position', 'attendancestatus','uniquecode'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Discussion Meeting Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getdistrictstatsListing($id)
	{
		try
		{
			$default = AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id));
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - DM Attendance - District DM Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDiscussionMeetingHomevisit($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemAttendance::DistrictHVStats(AttendancemAttendance::getid($id));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Discussion Meeting Homevisit [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getAttendeeInfo($id)
	{
		// Search membership
		try
		{
			$introducer = ""; $mobile = ""; $cname = "";
			$member = AttendancemPerson::findorfail(AttendancemPerson::getid($id), array('memberid','uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'remarks'));
			if($member['memberid'] != 0)
			{
				$memberssa = MembersmSSA::findorfail($member['memberid'], array('chinesename', 'introducer', 'mobile'));
				$introducer = $memberssa['introducer']; $mobile = $memberssa['mobile']; 
				$cname = $memberssa['chinesename'];
			}
		    else { $cname = $member['chinesename']; }
			return Response::json(array(
				'uniquecode' => $id, 
				'name' => $member['name'],
				'chinesename' => $cname, 
				'rhq' => $member['rhq'], 
				'zone' => $member['zone'], 
				'chapter' => $member['chapter'], 
				'district' => $member['district'], 
				'position' => $member['position'], 
				'division' => $member['division'],
				'remarks' => $member['remarks'],
				'introducer' => $introducer,
				'mobile' => $mobile
			), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, $id, ' - Leaders Portal - Discussion Meeting Get individual Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Error'), 400);
		}
	}

	public function putAbsentAttendee($id)
	{
		if (AttendancemAttendance::getattendancestatus(AttendancemPerson::getattendanceuniquecode($id)) == false)
		{
			try
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
					LogsfLogs::postLogs('Update', 53, AttendancemPerson::getid($id), ' - Discussion Meeting - Update Attendee ' + $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, AttendancemPerson::getid($id), ' - Discussion Meeting Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function putAttendedAttendee($id)
	{
		if (AttendancemAttendance::getattendancestatus(AttendancemPerson::getattendanceuniquecode($id)) == false)
		{
			try
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
					LogsfLogs::postLogs('Update', 53, AttendancemPerson::getid($id), ' - Discussion Meeting Attendance - Update Attendee ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, AttendancemPerson::getid($id), ' - Discussion Meeting Attendance - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function postNewAttendee($id)
	{
		if (AttendancemAttendance::getattendancestatus($id) == false)
		{
			try
			{
				$attendance = AttendancemAttendance::findorfail(AttendancemAttendance::getid($id), array('rhq', 'zone', 'chapter', 'district'));
				
				$post = new AttendancemPerson;
				$post->attendanceid = AttendancemAttendance::getid(Input::get('id'));
				$post->name = Input::get('name');
				$post->chinesename = Input::get('cname');
				$post->memberid = 0;
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district =Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
				$post->division = Input::get('division');
				if (Input::get('position') == 'NF') { $post->noofnewfriend = 1; }
				$post->uniquecode = uniqid('', TRUE);
				$post->attendancestatus = 'Attended';
				$post->remarks = Input::get('remarks');
				$post->save();

				if($post->save())
				{

					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function postEditAttendee($id)
	{
		if (AttendancemAttendance::getattendancestatus($id) == false)
		{
			try
			{
				// Update to Members_m_SSA
				if(AttendancemPerson::getmemberid(Input::get('uniquecode')) != 0)
				{
					$mssa = MembersmSSA::find(AttendancemPerson::getmemberid(Input::get('uniquecode')));
					$mssa->name = Input::get('name');
					$mssa->chinesename = Input::get('cname');
					$mssa->division = Input::get('division');
					$mssa->position = Input::get('position');
					$mssa->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
					if(Input::get('mobile') == ''){$mssa->mobile = 'NIL';} else {$mssa->mobile = Input::get('mobile');}
					$mssa->introducer = Input::get('introducer');
					$mssa->save();

					if($mssa->save())
					{
						$post = AttendancemPerson::find(AttendancemPerson::getid(Input::get('uniquecode')));
						$post->name = Input::get('name');
						$post->chinesename = Input::get('cname');
						$post->rhq = Input::get('rhq');
						$post->zone = Input::get('zone');
						$post->chapter = Input::get('chapter');
						$post->district = Input::get('district');
						$post->division = Input::get('division');
						$post->position = Input::get('position');
						$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
						if (Input::get('position') == 'NF') { $post->noofnewfriend = 1; }
						$post->remarks = Input::get('remarks');
						$post->save();

						if($post->save())
						{
							return Response::json(array('info' => 'Success'), 200);
						}
						else
						{
							LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - Edit Attendee - Failed to Save', NULL, NULL, 'Failed');
							return Response::json(array('info' => 'Duplicate'), 400);
						}
					}	
				}
				else
				{
					$post = AttendancemPerson::find(AttendancemPerson::getid(Input::get('uniquecode')));
					$post->name = Input::get('name');
					$post->chinesename = Input::get('cname');
					$post->rhq = Input::get('rhq');
					$post->zone = Input::get('zone');
					$post->chapter = Input::get('chapter');
					$post->district = Input::get('district');
					$post->division = Input::get('division');
					$post->position = Input::get('position');
					$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
					if (Input::get('position') == 'NF') { $post->noofnewfriend = 1; }
					$post->remarks = Input::get('remarks');
					$post->save();

					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - Edit Attendee - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function deleteAttendee($id)
	{
		if (AttendancemAttendance::getattendancestatus(AttendancemPerson::getattendanceuniquecode($id)) == false)
		{
			try
			{
				$post = AttendancemPerson::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 53, $id, ' - Discussion Meeting Attendance - Delete Attendee - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Delete', 53, $id, ' - Discussion Meeting Attendance - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function postSRZCAttendance($id)
	{
		if (AttendancemAttendance::getattendancestatus($id) == false)
		{
			try
			{
				$post = AttendancemAttendance::find(AttendancemAttendance::getid(Input::get('uniquecode')));
				$post->srmd = Input::get('md');
				$post->srwd = Input::get('wd');
				$post->srymd = Input::get('ymd');
				$post->srywd = Input::get('ywd');
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

						if($post->save())
						{
						}
						else
						{
							LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - Statistic - Failed to Save', NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
					}
					
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - SRZC - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function postHomevisit($id)
	{
		if (AttendancemAttendance::getattendancestatus($id) == false)
		{
			try
			{
				$post = AttendancemAttendance::find(AttendancemAttendance::getid(Input::get('uniquecode')));
				$post->hvmd = Input::get('md');
				$post->hvwd = Input::get('wd');
				$post->hvymd = Input::get('ymd');
				$post->hvywd = Input::get('ywd');
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

						if($post->save())
						{
						}
						else
						{
							LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - Statistic - Failed to Save', NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
					}

					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting - Homevisit - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Update Attendee - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Over', 'value' => $id), 400);
		}
	}

	public function postDMStatistic($id)
	{
		try
		{
			$statement = 'UPDATE Attendance_m_Attendance aa, (SELECT aa.id, aa.uniquecode, aa.description, COUNT(ap.attendancestatus) as TokangMembership, SUM(CASE WHEN ap.division IN ("MD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srmd as "MD", SUM(CASE WHEN ap.division IN ("WD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srwd as "WD", SUM(CASE WHEN ap.division IN ("YM") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srymd as "YMD", SUM(CASE WHEN ap.division IN ("YW") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + srymd as "YWD", SUM(CASE WHEN ap.division IN ("PD") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "PD", SUM(CASE WHEN ap.division IN ("YC") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "YC", SUM(CASE WHEN ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + (srmd + srwd + srymd + srywd) as "DivisionAttendanceTotal", SUM(CASE WHEN ap.position NOT IN ("NF", "MEM", "BEL") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "LDR", SUM(CASE WHEN ap.position IN ("MEM") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "MEM", SUM(CASE WHEN ap.position IN ("BEL") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "BEL", SUM(CASE WHEN ap.position IN ("NF") and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "NF", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division ="MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srmd as "ldrmd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memmd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belmd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "MD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfmd", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srwd as "ldrwd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memwd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belwd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "WD" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfwd", SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srymd as "ldrymd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memymd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belymd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "YM" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfymd", 0 as PDm , 0 as YCm, SUM(CASE WHEN mp.level IN ("district", "group") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) + aa.srywd as "ldrywd", SUM(CASE WHEN mp.level IN ("mem") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "memywd", SUM(CASE WHEN mp.level IN ("bel") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "belywd", SUM(CASE WHEN mp.level IN ("nf") and ap.division = "YW" and ap.attendancestatus IN ("attended") and ap.deleted_at IS NULL THEN 1 ELSE 0 End) as "nfywd" FROM Attendance_m_Attendance aa LEFT JOIN Attendance_m_Person ap on aa.id = ap.attendanceid LEFT JOIN Members_z_Position mp on mp.code = ap.position WHERE aa.uniquecode = "' . $id . '" GROUP BY aa.description) ap SET aa.tokangmembership = ap.TokangMembership, aa.md = ap.md, aa.wd = ap.wd, aa.ymd = ap.ymd, aa.ywd = ap.ywd, aa.pd = ap.pd, aa.yc = ap.yc, aa.attendancetotal = ap.DivisionAttendanceTotal, aa.ldr = ap.LDR, aa.mem = ap.MEM, aa.bel = ap.BEL, aa.nf = ap.NF, aa.ldrmd = ap.ldrmd, aa.memmd = ap.memmd, aa.belmd = ap.belmd, aa.nfmd = ap.nfmd, aa.ldrwd = ap.ldrwd, aa.memwd = ap.memwd, aa.belwd = ap.belwd, aa.nfwd = ap.nfwd, aa.ldrymd = ap.ldrymd, aa.memymd = ap.memymd, aa.belymd = ap.belymd, aa.nfymd = ap.nfymd, aa.ldrywd = ap.ldrywd, aa.memywd = ap.memywd, aa.belywd = ap.belywd, aa.nfywd = ap.nfywd WHERE aa.id = ap.id;';
			DB::Statement($statement);

			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Statistic - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}