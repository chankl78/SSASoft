<?php
class LeadersPortalNewFriendsController extends BaseController
{
	public function getIndex()
	{
		Session::put('lp_current_page', 'LeadersPortal');
		Session::put('lp_current_resource', 'LeadersPortal/NewFriend');
		$gakkaishq = AccessfCheck::getSHQUser();
		$gakkairegion = AccessfCheck::getRegionUser();
		$gakkaizone = AccessfCheck::getZoneUser();
		$gakkaichapter = AccessfCheck::getChapterUser();
		$gakkaidistrict = AccessfCheck::getDistrictUser();
		$position_options = MemberszPosition::Role()->whereIn('name', array('Believer', 'New Friend'))->orderBy('code', 'ASC')->lists('name', 'code');
		$view = View::make('leaderportal/newfriendslisting');
		$view->title = 'BOE Portal - New Friends Listing';
		return $view->with('gakkaishq', $gakkaishq)->with('gakkairegion', $gakkairegion)->with('gakkaizone', $gakkaizone)->with('gakkaichapter', $gakkaichapter)
			->with('gakkaidistrict', $gakkaidistrict)->with('position_options', $position_options);
	}

	public function getNewFriendsListingSHQ() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::NewFriendsShq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::NewFriendsShq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::NewFriendsShq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned','chanting','uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - NewFriend (SHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getNewFriendsListingRHQ() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::NewFriendsRhq()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::NewFriendsRhq()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::NewFriendsRhq()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned','chanting','uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - NewFriend (RHQ) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getNewFriendsListingZone() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::NewFriendsZone()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::NewFriendsZone()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::NewFriendsZone()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned','chanting','uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 8, 0, ' - Leaders Portal Dashboard - NewFriend (Zone) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getNewFriendsListingChapter() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::NewFriendsChapter()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::NewFriendsChapter()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::NewFriendsChapter()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned','chanting','uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - NewFriend (Chapter) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getNewFriendsListingDistrict() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::NewFriendsDistrict()->count();
			$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::NewFriendsDistrict()->Search('%'.$sSearch.'%')->count();
		    $result = MembersmSSA::NewFriendsDistrict()->Search('%'.$sSearch.'%')->take($iDisplayLength)->skip($iDisplayStart)
                     ->orderby('division')->orderby('rhq')->orderby('zone')->orderby('chapter')->orderby('district')->orderby('position')->orderby('name')->get(array('name','chinesename','rhq','zone','chapter','district','division','position','believersigned','chanting','uniquecode', 'created_at'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - NewFriend (District) [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putNewFriend($id)
	{
		try
		{
			$post = MembersmSSA::find(MembersmSSA::getid1($id));
			$post->name = Input::get('name');
			$post->chinesename = Input::get('chinesename');
			$post->position = Input::get('position');
			$post->division = Input::get('division');
			$post->believersigned = Input::get('believersigned');
			$post->chanting = Input::get('chanting');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 45, MembersmSSA::getid(Input::get('uniquecode')), ' - MembersmSSA - Update New Friend', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 45, MembersmSSA::getid(Input::get('uniquecode')), ' - MembersmSSA - Update New Friend' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function getNewFriendsInfo($id) // Server-Side Datatable
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
                     ->orderBy($sOrderBy, $sOrderdir)->get(array('attendancedate', 'description', 'remarks'));
     		// Log::debug(DB::getQueryLog());
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 1, 0, ' - Leaders Portal Dashboard - New Friend (District) [DT] - ' . $e, NULL, NULL, 'Failed');
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
				$mssa->chinesename = Input::get('chinesename');
				$mssa->nric = 'NIL';
				$mssa->nrichash = md5(Input::get('name'));
				$mssa->searchcode = '000';
				$mssa->personid = 0;
				$mssa->rhq = Session::get('gakkaiuserrhq');
				$mssa->zone = Session::get('gakkaiuserzone');
				$mssa->chapter = Session::get('gakkaiuserchapter');
				$mssa->district = Input::get('district');
				$mssa->position = Input::get('position');
				$mssa->division = Input::get('division');
				$mssa->uniquecode = uniqid('',TRUE);
				$mssa->source = 'OWN';
				$mssa->resourcefromid = 0;

				$mssa->tel = 'NIL';
				if(Input::get('mobile') == ''){$mssa->mobile = 'NIL';} else {$mssa->mobile = Input::get('mobile');}
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
					LogsfLogs::postLogs('Create', 53, 0, ' - New Friend - New Member - Failed to Save', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - New Friend - New Member - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, $id, ' - New Friend - Update Attendee - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteNewFriend($id)
	{
		try
		{
			$post = MembersmSSA::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 45, $id, ' - MembersmSSA - Delete Members - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 45, $id, ' - MembersmSSA - Delete Members - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}