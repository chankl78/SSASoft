<?php
class StaffController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'common/staff');
		Session::put('current_resource', 'CMTA');
		$staffposition_options = StaffzPosition::Role()->lists('value', 'value');
		$staffdepartment_options = StaffzDepartment::Role()->lists('value', 'value');
		$view = View::make('staff/staff');
		$view->title = 'Staff Listing';
		$view->with('staffposition_options', $staffposition_options)
			->with('staffdepartment_options', $staffdepartment_options);
		return $view;
	}

	public function getStaffListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = StaffmStaff::Status()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = StaffmStaff::Status()->Search('%'.$sSearch.'%')->count();
		    $default = StaffmStaff::Status()->Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'name', 'department', 'position', 
					'status', 'id', 'stafftype', 'teloffice'))->toarray();

			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 10, 0, ' - Common Table - Staff Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postStaff()
	{
		try
		{
			if (Input::get('name') != '')
			{
				$value = Input::get('name');
				if(StaffmStaff::getFindDuplicateStaff($value) == false)
				{
					$post = new StaffmStaff;
					$post->name = $value;
					$post->position = Input::get('position');
					$post->department = Input::get('department');
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 11, $post->id, ' - Common Tables - Staff - ' . $value, NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 11, 0, ' - Common Tables - Staff - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 11, 0, ' - Common Tables - Staff - Empty Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 11, 0, ' - Common Tables - Staff - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Empty Value'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 11, 0, ' - Common Tables - Post New Staff - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteStaff($id)
	{
		try
		{
			$post = StaffmStaff::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 11, $id, ' - Common Tables - Staff - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 11, $id, ' - Common Tables - Staff - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putStaff()
	{
		try
		{
			if (Input::get('ename') != '')
			{
				$post = StaffmStaff::find(Input::get('id'));
				$post->name = Input::get('ename');
				$post->teloffice = Input::get('eteloffice');
				$post->position = Input::get('eposition');
				$post->department = Input::get('edepartment');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 11, Input::get('id'), ' - Common Tables - Staff', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Update', 11, 0, ' - Common Tables - Staff - Empty Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Empty Value'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 6, Input::get('id'), ' - Common Tables - Staff - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('id')), 400);
		}
	}
}