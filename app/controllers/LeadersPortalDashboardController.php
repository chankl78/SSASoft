<?php
class LeadersPortalDashboardController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'Dashboard');
		Session::put('lp_current_resource', 'USER');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$gakkaidivision = Session::get('gakkaiuserdivision');
		$boe = ''; $youthsubmit = ''; $discussionmeeting = ''; $studyexam = ''; $mddaimoku = '0';
		$mdhomevisit = ''; $wdhomevisit = ''; $ymhomevisit = ''; $ywhomevisit = ''; $homevisitcampaign = 0; $dialoguecampaign = 0;
		$RGACRI = AccessfCheck::getSoftwareAdmin(Auth::user()->roleid, 'ACRI'); 

		if ($gakkaidistrict == 't')
		{
			$boe = CampaignmDetail::getBOEDistrictValue();
			$youthsubmit = CampaignmDetail::getYouthSubmitDistrictValue();
			$discussionmeeting = CampaignmDetail::getDiscussionMeetingDistrictValue();
			$studyexam = CampaignmDetail::getStudyExamDistrictValue();
			$mddaimoku = CampaignmDetail::getMDDaimokuDistrictValue();
			$homevisitcampaign = CampaignmCampaign:: getleadersportalcampaignaccess('districtregistration');
			$dialoguecampaign = CampaignmCampaign:: getleadersportalcampaignpositionlevelaccess('districtregistration');
			$mdhomevisit = CampaignmDetail::getHomeVisitMDDistrictValue();
			$wdhomevisit = CampaignmDetail::getHomeVisitWDDistrictValue();
			$ymhomevisit = CampaignmDetail::getHomeVisitYMDistrictValue();
			$ywhomevisit = CampaignmDetail::getHomeVisitYWDistrictValue();
		}
		elseif ($gakkaichapter == 't')
		{
			$boe = CampaignmDetail::getBOEChapterValue();
			$youthsubmit = CampaignmDetail::getYouthSubmitChapterValue();
			$discussionmeeting = CampaignmDetail::getDiscussionMeetingChapterValue();
			$studyexam = CampaignmDetail::getStudyExamChapterValue();
			$mddaimoku = CampaignmDetail::getMDDaimokuChapterValue();
			$homevisitcampaign = CampaignmCampaign::getleadersportalcampaignaccess('chapterregistration');
			$dialoguecampaign = CampaignmCampaign:: getleadersportalcampaignpositionlevelaccess('chapterregistration');
			$mdhomevisit = CampaignmDetail::getHomeVisitMDChapterValue();
			$wdhomevisit = CampaignmDetail::getHomeVisitWDChapterValue();
			$ymhomevisit = CampaignmDetail::getHomeVisitYMChapterValue();
			$ywhomevisit = CampaignmDetail::getHomeVisitYWChapterValue();
		}
		elseif ($gakkaizone == 't')
		{
			$boe = CampaignmDetail::getBOEZoneValue();
			$youthsubmit = CampaignmDetail::getYouthSubmitZoneValue();
			$discussionmeeting = CampaignmDetail::getDiscussionMeetingZoneValue();
			$studyexam = CampaignmDetail::getStudyExamZoneValue();
			$mddaimoku = CampaignmDetail::getMDDaimokuZoneValue();
			$homevisitcampaign = CampaignmCampaign::getleadersportalcampaignaccess('zoneregistration');
			$dialoguecampaign = CampaignmCampaign:: getleadersportalcampaignpositionlevelaccess('zoneregistration');
			$mdhomevisit = CampaignmDetail::getHomeVisitMDZoneValue();
			$wdhomevisit = CampaignmDetail::getHomeVisitWDZoneValue();
			$ymhomevisit = CampaignmDetail::getHomeVisitYMZoneValue();
			$ywhomevisit = CampaignmDetail::getHomeVisitYWZoneValue();
		}
		elseif ($gakkairegion == 't')
		{
			$boe = CampaignmDetail::getBOERegionValue();
			$youthsubmit = CampaignmDetail::getYouthSubmitRegionValue();
			$discussionmeeting = CampaignmDetail::getDiscussionMeetingRegionValue();
			$studyexam = CampaignmDetail::getStudyExamRegionValue();
			$mddaimoku = CampaignmDetail::getMDDaimokuRegionValue();
			$homevisitcampaign = CampaignmCampaign::getleadersportalcampaignaccess('regionregistration');
			$dialoguecampaign = CampaignmCampaign:: getleadersportalcampaignpositionlevelaccess('regionregistration');
			$mdhomevisit = CampaignmDetail::getHomeVisitMDRegionValue();
			$wdhomevisit = CampaignmDetail::getHomeVisitWDRegionValue();
			$ymhomevisit = CampaignmDetail::getHomeVisitYMRegionValue();
			$ywhomevisit = CampaignmDetail::getHomeVisitYWRegionValue();
		}
		elseif ($gakkaishq == 't')
		{
			$boe = CampaignmDetail::getBOESHQValue();
			$youthsubmit = CampaignmDetail::getYouthSubmitSHQValue();
			$discussionmeeting = CampaignmDetail::getDiscussionMeetingSHQValue();
			$studyexam = CampaignmDetail::getStudyExamSHQValue();
			$mddaimoku = CampaignmDetail::getMDDaimokuSHQValue();
			$homevisitcampaign = CampaignmCampaign::getleadersportalcampaignaccess('shqregistration');
			$dialoguecampaign = CampaignmCampaign:: getleadersportalcampaignpositionlevelaccess('shqregistration');
			$mdhomevisit = CampaignmDetail::getHomeVisitMDSHQValue();
			$wdhomevisit = CampaignmDetail::getHomeVisitWDSHQValue();
			$ymhomevisit = CampaignmDetail::getHomeVisitYMSHQValue();
			$ywhomevisit = CampaignmDetail::getHomeVisitYWSHQValue();
		}
		
		$view = View::make('dashboard/leadersportaldashboard')
			->with('RGACRI', $RGACRI)->with('gakkaishq', $gakkaishq)
			->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)
			->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)
			->with('gakkaidivision', $gakkaidivision)->with('boe', $boe)
			->with('youthsubmit', $youthsubmit)
			->with('discussionmeeting', $discussionmeeting)
			->with('studyexam', $studyexam)->with('mddaimoku', $mddaimoku)
			->with('mdhomevisit', $mdhomevisit)->with('wdhomevisit', $wdhomevisit)
			->with('ymhomevisit', $ymhomevisit)->with('ywhomevisit', $ywhomevisit)
			->with('homevisitcampaign', $homevisitcampaign)->with('dialoguecampaign', $dialoguecampaign);
		$view->title = 'BOE Portal Dashboard';
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
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - user logs - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getEventListing()
	{
		try
		{
			$default = EventmEvent::Role()->where('status', 'Active')->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal - Dashboard Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSHQStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 6;
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 6;
		    $default = MembersmSSA::SHQStats()->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - SHQ Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRegionDMCurrentMonthStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::RegionDMCurrentMonthStats()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::RegionDMCurrentMonthStats()->count();
		    $default = AttendancemAttendance::RegionDMCurrentMonthStats()->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Region Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRegionDMNotSubmittedStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::RegionDMNotSubmittedStats(Session::get('gakkaiuserrhq'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::RegionDMNotSubmittedStats()->count();
		    $default = AttendancemAttendance::RegionDMNotSubmittedStats()->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Region Not Submitted Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRegionStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 6;
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 6;
		    $default = MembersmSSA::RHQStats(Session::get('gakkaiuserrhq'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - RHQ Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZoneDMCurrentMonthStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::ZoneDMCurrentMonthStats(Session::get('gakkaiuserrhq'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::ZoneDMCurrentMonthStats(Session::get('gakkaiuserrhq'))->count();
		    $default = AttendancemAttendance::ZoneDMCurrentMonthStats(Session::get('gakkaiuserrhq'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Zone Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZoneDMNotSubmittedStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::ZoneDMNotSubmittedStats(Session::get('gakkaiuserrhq'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::ZoneDMNotSubmittedStats(Session::get('gakkaiuserrhq'))->count();
		    $default = AttendancemAttendance::ZoneDMNotSubmittedStats(Session::get('gakkaiuserrhq'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Zone Not Submitted Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZoneStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 6;
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 6;
		    $default = MembersmSSA::ZoneStats(Session::get('gakkaiuserzone'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Zone Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterDMCurrentMonthStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::ChapterDMCurrentMonthStats(Session::get('gakkaiuserzone'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::ChapterDMCurrentMonthStats(Session::get('gakkaiuserzone'))->count();
		    $default = AttendancemAttendance::ChapterDMCurrentMonthStats(Session::get('gakkaiuserzone'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Chapter Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterDMNotSubmittedStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::ChapterDMNotSubmittedStats(Session::get('gakkaiuserzone'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::ChapterDMNotSubmittedStats(Session::get('gakkaiuserzone'))->count();
		    $default = AttendancemAttendance::ChapterDMNotSubmittedStats(Session::get('gakkaiuserzone'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Chapter Not Submitted Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 6;
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 6;
		    $default =MembersmSSA::ChapterStats(Session::get('gakkaiuserchapter'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Chapter Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictDMCurrentMonthStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::DistrictDMCurrentMonthStats(Session::get('gakkaiuserzone'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::DistrictDMCurrentMonthStats(Session::get('gakkaiuserchapter'))->count();
		    $default = AttendancemAttendance::DistrictDMCurrentMonthStats(Session::get('gakkaiuserchapter'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - District Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictDMNotSubmittedStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::DistrictDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::DistrictDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->count();
		    $default = AttendancemAttendance::DistrictDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - District Not Submitted Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 6;
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 6;
		    $default = MembersmSSA::DistrictStats(Session::get('gakkaiuserchapter'), Session::get('gakkaiuserdistrict'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - District Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictIndividualDMNotSubmittedStats()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AttendancemAttendance::DistrictIndividualDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AttendancemAttendance::DistrictIndividualDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->count();
		    $default = AttendancemAttendance::DistrictIndividualDMNotSubmittedStats(Session::get('gakkaiuserchapter'))->take($iDisplayLength)->skip($iDisplayStart)
                ->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Dashboard - Individual District Not Submitted Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	// To be deleted after campaign
	public function putBOEedit() // 20200605 Reuse for Together we dialogue Campaign
	{
		try
		{
			$gakkaishq = AccessfCheck::getSHQUser();
			$gakkairegion = AccessfCheck::getRegionUser();
			$gakkaizone = AccessfCheck::getZoneUser();
			$gakkaichapter = AccessfCheck::getChapterUser();
			$gakkaidistrict = AccessfCheck::getDistrictUser();
			$campaignvalue = '';

			$post = new CampaignmDetail;
			$post->campaignid = 12;
			$post->uniquecode = uniqid('',TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Session::get('gakkaiuserdivision');
			$post->position = Session::get('gakkaiuserposition');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = Input::get('value');
			$post->campaigndetailtype = 'Actual';

			$post->save();

			if($post->save())
			{
				if ($gakkaishq == 't') { $campaignvalue = CampaignmDetail::getCampaignDetailValueSHQValue(); }
				elseif ($gakkairegion == 't') { $campaignvalue = CampaignmDetail::getCampaignDetailValueRegionValue(); }
				elseif ($gakkaizone == 't') { $campaignvalue = CampaignmDetail::getCampaignDetailValueZoneValue(); }
				elseif ($gakkaichapter == 't') { $campaignvalue = CampaignmDetail::getCampaignDetailValueChapterValue(); }
				elseif ($gakkaidistrict == 't') { $campaignvalue = CampaignmDetail::getCampaignDetailValueDistrictValue(); }
				return Response::json(array('info' => 'Success', 'campaignvalue' => $campaignvalue), 200);
			}
			else
			{
				LogsfLogs::postLogs('Insert', 26, 0, ' - Dashboard - Togehter We Dialogue 2020 to Update ' . Input::get('value'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, CampaignmDetail::getBOEid(), ' - Dashboard - BOE - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function putYouthSubmitedit()
	{
		try
		{
			$post = CampaignmDetail::find(CampaignmDetail::getYouthSubmitid());
			$post->value = Input::get('value');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Dashboard - Youth Submit Failed to Update ' . CampaignmDetail::getYouthSubmitid() . Input::get('value'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, CampaignmDetail::getYouthSubmitid(), ' - Dashboard - Youth Submit - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function putDiscussionMeetingedit()
	{
		try
		{
			$post = CampaignmDetail::find(CampaignmDetail::getDiscussionMeetingid());
			$post->value = Input::get('value');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Dashboard - Discussion Meeting Failed to Update ' . CampaignmDetail::getDiscussionMeetingid() . Input::get('value'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, CampaignmDetail::getDiscussionMeetingid(), ' - Dashboard - Discussion Meeting - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function putStudyExamedit()
	{
		try
		{
			$post = CampaignmDetail::find(CampaignmDetail::getStudyExamid());
			$post->value = Input::get('value');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 26, 0, ' - Dashboard - Study Exam Failed to Update ' . CampaignmDetail::getStudyMeetingid() . Input::get('value'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 26, CampaignmDetail::getStudyMeetingid(), ' - Dashboard - Study Exam - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function postMDDaimoku()
	{
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$mddaimoku = '';

		try
		{
			$post = new CampaignmDetail;
			$post->campaignid = 11;
			$post->uniquecode = uniqid('',TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Session::get('gakkaiuserdivision');
			$post->position = Session::get('gakkaiuserposition');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = Input::get('value');
			$post->campaigndetailtype = 'Actual';

			$post->save();

			if($post->save())
			{
				if ($gakkairegion == 't') { $mddaimoku = CampaignmDetail::getMDDaimokuRegionValue(); }
				elseif ($gakkaizone == 't') { $mddaimoku = CampaignmDetail::getMDDaimokuZoneValue(); }
				elseif ($gakkaichapter == 't') { $mddaimoku = CampaignmDetail::getMDDaimokuChapterValue(); }
				elseif ($gakkaidistrict == 't') { $mddaimoku = CampaignmDetail::getMDDaimokuDistrictValue(); }
				return Response::json(array('info' => 'Success', 'mddaimokutotal' => $mddaimoku), 200);
			}
			else
			{
				LogsfLogs::postLogs('Insert', 26, 0, ' - Dashboard - MD Daimoku Failed to Update ' . Input::get('value'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Insert', 26, 0, ' - Dashboard - MD Daimoku - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function posthomevisitmdadd()
	{
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$homevisittotal = '';

		try {
			$post = new CampaignmDetail;
			$post->campaignid = CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home'));
			$post->uniquecode = uniqid('', TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Input::get('division');
			$post->position = Session::get('gakkaiuserposition');
			$post->positionlevel = Session::get('gakkaiuserpositionlevel');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = '1';
			$post->campaigndetailtype = 'Actual';

			$post->save();

			if ($post->save()) {
				if ($gakkaishq == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitMDSHQValue();
				} elseif ($gakkairegion == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitMDRegionValue();
				} elseif ($gakkaizone == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitMDZoneValue();
				} elseif ($gakkaichapter == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitMDChapterValue();
				} elseif ($gakkaidistrict == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitMDDistrictValue();
				}
				return Response::json(array('info' => 'Success', 'homevisittotal' => $homevisittotal), 200);
			} else {
				LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - MD Homevisit Failed to Update ', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - MD Homevisit - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function posthomevisitwdadd()
	{
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$homevisittotal = '';

		try {
			$post = new CampaignmDetail;
			$post->campaignid = CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home'));
			$post->uniquecode = uniqid('', TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Input::get('division');
			$post->position = Session::get('gakkaiuserposition');
			$post->positionlevel = Session::get('gakkaiuserpositionlevel');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = '1';
			$post->campaigndetailtype = 'Actual';

			$post->save();

			if ($post->save()) {
				if ($gakkaishq == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitWDSHQValue();
				} elseif ($gakkairegion == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitWDRegionValue();
				} elseif ($gakkaizone == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitWDZoneValue();
				} elseif ($gakkaichapter == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitWDChapterValue();
				} elseif ($gakkaidistrict == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitWDDistrictValue();
				}
				return Response::json(array('info' => 'Success', 'homevisittotal' => $homevisittotal), 200);
			} else {
				LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - WD Homevisit Failed to Update ', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - WD Homevisit - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function posthomevisitymadd()
	{
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$homevisittotal = '';

		try {
			$post = new CampaignmDetail;
			$post->campaignid = CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home'));
			$post->uniquecode = uniqid('', TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Input::get('division');
			$post->position = Session::get('gakkaiuserposition');
			$post->positionlevel = Session::get('gakkaiuserpositionlevel');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = '1';
			$post->campaigndetailtype = 'Actual';

			$post->save();

			if ($post->save()) {
				if ($gakkaishq == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYMSHQValue();
				} elseif ($gakkairegion == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYMRegionValue();
				} elseif ($gakkaizone == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYMZoneValue();
				} elseif ($gakkaichapter == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYMChapterValue();
				} elseif ($gakkaidistrict == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYMDistrictValue();
				}
				return Response::json(array('info' => 'Success', 'homevisittotal' => $homevisittotal), 200);
			} else {
				LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - YM Homevisit Failed to Update ', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - YM Homevisit - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}

	public function posthomevisitywadd()
	{
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$homevisittotal = '';

		try {
			$post = new CampaignmDetail;
			$post->campaignid = CampaignmCampaign::getid(ConfigurationmDefault::DefaultCode('Home'));
			$post->uniquecode = uniqid('', TRUE);
			$post->campaigndetaildate = date('Y-m-d H:i:s');
			$post->rhq = Session::get('gakkaiuserrhq');
			$post->zone = Session::get('gakkaiuserzone');
			$post->chapter = Session::get('gakkaiuserchapter');
			$post->district = Session::get('gakkaiuserdistrict');
			$post->division = Input::get('division');
			$post->position = Session::get('gakkaiuserposition');
			$post->positionlevel = Session::get('gakkaiuserpositionlevel');
			$post->name = Session::get('gakkaiusername');
			$post->personid = MembersmSSA::getpersonid(Session::get('gakkaiuseruc'));
			$post->memberid = MembersmSSA::getid1(Session::get('gakkaiuseruc'));
			$post->value = '1';
			$post->campaigndetailtype = 'Actual';

			$post->save();

            if ($post->save()) {
				if ($gakkaishq == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYWSHQValue();
				}elseif ($gakkairegion == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYWRegionValue();
				} elseif ($gakkaizone == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYWZoneValue();
				} elseif ($gakkaichapter == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYWChapterValue();
				} elseif ($gakkaidistrict == 't') {
					$homevisittotal = CampaignmDetail::getHomeVisitYWDistrictValue();
				}
				return Response::json(array('info' => 'Success', 'homevisittotal' => $homevisittotal), 200);
				} else {
					LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - YW Homevisit Failed to Update ', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Insert', 69, 0, ' - Dashboard - YW Homevisit - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => 'NULL'), 400);
		}
	}
	// for the above to be deleted after campaign
}