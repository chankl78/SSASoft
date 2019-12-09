<?php
class DashboardController extends BaseController
{
	public function getIndex()
	{
		Session::put('current_page', 'Dashboard');
		Session::put('current_resource', 'USER');
		$RGACRI = AccessfCheck::getSoftwareAdmin(Auth::user()->roleid, 'ACRI'); //Session::get(Session::getId() . '_' . 'RGACRI');;
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$view = View::make('dashboard/dashboard')
			->with('RGACRI', $RGACRI)->with('REEVGKA', $REEVGKA);
		$view->title = 'Dashboard';
		return $view;
	}

	public function userlogs() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = LogsmLogs::count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = LogsmLogs::Search('%'.$sSearch.'%')->count();
		    $userlogs = LogsmLogs::Select(DB::raw('substr(description, 1, 100) as description, logtype, ipaddress, status, created_at, session'))
                     ->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderBy($sOrderBy, $sOrderdir)->get();
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $userlogs));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - user logs - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function nationwideorgcharttotal() // Server-Side Datatable
	{
		try
		{
			$data = MemberszOrgChart::NationwideOrgChartTotal()->get();
			return Response::json(array('data' => $data));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Nationwide Org Chart Total - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function nationwideorgchartbyrhqtotal() // Server-Side Datatable
	{
		try
		{
			$data = MemberszOrgChart::NationwideOrgChartByRHQTotal()->get();
			return Response::json(array('data' => $data));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Nationwide Org Chart By RHQ Total - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function nationwideboepositionsummary() // Server-Side Datatable
	{
		try
		{
			$data = MembersmSSA::NationWideBOEPositionSummary()->get();
			return Response::json(array('data' => $data));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Nationwide BOE Position Summary By RHQ Total - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function nationwidedistrictleaderssummary() // Server-Side Datatable
	{
		try
		{
			$data = MembersmSSA::NationWideDistrictLeadersSummary()->get();
			return Response::json(array('data' => $data));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Nationwide District Leaders Summary By Chapter Total - ' . $e, NULL, NULL, 'Failed');
		}
	}
}