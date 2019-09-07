<?php
class LeadersPortalStudyMeetingListingController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/StudyMeeting');
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/studymeetinglisting');
		$view->title = 'BOE Portal - Study Meeting Listing';
		return $view->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
	}

	public function getStudyMeetingListingDistrict() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::StudyMeetingListingDistrict()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::StudyMeetingListingDistrict()->SearchAll('%'.$sSearch.'%')->count();
		    $result = AttendancemAttendance::StudyMeetingListingDistrict()->SearchAll('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate','description','rhq','zone','chapter','district','uniquecode'));
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Discussion Meeting Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postdistrictattendees()
	{
		try
		{
			$id = Input::get('id');

			if (AttendancemPerson::where('attendanceid', AttendancemAttendance::getid($id))->count() == 0)
			{
				$eventAttendeelist = MembersmSSA::where('chapter', Session::get('gakkaiuserchapter'))->where('district', Session::get('gakkaiuserdistrict'))
					->get()->toarray();
			
				foreach($eventAttendeelist as $eventAttendeelist)
				{
					$insert[] = array(
						'attendanceid' => AttendancemAttendance::getid($id),
				        'memberid' => $eventAttendeelist['id'],
				        'name' => $eventAttendeelist['name'],
				        'rhq' => $eventAttendeelist['rhq'],
				        'zone' => $eventAttendeelist['zone'],
				        'chapter' => $eventAttendeelist['chapter'],
				        'district' => $eventAttendeelist['district'],
				        'division' => $eventAttendeelist['division'],
				        'position' => $eventAttendeelist['position'],
				        'attendancestatus' => 'Absent',
				        'uniquecode' => uniqid('', TRUE),
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
				    );
				}

				DB::table('Attendance_m_Person')->insert($insert);

				return Response::json(array('info' => 'Success'), 200);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Attendance - Discussion Meeting - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}
}