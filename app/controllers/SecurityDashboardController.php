¢<?php
class SecurityDashboardController extends BaseController
{
	public function getIndex()
	{
		Session::put('current_page', 'Dashboard');
		Session::put('current_resource', 'USER');
		$shifttype_options = SecurityzShift::Role()->lists('value', 'value');
		$occurancetype_options = SecurityzOccuranceType::Role()->lists('value', 'value');
		$view = View::make('dashboard/securitydashboard');
		$view->title = 'Security Dashboard';
		return $view->with('shifttype_options', $shifttype_options)->with('occurancetype_options', $occurancetype_options);
	}

	public function getSecurityAttendanceListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = SecuritymAttendance::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = SecuritymAttendance::Search('%'.$sSearch.'%')->count();
		    $default = SecuritymAttendance::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode', 'location', 'login', 'logout', 'shifttype'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 63, 0, ' - Security - Attendance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function deleteSecurityAttendance($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'SC04', 'delete') == 't')
			{
				$post = SecuritymAttendance::where('uniquecode', $id);
				$post->Delete();

				LogsfLogs::postLogs('Delete', 63, $id, ' - Security - Attendance - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 63, 0, ' - Security - Attendance - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 63, $id, ' - Security - Attendance - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postlogout($id)
	{
		try
		{
			$resource = SecuritymAttendance::find(SecuritymAttendance::getid($id))->toarray();
			if ($resource['logout'] == null)
			{
				$post = SecuritymAttendance::find(SecuritymAttendance::getid($id));
				$post->logout = date('Y-m-d H:i:s');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 63, 0, ' - Security - Sign Out ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 63, 0, ' - Security - Sign Out ' . $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Logout'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 63, $id, ' - Security - Sign Out - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function getSecurityOccuranceListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = SecuritymOccurance::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = SecuritymOccurance::Search('%'.$sSearch.'%')->count();
		    $default = SecuritymOccurance::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'uniquecode', 'location', 'resourcedate', 'occurrancetype', 'description', 'staffresponse'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 63, 0, ' - Security - Occurance Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postNricSearch()
	{
		// Search membership
		try
		{
			$searchnric = Input::get('nricsearch');
			$searchcode = substr(Input::get('nricsearch'), 1, 3);


			$search = MembersmSSA::SearchCode($searchcode)->get(array('id', 'nric'));
			$searchfilter = $search->filter(function($search) use ($searchnric)
		    {
		        if ($search->nric == $searchnric) {
		        	Session::put('key', $search->id);
		            return $search;
		        }
		    });

		    try
			{
				$mid = Session::get('key');
				$member = MembersmSSA::find($mid)->toarray();
				if(SecuritymAttendance::getFindDuplicateValue($mid, Input::get('shifttype')) == false)
				{
					$post = new SecuritymAttendance;
					$post->personid = $member['personid'];
					$post->memberid = $mid;
					$post->name = $member['name'];
					$post->location = 'SSA HQ';
					$post->resourcedate = date('Y-m-d');
					$post->shifttype = Input::get('shifttype');
					$post->login = date('Y-m-d H:i:s');
					$post->uniquecode = date('YmdHis');
					$post->save();

					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 63, 0, ' - Security Attendance - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 63, 0, ' - Security Attendance - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 63, 0, ' - Security Attendance - Login - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		    Session::forget('key');
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 63, $id, ' - Security Attendance - Login - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postOccurance()
	{
		if (AccessfCheck::getResourceAccess(Auth::user()->roleid, 'SECU', 'SC04', 'create') == 't')
		{
			try
			{
				$mid = SecuritymOccurance::getmemberid($id);
				$member = MembersmSSA::find($mid)->toarray();
				$er = EventmRegistration::find(EventmRegistration::getid($id))->toarray();
				if(AccessmUsers::getFindDuplicateValue($member['email']) == false)
				{
					$post = new SecuritymOccurance;
					$post->personid = $member['personid'];
					$post->memberid = $mid;
					$post->name = $member['name'];
					$post->location = 'SSA HQ';
					$post->resourcedate = date('Y-m-d');
					$post->shifttype = Input::get('shifttype');
					$post->login = date('Y-m-d H:i:s');
					$post->uniquecode = date('YmdHis');
					$post->save();

					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 63, 0, ' - Security Occurrence - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 8, 0, ' - Security Occurrence - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 8, 0, ' - Security Occurrence - New User - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 8, 0, ' - Security Occurrence - New User - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}	
}