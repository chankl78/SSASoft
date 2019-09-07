<?php
class AwardController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'award/award');
		Session::put('current_resource', 'CERT');
		$RECE03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE03', 'create');
		$type_options = AwardzType::Role()->lists('value', 'value');
		$view = View::make('award/award');
		$view->title = 'Award / Gift / Certificate Listing';
		$view->with('RECE03A', $RECE03A)->with('type_options', $type_options);
		return $view;
	}

	public function getAwardListing()
	{
		try
		{
			$sEcho = (int)$_GET['sEcho'];
			$iTotalRecords = AwardmAward::Role()->count();
	 		$iDisplayLength = (int)$_GET['iDisplayLength'];
		    $iDisplayStart = (int)$_GET['iDisplayStart'];
		    $sSearch = $_GET['sSearch'];
		    $iTotalDisplayRecords = AwardmAward::Role()->Search('%'.$sSearch.'%')->count();
		    $default = AwardmAward::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy('created_at', 'DESC')->get(array('uniquecode', 'awardtitle', 'awarddate', 'country', 'awardtype', 
					'awardby'))
				->toarray();
			return Response::json(array('iTotalRecords' => $iTotalRecords, 
				'iTotalDisplayRecords' => $iTotalDisplayRecords, 'sEcho' => (string)$sEcho, 
				'aaData' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 49, 0, ' - Award - Award Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postAward()
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE03', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-m-Y', Input::get('awarddate'));
				if(Input::get('awarddate') != "")
				{
					if(AwardmAward::getFindDuplicateValue(Input::get('awarddate'), Input::get('awardtitle')) == false)
					{
						$post = new AwardmAward;
						$post->awarddate = $datDate;
						$post->awardtitle = Input::get('awardtitle');
						$post->description = Input::get('description');
						$post->awardtype = Input::get('awardtype');
						$post->country = Input::get('country');
						$post->awardby = Input::get('awardby');
						$post->uniquecode = date('YmdHis');
						$post->save();

						if($post->save())
						{
							LogsfLogs::postLogs('Create', 50, $post->id, ' - Award - Award - ' . Input::get('awardtitle'), NULL, NULL, 'Success');
							return Response::json(array('info' => 'Success'), 200);
						}
						else
						{
							LogsfLogs::postLogs('Create', 50, 0, ' - Award - Unable to Add Record', NULL, NULL, 'Failed');
							return Response::json(array('info' => 'Duplicate'), 400);
						}
					}
					else
					{
						LogsfLogs::postLogs('Create', 50, 0, ' - Award - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 50, 0, ' - Award - Empty Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'EmptyValue'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 50, 0, ' - Award - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 50, 0, ' - Award - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteAward($id)
	{
		try
		{
			$post = AwardmAward::where('uniquecode', '=', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 50, $id, ' - Award - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 50, $id, ' - Award - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putAward($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CE04', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('awarddate'));
				$post = AwardmAward::find(AwardmAward::getid($id));
				$post->awarddate = $datDate;
				$post->awardtitle = Input::get('awardtitle');
				$post->description = Input::get('description');
				$post->awardtype = Input::get('awardtype');
				$post->country = Input::get('country');
				$post->awardby = Input::get('awardby');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 50, 0, ' - Award - Update Award ' + $id + ' ' + Input::get('awardtitle'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 50, $id, ' - Award - Update Award - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 50, 0, ' - Award - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}

	}
}