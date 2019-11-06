<?php
class LeadersPortalBelieversController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/Believer');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$memposition_options = MemberszPosition::Role()->whereIn('name', array('Believer', 'New Friend'))->orderBy('name', 'ASC')->lists('name', 'code');
		$rhq = Session::get('gakkaiuserrhq');
		$zone = Session::get('gakkaiuserzone');
		$chapter = Session::get('gakkaiuserchapter');
		$district = Session::get('gakkaiuserdistrict');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/believerslisting');
		$view->title = 'BOE Portal - Believers Listing';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('memposition_options', $memposition_options)->with('rhq_options', $rhq_options)
			->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('rhq', $rhq)->with('zone', $zone)->with('chapter', $chapter);
	}

	public function getBelieversListingSHQ() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::BelieversShq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::BelieversShq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::BelieversShq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned', 'uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Believers (SHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getBelieversListingRHQ() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::BelieversRhq()->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned', 'uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Believers (RHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getBelieversListingZone() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::BelieversZone()->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - Believers (Zone) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getBelieversListingChapter() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::BelieversChapter()->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Believers (Chapter) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getBelieversListingDistrict() // Server-Side Datatable
	{
		try
		{
			$result = MembersmSSA::BelieversDistrict()->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Believers (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getBelieversInfo($id) // Server-Side Datatable
	{
		try
		{
			$result = AttendancemPerson::MembersAttendanceInEvent(MembersmSSA::getid1($id))->get(array('attendancedate','description'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - Believers (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postNewAttendee()
	{
		try
		{
			try
			{
				// Add to Members_m_SSA
				$mssa = new MembersmSSA;
				$mssa->name = Input::get('name');
				$mssa->nric = 'NIL';
				$mssa->nrichash = md5(Input::get('name'));
				$mssa->searchcode = '000';
				$mssa->personid = 0;
				$mssa->rhq = Input::get('rhq');
				$mssa->zone = Input::get('zone');
				$mssa->chapter = Input::get('chapter');
				$mssa->district = Input::get('district');
				$mssa->position = Input::get('position');
				$mssa->division = Input::get('division');
				$mssa->uniquecode = uniqid('',TRUE);
				$mssa->source = 'OWN';
				$mssa->resourcefromid = 0;

				$mssa->tel = 'NIL';
				$mssa->mobile = 'NIL';
				$mssa->email = 'NIL';
				$mssa->introducer = Input::get('introducer');
				$mssa->introducermobile = 'NIL';

				$mssa->emergencytel = 'NIL';
				$mssa->emergencymobile = 'NIL';

				$mssa->address = 'NIL';
				$mssa->buildingname = 'NIL';
				$mssa->unitno = 'NIL';
				$mssa->postalcode = 'NIL';
				$mssa->save();

				if($mssa->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 53, 0, ' - Believers - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Believers - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, 0, ' - Believers - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
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

	public function deleteBeliever($id)
	{
		try
		{
			if(MembersmSSA::getpersonid($id) == 0)
			{
				$post = MembersmSSA::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 45, $id, ' - MembersmSSA - Delete Members - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else { return Response::json(array('info' => 'Failed', 'ErrType' => 'MMS', 'value' => $id), 400); }
			
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 45, $id, ' - MembersmSSA - Delete Members - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}