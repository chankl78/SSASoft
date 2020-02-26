<?php
class LeadersPortalEventController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Event');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$eventname = EventmEvent::geteventdescription($id);
		$eventtype = EventmEvent::geteventtype($id);
		$rsvpeventtype = EventmEvent::getrsvpeventtype($id);
		$studyeventtype = EventmEvent::getstudyeventtype($id);
		$madeventtype = EventmEvent::getmadeventtype($id);
		$special = EventmEvent::getspecial($id);
		$viewattendance = EventmEvent::getviewattendance($id);
		$sessionselect = EventmEvent::getsessionselect($id);
		$languageselect = EventmEvent::getlanguageselect($id);
		$nationalityselect = EventmEvent::getnationalityselect($id);
		$moredetailselect = EventmEvent::getmoredetailselect($id); 
		$readonly = EventmEvent::getreadonly($id);
		$addonly = EventmEvent::getaddonly($id);
		$editonly = EventmEvent::geteditonly($id);
		$deleteonly = EventmEvent::getdeleteonly($id);
		$addnontokang = EventmEvent::getaddnontokang($id);
		$directaccept = EventmEvent::getdirectaccept($id);
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		//$memposition_options = MemberszPosition::Role()->whereIn('name', array('Believer', 'New Friend', 'Member'))->orderBy('name', 'ASC')->lists('name', 'code');
		$memposition_options = MemberszPosition::Role()->orderBy('name', 'ASC')->lists('name', 'code');
		if ($studyeventtype == true){ $language_options = array('' => 'Please Select a Language') + EventzLanguage::Role()->where('studyexam', 1)->lists('value', 'value'); }
		else { $language_options = array('' => 'Please Select a Language') + EventzLanguage::Role()->where('studyexam', 0)->lists('value', 'value'); }
		$country_options = array('' => 'Please Select a Country') + EventzCountry::Role()->lists('value', 'value');
		$position_options = MemberszPosition::Role()->whereIn('level', array('bel', 'nf', 'mem', 'district'))->orderBy('name', 'ASC')->lists('name', 'code');
		$sessionshow_options = array('' => 'Please Select a Session') + EventmEventShow::Role()->where('eventid', EventmEvent::getid($id))->lists('value', 'value');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$rhq = Session::get('gakkaiuserrhq');
		$zone = Session::get('gakkaiuserzone');
		$chapter = Session::get('gakkaiuserchapter');
		$district = Session::get('gakkaiuserdistrict');
		$query = EventmEvent::Role()->where('uniquecode', '=', $id)->get();
		$view = View::make('leaderportal/event');
		$view->title = 'BOE Portal - ' . $eventname;

		if ($gakkaidistrict == 't')
		{
			$rsvpeventtypeprocessing = EventmRegistration::getRSVPEventTypeProcessing(EventmEvent::getid($id), 'District');
			$rsvpeventtypeaccepted = EventmRegistration::getRSVPEventTypeAccepted(EventmEvent::getid($id), 'District');
			
			$tried = EventmRegistration::getLPEventcheck1Value(EventmEvent::getid($id), 'District');
			$met = EventmRegistration::getLPEventcheck2Value(EventmEvent::getid($id), 'District');
			$attending = EventmRegistration::getLPEventcheck3Value(EventmEvent::getid($id), 'District');
		}
		elseif ($gakkaichapter == 't')
		{
			$rsvpeventtypeprocessing = EventmRegistration::getRSVPEventTypeProcessing(EventmEvent::getid($id), 'Chapter');
			$rsvpeventtypeaccepted = EventmRegistration::getRSVPEventTypeAccepted(EventmEvent::getid($id), 'Chapter');

			$tried = EventmRegistration::getLPEventcheck1Value(EventmEvent::getid($id), 'Chapter');
			$met = EventmRegistration::getLPEventcheck2Value(EventmEvent::getid($id), 'Chapter');
			$attending = EventmRegistration::getLPEventcheck3Value(EventmEvent::getid($id), 'Chapter');
		}
		elseif ($gakkaizone == 't')
		{
			$rsvpeventtypeprocessing = EventmRegistration::getRSVPEventTypeProcessing(EventmEvent::getid($id), 'Zone');
			$rsvpeventtypeaccepted = EventmRegistration::getRSVPEventTypeAccepted(EventmEvent::getid($id), 'Zone');

			$tried = EventmRegistration::getLPEventcheck1Value(EventmEvent::getid($id), 'Zone');
			$met = EventmRegistration::getLPEventcheck2Value(EventmEvent::getid($id), 'Zone');
			$attending = EventmRegistration::getLPEventcheck3Value(EventmEvent::getid($id), 'Zone');
		}
		elseif ($gakkairegion == 't')
		{
			$rsvpeventtypeprocessing = EventmRegistration::getRSVPEventTypeProcessing(EventmEvent::getid($id), 'Region');
			$rsvpeventtypeaccepted = EventmRegistration::getRSVPEventTypeAccepted(EventmEvent::getid($id), 'Region');

			$tried = EventmRegistration::getLPEventcheck1Value(EventmEvent::getid($id), 'Region');
			$met = EventmRegistration::getLPEventcheck2Value(EventmEvent::getid($id), 'Region');
			$attending = EventmRegistration::getLPEventcheck3Value(EventmEvent::getid($id), 'Region');
		}
		elseif ($gakkaishq == 't')
		{
			$rsvpeventtypeprocessing = EventmRegistration::getRSVPEventTypeProcessing(EventmEvent::getid($id), 'SHQ');
			$rsvpeventtypeaccepted = EventmRegistration::getRSVPEventTypeAccepted(EventmEvent::getid($id), 'SHQ');

			$tried = EventmRegistration::getLPEventcheck1Value(EventmEvent::getid($id), 'SHQ');
			$met = EventmRegistration::getLPEventcheck2Value(EventmEvent::getid($id), 'SHQ');
			$attending = EventmRegistration::getLPEventcheck3Value(EventmEvent::getid($id), 'SHQ');
		}

		// To delete after usage
		$youthsummittickets = 0; // Need to futher Expand for Event Tickets RSVP
		if ($id == '5b3a177c46e225.92925500')
		{
			$youthsummittickets = 1;
		}

		$youthsummit = 0; // Need to futher Expand for Event Culture Participate like t-shirt size group code
		if ($id == '5adfe9e38b4882.62379394')
		{
			$youthsummit = 1;
		}
		
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)
			->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('eventname', $eventname)
			->with('eventtype', $eventtype)->with('rid', $id)->with('result', $query)
			->with('memposition_options', $memposition_options)->with('madeventtype', $madeventtype)
			->with('position_options', $position_options)->with('rhq_options', $rhq_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('rhq', $rhq)->with('zone', $zone)->with('chapter', $chapter)
			->with('special', $special)->with('readonly', $readonly)->with('addonly', $addonly)
			->with('editonly', $editonly)->with('deleteonly', $deleteonly)
			->with('viewattendance', $viewattendance)->with('rsvpeventtype', $rsvpeventtype)
			->with('language_options', $language_options)->with('studyeventtype', $studyeventtype)
			->with('country_options', $country_options)->with('tried', $tried)
			->with('met', $met)->with('attending', $attending)->with('sessionshow_options', $sessionshow_options)
			->with('rsvpeventtypeprocessing', $rsvpeventtypeprocessing)
			->with('rsvpeventtypeaccepted', $rsvpeventtypeaccepted)->with('sessionselect', $sessionselect)
			->with('youthsummittickets', $youthsummittickets)->with('youthsummit', $youthsummit)
			->with('languageselect', $languageselect)->with('nationalityselect', $nationalityselect)
			->with('addnontokang', $addnontokang)->with('directaccept', $directaccept)
			->with('moredetailselect', $moredetailselect)->with('division_options', $division_options);
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function getEventParticipant($id) // Server-Side Datatable
	{
		try
		{ // Have included the role, t-shirt size for event participation, Introducer
			$result = EventmRegistration::where('eventid', EventmEvent::getid($id))->Role()->get(array('name', 'chinesename','division','rhq','zone','chapter','district', 'position', 'status', 'uniquecode', 'created_at', 'check1', 'check2', 'check3', 'role', DB::raw('CONCAT(groupcodeprefix, "-", groupcode) AS groupcode'), 'costume3', 'costume9', 'Introducer', 'language', 'nationality', 'session', 'countryofbirth', 'dateofbirth'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Participant Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembership($id) // Server-Side Datatable
	{
		try
		{
			if (EventmEvent::getstudyeventtype($id) == true)
			{
				$result = MembersmSSA::StudyExamEntrance()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array('data' => $result));
			}
			else if (EventmEvent::getmadeventtype($id) == true)
			{
				$result = MembersmSSA::MADEligibleListing()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array('data' => $result));
			}
			else 
			{
				$result = MembersmSSA::Role()->EventType(EventmEvent::getdivisiontype($id))->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array('data' => $result));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Membership Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMembershipSHQ($id) // Server-Side Datatable
	{
		try {
			if (EventmEvent::getstudyeventtype($id) == true) {
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = MembersmSSA::StudyExamEntrance()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'))->count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = MembersmSSA::StudyExamEntrance()->Search('%'.$sSearch.'%')->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'))->count();
				$default = MembersmSSA::StudyExamEntrance()->Search('%'.$sSearch.'%')->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));

				return Response::json(array(
					'recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 'draw' => (string)$sEcho, 'data' => $default
				));
			} else {
				$sEcho = (int)$_GET['draw'];
				$iTotalRecords = MembersmSSA::Role()->get(array('uniquecode'))->count();
				$iDisplayLength = (int)$_GET['length'];
				$iDisplayStart = (int)$_GET['start'];
				$sSearch = $_GET['search']['value'];
				$sOrderByID = $_GET['order'][0]['column'];
				$sOrderBy = $_GET['columns'][$sOrderByID]['data'];
				$sOrderdir = $_GET['order'][0]['dir'];
				$iTotalDisplayRecords = MembersmSSA::Role()->Search('%'.$sSearch.'%')->get(array('uniquecode'))->count();
				$default = MembersmSSA::Role()->Search('%'.$sSearch.'%')->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array(
					'recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 'draw' => (string)$sEcho, 'data' => $default
				));
			}
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Membership Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMADMembership($id) // Server-Side Datatable
	{
		try
		{
			if (EventmEvent::getmadeventtype($id) == true)
			{
				$result = MembersmSSA::MADEligibleListing()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array('data' => $result));
			}
			else
			{
				$result = MembersmSSA::MADMembership(EventmEvent::getdivisiontype($id))->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
				return Response::json(array('data' => $result));
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Pre M & D Membership Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getdistrictstatsListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = 0; // AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = 0; //AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id))->count();
		    $default = AttendancemPerson::DistrictADMAttendanceStats(AttendancemAttendance::getid($id));

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - DM Attendance - District DM Statistic [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSpecialRHQStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::SpecialRHQStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Participant Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSpecialZoneStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::SpecialZoneStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Zone Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSpecialChapterStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::SpecialChapterStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Chapter Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSpecialDistrictStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::SpecialDistrictStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Chapter Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getSHQEventTrainingStats($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::SHQEventTrainingStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Training Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRoleDivisionRHQStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RoleDivisionRHQStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Role Division Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRoleDivisionZoneStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RoleDivisionZoneStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Role Division Zone Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRoleDivisionChapterStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RoleDivisionChapterStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Role Division Chapter Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRoleDivisionDistrictStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RoleDivisionDistrictStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Role Division District Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getStatusDivisionRHQStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::StatusDivisionRHQStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Status Division Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getStatusDivisionZoneStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::StatusDivisionZoneStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Status Division Zone Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getStatusDivisionChapterStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::StatusDivisionChapterStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Status Division Chapter Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getStatusDivisionDistrictStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::StatusDivisionDistrictStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Status Division District Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRSVPShowRHQStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RSVPShowRHQStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - RSVP Show Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRSVPShowZoneStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RSVPShowZoneStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - RSVP Show Zone Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRSVPShowChapterStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RSVPShowChapterStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - RSVP Show Chapter Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRSVPShowDistrictStats($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::RSVPShowDistrictStats(EventmEvent::getid($id))->get();
		    return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - RSVP Show District Stats Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getRHQEventTrainingStats($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::RHQEventTrainingStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Training Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZoneEventTrainingStats($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::ZoneEventTrainingStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Training Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getChapterEventTrainingStats($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::ChapterEventTrainingStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Training Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getDistrictEventTrainingStats($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::DistrictEventTrainingStats(EventmEvent::getid($id))->get();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Event Training Attendance [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEventParticipant($id)
	{
		if (EventmRegistration::getEventMemberDuplicate(MembersmSSA::getid1($id), EventmEvent::getid(Input::get('eventuniquecode'))) == false)
		{
			try
			{
				$member = MembersmSSA::find(MembersmSSA::getid1($id))->toarray();
				$discussionmeetingday = MemberszOrgChart::getDiscussionMtgDay($member['chapter'], $member['district']);
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid(Input::get('eventuniquecode'));
				$post->eventname = EventmEvent::geteventdescription(Input::get('eventuniquecode'));
				$post->personid = $member['personid'];
				$post->memberid = MembersmSSA::getid1($id);
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->positionlevel = $member['positionlevel'];
				$post->division = $member['division'];
				$post->discussionmeetingday = $discussionmeetingday;
				$post->nric = $member['nric'];
				$post->nrichash = $member['nrichash'];
				$post->dateofbirth = $member['dateofbirth'];

				$post->tel = $member['tel'];
				$post->mobile = $member['mobile'];
				$post->email = $member['email'];

				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				$post->emergencytel = $member['emergencytel'];
				$post->emergencymobile = $member['emergencymobile'];

				$post->drugallergy = $member['drugallergy'];
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				$post->language = $member['language'];
				
				$post->race = $member['race'];
				$post->gender = $member['gender'];

				$post->countryofbirth = $member['countryofbirth'];

				$post->address = $member['address'];
				$post->buildingname = $member['buildingname'];
				$post->unitno = $member['unitno'];
				$post->postalcode = $member['postalcode'];

				$post->introducermobile = $member['introducermobile'];
				$post->role = 'Participant';
				$post->ssagroupid = 0;
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->uniquecode = uniqid('', TRUE);

				if(EventmEvent::getdirectaccept(Input::get('eventuniquecode')) == true) {$post->status = "Accepted";}

				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 34, $post->id, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event Detail - Participant Detail - ' . $member['name'], NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success', 'name' => $member['name']), 200);
				}
				else
				{
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
		}
	}

	public function getMemberInfo($id)
	{
		try {
			$search = MembersmSSA::find(MembersmSSA::getid1($id))->toarray();

			return Response::json(array(
				'name' => $search['name'], 'chinesename' => $search['chinesename'], 'mobile' => $search['mobile'], 'rhq' => $search['rhq'], 'zone' => $search['zone'], 'chapter' => $search['chapter'], 'district' => $search['district'], 'position' => $search['position'], 'division' => $search['division'], 'countryofbirth' => $search['countryofbirth'], 'dateofbirth' => $search['dateofbirth'], 'language' => $search['language'], 'nationality' => $search['nationality'], 'uniquecode' => $search['uniquecode']
			), 200);
		} catch (\Exception $e) {
			LogsfLogs::postLogs('Read', 34, MembersmSSA::getid1($id), ' - Leaders Portal Members Get Additional Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postEventParticipantOthers($id)
	{
		try
		{
			$post = new EventmRegistration;
			$post->eventid = EventmEvent::getid(Input::get('id'));
			$post->eventname = EventmEvent::geteventdescription(Input::get('id'));
			$post->personid = 0;
			$post->memberid = 0;
			$post->name = Input::get('name');
			$post->chinesename = Input::get('cname');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
			$post->division = Input::get('division');
			$post->nric = 'NIL';
			$post->nrichash = md5(Input::get('name'));

			$post->tel = 'NIL';
			if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
			$post->email = 'NIL';

			$post->emergencytel = 'NIL';
			$post->emergencymobile = 'NIL';

			$post->address = 'NIL';
			$post->buildingname = 'NIL';
			$post->unitno = 'NIL';
			$post->postalcode = 'NIL';

			$post->introducermobile = 'NIL';
			$post->introducer = Input::get('introducer');
			$post->otherremarks = Input::get('remarks');

			$post->language = Input::get('language');
			$post->countryofbirth = Input::get('country');
			$post->dateofbirth = Input::get('dateofbirthtxt');
			$post->session = Input::get('session');

			$post->role = 'Participant';
			$post->ssagroupid = 0;
			$post->ssagroup = NULL;
			$post->auditioncode = NULL;
			$post->eventitem = NULL;
			$post->uniquecode = uniqid('', TRUE);

			if (EventmEvent::getdirectaccept($id) == true) {
				$post->status = "Accepted";
			}

			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Create', 34, 0, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event Detail - Participant Detail - ' . Input::get('name'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success', 'name' => Input::get('name')), 200);
			}
			else
			{
				return Response::json(array('info' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteParticipant($id)
	{
		try
		{
			$post = EventmRegistration::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 34, $id, ' - Event - Pariticpant- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck1Yes($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')));
			$post->check1 = 1;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck1No($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')));
			$post->check1 = 0;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck2Yes($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')));
			$post->check2 = 1;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck2No($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')));
			$post->check2 = 0;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck3Yes($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid($id));
			$post->check3 = 1;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postEventSpecialCheck3No($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')));
			$post->check3 = 0;
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, $id,  ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event - Participant - ' . $id , NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getEventAddInfo($id)
	{
		try
		{
			$search=EventmRegistration::find(EventmRegistration::getid($id))->toarray();

			return Response::json(array(
				'costume6' => $search['costume6'], 'costume7' => $search['costume7'], 'costume8' => $search['costume8'], 'costume9' => $search['costume9'], 'name' => $search['name'], 'dateofbirthtxt' => $search['dateofbirthtxt'], 'dateofbirth' => $search['dateofbirth'], 'session' => $search['session'], 'language' => $search['language'], 'countryofbirth' => $search['countryofbirth'], 'nationality' => $search['nationality'], 'uniquecode' => $search['uniquecode']), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, EventmRegistration::getid($id), ' - Leaders Portal Event Get Additional Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function putEventAddInfo($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid($id));

			$post->costume6 = Input::get('costume6');
			$post->costume7 = Input::get('costume7');
			$post->costume9 = Input::get('costume9');

			$post->name = Input::get('name');
			
			$post->language = Input::get('language');
			$post->nationality = Input::get('country');
			$post->session = Input::get('session');
			$post->dateofbirth = Input::get('dateofbirth');

			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, 0, ' - Leaders Portal Event - Failed to Update ' . EventmRegistration::getid($id), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, EventmRegistration::getid($id), ' - Leaders Portal Event - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function putAbsent($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid($id));
			$post->status = 'Processing';
			$post->save();

			if($post->save())
			{
				
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, EventmRegistration::getid($id), ' - Update Status ' + $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, EventmRegistration::getid($id), ' - Update Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAttend($id)
	{
		try
		{
			$post = EventmRegistration::find(EventmRegistration::getid($id));
			$post->status = 'Accepted';
			$post->save();

			if($post->save())
			{
				
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 34, EventmRegistration::getid($id), ' - Update Status ' + $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 34, EventmRegistration::getid($id), ' - Update Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	// To Delete after Youth Summit
	public function getYSParticipants($id) // Server-Side Datatable
	{
		try
		{
			$result = EventmRegistration::Role()->where('eventid', 126)->where('status', 'Accepted')->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Youth Summit Participants Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getYSYonsha($id) // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::YouthSummitYonsha()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Youth Summit Yonsha [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getYSYouth($id) // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::YouthSummitYouth()->get(array('name', 'chinesename', 'division', 'rhq', 'zone', 'chapter', 'district', 'position', 'uniquecode'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Leaders Portal - Youth Summit Yonsha [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postEventYouthSummitParticipantsTickets($id)
	{
		try
		{
			$eventparticipant = EventmRegistration::find(EventmRegistration::getid(Input::get('uniquecode')))->toarray();
			$post = new EventmRegistration;
			$post->eventid = EventmEvent::getid('5b3a177c46e225.92925500');
			$post->eventname = EventmEvent::geteventdescription('5b3a177c46e225.92925500');
			$post->personid = 0;
			$post->memberid = 0;
			$post->eventregidforward = $eventparticipant['id'];
			$post->eventidforward = $eventparticipant['eventid'];
			$post->name = Input::get('name');
			$post->chinesename = Input::get('cname');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
			$post->division = Input::get('division');
			$post->nric = 'NIL';
			$post->nrichash = md5(Input::get('name'));

			$post->tel = 'NIL';
			$post->mobile = 'NIL';
			$post->email = 'NIL';

			$post->emergencytel = 'NIL';
			$post->emergencymobile = 'NIL';

			$post->address = 'NIL';
			$post->buildingname = 'NIL';
			$post->unitno = 'NIL';
			$post->postalcode = 'NIL';

			$post->introducermobile = 'NIL';
			$post->introducermemberid = $eventparticipant['memberid'];
			$post->introducer = Input::get('introducer');
			$post->otherremarks = Input::get('remarks');

			$post->language = Input::get('language');
			$post->nationality = Input::get('country');

			$post->costume9 = Input::get('costume9');
			// if (Input::get('rhq') == 'H1') { $post->costume9 = 'Show 1 (25 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H4') { $post->costume9 = 'Show 1 (25 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H6') { $post->costume9 = 'Show 1 (25 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H8') { $post->costume9 = 'Show 1 (25 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H0') { $post->costume9 = 'Show 1 (25 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H2') { $post->costume9 = 'Show 2 (26 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H3') { $post->costume9 = 'Show 2 (26 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H5') { $post->costume9 = 'Show 2 (26 Aug 2018)'; }
			// elseif (Input::get('rhq') == 'H7') { $post->costume9 = 'Show 2 (26 Aug 2018)'; }
			// else { $post->costume9 = 'Show 2 (26 Aug 2018)'; }

			$post->role = 'Participant';
			$post->ssagroupid = 0;
			$post->ssagroup = NULL;
			$post->auditioncode = NULL;
			$post->eventitem = NULL;
			$post->uniquecode = uniqid('', TRUE);

			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Create', 34, 0, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event Detail - Participant Detail - ' . Input::get('name'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success', 'name' => Input::get('name')), 200);
			}
			else
			{
				return Response::json(array('info' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getYouthSummitParticipantInfo($id)
	{
		try
		{
			$eventparticipant = EventmRegistration::findorfail(EventmRegistration::getid($id), array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position', 'remarks'));
			return Response::json(array(
				'uniquecode' => $id, 
				'name' => $eventparticipant['name'],
				'chinesename' => $eventparticipant['chinesename'], 
				'rhq' => $eventparticipant['rhq'], 
				'zone' => $eventparticipant['zone'], 
				'chapter' => $eventparticipant['chapter'], 
				'district' => $eventparticipant['district'], 
				'position' => $eventparticipant['position'], 
				'division' => $eventparticipant['division']
			), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, $id, ' - Leaders Portal - Event Registration Get individual Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Error'), 400);
		}
	}

	public function getZoneysp($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzoneysp');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapterysp($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapterysp');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function postEventYouthSummitYonshaTickets($id)
	{
		try
		{
			$eventparticipant = MembersmSSA::find(MembersmSSA::getid1(Input::get('uniquecode')))->toarray();
			$post = new EventmRegistration;
			$post->eventid = EventmEvent::getid('5b3a177c46e225.92925500');
			$post->eventname = EventmEvent::geteventdescription('5b3a177c46e225.92925500');
			$post->personid = 0;
			$post->memberid = 0;
			$post->eventregidforward = 0;
			$post->eventidforward = 0;
			$post->name = Input::get('name');
			$post->chinesename = Input::get('cname');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
			$post->division = Input::get('division');
			$post->nric = 'NIL';
			$post->nrichash = md5(Input::get('name'));

			$post->tel = 'NIL';
			$post->mobile = 'NIL';
			$post->email = 'NIL';

			$post->emergencytel = 'NIL';
			$post->emergencymobile = 'NIL';

			$post->address = 'NIL';
			$post->buildingname = 'NIL';
			$post->unitno = 'NIL';
			$post->postalcode = 'NIL';

			$post->introducermobile = 'NIL';
			$post->introducermemberid = $eventparticipant['id'];
			$post->introducer = Input::get('introducer');
			$post->otherremarks = Input::get('remarks');

			$post->language = Input::get('language');
			$post->nationality = Input::get('country');

			$post->costume9 = Input::get('costume9');

			$post->role = 'Participant';
			$post->ssagroupid = 0;
			$post->ssagroup = NULL;
			$post->auditioncode = NULL;
			$post->eventitem = NULL;
			$post->uniquecode = uniqid('', TRUE);

			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Create', 34, 0, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event Detail - Participant Detail - ' . Input::get('name'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success', 'name' => Input::get('name')), 200);
			}
			else
			{
				return Response::json(array('info' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getYouthSummitYonshaInfo($id)
	{
		try
		{
			$eventparticipant = MembersmSSA::findorfail(MembersmSSA::getid1($id), array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'));
			return Response::json(array(
				'uniquecode' => $id, 
				'name' => $eventparticipant['name'],
				'chinesename' => $eventparticipant['chinesename'], 
				'rhq' => $eventparticipant['rhq'], 
				'zone' => $eventparticipant['zone'], 
				'chapter' => $eventparticipant['chapter'], 
				'district' => $eventparticipant['district'], 
				'position' => $eventparticipant['position'], 
				'division' => $eventparticipant['division']
			), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, $id, ' - Leaders Portal - Members SSA Get individual Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Error'), 400);
		}
	}

	public function getZoneysy($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzoneysy');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapterysy($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapterysy');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function postEventYouthSummitYouthTickets($id)
	{
		try
		{
			$eventparticipant = MembersmSSA::find(MembersmSSA::getid1(Input::get('uniquecode')))->toarray();
			if (EventmRegistration::getEventMemberDuplicate(Input::get('uniquecode'), EventmEvent::getid('5b3a177c46e225.92925500')) == false)
			{
				$post = new EventmRegistration;
				$post->eventid = EventmEvent::getid('5b3a177c46e225.92925500');
				$post->eventname = EventmEvent::geteventdescription('5b3a177c46e225.92925500');
				$post->personid = $eventparticipant['personid'];
				$post->memberid = $eventparticipant['id'];
				$post->eventregidforward = 0;
				$post->eventidforward = 0;
				$post->name = Input::get('name');
				$post->chinesename = Input::get('cname');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = $eventparticipant['position'];
				$post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position'));
				$post->division = Input::get('division');
				$post->nric = 'NIL';
				$post->nrichash = md5(Input::get('name'));

				$post->tel = 'NIL';
				$post->mobile = 'NIL';
				$post->email = 'NIL';

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';

				$post->address = 'NIL';
				$post->buildingname = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';

				$post->introducermobile = 'NIL';
				$post->introducermemberid = $eventparticipant['id'];
				$post->introducer = Input::get('introducer');
				$post->otherremarks = Input::get('remarks');

				$post->costume9 = Input::get('costume9');

				$post->role = 'Participant';
				$post->ssagroupid = 0;
				$post->ssagroup = NULL;
				$post->auditioncode = NULL;
				$post->eventitem = NULL;
				$post->uniquecode = uniqid('', TRUE);

				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 34, 0, ' Name: ' . Session::get('gakkaiusername') . ' RHQ: ' . Session::get('gakkaiuserrhq') . ' Zone: ' . Session::get('gakkaiuserzone') . ' Chapter: ' . Session::get('gakkaiuserchapter') . ' District: ' . Session::get('gakkaiuserdistrict') . ' Division: ' . Session::get('gakkaiuserdivision') . ' Position: ' . Session::get('gakkaiuserposition') . ' - BOE Event Detail - Participant Detail - ' . Input::get('name'), NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success', 'name' => Input::get('name')), 200);
				}
				else
				{
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getYouthSummitYouthInfo($id)
	{
		try
		{
			$eventparticipant = MembersmSSA::findorfail(MembersmSSA::getid1($id), array('uniquecode', 'name', 'chinesename', 'rhq', 'zone', 'chapter', 'district', 'division', 'position'));
			return Response::json(array(
				'uniquecode' => $eventparticipant['uniquecode'], 
				'name' => $eventparticipant['name'],
				'chinesename' => $eventparticipant['chinesename'], 
				'rhq' => $eventparticipant['rhq'], 
				'zone' => $eventparticipant['zone'], 
				'chapter' => $eventparticipant['chapter'], 
				'district' => $eventparticipant['district'], 
				'position' => $eventparticipant['position'], 
				'division' => $eventparticipant['division'],
				'introducer' => Session::get('gakkaiusername')
			), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, $id, ' - Leaders Portal - Members SSA Get individual Info - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Error'), 400);
		}
	}

	public function getZoneysa($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzoneysa');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapterysa($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapterysa');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}
}