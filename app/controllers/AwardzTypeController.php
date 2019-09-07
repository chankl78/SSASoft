<?php
class AwardzTypeController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'award/ztype');
		Session::put('current_resource', 'CERT');
		$RECE02A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP02', 'create');
		$view = View::make('award/ztype');
		$view->title = 'Award Type - Award';
		$view->with('RECE02A', $RECE02A);
		return $view;
	}

	public function getListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['sEcho'];
			$iTotalRecords = AwardzType::count();
	 		$iDisplayLength = (int)$_GET['iDisplayLength'];
		    $iDisplayStart = (int)$_GET['iDisplayStart'];
		    $sSearch = $_GET['sSearch'];
		    $iTotalDisplayRecords = AwardzType::Search('%'.$sSearch.'%')->count();
		    $default = AwardzType::Search('%'.$sSearch.'%')
		    	->take($iDisplayLength)->skip($iDisplayStart)
		    	->orderBy('value', 'ASC')->get(array('created_at', 'value', 'id'))->toarray();

			return Response::json(array('iTotalRecords' => $iTotalRecords, 
				'iTotalDisplayRecords' => $iTotalDisplayRecords, 'sEcho' => (string)$sEcho, 
				'aaData' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 48, 0, ' - Award - Type Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postType()
	{
		try
		{
			$value = Input::get('txtvalue');
			if(AwardzType::getFindDuplicateValue($value) == false)
			{
				$post = new AwardzType;
				$post->value = $value;
				$post->save();

				if($post->save())
				{
					LogsfLogs::postLogs('Create', 48, $post->id, ' - Award - Type - ' . $value, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Create', 48, 0, ' - Award - Type - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Duplicate'), 400);
				}
			}
			else
			{
				LogsfLogs::postLogs('Create', 48, 0, ' - Award - Award Type - Duplicate Value', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 48, 0, ' - Award - Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function putType($id)
	{
		try
		{
			$post = AwardzType::find($id);
			$post->value = Input::get('evalue');
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 48, 0, ' - Award - Update Type ' + Input::get('evalueid') + Input::get('evalue'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 48, Input::get('evalueid'), ' - Award - Update Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'Value' => Input::get('evalueid')), 400);
		}
	}

	public function deleteType($id)
	{
		try
		{
			$post = AwardzType::find($id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 48, $id, ' - Award - Type - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 48, $id, ' - Award - Delete Type - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}