<?php
class CrisisManagementController extends BaseController
{
	public function getIndex()
	{
		Session::put('current_page', 'crisis/crisis');
		Session::put('current_resource', 'CRMA');
		$RECR03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'create');
		$location_options = ConfigurationmBranch::Role()->lists('name', 'code');
		$shift_options = CrisiszShift::Role()->lists('value', 'value');
		$currentdate = date('d-m-Y');
		$view = View::make('crisis/crisis');
		$view->title = 'Crisis Management Listing ';
		return $view->with('RECR03A', $RECR03A)->with('location_options', $location_options)->with('currentdate', $currentdate)->with('shift_options', $shift_options);
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$result = CrisismCrisis::get()->toarray();
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 34, 0, ' - Crisis Management - Detail Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postResource()
	{
		$datDate = DateTime::createFromFormat('d-m-Y', Input::get('resourcedate'));

		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'create') == 't')
		{
			if(CrisismCrisis::getFindDuplicateValue(Input::get('location'), $datDate, Input::get('shift')) == false)
			{
				try
				{
					$post = new CrisismCrisis;
					$post->resourcedate = $datDate;
					$post->location = Input::get('location');
					$post->shift = Input::get('shift');
					$post->createbyname = Auth::user()->name;
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 74, 0, ' - Crisis Management Error - ' . Input::get('resourcedate') . ' - ' . Input::get('location') . ' - ' . Input::get('shift'), NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
					}
				}
				catch(\Exception $e)
				{
					LogsfLogs::postLogs('Create', 74, 0, ' - Crisis - ' . $e, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 74, 0, ' - Crisis - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 74, 0, ' - Crisis - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteResource($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'delete') == 't')
			{
				$post = CrisismCrisis::find(CrisismCrisis::getid($id));
				$post->Delete();

				LogsfLogs::postLogs('Delete', 74, CrisismCrisis::getid($id), ' - Crisis Management - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 74, 0, ' - Crisis Management - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 74, CrisismCrisis::getid($id), ' - Crisis Management - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postACCheck($id)
	{
		if (AccessfCheck::getCheckEventAccess(CrisismCrisis::getid($id)) == true)
		{
			try
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 74, 0, ' - Crisis Management - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 28, 0, ' - Crisis Management - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}
}