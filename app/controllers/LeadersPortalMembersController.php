<?php
class LeadersPortalMembersController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Member');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/memberslisting');
		$view->title = 'BOE Portal - Members Listing';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
	}

	public function getMembersListingShq() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::MembersShq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::MembersShq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::MembersShq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at', 'description', 'currentage'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (SHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembersListingRhq() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::MembersRhq()->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at', 'description', 'currentage'));
     		return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (RHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembersListingZone() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::MembersZone()->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at', 'description', 'currentage'));
     		return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (Zone) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembersListingChapter() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::MembersChapter()->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at', 'description', 'currentage'));
     		return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (Chapter) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembersListingDistrict() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::MembersDistrict()->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode','created_at', 'description', 'currentage'));
     		return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembersInfo($id) // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemPerson::MembersAttendanceInEvent(MembersmSSA::getid1($id))->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemPerson::MembersAttendanceInEvent(MembersmSSA::getid1($id))->count();
		    $result = AttendancemPerson::MembersAttendanceInEvent(MembersmSSA::getid1($id))->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate','description'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Members (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}