<?php
class CrisisManagementDetailController extends BaseController
{
	public function getIndex($id)
	{
		Session::put('current_page', 'crisis/crisis');
		Session::put('current_resource', 'CRMA');
		$RECR03A = AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'create');
		$location_options = ConfigurationmBranch::Role()->lists('name', 'code');
		$shift_options = CrisiszShift::Role()->lists('value', 'value');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$memposition_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$division_options = MemberszDivision::Role()->lists('name', 'code');
		$query = crisismcrisis::Role()->where('uniquecode', $id)->get();
		$pagetitle = CrisismCrisis::getcrisisdescription($id);
		$view = View::make('crisis/crisisdetail');
		$view->title = $pagetitle;
		return $view->with('pagetitle', $pagetitle)->with('rid', $id)->with('result', $query)
			->with('location_options', $location_options)->with('shift_options', $shift_options)
			->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)
			->with('memposition_options', $memposition_options)->with('division_options', $division_options);
	}

	public function getListing($id) // Server-Side Datatable
	{
		try
		{
			$result = CrisismDetail::where('crisisid', CrisismCrisis::getid($id))->Role()->get(array('name', 'division', 'rhq', 'zone', 'chapter','district', 'position', 'positionlevel', 'remark', 'status', 'firsttemperaturereading', 'secondtemperaturereading', 'thirdtemperaturereading', 'role', 'status', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 74, 0, ' - Crisis Management Detail Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getOccurrenceListing($id) // Server-Side Datatable
	{
		try
		{
			$result = CrisismOccurrence::where('crisisid', CrisismCrisis::getid($id))->get(array('createdby', 'occurrence', 'uniquecode', 'created_at'));
			return Response::json(array('data' => $result));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 74, 0, ' - Crisis Management Occurrence Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putResource($id)
	{
		if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'update') == 't')
		{
			try
			{
				$datDate = DateTime::createFromFormat('d-M-Y', Input::get('resourcedate'));
				$post = crisismcrisis::find(crisismcrisis::getid($id));
				$post->resourcedate = $datDate;
				$post->location = Input::get('location');
				$post->shift = Input::get('shift');
				$post->nooffailed = Input::get('nooffailed');
				$post->noofdeclarationform = Input::get('noofdeclarationform');
				$post->equipthermometerwork = Input::get('equipthermometerwork');
				$post->equipthermometerspoilt = Input::get('equipthermometerspoilt');
				$post->equipthermometerbatteries = Input::get('equipthermometerbatteries');
				$post->equipmentsurgicalmask = Input::get('equipmentsurgicalmask');
				$post->equipmentnninetyfive = Input::get('equipmentnninetyfive');
				$post->equipmentgloves = Input::get('equipmentgloves');
				$post->equipmenthandsanitizer = Input::get('equipmenthandsanitizer');
				$post->equipmentantibacterialwipes = Input::get('equipmentantibacterialwipes');
				$post->equipmentdeclarationforms = Input::get('equipmentdeclarationforms');
				
				$post->save();

				if($post->save())
				{
					return Response::json(array('info' => 'Success'), 200);
				}
				else
				{
					LogsfLogs::postLogs('Update', 27, 0, ' - Crisis Management - Update Crisis Management ' + $id, NULL, NULL, 'Failed');
					return Response::json(array('info' => 'Failed'), 400);
				}
			}
			catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 27, $id, ' - Crisis Management - Update Crisis Management - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown'), 400);
			}
		}
		else
		{
			LogsfLogs::postLogs('Update', 28, 0, ' - Crisis Management - No Access Rights', NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
		}
	}

	public function getNameSearch()
	{
		$membercode = Input::get('term');
		
		$member = MembersmSSA::where('name','LIKE','%'. $membercode .'%')->orwhere('alias','LIKE','%'. $membercode .'%')->orwhere('uniquecode', 'Like', '%'. $membercode .'%')->orwhere('mmsuuid', 'Like', '%'. $membercode .'%')->orwhere('rhq', 'Like', '%'. $membercode .'%')->orwhere('zone', 'Like', '%'. $membercode .'%')->orwhere('chapter', 'Like', '%'. $membercode .'%')->orwhere('district', 'Like', '%'. $membercode .'%')->orwhere('positionlevel', 'Like', '%'. $membercode .'%')->orderBy('name', 'ASC')->get(array('id', 'uniquecode', 'name', 'alias', 'mmsuuid', 'mobile', 'tel', 'rhq', 'zone', 'chapter', 'district', 'division', 'positionlevel', 'position'))->take(10)->toarray();
		$memberlist = array();
		foreach($member as $member){
			$memberlist[] = array('id'=>$member['uniquecode'], 'label'=>$member['name'].' - '.$member['alias'].' - '.$member['rhq'].' - '.$member['zone'].' - '.$member['chapter'].' - '.$member['district'].' - '.$member['division'].' - '.$member['position'].' - '.$member['mobile'].' - '.$member['tel'].' - '.$member['uniquecode'], 'value' => $member['uniquecode']);
		}
		return Response::json($memberlist);
	}

	public function postResourceDetail($id, $role)
	{
		try
		{
			$member = MembersmSSA::find(MembersmSSA::getid1(Input::get('namesearch')))->toarray();
			$post = new CrisismDetail;
			$post->crisisid = CrisismCrisis::getid($id);
			$post->uniquecode = uniqid('', TRUE);
			if ($role == 'duty') { $post->role = "Duty Personnel"; }
			elseif ($role == 'mem') { $post->role = "SSA Member"; }
			else  { $post->role = "Visitor"; }
			$post->memberid = $member['id'];
			$post->personid = $member['personid'];
			$post->name = $member['name'];
			$post->rhq = $member['rhq'];
			$post->zone = $member['zone'];
			$post->chapter = $member['chapter'];
			$post->district = $member['district'];
			$post->position = $member['position'];
			$post->positionlevel = $member['positionlevel'];
			$post->division = $member['division'];
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 74, CrisismCrisis::getid($id),  ' Crisis Management Detail - ' . $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 74, CrisismCrisis::getid($id),  ' Crisis Management Detail  - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function postResourceDetailVisitor($id)
	{
		try
		{
			$post = new CrisismDetail;
			$post->crisisid = CrisismCrisis::getid($id);
			$post->uniquecode = uniqid('', TRUE);
			$post->role = "Visitor";
			$post->name = Input::get('name');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			if (Input::get('position') == "") { $post->positionlevel = '-'; }
			else { $post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position')); }
			$post->division = Input::get('division');
			if (Input::get('contactno') == "") {  }
			else { $post->contactno = Input::get('contactno'); }
			$post->firsttemperaturereading = Input::get('firsttemperaturereading');
			$post->secondtemperaturereading = Input::get('secondtemperaturereading');
			$post->thirdtemperaturereading = Input::get('thirdtemperaturereading');
			$post->remark = Input::get('remark');
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 74, 0,  ' Crisis Management Detail - ' . Input::get('name'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 74, 0,  ' Crisis Management Detail - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putResourceDetailVisitor($id)
	{
		try
		{
			$post = CrisismDetail::find(CrisismDetail::getid(Input::get('uniquecode')));
			$post->name = Input::get('name');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			if (Input::get('position') == "") { $post->positionlevel = '-'; }
			else { $post->positionlevel = MemberszPosition::getPositionLevel(Input::get('position')); }
			$post->division = Input::get('division');
			if (Input::get('contactno') == "") {  }
			else { $post->contactno = Input::get('contactno'); }
			$post->firsttemperaturereading = Input::get('firsttemperaturereading');
			$post->secondtemperaturereading = Input::get('secondtemperaturereading');
			$post->thirdtemperaturereading = Input::get('thirdtemperaturereading');
			$post->remark = Input::get('remark');
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 74, 0,  ' Crisis Management Detail - ' . Input::get('name'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 74, 0,  ' Crisis Management Detail - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getModuleDetail($id)
	{
		try
		{
			$resource = CrisismDetail::find(CrisismDetail::getid($id))->toarray();
			return Response::json(array('contactno' => $resource['contactno'], 'remark' => $resource['remark']), 200);
		}
		catch(\Exception $e) 
		{
			try
			{
				$resource = CrisismDetail::getdetailremark($id);
				return Response::json(array('remark' => $resource), 200);
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 74, CrisismDetail::getid($id), ' - Crisis Detail - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function deleteResourceDetail($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR03', 'delete') == 't')
			{
				$post = CrisismDetail::find(CrisismDetail::getid($id));
				$post->Delete();

				LogsfLogs::postLogs('Delete', 74, CrisismDetail::getid($id), ' - Crisis Management Detail - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 74, 0, ' - Crisis Management Detail - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 74, CrisismDetail::getid($id), ' - Crisis Management Detail- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('crisis/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('crisis/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function getZoneEdit($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('crisis/getzoneedit');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapterEdit($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('crisis/getchapteredit');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function postOccurrence($id)
	{
		try
		{
			$post = new CrisismOccurrence;
			$post->crisisid = CrisismCrisis::getid($id);
			$post->uniquecode = uniqid('', TRUE);
			$post->createdby = Auth::user()->name;
			$post->occurrence = Input::get('occurrence');
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Create', 74, CrisismCrisis::getid($id),  ' Crisis Management Occurrence Detail - ' . $id, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Create', 74, CrisismCrisis::getid($id),  ' Crisis Management Occurrence Detail  - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function deleteOccurrence($id)
	{
		try
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->roleid, 'CR04', 'delete') == 't')
			{
				$post = CrisismOccurrence::find(CrisismOccurrence::getid($id));
				$post->Delete();

				LogsfLogs::postLogs('Delete', 74, CrisismOccurrence::getid($id), ' - Crisis Management Occurrence - ' . $id , NULL, NULL, 'Success');
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Delete', 74, 0, ' - Crisis Management Occurrence - No Access Rights', NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => 'NoAccess'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 74, CrisismOccurrence::getid($id), ' - Crisis Management Occurrence- ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putOccurrence($id)
	{
		try
		{
			$post = CrisismOccurrence::find(CrisismOccurrence::getid(Input::get('uniquecode')));
			$post->occurrence = Input::get('occurrence');
			
			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 74, 0,  ' Crisis Occurrence - ' . Input::get('name'), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 74, 0,  ' Crisis Occurrence - ' . $id . ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}
}