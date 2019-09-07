<?php
class LeadersPortalStudyMeetingController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/StudyMeeting');
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$dmname = AttendancemAttendance::getdescription($id);
		$memposition_options = MemberszPosition::Role()->orderBy('name', 'ASC')->lists('name', 'code');
		$view = View::make('leaderportal/studymeeting');
		$view->title = 'BOE Portal - ' . $dmname;
		return $view->with('gakkaidistrict', $gakkaidistrict)->with('dmname', $dmname)->with('rid', $id)->with('memposition_options', $memposition_options);
	}

	public function getStudyMeetingAttendees($id) // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemPerson::where('attendanceid', AttendancemAttendance::getid($id))->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemPerson::where('attendanceid', AttendancemAttendance::getid($id))->Search('%'.$sSearch.'%', AttendancemAttendance::getid($id))->count();
		    $result = AttendancemPerson::where('attendanceid', AttendancemAttendance::getid($id))->Search('%'.$sSearch.'%', AttendancemAttendance::getid($id))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get(array('name','division','rhq','zone','chapter','district', 'position', 'attendancestatus','uniquecode'));
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Discussion Meeting Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getdistrictstatsListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id))->count();
		    $default = AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - DM Attendance - District DM Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putAbsentAttendee($id)
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

	public function putAttendedAttendee($id)
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

	public function postNewAttendee($id)
	{
		try
		{
			try
			{
				// Add to Members_m_SSA
				$mssa = new MembersmSSA;
				$mssa->name = Input::get('name');
				$mssa->nric = 'NIL';
				$mssa->nrichash = md5(Input::get('name'));
				$mssa->searchcode = '000';
				$mssa->personid = 0;
				$mssa->rhq = Session::get('gakkaiuserrhq');
				$mssa->zone = Session::get('gakkaiuserzone');
				$mssa->chapter = Session::get('gakkaiuserchapter');
				$mssa->district = Session::get('gakkaiuserdistrict');
				$mssa->position = Input::get('position');
				$mssa->division = Input::get('division');
				$mssa->uniquecode = uniqid('',TRUE);
				$mssa->source = 'ATTE';
				$mssa->resourcefromid = 0;

				$mssa->tel = 'NIL';
				$mssa->mobile = 'NIL';
				$mssa->email = 'NIL';
				$mssa->introducer = Input::get('introducer');
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
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid(Input::get('id'));
					$post->name = Input::get('name');
					$post->memberid = $mssa->id;
					$post->rhq = Session::get('gakkaiuserrhq');
					$post->zone = Session::get('gakkaiuserzone');
					$post->chapter = Session::get('gakkaiuserchapter');
					$post->district = Session::get('gakkaiuserdistrict');
					$post->position = Input::get('position');
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
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Discussion Meeting Attendance - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - Discussion Meeting - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}