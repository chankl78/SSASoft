<?php
class LeadersPortalDiscussionMeetingListingController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/DiscussionMeeting');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$dmyear_options = AttendancemAttendance::DMyear()->lists('year', 'year');
		$dmyear = date('Y');
		$dmmonth = date('m');
		$view = View::make('leaderportal/discussionmeetinglisting');
		$view->title = 'BOE Portal - Discussion Meeting Listing';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('dmyear_options', $dmyear_options)
			->with('dmyear', $dmyear)->with('dmmonth', $dmmonth);
	}

	public function getDiscussionMeetingListingDistrict() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::DiscussionMeetingListingDistrict()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::DiscussionMeetingListingDistrict()->SearchAll('%'.$sSearch.'%')->count();
		    $result = AttendancemAttendance::DiscussionMeetingListingDistrict()->SearchAll('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate','description','rhq','zone','chapter','district','uniquecode'));
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Discussion Meeting Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDiscussionMeetingListingSummary() // Server-Side Datatable
	{
		try
		{
			if (Session::get('gakkaiuserpositionlevel') == 'shq')
			{	
				$default = AttendancemAttendance::whereIn('attendancetype', array('Discussion Meeting', 'Training'))->get();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'rhq')
			{	
				$default = AttendancemAttendance::whereIn('attendancetype', array('Discussion Meeting', 'Training'))->where('rhq', Session::get('gakkaiuserrhq'))->get();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'zone')
			{	
				$default = AttendancemAttendance::whereIn('attendancetype', array('Discussion Meeting', 'Training'))->where('zone', Session::get('gakkaiuserzone'))->get();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'chapter')
			{	
				$default =  AttendancemAttendance::whereIn('attendancetype', array('Discussion Meeting', 'Training'))->where('chapter', Session::get('gakkaiuserchapter'))->get();
				return Response::json(array('data' => $default));
			}
			elseif (Session::get('gakkaiuserpositionlevel') == 'district')
			{	
				$result = AttendancemAttendance::whereIn('attendancetype', array('Discussion Meeting', 'Training'))->where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))->get();
				return Response::json(array('data' => $result));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Discussion Meeting Attendance Summary [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postdistrictattendees()
	{
		try
		{
			$id = Input::get('id');
			// Get Discussion Meeting Chapter & District
			$requestchapter = AttendancemAttendance::getattendancechapter($id);
			$requestdistrict = AttendancemAttendance::getattendancedistrict($id);
			$totalssadistrictmembership = MembersmSSA::gettotaldistrictcount($requestchapter, $requestdistrict);

			if(MembersmSSA::gettotaldistrictcount($requestchapter, $requestdistrict) == AttendancemPerson::gettotalattendancecount(AttendancemAttendance::getid($id)))
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else if (MembersmSSA::gettotaldistrictcount($requestchapter, $requestdistrict) <= AttendancemPerson::gettotalattendancecount(AttendancemAttendance::getid($id))) 
			{
				return Response::json(array('info' => 'Success'), 200);
			}

			$eventAttendeelist = MembersmSSA::where('chapter', $requestchapter)->where('district',  $requestdistrict)->get()->toarray();

			foreach($eventAttendeelist as $eventAttendeelist)
			{
				//Check for duplicate
				if(AttendancemPerson::getAttendancePersonDuplicate($eventAttendeelist['id'], AttendancemAttendance::getid($id)) == false)
				{
					$post = new AttendancemPerson;
					$post->attendanceid = AttendancemAttendance::getid($id);
					$post->memberid = $eventAttendeelist['id'];
					$post->name = $eventAttendeelist['name'];
					$post->chinesename = $eventAttendeelist['chinesename'];
					$post->rhq = $eventAttendeelist['rhq'];
					$post->zone = $eventAttendeelist['zone'];
					$post->chapter = $eventAttendeelist['chapter'];
					$post->district = $eventAttendeelist['district'];
					$post->division = $eventAttendeelist['division'];
					$post->position = $eventAttendeelist['position'];
					$post->attendancestatus = 'Absent';
					$post->uniquecode = uniqid('', TRUE);
					$post->created_at = date('Y-m-d H:i:s');
					$post->updated_at = date('Y-m-d H:i:s');
					$post->save();
				}
			}
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Discussion Meeting - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}