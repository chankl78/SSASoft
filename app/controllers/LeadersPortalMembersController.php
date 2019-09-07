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
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode'));
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
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::MembersRhq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::MembersRhq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::MembersRhq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
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
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::MembersZone()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::MembersZone()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::MembersZone()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
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
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::MembersChapter()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::MembersChapter()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::MembersChapter()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
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
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::MembersDistrict()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::MembersDistrict()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::MembersDistrict()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename', 'alias','rhq','zone','chapter','district','division','position','uniquecode'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
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