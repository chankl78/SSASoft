<?php
class GroupController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/group');
		Session::put('current_resource', 'GRPS');
		$REGP03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'create');
		$grouptype_options = GroupzGroupType::Role()->lists('value', 'value');
		$divisiontype_options = GroupzDivisionType::Role()->lists('value', 'value');
		$view = View::make('group/group');
		$view->title = 'Groups Listing';
		$view->with('REGP03A', $REGP03A)->with('grouptype_options', $grouptype_options)
			->with('divisiontype_options', $divisiontype_options);
		return $view;
	}

	public function getGroupListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupmGroup::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupmGroup::Role()->Search('%'.$sSearch.'%')->count();
		    $default = GroupmGroup::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('uniquecode', 'name', 'groupformed', 'status', 'grouptype', 'divisiontype'))
				->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 44, 0, ' - Group - Group Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postGroup()
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('groupdate'));
				if(Input::get('groupdate') != "")
				{
					if(GroupmGroup::getFindDuplicateValue(Input::get('description')) == false)
					{
						$post = new GroupmGroup;
						$post->groupformed = $datDate;
						$post->name = Input::get('description');
						$post->grouptype = Input::get('grouptype');
						$post->divisiontype = Input::get('divisiontype');
						$post->uniquecode = uniqid('',TRUE);
						$post->save();

						if($post->save())
						{
							LogsfLogs::postLogs('Create', 44, $post->id, ' - Group - Group - ' . Input::get('description'), NULL, NULL, 'Success');
							return Response::json(array('info' => 'Success'), 200);
						}
						else
						{
							LogsfLogs::postLogs('Create', 44, 0, ' - Group - Duplicate Value', NULL, NULL, 'Failed');
							return Response::json(array('info' => 'Duplicate'), 400);
						}
					}
					else
					{
						LogsfLogs::postLogs('Create', 44, 0, ' - Group - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 44, 0, ' - Group - Empty Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'EmptyValue'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 44, 0, ' - Group - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 44, 0, ' - Group - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteGroup($id)
	{
		try
		{
			$post = GroupmGroup::where('uniquecode', '=', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 44, $id, ' - Group - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 44, $id, ' - Group - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putGroup($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP04', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('groupformed'));
				$datCeasedDate = DateTime::createFromFormat('d-M-Y', Input::get('groupceased'));
				$post = GroupmGroup::find(GroupmGroup::getid($id));
				$post->groupformed = $datDate;
				if (Input::get('groupceased') == '') { $post->groupCeased = null; }
				else { $post->groupCeased = $datCeasedDate; }
				$post->name = Input::get('name');
				$post->description = Input::get('description');
				$post->grouptype = Input::get('grouptype');
				$post->divisiontype = Input::get('divisiontype');
				$post->status = Input::get('status');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 45, 0, ' - Group - Update Group ' + $id + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 45, $id, ' - Group - Update Group - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 45, 0, ' - Group - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}

	}
}