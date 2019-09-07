<?php
class AccessRightsController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'accessrights/userlisting');
		Session::put('current_resource', 'ACRI');
		$view = View::make('accessrights/accessrights');
		$view->title = 'Access Rights Users Listing';
		return $view;
	}

	public function getUser($id)
	{
		Session::put('current_page', 'accessrights/userlisting');
		Session::put('current_resource', 'ACRI');
		$REAR04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AR04', 'create');
		$username = AccessmUsers::getName(AccessmUsers::getid($id));
		$acroleid = AccessmUsers::getRole(AccessmUsers::getid($id));
		$resourcecode_options = ConfigurationmResource::Role()->orderBy('resource', 'ASC')->lists('resource', 'code');
		$accesstype_options = AccesszAccessTypes::Role()->orderBy('value', 'ASC')->lists('value', 'id');
		$role_options = AccesszRoles::Role()->orderBy('value', 'ASC')->lists('value', 'value');
		$status_options = AccesszStatus::Role()->lists('value', 'value');
		$event_options = array('0' => 'Please Select a Event') + EventmEvent::Role()->orderBy('description', 'ASC')->lists('description', 'id');
		$group_options = array('0' => 'Please Select a Group') + GroupmGroup::Role()->orderBy('name', 'ASC')->lists('name', 'id');
		$query = AccessmUsers::where('uniquecode', '=', $id)->get();
		$view = View::make('accessrights/user');
		$view->title = 'Access Rights - Users';
		$view->with('REAR04A', $REAR04A)->with('rid', $id)->with('acroleid', $acroleid)
			->with('resourcecode_options', $resourcecode_options)->with('accesstype_options', $accesstype_options)
			->with('role_options', $role_options)->with('status_options', $status_options)->with('result', $query)
			->with('event_options', $event_options)->with('group_options', $group_options);
		return $view;
	}

	public function deleteUser($id)
	{
		try
		{
			$post = AccessmUsers::where('uniquecode',$id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 2, $id, ' - Access Rights - User - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 2, $id, ' - Access Rights - Delete User - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getAccessTypesIndex()
	{
		Session::put('current_page', 'accessrights/accesstypes');
		Session::put('current_resource', 'ACRI');
		$REAR04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AR04', 'create');
		$view = View::make('accessrights/accesstypes');
		$view->title = 'Access Types - Access Rights';
		$view->with('REAR04A', $REAR04A);
		return $view;
	}

	public function getStatusIndex()
	{
		Session::put('current_page', 'accessrights/status');
		Session::put('current_resource', 'ACRI');
		$REAR04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AR04', 'create');
		$view = View::make('accessrights/status');
		$view->title = 'Status - Access Rights';
		$view->with('REAR04A', $REAR04A);
		return $view;
	}

	public function getStatusListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccesszStatus::all()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccesszStatus::Search('%'.$sSearch.'%')
		    	->count();
		    $default = AccesszStatus::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get()->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 6, 0, ' - Access Rights - Status [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStatus()
	{
		try
		{
			if (Input::get('txtvalue') != '')
			{
				$value = Input::get('txtvalue');
				if(AccesszStatus::getFindDuplicateValue($value) == false)
				{
					$post = new AccesszStatus;
					$post->value = $value;
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 6, $post->id, ' - Access Rights - Status - ' . $value, NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Status - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Status - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Status - Empty Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'No Value'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Post Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteStatus($id)
	{
		try
		{
			$post = AccesszStatus::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Status - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Delete Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putStatus($id)
	{
		try
		{
			$post = AccesszStatus::find($id);
			$post->value = Input::get('evalue'); 
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 6, Input::get('evalueid'), ' - Access Rights - Update Status', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('evalueid'), ' - Access Rights - Update Status - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function getRolesIndex()
	{
		Session::put('current_page', 'accessrights/roles');
		Session::put('current_resource', 'ACRI');
		$REAR02A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'AR02', 'create');
		$view = View::make('accessrights/roles');
		$view->title = 'Roles - Access Rights';
		$view->with('REAR02A', $REAR02A);
		return $view;
	}

	public function getRolesListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccesszRoles::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccesszRoles::Role()->Search('%'.$sSearch.'%')->count();
		    $default = AccesszRoles::Role()
		    	->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get()->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 6, 0, ' - Access Rights - Roles [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postRole()
	{
		try
		{
			$value = Input::get('arole');
			if(AccesszRoles::getFindAccessRole($value) == false)
			{
				$post = new AccesszRoles;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 6, $post->id, ' - Access Rights - Roles - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Roles - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Roles - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Post Roles - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteRole($id)
	{
		try
		{
			$post = AccesszRoles::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Roles - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Delete Role - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putRole()
	{
		try
		{
			$value = Input::get('eroleid');
			$post = AccesszRoles::find(Input::get('eroleid'));
			$post->value = Input::get('erole'); 
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 6, Input::get('eroleid'), ' - Access Rights - Update Role', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('eroleid'), ' - Access Rights - Update Roles - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('eroleid')), 400);
		}
	}

	public function getUsersListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccessmUsers::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccessmUsers::Role()->Search('%'.$sSearch.'%')->count();
		    $default = AccessmUsers::Role()
		    	->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get()->toarray();

			LogsfLogs::postLogs('Read', 7, 0, ' - Access Rights - Users [DT]', NULL, NULL, 'Success');

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));;
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 7, 0, ' - Access Rights - Users [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getAccessTypesListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccesszAccessTypes::all()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccesszAccessTypes::Search('%'.$sSearch.'%')
		    	->count();
		    $default = AccesszAccessTypes::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get()->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 6, 0, ' - Access Rights - Access Types [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postAccessType()
	{
		try
		{
			if (Input::get('txtvalue') != '')
			{
				$value = Input::get('txtvalue');
				if(AccesszAccessTypes::getFindDuplicateValue($value) == false)
				{
					$post = new AccesszAccessTypes;
					$post->value = $value;
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 6, $post->id, ' - Access Rights - Access Types - ' . $value, NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Access Types - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Access Types - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Access Types - Empty Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'No Value'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 6, 0, ' - Access Rights - Post Access Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteAccessType($id)
	{
		try
		{
			$post = AccesszAccessTypes::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Access Type - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 6, $id, ' - Access Rights - Delete Access Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAccessType($id)
	{
		try
		{
			$post = AccesszAccessTypes::find($id);
			$post->value = Input::get('evalue'); 
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 6, Input::get('evalueid'), ' - Access Rights - Update Access Type', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('evalueid'), ' - Access Rights - Update Access Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function getUserAccessRightsListing($id) // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = AccessmAccessRights::where('userid', '=', AccessmUsers::getid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = AccessmAccessRights::where('userid', '=', AccessmUsers::getid($id))->count();
		    $default = AccessmAccessRights::where('userid', '=', AccessmUsers::getid($id))
		    	->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'resourcecode', 'create', 'read', 
					'update', 'delete', 'void', 'unvoid', 'print', 'uniquecode', 'accesstypeid', 'groupid', 'eventid', 'eventitem'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 7, 0, ' - Access Rights - Users [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putUserACDetail($id)
	{
		try
		{
			$post = AccessmUsers::find(AccessmUsers::getid($id));
			$post->name = Input::get('name');
			$post->roleid = Input::get('roleid');
			$post->status = Input::get('status');
			$post->tel = Input::get('tel');
			$post->mobile = Input::get('mobile');
			$post->email = Input::get('email');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 6, Input::get('name'), ' - Access Rights - Update User Detail', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('name'), ' - Access Rights - Update User Detail - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('name')), 400);
		}
	}

	public function putUserResetPassword($id)
	{
		try
		{
			$post = AccessmUsers::find(AccessmUsers::getid($id));
			$post->password = Hash::make(Input::get('password'));
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 6, Input::get('name'), ' - Access Rights - Reset Password', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('name'), ' - Access Rights - Reset Password - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postAccessRightsAdd()
	{
		try
		{
			$aroleid = Input::get('aroleid');
			$aaccesstypeid = Input::get('aaccesstypeid');
			$aresourcecode = Input::get('aresourcecode');
			$acreate = Input::get('acreate');
			$aread = Input::get('aread');
			$aupdate = Input::get('aupdate');
			$adelete = Input::get('adelete');
			$avoid = Input::get('avoid');
			$aunvoid = Input::get('aunvoid');
			$aprint = Input::get('aprint');
			$userid = AccessmUsers::getid(Input::get('auserid'));
			
			if(AccessmAccessRights::getFindResource($aresourcecode, $userid, $aroleid, Input::get('aeventid')) == false)
			{
				$rgc = ConfigurationmResource::getResourceGroupCode($aresourcecode);
				$rid =  ConfigurationmResource::getResourceID($aresourcecode);
				
				$post = new AccessmAccessRights;
				$post->userid = $userid;
				$post->uniquecode = date('YmdHis');
				$post->accesstypeid = $aaccesstypeid;
				$post->resourcegroup = $rgc;
				if ($aroleid == "Resource Administrator")
				{
					$post->resourcecode = $rgc;
					$post->resourceid = 0;
				}
				else
				{
					$post->resourcecode = $aresourcecode;
					$post->resourceid = $rid;
				}
				
				$post->create = $acreate;
				$post->read = $aread;
				$post->update = $aupdate;
				$post->delete = $adelete;
				$post->void = $avoid;
				$post->unvoid = $aunvoid;
				$post->print = $aprint;
				$post->eventid = Input::get('aeventid');
				$post->startdate = '0000-00-00';
				$post->enddate = '0000-00-00';
				$post->starttime = '00:00:00';
				$post->endtime = '00:00:00';
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 8, $post->id, ' - Access Rights - ' . $aresourcecode, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - Exists', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Exist'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - Exists', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Exist'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 8, 0, ' - Access Rights - Post Access Rights - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function postAccessRightsUpdate()
	{
		try
		{
			$ucreate = Input::get('ucreate');
			$uread = Input::get('uread');
			$uupdate = Input::get('uupdate');
			$udelete = Input::get('udelete');
			$uvoid = Input::get('uvoid');
			$uunvoid = Input::get('uunvoid');
			$uprint = Input::get('uprint');
			$uid = Input::get('uid');
			
			$post = AccessmAccessRights::find(AccessmAccessRights::getid($uid));
			$post->create = $ucreate;
			$post->read = $uread;
			$post->update = $uupdate;
			$post->delete = $udelete;
			$post->void = $uvoid;
			$post->unvoid = $uunvoid;
			$post->print = $uprint;
			$post->eventid = Input::get('ueventid');
			$post->eventitem = Input::get('ueventitem');
			$post->groupid = Input::get('ugroupid');
			$post->save();

			if($post->save())
			{
				LogsfLogs::postLogs('Update', 8, $post->id, ' - Access Rights - ' . Input::get('uresourcecode'), NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 8, 0, ' - Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Exist'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 8, 0, ' - Access Rights - Post Access Rights - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteAccessRights($id)
	{
		try
		{
			$post = AccessmAccessRights::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 8, $id, ' - Access Rights - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 8, $id, ' - Access Rights - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}