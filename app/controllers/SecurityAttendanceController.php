<?php
class SecurityAttendanceController extends BaseController
{
	public function getIndex()
	{
		Session::put('current_page', 'SecurityAttendance');
		$view = View::make('securityattendance/securityattendance');
		$view->title = 'Security Attendance';
		return $view;
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

	public function postSignOut($id)
	{
		try
		{
			$resource = SecuritymAttendance::find(SecuritymAttendance::getid($id))->toarray();
			if ($resource['logout'] == null)
			{
				$post = SecuritymAttendance::find(SecuritymAttendance::getid($id));
				$post->logout = date('Y-m-d H:i:s');
				
				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 63, 0, ' - Security - Sign Out ' . $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 63, 0, ' - Security - Sign Out ' . $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate Sign Out'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 63, $id, ' - Security - Sign Out - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => $id), 400);
		}
	}

	public function postSignIn()
	{
		// Search membership
		try
		{
			$searchnric = Input::get('nricsearch');
			$shifttype = Input::get('shifttype');
			$member = MembersmSSA::getByNric($searchnric);
			
			if (is_null($member))
			{
				LogsfLogs::postLogs('Read', 63, 0, ' - Security Attendance - Login - ' . Input::get('nricsearch') . ' - Does not exist', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);	
			}
			else
			{
				$mid = $member->id;
				$member = MembersmSSA::find($mid)->toarray();
				
				// Test if there is a duplicate Gajokai shift attendance record, if not, then allow sign in
				if(SecuritymAttendance::getFindDuplicateValue($mid, $shifttype) == false)
				{
					$post = new SecuritymAttendance;
					$post->personid = $member['personid'];
					$post->memberid = $mid;
					$post->name = $member['name'];
					$post->location = 'SSA HQ';
					$post->resourcedate = date('Y-m-d');
					$post->shifttype = $shifttype;
					$post->login = date('Y-m-d H:i:s');
					$post->uniquecode = uniqid('',TRUE);
					
					if($post->save())
					{
						# SUCCESS: Return the response 200 to the view Security/postSignIn/
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						# FAIL: Log failure and return the response 400 to the view Security/postSignIn/
						LogsfLogs::postLogs('Create', 63, 0, ' - Security Attendance - Failed to Save', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed'), 400);
					}
				}
				else
				{
					# Test for duplicate attendance record showed a duplicate record.
					LogsfLogs::postLogs('Create', 63, 0, ' - Security Attendance - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 63, 0, ' - Security Attendance - Login - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown Error'), 400);
		}
	}
}
