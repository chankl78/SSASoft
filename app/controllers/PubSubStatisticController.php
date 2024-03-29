<?php
class PubSubStatisticController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'pubsub/pubsubstatistic');
		Session::put('current_resource', 'PUSU');
		$divisiontype_options = array('All' => 'All') +CommonzDivisionType::Role()->lists('value', 'value');
		$psyear_options = MembersmPubSub::PSyear()->orderBy('year', 'desc')->lists('year', 'year');
		$currentyear = date('Y');
		$view = View::make('pubsub/pubsubstatistic');
		$view->title = 'Publication Subscription Statistic';
		$view->with('psyear_options', $psyear_options)->with('currentyear', $currentyear)->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getListing($id, $divisiontype)
	{
		try
		{
			$default = AttendancemAttendance::DMStatsListing($id, $divisiontype)->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Discussion Meeting Statistic Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postImport()
	{
		try
		{
			MembersmPubSub::transfermmstopubsub();
			return Response::json(array('info' => 'Success'), 200);
		}
		catch (\Exception $e)
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - MembersmImportSSA Model - MMS to BOE Failed - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed'), 400);
		}
	}

	public function postStatsUpdate()
	{
		try
		{
			MembersmPubSub::updatezzmembers();
			return Response::json(array('info' => 'Success'), 200);
		}
		catch (\Exception $e)
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - MembersmImportSSA Model - MMS to BOE Failed - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed'), 400);
		}
	}

	public function getRHQCLStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBCLRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing RHQStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQSTStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBSTRHQStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing RHQStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getAgeGroupCLStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBCLAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing RHQAgeGroupStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getAgeGroupSTStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBSTAgeGroupStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing AgeGroupStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getPositionLevelCLStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBCLPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing RHQPositionLevelStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getPositionLevelSTStats($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$default = zz2017members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2018)
			{
				$default = zz2018members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2019)
			{
				$default = zz2019members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2020)
			{
				$default = zz2020members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2021)
			{
				$default = zz2021members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
			else if ($id == 2022)
			{
				$default = zz2022members::PUBSTPositionLevelStats($id, $divisiontype)->get()->toarray();
				return Response::json(array('data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing PositionLevelStats [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getCLNameList($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2017members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2017members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2017members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2018)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2018members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2018members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2018members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2019)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2019members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2019members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2019members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2020)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2020members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2020members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2020members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2021)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2021members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2021members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2021members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2022)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2022members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2022members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2022members::PUBCLNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubcljan', 'pubclfeb', 'pubclmar', 'pubclapr', 'pubclmay', 'pubcljun', 'pubcljul', 'pubclaug', 'pubclsep', 'pubcloct', 'pubclnov', 'pubcldec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing NameList CL [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSTNameList($id, $divisiontype)
	{
		try
		{
			if ($id == 2017)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2017members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2017members::Search('%'.$sSearch.'%')->count();
				
				$default =zz1720members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2018)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2018members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2018members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2018members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2019)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2019members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2019members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2019members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2020)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2020members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2020members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2020members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2021)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2021members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2021members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2021members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
			else if ($id == 2022)
			{
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = zz2022members::count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = zz2022members::Search('%'.$sSearch.'%')->count();
				
				$default =zz2022members::PUBSTNameList($id, $divisiontype)->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
					->orderby('name')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'positionlevel', 'chinesename', 'created_at', 'division', DB::Raw('concat(chapter, " ", district) as description'), 'pubstjan', 'pubstfeb', 'pubstmar', 'pubstapr', 'pubstmay', 'pubstjun', 'pubstjul', 'pubstaug', 'pubstsep', 'pubstoct', 'pubstnov', 'pubstdec'));
				
				return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
					'draw' => (string)$sEcho, 'data' => $default));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Publication Subscription Statistic Listing ST NameList [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}
}