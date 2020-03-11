<?php
class CampaignDetailController extends BaseController
{
	public $restful = true;

	public function getIndex($id)
	{
		Session::put('current_page', 'campaign/campaign');
		Session::put('current_resource', 'CAMP');
		$RECP03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP03', 'create');
		$RECP04A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP04', 'create');
		$RECP05R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP05', 'read');
		$RECP01R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP01', 'read');
		$RECP02R = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP02', 'read');
		$REEVGKA = AccessfCheck::getResourceGakkaiRole();
		$pagetitle = CampaignmCampaign::getdescription($id);
		$view = View::make('campaign/campaigndetail');
		$query = CampaignmCampaign::where('uniquecode', '=', $id)->get();
		$status_options = CampaignzStatus::Role()->lists('value', 'value');
		$campaigntype_options = CampaignzCampaignType::Role()->lists('value', 'value');
		$divisiontype_options = CommonzDivisionType::Role()->lists('value', 'value');
		$leveltype_options = CommonzLevelType::Role()->lists('value', 'value');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$event_options = array('' => 'Please Select an Event') + EventmEvent::Role()->ActiveStatus()
			->orderBy('description', 'ASC')->lists('description', 'description');
		$view->title = $pagetitle;
		$view->with('RECP03A', $RECP03A)->with('rid', $id)->with('result', $query)->with('pagetitle', $pagetitle)
			->with('RECP05R', $RECP05R)->with('RECP01R', $RECP01R)->with('RECP04A', $RECP04A)
			->with('divisiontype_options', $divisiontype_options)->with('division_options', $division_options)->with('RECP02R', $RECP02R)
			->with('campaigntype_options', $campaigntype_options)->with('status_options', $status_options)
			->with('REEVGKA', $REEVGKA)->with('event_options', $event_options)->with('leveltype_options', $leveltype_options)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('memposition_options', $memposition_options);
		return $view;
	}

