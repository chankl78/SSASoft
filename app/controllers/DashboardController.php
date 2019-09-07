<?php
class DashboardController extends BaseController
{
	public function getIndex()
	{
		Session::put('current_page', 'Dashboard');
		Session::put('current_resource', 'USER');
		$RGACRI = AccessfCheck::getSoftwareAdmin(Auth::user()->roleid, 'ACRI'); //Session::get(Session::getId() . '_' . 'RGACRI');;
		$view = View::make('dashboard/dashboard')
			->with('RGACRI', $RGACRI);
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
}