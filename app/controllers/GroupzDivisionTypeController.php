<?php
class GroupzDivisionTypeController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'group/zdivisiontype');
		Session::put('current_resource', 'GRPS');
		$REGP02A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'create');
		$view = View::make('group/zdivisiontype');
		$view->title = 'Division Type - Groups';
		$view->with('REGP02A', $REGP02A);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = GroupzDivisionType::count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = GroupzDivisionType::Search('%'.$sSearch.'%')->count();
		    $default = GroupzDivisionType::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy($sOrderBy, $sOrderdir)->get(array('created_at', 'value', 'id'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 43, 0, ' - Group - Division Type Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postDivisionType()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(GroupzDivisionType::getFindDuplicateValue($value) == false)
			{
				$post = new GroupzDivisionType;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 43, $post->id, ' - Group - Division Type - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 43, 0, ' - Group - Division Type - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 43, 0, ' - Group - Division Type - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 43, 0, ' - Group - Division Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putDivisionType($id)
	{
		try
		{
			$post = GroupzDivisionType::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 43, 0, ' - Group - Update Division Type ' . Input::get('evalueid') . Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 43, Input::get('evalueid'), ' - Group - Update Division Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalue')), 400);
		}
	}

	public function deleteDivisionType($id)
	{
		try
		{
			$post = GroupzDivisionType::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Division Type - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 43, $id, ' - Group - Delete Division Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}