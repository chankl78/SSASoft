<?php
class CampaignController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'campaign/campaign');
		Session::put('current_resource', 'CAMP');
		$RECP03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP03', 'create');
		$campaigntype_options = CampaignzCampaignType::Role()->lists('value', 'value');
		$divisiontype_options = CommonzDivisionType::Role()->lists('value', 'value');
		$leveltype_options = CommonzLevelType::Role()->lists('value', 'value');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()->orderBy('description', 'ASC')->lists('description', 'description');
		$view = View::make('campaign/campaign');
		$view->title = 'Campaign Listing';
		$view->with('RECP03A', $RECP03A)->with('campaigntype_options', $campaigntype_options)->with('divisiontype_options', $divisiontype_options)->with('leveltype_options', $leveltype_options)->with('event_options', $event_options);
		return $view;
	}

	public function getListing()
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = CampaignmCampaign::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = CampaignmCampaign::Role()->Search('%'.$sSearch.'%')->count();
		    $default = CampaignmCampaign::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('resourcedate', 'campaigntype', 'description', 'divisiontype', 'uniquecode', 'status', 'leveltype', 'eventname'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 27, 0, ' - Event - Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postResource()
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP03', 'create') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('Y-m-d', Input::get('resourcedate'));
				if(CampaignmCampaign::getFindDuplicateValue(Input::get('description')) == false)
				{
					$post = new CampaignmCampaign;
					$post->resourcedate = $datDate;
					$post->campaigntype = Input::get('campaigntype');
					$post->description = Input::get('description');
					$post->divisiontype = Input::get('divisiontype');
					$post->leveltype = Input::get('leveltype');
					if (EventmEvent::getdescid(Input::get('event')) == "")
					{
						$post->eventid = 0;
						$post->eventname = NULL;
					}
					else
					{
						$post->eventid = EventmEvent::getdescid(Input::get('event'));
						$post->eventname = Input::get('event');
					}
					$post->createby = Auth::user()->name;
					$post->uniquecode = uniqid('',TRUE);
					$post->save();

					if($post->save())
					{
						LogsfLogs::postLogs('Create', 69, $post->id, ' - Campaign - ' . Input::get('description'), NULL, NULL, 'Success');
						return Response::json(array('info' => 'Success'), 200);
					}
					else
					{
						LogsfLogs::postLogs('Create', 69, 0, ' - Campaign - Duplicate Value', NULL, NULL, 'Failed');
						return Response::json(array('info' => 'Duplicate'), 400);
					}
				}
				else
				{
					LogsfLogs::postLogs('Create', 69, 0, ' - Campaign - Duplicate Value', NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed', 'ErrType' => 'Duplicate'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 69, 0, ' - Event - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 69, 0, ' - Event - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function deleteResource($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP03', 'delete') == 't')
			{
				$post = CampaignmCampaign::find(CampaignmCampaign::getid($id));
				$post->Delete();

				LogsfLogs::postLogs('Delete', 69, $id, ' - Campaign - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 69, 0, ' - Campaign - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 69, $id, ' - Campaign - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putResource($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP03', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('Y-m-d', Input::get('resourcedate'));
				$post = CampaignmCampaign::find(CampaignmCampaign::getid($id));
				$post->resourcedate = $datDate;
				$post->description = Input::get('description');
				$post->divisiontype = Input::get('divisiontype');
				$post->campaigntype = Input::get('campaigntype');
				$post->leveltype = Input::get('leveltype');
				$post->status = Input::get('status');
				$post->memregistration = Input::get('allowmemregistration');
                $post->shqregistration = Input::get('allowshqregistration');
                $post->regionregistration = Input::get('allowregionregistration');
                $post->zoneregistration = Input::get('allowzoneregistration');
                $post->chapterregistration = Input::get('allowchapterregistration');
				$post->districtregistration = Input::get('allowdistrictregistration');
				if (Input::get('status') == "Closed") { $post->readonly = true; }
				else { $post->readonly = Input::get('readonly'); }

				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 69, 0, ' - Campaign - Update ' + $id + ' ' + Input::get('description'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 69, $id, ' - Campaign - Update - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Campaign - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}
}