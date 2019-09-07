<?php
class LeadersPortalLeadersController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Leader');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$view = View::make('leaderportal/leaderslisting');
		$view->title = 'BOE Portal - Leaders Listing';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict);
	}

	public function getLeadersListingSHQ() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::LeadersShq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::LeadersShq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::LeadersShq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Leaders (SHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getLeadersListingRHQ() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::LeadersRhq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::LeadersRhq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::LeadersRhq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Leaders (RHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getLeadersListingZone() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::LeadersZone()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::LeadersZone()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::LeadersZone()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Leaders (Zone) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getLeadersListingChapter() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::LeadersChapter()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::LeadersChapter()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::LeadersChapter()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Leaders (Chapter) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getLeadersListingDistrict() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::LeadersDistrict()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::LeadersDistrict()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::LeadersDistrict()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('division')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Leaders (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}