	public function getListing($id)
	{
		try
		{
			$default =  CampaignmDetail::where('campaignid', CampaignmCampaign::getid($id))->get()->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 69, 0, ' - Campaign - Detail Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getEventListing($id)
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = EventmEvent::Role()->where('id', CampaignmCampaign::geteventid($id))->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = EventmEvent::Role()->where('id', CampaignmCampaign::geteventid($id))->Search('%'.$sSearch.'%')->count();
		    $default = EventmEvent::Role()->where('id', CampaignmCampaign::geteventid($id))->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('eventdate', 'eventtype', 'description', 'location', 'uniquecode', 'status'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 45, 0, ' - Campaign - Event Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postLevelDistrict($id)
	{
		try
		{
			// Step 1 - Which Level to insert
			if (Input::get('leveltype') == 'District')
			{
				$mem = MemberszOrgChart::whereNotIn('id', array(1,2))->orderBy('rhqabbv')->orderBy('zoneabbv')->orderBy('chapabbv')->orderBy('district')->get()->toarray();
				foreach($mem as $mem)
				{
					$post = new CampaignmDetail;
					$post->campaignid = CampaignmCampaign::getid($id);
					$post->uniquecode = uniqid('',TRUE);
					$post->campaigndetaildate = date('Y-m-d H:i:s');
					$post->rhq = $mem['rhqabbv'];
					$post->zone = $mem['zoneabbv'];
					$post->chapter = $mem['chapabbv'];
					$post->district = $mem['district'];
					$post->value = '0';
					$post->campaigndetailtype = 'Target';

					$post->save();
				}
			}
			elseif (Input::get('leveltype') == 'Chapter')
			{
				$mem = MemberszOrgChart::whereNotIn('id', array(1,2))->groupby('chapter')->orderBy('rhqabbv')->orderBy('zoneabbv')->orderBy('chapabbv')->get(array('rhqabbv', 'zoneabbv', 'chapabbv'))->toarray();
				foreach($mem as $mem)
				{
					$post = new CampaignmDetail;
					$post->campaignid = CampaignmCampaign::getid($id);
					$post->uniquecode = uniqid('',TRUE);
					$post->campaigndetaildate = date('Y-m-d H:i:s');
					$post->rhq = $mem['rhqabbv'];
					$post->zone = $mem['zoneabbv'];
					$post->chapter = $mem['chapabbv'];
					$post->value = '0';
					$post->campaigndetailtype = 'Target';

					$post->save();
				}
			}
			elseif (Input::get('leveltype') == 'Zone')
			{
				$mem = MemberszOrgChart::whereNotIn('id', array(1,2))->groupby('zone')->orderBy('rhqabbv')->orderBy('zoneabbv')->get(array('rhqabbv', 'zoneabbv'))->toarray();
				foreach($mem as $mem)
				{
					$post = new CampaignmDetail;
					$post->campaignid = CampaignmCampaign::getid($id);
					$post->uniquecode = uniqid('',TRUE);
					$post->campaigndetaildate = date('Y-m-d H:i:s');
					$post->rhq = $mem['rhqabbv'];
					$post->zone = $mem['zoneabbv'];
					$post->value = '0';
					$post->campaigndetailtype = 'Target';

					$post->save();
				}
			}
			
		    LogsfLogs::postLogs('Read', 69, $id, ' - Campaign - Insert By District', NULL, NULL, 'Success');
		    return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 69, $id, ' - Campaign - Insert By District - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function deleteAll($id)
	{
		try
		{
			CampaignmDetail::deleteAll(CampaignmCampaign::getid($id));
			LogsfLogs::postLogs('Delete', 69, CampaignmCampaign::getid($id), ' - Campaign Detail - Delete All - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 53, CampaignmCampaign::getid($id), ' - Campaign Detail - Delete All - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('event/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('event/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function getApplicationPrint($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'GP03', 'print') == 't')
			{
				$value = $id;
				$postdelete = PrintmPrint::where('userid', '=', Auth::user()->id);
				$postdelete->Delete();

				$eventmemberlist = MembersmSSA::where('id', GroupmMember::getmemberid($id))->get()->toarray();
				
				foreach($eventmemberlist as $eventmemberlist)
				{	
					if ($eventmemberlist['tel'] == 'NIL') {$etel = NULL;} else {$etel = $eventmemberlist['tel'];}
					if ($eventmemberlist['mobile'] == 'NIL') {$emobile = NULL;} else {$emobile = $eventmemberlist['mobile'];}
					if ($eventmemberlist['email'] == 'NIL') {$eemail = NULL;} else {$eemail = $eventmemberlist['email'];}
					if ($eventmemberlist['emergencytel'] == 'NIL') {$eemergencytel = NULL;} else {$eemergencytel = $eventmemberlist['emergencytel'];}
					if ($eventmemberlist['emergencymobile'] == 'NIL') {$eemergencymobile = NULL;} else {$eemergencymobile = $eventmemberlist['emergencymobile'];}
					if ($eventmemberlist['introducermobile'] == 'NIL') {$eintroducermobile = NULL;} else {$eintroducermobile = $eventmemberlist['introducermobile'];}
					if ($eventmemberlist['nric'] == 'NIL') {$enric = NULL;} 
					else 
					{
						$leng = strlen($eventmemberlist['nric']) - 4;
						$enric = 'XXXXX' . substr($eventmemberlist['nric'], $leng);
					}
					if ($eventmemberlist['address'] == 'NIL') {$eaddress = NULL;} else {$eaddress = $eventmemberlist['address'];}
					if ($eventmemberlist['buildingname'] == 'NIL') {$ebuildingname = NULL;} else {$ebuildingname = $eventmemberlist['buildingname'];}
					if ($eventmemberlist['unitno'] == 'NIL') {$eunitno = NULL;} else {$eunitno = $eventmemberlist['unitno'];}
					if ($eventmemberlist['postalcode'] == 'NIL') {$epostalcode = NULL;} else {$epostalcode = $eventmemberlist['postalcode'];}
					$insert[] = array(
				        'userid' => Auth::user()->id,
				        'resourceid' => GroupmMember::getid($id),
				        'resourcecodeid' => $eventmemberlist['id'],
				        'string1' => $etel,
				        'string2' => $emobile,
				        'string3' => $eemail,
				        'string4' => $eemergencytel,
				        'string5' => $eemergencymobile,
				        'string6' => $eintroducermobile,
				        'string7' => $enric,
				        'string8' => $eaddress,
				        'string9' => $ebuildingname,
				        'string10' => $eunitno,
				        'string11' => $epostalcode,
				        'created_at' => date('Y-m-d H:i:s'),
				        'updated_at' => date('Y-m-d H:i:s')
			  		);
				}

				DB::table('Print_m_Print')->insert($insert);
				
				LogsfLogs::postLogs('Print', 44, $id, ' - Group - Print Hardcopy - ' . $id, NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 44, 0, ' - Group - Print Hardcopy - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}

		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Print', 44, 0, ' - Group - Print Hardcopy - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
		}
	}

	public function deleteModuleDetail($id)
	{
		try
		{
			$post = CampaignmDetail::find(CampaignmDetail::getid($id));
			$post->Delete();

			LogsfLogs::postLogs('Delete', 53, CampaignmDetail::getid($id), ' - Campaign Detail - ' . CampaignmDetail::getid($id) , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 53, CampaignmDetail::getid($id), ' - Campaign Detail - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getModuleDetail($id)
	{
		try
		{
			$resource = CampaignmDetail::find(CampaignmDetail::getid($id))->toarray();
			return Response::json(array(
				'name' => $resource['name'], 
				'rhq' => $resource['rhq'], 
				'zone' => $resource['zone'], 
				'chapter' => $resource['chapter'], 
				'district' => $resource['district'], 
				'position' => $resource['position'], 
				'division' => $resource['division'],
				'value' => $resource['value'],
				'remarks' => $resource['remarks'],
				'uniquecode' => $resource['uniquecode']
				), 200);
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Campaign Detail - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postModuleDetail($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP04', 'create') == 't')
		{
			try
			{
				$mem = MembersmSSA::findorfail(MembersmSSA::getid1(Input::get('memuniquecode')), array('id', 'personid'));
				$post = new CampaignmDetail;
				$post->campaigndetaildate = date('Y-m-d H:i:s');
				$post->campaignid = CampaignmCampaign::getid(Input::get('uniquecode'));
				$post->name = Input::get('name');
				$post->position = Input::get('position');
				$post->memberid = $mem['id'];
				$post->personid = $mem['personid'];
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->position = Input::get('position');
				$post->positionlevel = $mem['positionlevel'];
				$post->division = Input::get('division');
				$post->value = Input::get('value');
				$post->remarks = Input::get('remarks');
				$post->uniquecode = uniqid('',TRUE);
				$post->save();
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Create', 53, 0, ' - Campaign Detail - New - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Create', 53, 0, ' - Campaign Detail - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function putModuleDetail($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CP04', 'update') == 't')
		{
			try
			{
				$post = CampaignmDetail::find(CampaignmDetail::getid($id));
				$post->name = Input::get('name');
				$post->rhq = Input::get('rhq');
				$post->zone = Input::get('zone');
				$post->chapter = Input::get('chapter');
				$post->district = Input::get('district');
				$post->division = Input::get('division');
				$post->position = Input::get('position');
				$post->value = Input::get('value');
				$post->remarks = Input::get('remarks');
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 53, 0, ' - Campaign Detail' + CampaignmDetail::getid($id) + ' ' + Input::get('name'), NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 53, $id, ' - Campaign Detail - ' . CampaignmDetail::getid($id) . ' ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 53, 0, ' - Campaign Detail - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function postNricSearch()
	{
		// Search membership
		try
		{
			$searchresult = MembersmSSA::findorfail(MembersmSSA::getidbynrichash(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position'));
		    
		    LogsfLogs::postLogs('Read', 54, 0, ' - Campaign - NRIC Search - ' . md5(Input::get('nricsearch')), NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 54, 0, ' - Campaign - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function getMemberNric()
	{
		$member=MembersmSSA::where('nric', Input::get('namesearch'))->get(array('nric'))->toarray();
		return Response::json($member, 200);
	}

	public function getNameSearch()
	{
		$membercode = Input::get('term');
		$member = MembersmSSA::where('name','LIKE','%'. $membercode .'%')->orwhere('nric', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'nric', 'name'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['nric'], 'label'=>$member['name'].' - '.$member['nric'], 'value' => $member['nric']);
		}
		return Response::json($memberlist);
	}
}