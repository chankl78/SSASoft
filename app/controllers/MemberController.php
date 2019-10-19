<?php
class MemberController extends BaseController
{
	public $restful = true;

	public function getIndex()
	{
		Session::put('current_page', 'member/listing');
		Session::put('current_resource', 'SSAM');
		$REME04U = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'ME04', 'update');
		$REME04D = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'ME04', 'delete');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$position_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$view = View::make('member/memberlisting');
		$view->title = 'Members';
		return $view->with('position_options', $position_options)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('REME04U', $REME04U)->with('REME04D', $REME04D);
	}

	public function getMemberListing() // Server-Side Datatable
	{
		try
		{
			$sEcho = (int)$_GET['draw'];
			$iTotalRecords = MembersmSSA::Role()->count();
	 		$iDisplayLength = (int)$_GET['length'];
		    $iDisplayStart = (int)$_GET['start'];
		    $sSearch = $_GET['search']['value'];
		    $sOrderByID = $_GET['order'][0]['column'];
		    $sOrderBy = $_GET['columns'][$sOrderByID]['data'];
		    $sOrderdir = $_GET['order'][0]['dir'];
		    $iTotalDisplayRecords = MembersmSSA::Role()->Search('%'.$sSearch.'%')->count();
		    $default = MembersmSSA::Role()->Search('%'.$sSearch.'%')
				->take($iDisplayLength)->skip($iDisplayStart)
				->orderBy($sOrderBy, $sOrderdir)->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'chinesename', 'classification', 'created_at', 'alias', 'email', 'mobile', 'division', 'dateofbirth'))->toarray();
			return Response::json(array('recordsTotal' => $iTotalRecords, 'recordsFiltered' => $iTotalDisplayRecords, 
				'draw' => (string)$sEcho, 'data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 38, 0, ' - Members - Members Listing [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getFuneralServicesIndex()
	{
		Session::put('current_page', 'member/funeralmdchapterandabovelisting');
		Session::put('current_resource', 'SSAM');
		$REME04U = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'ME04', 'update');
		$REME04D = AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'ME04', 'delete');
		$rhq_options = MemberszOrgChart::Rhq()->lists('rhq', 'rhqabbv');
		$zone_options = array('' => 'Please Select a Zone') + MemberszOrgChart::Zone()->lists('zone', 'zoneabbv');
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->lists('chapter', 'chapabbv');
		$position_options = MemberszPosition::Role()->orderBy('code', 'ASC')->lists('name', 'code');
		$view = View::make('member/funeralmdchapterandabovelisting');
		$view->title = 'Members';
		return $view->with('position_options', $position_options)->with('rhq_options', $rhq_options)->with('zone_options', $zone_options)->with('chapter_options', $chapter_options)->with('REME04U', $REME04U)->with('REME04D', $REME04D);
	}

	public function getMDChapterAndAboveListing() // Server-Side Datatable
	{
		try
		{
			$default = MembersmSSA::Role()->FuneralServices()->orderBy('rhq', 'ASC')->orderBy('zone', 'ASC')->orderBy('chapter', 'ASC')
			->orderBy('position', 'ASC')->orderBy('name', 'ASC')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'chinesename', 'classification', 'created_at', 'alias', 'email', 'mobile', 'division'))->toarray();
			return Response::json(array('data' => $default));
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 38, 0, ' - Members - MD Chapter and Above Listing for Funeral Services [DT] - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getMemberInfo($id)
	{
		try
		{
			$member=MembersmSSA::find(MembersmSSA::getid1($id))->toarray();
			LogsfLogs::postLogs('Read', 38, 0, ' - SSA Members - ' . $member['name'] . ' - ' . MembersmSSA::getid1($id), NULL, NULL, 'Success');
			return Response::json(array(
				'name' => $member['name'], 
				'rhq' => $member['rhq'], 
				'zone' => $member['zone'], 
				'chapter' => $member['chapter'], 
				'district' => $member['district'], 
				'position' => $member['position'], 
				'division' => $member['division'],
				'nric' => $member['nric'],
				'dateofbirth' => $member['dateofbirth'],
				'mobile' => $member['mobile'],
				'tel' => $member['tel'],
				'email' => $member['email'],
				'uniquecode' => $member['uniquecode'],
				'personid' => $member['personid']
				), 200);
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Read', 38, 0, ' - SSA Members - ' . $id . ' - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function postNricSearch($id)
	{
		// Search membership
		try
		{
			$searchresult = MembersmSSA::findorfail(MembersmSSA::getidbynrichash(Input::get('nricsearch')), array('uniquecode', 'name', 'rhq', 'zone', 'chapter', 'district', 'nric', 'division', 'position', 'mobile', 'tel', 'email', 'personid'));

			LogsfLogs::postLogs('Read', 38, $id, ' - Members - NRIC Search - ' . $searchresult['name'], NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 38, $id, ' - Members - NRIC Search - ' . Input::get('nricsearch'). ' ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Does Not Exist'), 400);
		}
	}

	public function postPrintLeadersAttendanceByRegion()
	{
		try
		{
			LogsfLogs::postLogs('Read', 38, $id, ' - Members - Print Leaders Attendance Report - ', NULL, NULL, 'Success');
			return Response::json($searchresult, 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 38, 0, ' - Members - Print Leaders Attendance Reporth - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function getZone($id)
	{
		$zone_options = array('' => 'Please Select a Zone') +  MemberszOrgChart::Zone()->where('rhqabbv', $id)->lists('zone', 'zoneabbv');
		$view = View::make('leaderportal/getzone');
		$view->with('zone_options', $zone_options);	
		return $view;
	}

	public function getChapter($id)
	{
		$chapter_options = array('' => 'Please Select a Chapter') + MemberszOrgChart::Chapter()->where('zoneabbv', $id)->lists('chapter', 'chapabbv');
		$view = View::make('leaderportal/getchapter');
		$view->with('chapter_options', $chapter_options);	
		return $view;
	}

	public function deleteMember($id)
	{
		try
		{
			$post = MembersmSSA::where('uniquecode', $id);
			$post->Delete();

			LogsfLogs::postLogs('Delete', 39, MembersmSSA::getid1($id), ' - Member - Delete Attendee - ' . $id , NULL, NULL, 'Success');
			return Response::json(array('info' => 'Success'), 200);
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Delete', 39, MembersmSSA::getid1($id), ' - Member - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function putMember($id)
	{
		try
		{
			$post = MembersmSSA::find(MembersmSSA::getid1(Input::get('uniquecode')));
			if (Input::get('nric') == "") { $post->nric = "NIL"; } else { $post->nric = Input::get('nric'); }
			if (Input::get('tel') == "") { $post->tel = "NIL"; } else { $post->tel = Input::get('tel'); }
			if (Input::get('mobile') == "") { $post->mobile = "NIL"; } else { $post->mobile = Input::get('mobile'); }
			if (Input::get('email') == "") 
			{ 
				$post->email = "NIL";
				$post->emailhash = NULL;
			} 
			else 
			{ 
				$post->email = Input::get('email'); 
				$post->emailhash = md5(Input::get('email'));
			}
			$post->name = Input::get('name');
			$post->rhq = Input::get('rhq');
			$post->zone = Input::get('zone');
			$post->chapter = Input::get('chapter');
			$post->district = Input::get('district');
			$post->position = Input::get('position');
			$post->division = Input::get('division');
			$post->personid = Input::get('personid');

			$post->save();

			if($post->save())
			{
				return Response::json(array('info' => 'Success'), 200);
			}
			else
			{
				LogsfLogs::postLogs('Update', 39, MembersmSSA::getid1($id), ' - Member - Update ' . MembersmSSA::getid1($id), NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed'), 400);
			}
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Update', 53, MembersmSSA::getid($id), ' - Member - Update - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => 'Unknown', 'value' => $id), 400);
		}
	}

	public function getConvert()
	{
		Session::put('current_page', 'member/admin/convert');
		Session::put('current_resource', 'SSAM');
		$view = View::make('member/convert');
		$view->title = 'Members';
		return $view;
	}

	public function postConvert()
	{
		$convertcount = DB::table('Members_m_ImportSSA')->count();
		for($i = 1; $i <= 52326; $i++)
		{
			try
			{
				try
				{
					$member = MembersmImportSSA::find($i)->toarray();
					$personid =  $member['personid'];
					$nric =  $member['nric'];
					$nrichash =  $member['nrichash'];
					$mmsuuid =  $member['uuid'];
					$searchcode =  $member['searchcode'];
					$name = $member['name'];
					$chinesename =  $member['chinese_name'];
					$alias =  $member['alias'];
					$gender =  $member['gender'];
					$nationality =  $member['citizenship'];
					$countryofbirth =  $member['country_of_birth'];
					$language =  $member['language_name'];
					$dateofbirth =  $member['date_of_birth'];
					$convertedon =  $member['converted_on'];
					$tel =  $member['tel_home'];
					$mobile =  $member['tel_mobile'];
					$email =  $member['email'];
					$rhq =  $member['hq'];
					$zone =  $member['zone'];
					$chapter =  $member['chapter'];
					$district =  $member['dist'];
					$position =  $member['position'];
					if ($member['position'] == 'BEL') { $positionlevel = 'bel'; }
					elseif ($member['position'] == 'MEM') { $positionlevel = 'mem'; }
					else { $positionlevel = MemberszPosition::getPositionLevel($member['position']); }		
					$division =  $member['division'];
					$address =  $member['address1'];
					$buildingname =  $member['buildingName'];
					$unitno =  $member['address2'];
					$postalcode =  $member['postalcode'];
					$classification =  $member['classification'];
					$status =  $member['status'];
					$memsigned =  $member['mem_signed'];
					$belsigned =  $member['bel_signed'];
				}
				catch(\Exception $e) 
				{
					LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist array - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
				}

				try
				{
					if (MembersmSSA::where('personid', $member['personid'])->count() == 0)
					{
						$post = new MembersmSSA;
						$post->personid = $personid;
						$post->nric = $nric;
						$post->nrichash = $nrichash;
						$post->mmsuuid = $mmsuuid;
						$post->name = $name;
						$post->uniquecode = uniqid('',TRUE);
						$post->searchcode = $searchcode;
						$post->chinesename = $chinesename;
						$post->alias = $alias;
						$post->nationality = $nationality;
						$post->language = $language;
						$post->gender = $gender;
						$post->dateofbirth = $dateofbirth;
						$post->converted_on = $convertedon;
						$post->countryofbirth = $countryofbirth;
						if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
						if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
						if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
						$post->rhq = $rhq;
						$post->zone = $zone;
						$post->chapter = $chapter;
						$post->district = $district;
						$post->position = $position;
						$post->positionlevel = $positionlevel;
						$post->division = $division;
						if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
						if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
						if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
						if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
						$post->emergencytel = 'NIL'; 
				 		$post->emergencymobile = 'NIL';
				 		$post->introducermobile = 'NIL';
				 		$post->classification = $classification;
				 		$post->status = $status;
				 		$post->memsigned = $memsigned;
				 		$post->belsigned = $belsigned;
				 		if($belsigned == 1){$post->believersigned = 1;}

						$post->save();
						LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert New - ' . $i . ' ' . $personid, NULL, NULL, 'Success');
					}
					else
					{
						$mid = DB::table('Members_m_SSA')->where('personid', $member['personid'])->pluck('id');
						$post = MembersmSSA::find($mid);
						$post->personid = $personid;
						$post->nric = $nric;
						$post->nrichash = $nrichash;
						$post->mmsuuid = $mmsuuid;
						$post->searchcode = $searchcode;
						$post->name = $name;
						$post->chinesename = $chinesename;
						$post->alias = $alias;
						$post->nationality = $nationality;
						$post->language = $language;
						$post->gender = $gender;
						$post->dateofbirth = $dateofbirth;
						$post->converted_on = $convertedon;
						$post->countryofbirth = $countryofbirth;
						if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
						if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
						if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
						$post->rhq = $rhq;
						$post->zone = $zone;
						$post->chapter = $chapter;
						$post->district = $district;
						$post->position = $position;
						$post->positionlevel = $positionlevel;
						$post->division = $division;
						if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
						if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
						if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
						if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
						$post->classification = $classification;
						$post->status = $status;
						$post->memsigned = $memsigned;
				 		$post->belsigned = $belsigned;
				 		if($belsigned == 1){$post->believersigned = 1;}
						
						$post->save();
						LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convert Old - ' . $i . ' ' . $personid, NULL, NULL, 'Success');
					}
				}
				catch(\Exception $e) 
				{
					LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function postConvertNricHash()
	{
		for($i=1; $i <= 49286; $i++) //49356
		{
			try
			{
				$member = MembersmSSA::find($i)->toarray();
				$post = MembersmSSA::find($i);
				$post->nrichash = Hash::make($member['nric']);
				$post->save();

				if($post->save()) { }
				else
				{
					LogsfLogs::postLogs('Create', 39, 0, ' - Members - Failed to hash - ' . $member['id'] . ' ' . $member['nric'] . ' '  . $member['name'], NULL, NULL, 'Failed');
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Failed to hash - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}

	}

	public function postConvertFront($id)
	{
		try
		{
			try
			{
				$member = MembersmImportSSA::find($id)->toarray();
				$personid =  $member['personid'];
				$nric =  $member['nric'];
				$searchcode =  $member['searchcode'];
				$name = $member['name'];
				//$chinesename =  $member['chinese_name'];
				$gender =  $member['gender'];
				$nationality =  $member['citizenship'];
				$countryofbirth =  $member['country_of_birth'];
				$language =  $member['language_name'];
				$dateofbirth =  $member['date_of_birth'];
				$tel =  $member['tel_home'];
				$mobile =  $member['tel_mobile'];
				$email =  $member['email'];
				$rhq =  $member['hq'];
				$zone =  $member['zone'];
				$chapter =  $member['chapter'];
				$district =  $member['dist'];
				$position =  $member['position'];
				$division =  $member['division'];
				$address =  $member['address1'];
				$buildingname =  $member['buildingName'];
				$unitno =  $member['address2'];
				$postalcode =  $member['postalcode'];
				$classification =  $member['classification'];
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist array - ' . $id . ' - ' . $e, NULL, NULL, 'Failed');
			}

			try
			{
				if (MembersmSSA::where('personid', $member['personid'])->count() == 0)
				{
					$post = new MembersmSSA;
					$post->personid = $personid;
					$post->nric = $nric;
					$post->name = $name;
					$post->uniquecode = date('dmY') . $i . date('His');
					$post->searchcode = $searchcode;
					//$post->chinesename = $chinesename;
					$post->nationality = $nationality;
					$post->language = $language;
					$post->gender = $gender;
					$post->dateofbirth = $dateofbirth;
					$post->countryofbirth = $countryofbirth;
					if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
					if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
					if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
					$post->rhq = $rhq;
					$post->zone = $zone;
					$post->chapter = $chapter;
					$post->district = $district;
					$post->position = $position;
					$post->division = $division;
					if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
					if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
					if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
					if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
					$post->emergencytel = 'NIL'; 
			 		$post->emergencymobile = 'NIL';
			 		$post->introducermobile = 'NIL';
			 		$post->classification = $classification;

					$post->save();
					LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert New - ' . $id . ' ' . $personid, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success', 'ErrType' => $id), 200);
				}
				else
				{
					$mid = DB::table('Members_m_SSA')->where('personid', $member['personid'])->pluck('id');
					$post = MembersmSSA::find($mid);
					$post->personid = $personid;
					$post->nric = $nric;
					$post->uniquecode = date('Ymd') . $i . date('His');
					$post->searchcode = $searchcode;
					$post->name = $name;
					$post->chinesename = $chinesename;
					$post->nationality = $nationality;
					$post->language = $language;
					$post->gender = $gender;
					$post->dateofbirth = $dateofbirth;
					$post->countryofbirth = $countryofbirth;
					if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
					if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
					if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
					$post->rhq = $rhq;
					$post->zone = $zone;
					$post->chapter = $chapter;
					$post->district = $district;
					$post->position = $position;
					$post->division = $division;
					if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
					if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
					if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
					if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
					$post->classification = $classification;
					
					$post->save();
					LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convert Old - ' . $id . ' ' . $personid, NULL, NULL, 'Success');
					return Response::json(array('info' => 'Success', 'ErrType' => $id), 200);
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist - ' . $id . ' - ' . $e, NULL, NULL, 'Failed');
				return Response::json(array('info' => 'Failed', 'ErrType' => $id), 400);
			}
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert - ' . $id . ' - ' . $e, NULL, NULL, 'Failed');
			return Response::json(array('info' => 'Failed', 'ErrType' => $id), 400);
		}
	}

	public function putNricSearchCode()
	{
		$i = 47000;
		try
		{
			$member = MembersmImportSSA::find(47000)->toarray();
			$personid =  $member['personid'];
			$nric =  $member['nric'];
			$searchcode =  $member['searchcode'];
			$name = $member['name'];
			$chinesename =  $member['chinese_name'];
			$nationality =  $member['citizenship'];
			$countryofbirth =  $member['country_of_birth'];
			$language =  $member['language_name'];
			$dateofbirth =  $member['date_of_birth'];
			$tel =  $member['tel_home'];
			$mobile =  $member['tel_mobile'];
			$email =  $member['email'];
			$rhq =  $member['hq'];
			$zone =  $member['zone'];
			$chapter =  $member['chapter'];
			$district =  $member['dist'];
			$position =  $member['position'];
			$division =  $member['division'];
			$address =  $member['address1'];
			$buildingname =  $member['buildingName'];
			$unitno =  $member['address2'];
			$postalcode =  $member['address3'];
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist - ' . ' - ' . $e, NULL, NULL, 'Failed');
		}

		// $drugallergy =  $member['drug_allergy'];
		// $nodrugallergy = $member['no_drug_allergy'];
		// $medicalhistory =  $member['others'];
		try
		{
			if (MembersmSSA::where('personid', $i)->count() == 0)
			{
				$post = new MembersmSSA;
				$post->personid = $personid;
				$post->nric = $nric;
				$post->uniquecode = date('Ymd') . $i . date('His');
				$post->name = $name;
				$post->searchcode = $searchcode;
				$post->chinesename = $chinesename;
				$post->nationality = $nationality;
				$post->language = $language;
				$post->dateofbirth = $dateofbirth;
				$post->countryofbirth = $countryofbirth;
				if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
				if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
				if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
				$post->rhq = $rhq;
				$post->zone = $zone;
				$post->chapter = $chapter;
				$post->district = $district;
				$post->position = $position;
				$post->division = $division;
				if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
				if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
				if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
				if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
				// $post->drugallergy = $drugallergy;
				// $post->nodrugallergy = $nodrugallergy;
				// $post->introducermobile = 'NIL';

				$post->save();
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert New - ' . $i, NULL, NULL, 'Success');
			}
			else
			{
				$mid = DB::table('Members_m_SSA')->where('personid', $i)->pluck('id');
				$post = MembersmSSA::find($mid);
				$post->nric = $nric;
				$post->uniquecode = date('Ymd') . $i . date('His');
				$post->searchcode = $searchcode;
				$post->name = $name;
				$post->chinesename = $chinesename;
				$post->nationality = $nationality;
				$post->language = $language;
				$post->dateofbirth = $dateofbirth;
				$post->countryofbirth = $countryofbirth;
				if($tel == ''){$post->tel = 'NIL';} else {$post->tel = $tel;}
				if($mobile == ''){$post->mobile = 'NIL';} else {$post->mobile = $mobile;}
				if($email == ''){$post->email = 'NIL';} else {$post->email = $email;}
				$post->rhq = $rhq;
				$post->zone = $zone;
				$post->chapter = $chapter;
				$post->district = $district;
				$post->position = $position;
				$post->division = $division;
				if($address == ''){$post->address = 'NIL';} else {$post->address = $address;}
				if($buildingname == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $buildingname;}
				if($unitno == ''){$post->unitno = 'NIL';} else {$post->unitno = $unitno;}
				if($postalcode == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $postalcode;}
				// $post->drugallergy = $drugallergy;
				// $post->nodrugallergy = $nodrugallergy;
				// $post->introducermobile = 'NIL';

				$post->save();
				LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convert Old - ' . $i, NULL, NULL, 'Success');
			}
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - Members - Convert Does not Exist - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putCNameDOB()
	{
		$convertcount = DB::table('Event_m_Registration')->count();
		for($i=1; $i <= $convertcount; $i++)
		{
			try
			{

				$member = EventmRegistration::find($i);
				$member->chinesename = DB::table('Members_m_SSA')->where('id', $member['memberid'])->pluck('chinesename');
				$member->dateofbirth = DB::table('Members_m_SSA')->where('id', $member['memberid'])->pluck('dateofbirth');

				$member->save();
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Read', 28, 0, ' - Members - Update Chinese & Date of Birth - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function DatabaseUpdate()
	{
		try
		{
			Artisan::call('migrate');
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Read', 28, 0, ' - Members - Update Database - ' . $e, NULL, NULL, 'Failed');
		}
	}

	public function putEncryptAddress()
	{
		$convertcount = DB::table('Event_m_Registration')->count();
		for($i=1; $i <= $convertcount; $i++)
		{
			try
			{
				$regaddress = DB::table('Event_m_Registration')->where('id', $i)->pluck('address');
				$regbuildingname = DB::table('Event_m_Registration')->where('id', $i)->pluck('buildingname');
				$regunitno = DB::table('Event_m_Registration')->where('id', $i)->pluck('unitno');
				$regpostalcode = DB::table('Event_m_Registration')->where('id', $i)->pluck('postalcode');


				$member = EventmRegistration::find($i);
				// if($regaddress == ''){$member->address = Crypt::encrypt('NIL');} else {$member->address = Crypt::encrypt($regaddress);}
				// if($regbuildingname == ''){$member->buildingname = Crypt::encrypt('NIL');} else {$member->buildingname = Crypt::encrypt($regbuildingname);}
				// if($regunitno == ''){$member->unitno = Crypt::encrypt('NIL');} else {$member->unitno = Crypt::encrypt($regunitno);}
				// if($regpostalcode == ''){$member->postalcode = Crypt::encrypt('NIL');} else {$member->postalcode = Crypt::encrypt($regpostalcode);}
				if($regaddress == ''){$member->address = 'NIL';} else {$member->address = $regaddress;}
				if($regbuildingname == ''){$member->buildingname = 'NIL';} else {$member->buildingname = $regbuildingname;}
				if($regunitno == ''){$member->unitno = 'NIL';} else {$member->unitno = $regunitno;}
				if($regpostalcode == ''){$member->postalcode = 'NIL';} else {$member->postalcode = $regpostalcode;}
				$member->save();
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Read', 28, 0, ' - Members - Update Encrypt Address - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function posteventdetail()
	{
		for($i=26; $i <= 180; $i++)
		{
			try
			{
				$member = table61::find($i)->toarray();

				$post = new EventmRegistration;
				$post->name = $member['name'];
				$post->chinesename = $member['chinesename'];
				$post->nric = $member['nric'];
				$post->dateofbirth = $member['dateofbirth'];
				if($member['email'] == ''){$post->email = 'NIL';} else {$post->email = $member['email'];}
				if($member['tel'] == ''){$post->tel = 'NIL';} else {$post->tel = $member['tel'];}
				if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
				$post->bloodgroup = $member['bloodgroup'];
				$post->nationality = $member['nationality'];
				$post->countryofbirth = $member['countryofbirth'];
				$post->race = $member['race'];
				$post->occupation = $member['occupation'];
				
				if($member['buildingname'] == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $member['buildingname'];}
				if($member['address'] == ''){$post->address = 'NIL';} else {$post->address = $member['address'];}
				if($member['unitno'] == ''){$post->unitno = 'NIL';} else {$post->unitno = $member['unitno'];}
				if($member['postalcode'] == ''){$post->postalcode = 'NIL';} else {$post->postalcode = $member['postalcode'];}
				$post->rhq =$member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->position = $member['position'];
				$post->division = $member['division'];

				$post->emergencyname = $member['emergencyname'];
				$post->emergencyrelationship = $member['emergencyrelationship'];
				if($member['emergencytel'] == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = $member['emergencytel'];}
				if($member['emergencymobile'] == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = $member['emergencymobile'];}

				$post->drugallergy = $member['drugallergy'];

				$post->medicalhistory = $member['medicalhistory'];
				$post->hypertension = $member['hypertension'];
				$post->heartdisease = $member['heartdisease'];
				$post->longtermmedication = $member['longtermmedication'];
				$post->goodhealth = $member['goodhealth'];
				$post->menstrual = $member['menstrual'];

				$post->commitwedsat = $member['commitwedsat'];
				$post->travelperiod = $member['travelperiod'];

				$post->introducer = $member['introducer'];
				if($member['introducermobile'] == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = $member['introducermobile'];}

				$post->BPReading1 = $member['BPReading1'];
				$post->BPReading2 = $member['BPReading2'];
				$post->BPReading3 = $member['BPReading3'];
				$post->medicalstatus = $member['medicalstatus'];
				$post->medicalremarks = $member['medicalremarks'];
				$post->medicalofficer = $member['medicalofficer'];

				$post->auditionstatus = $member['auditionstatus'];
				$post->auditionremarks = $member['auditionremarks'];
				$post->trainer = $member['trainer'];

				$post->costume1 = $member['costume1'];
				$post->costume2 = $member['costume2'];
				$post->costume3 = $member['costume3'];
				$post->costume4 = $member['costume4'];
				$post->costume5 = $member['costume5'];
				$post->costume6 = $member['costume6'];
				$post->costume7 = $member['costume7'];
				$post->costume8 = $member['costume8'];
				$post->costume9 = $member['costume9'];
				$post->shoes = $member['shoes'];

				$post->otherremarks = $member['otherremarks'];
				$post->committeemember = $member['committeemember'];

				$post->status = $member['status'];
				$post->role = $member['role'];

				$post->eventid = $member['eventid'];
				$post->groupcode = $member['groupcode'];
				$post->auditioncode = $member['auditioncode'];
				$post->ssagroup = $member['ssagroup'];
				$post->eventitem = $member['eventitem'];
				$post->cardno = $member['cardno'];
				$post->uniquecode = $member['uniquecode'];
				$post->personid = $member['personid'];
				$post->memberid = $member['memberid'];
				$post->created_at = $member['created_at'];
				$post->updated_at = $member['updated_at'];

				$post->save();
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Members - Event Unable to Insert - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function posteventfddetail()
	{
		for($i=1; $i <= 550; $i++)
		{
			try
			{
				$member = MembersmImportFD::find($i)->toarray();

				if(EventmRegistration::where('eventid', 2)->where('memberid', $member['memberid'])->count() == 0)
				{
					$post = new EventmRegistration;
					$post->name = $member['name'];
					$post->nric = $member['nric'];
					$post->dateofbirth = $member['DOB'];
					if($member['email'] == ''){$post->email = 'NIL';} else {$post->email = $member['email'];}
					if($member['tel'] == ''){$post->tel = 'NIL';} else {$post->tel = $member['tel'];}
					if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
					
					$post->buildingname = 'NIL';
					$post->address = 'NIL';
					$post->unitno = 'NIL';
					$post->postalcode = 'NIL';
					$post->rhq =$member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->division = $member['division'];

					$post->emergencyname = $member['emergencyname'];
					$post->emergencyrelationship = $member['emergencyrelationship'];
					if($member['emergencytel'] == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = $member['emergencytel'];}
					if($member['emergencymobile'] == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = $member['emergencymobile'];}

					$post->drugallergy = $member['medicalhistory'];

					$post->introducer = $member['introducer'];
					if($member['introducermobile'] == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = $member['introducermobile'];}

					$post->costume2 = $member['costume2'];
					$post->costume4 = $member['costume4'];
					$post->costume5 = $member['costume5'];
					$post->costume6 = $member['costume6'];
					$post->costume9 = $member['costume9'];

					$post->otherremarks = $member['Remarks'];

					$post->status = "Accepted";
					$post->role = "Performer";

					$post->eventid = 2;
					$post->groupcode = $member['groupcode'];
					$post->ssagroup = $member['functiongroup'];
					$post->eventitem = $member['eventitem'];
					$post->uniquecode = date('Ym') . '2' . RAND(00, 99) . $member['id'] . date('Hs');
					$post->personid = $member['personid'];
					$post->memberid = $member['memberid'];

					$post->save();
					LogsfLogs::postLogs('Create', 39, 0, ' - FD - Step 1 - ' . $i . ' - ' . $member['name'], NULL, NULL, 'Success');
				}
				else if ($member['memberid'] == 0 and $member['personid'] == 0)
				{
					$post = new EventmRegistration;
					$post->name = $member['name'];
					$post->nric = $member['nric'];
					$post->dateofbirth = $member['DOB'];
					if($member['email'] == ''){$post->email = 'NIL';} else {$post->email = $member['email'];}
					if($member['tel'] == ''){$post->tel = 'NIL';} else {$post->tel = $member['tel'];}
					if(Input::get('mobile') == ''){$post->mobile = 'NIL';} else {$post->mobile = Input::get('mobile');}
					
					$post->buildingname = 'NIL';
					$post->address = 'NIL';
					$post->unitno = 'NIL';
					$post->postalcode = 'NIL';
					$post->rhq =$member['rhq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['district'];
					$post->position = $member['position'];
					$post->division = $member['division'];

					$post->emergencyname = $member['emergencyname'];
					$post->emergencyrelationship = $member['emergencyrelationship'];
					if($member['emergencytel'] == ''){$post->emergencytel = 'NIL';} else {$post->emergencytel = $member['emergencytel'];}
					if($member['emergencymobile'] == ''){$post->emergencymobile = 'NIL';} else {$post->emergencymobile = $member['emergencymobile'];}

					$post->drugallergy = $member['medicalhistory'];

					$post->introducer = $member['introducer'];
					if($member['introducermobile'] == ''){$post->introducermobile = 'NIL';} else {$post->introducermobile = $member['introducermobile'];}

					$post->costume2 = $member['costume2'];
					$post->costume4 = $member['costume4'];
					$post->costume5 = $member['costume5'];
					$post->costume6 = $member['costume6'];
					$post->costume9 = $member['costume9'];

					$post->otherremarks = $member['Remarks'];

					$post->status = "Accepted";
					$post->role = "Performer";

					$post->eventid = 2;
					$post->groupcode = $member['groupcode'];
					$post->ssagroup = $member['functiongroup'];
					$post->eventitem = $member['eventitem'];
					$post->uniquecode = date('Ym') . '2' . RAND(00, 99) . $member['id'] . date('Hs');
					$post->personid = $member['personid'];
					$post->memberid = $member['memberid'];

					$post->save();
					LogsfLogs::postLogs('Create', 39, 0, ' - FD - Step 2 - ' . $i . ' - ' . $member['name'], NULL, NULL, 'Success');
				}
				else
				{
					LogsfLogs::postLogs('Create', 39, 0, ' - FD - Step 3 - ' . $i . ' - ' . $member['name'], NULL, NULL, 'Failed');
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - FD - Unable to Insert - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function posteventpddetail()
	{
		for($i=1; $i <= 700; $i++)
		{
			try
			{
				$member = table61::find($i)->toarray();

				$post = new EventmRegistration;
				$post->name = $member['name'];
				$post->nric = 'NIL';
				$post->email = 'NIL';
				$post->tel = 'NIL';
				$post->mobile = 'NIL';
				
				$post->buildingname = 'NIL';
				$post->address = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';
				$post->division = $member['division'];

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';
				
				$post->introducermobile = 'NIL';

				$post->status = "Accepted";
				$post->role = "Performer";

				$post->eventid = 2;
				$post->groupcode = 'PDSA';
				$post->ssagroup = $member['ssagroup'];
				$post->eventitem = $member['eventitem'];
				$post->uniquecode = date('Ym') . '2' . RAND(00, 99) . $member['id'] . date('Hs');
				$post->personid = $member['personid'];
				$post->memberid = $member['memberid'];

				$post->save();
				LogsfLogs::postLogs('Create', 39, 0, ' - PD - Step 1 - ' . $i . ' - ' . $member['name'], NULL, NULL, 'Success');
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - PD - Unable to Insert - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function posteventknightdetail()
	{
		for($i=1; $i <= 300; $i++)
		{
			try
			{
				$member = table61::find($i)->toarray();

				$post = new EventmRegistration;
				$post->name = $member['name'];
				$post->nric = 'NIL';
				$post->email = 'NIL';
				$post->tel = 'NIL';
				$post->mobile = 'NIL';
				
				$post->buildingname = 'NIL';
				$post->address = 'NIL';
				$post->unitno = 'NIL';
				$post->postalcode = 'NIL';
				$post->division = $member['division'];

				$post->emergencytel = 'NIL';
				$post->emergencymobile = 'NIL';
				
				$post->introducermobile = 'NIL';

				$post->status = "Accepted";
				$post->role = "Logistic";

				$post->eventid = 2;
				$post->groupcode = 'LOGS';
				$post->ssagroup = $member['ssagroup'];
				$post->eventitem = $member['eventitem'];
				$post->uniquecode = date('Ym') . '2' . RAND(00, 99) . $member['id'] . date('Hs');
				$post->personid = $member['personid'];
				$post->memberid = $member['memberid'];

				$post->save();
				LogsfLogs::postLogs('Create', 39, 0, ' - Soka Knight - Step 1 - ' . $i . ' - ' . $member['name'], NULL, NULL, 'Success');
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Soka Knight - Unable to Insert - ' . $i . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function posteventancdetail()
	{
		for($i=1; $i <= 418; $i++)
		{
			try
			{
				$anc = table61::find($i)->toarray();
				$member = MembersmSSA::find($anc['memberid'])->toarray();
				$post = new GroupmMember;
				$post->enrolleddate = '2015-05-22 00:00:00';
				$post->name = $member['name'];
				$post->groupid = $anc['groupid'];
				$post->groupname = $anc['group'];
				$post->rhq = $member['rhq'];
				$post->zone = $member['zone'];
				$post->chapter = $member['chapter'];
				$post->district = $member['district'];
				$post->division = $member['division'];
				$post->positionorg = $member['position'];
				$post->position = $anc['position'];
				$post->uniquecode = date('Y') . '2' . RAND(00, 99) . $member['id'] . date('s');
				$post->personid = $member['personid'];
				$post->memberid = $member['id'];

				$post->save();
				LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member - ' . $member['name'] . ' - ' . $anc['group'], NULL, NULL, 'Success');

				if($post->save())
				{
					try
					{
						if(GroupmMemberPosition::getFindDuplicateValue($member['id'], 'Member') == false)
						{	
							$post1 = new GroupmMemberPosition;
							$post1->appointeddate = '2015-05-22 00:00:00';
							$post1->groupmemberid = $post->id;
							$post1->position = 'Member';
							$post1->uniquecode = date('Y') . '6' . RAND(00, 99) . $member['id'] . date('H');
							$post1->save();

							if($post1->save())
							{
								LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Position - ' . $member['name'] . ' - ' . $anc['group'], NULL, NULL, 'Success');
							}
							else
							{
								LogsfLogs::postLogs('Create', 45, $post->id, ' - Group - New Member & Position - ', NULL, NULL, 'Failed');
							}
						}
						else
						{
							LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member & Position - Failed to Save (Duplicate) - ' . $member['name'] . ' - ' . $anc['group'], NULL, NULL, 'Failed');
						}
					}
					catch(\Exception $e)
					{
						LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member & Position - ' . $e, NULL, NULL, 'Failed');
					}
					
				}
				else
				{
					LogsfLogs::postLogs('Create', 45, 0, ' - Group - New Member - Failed to Save', NULL, NULL, 'Failed');
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - ANC - Unable to Insert - ' . $i . ' - ' . $member['name'] . ' - ' . $anc['group'] . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}

	public function postzonedm()
	{
		for($i=3; $i <= 510; $i++)
		{
			try
			{
				try
				{
					$member = MemberszOrgChart::find($i)->toarray();
					$rhq =  $member['rhqabbv'];
					$zone =  $member['zoneabbv'];
					$chapter =  $member['chapabbv'];
					$district =  $member['district'];
				}
				catch(\Exception $e){}

				try
				{
					if ($rhq == 'H7')
					{
						$post = new AttendancemAttendance;
						$post->attendancedate = '2017-07-22';
						$post->attendancetime = '00:00:00';
						$post->uniquecode = uniqid('',TRUE);
						$post->rhq = $rhq;
						$post->zone = $zone;
						$post->chapter = $chapter;
						$post->district = $district;
						$post->description = 'Jul 2017 Discussion Meeting - ' . $rhq . ' - ' . $zone . ' - '. $chapter . ' - ' . $district;
						$post->createbyname = 'Chan Kuan Leang';
						$post->attendancetype = 'Discussion Meeting';

						$post->save();
						LogsfLogs::postLogs('Create', 39, 0, ' - Region Discussion Meeting', NULL, NULL, 'Success');
					}
				}
				catch(\Exception $e) 
				{
					LogsfLogs::postLogs('Create', 39, 0, ' - Region Discussion Meeting - ' . $chapter . ' - ' . $e, NULL, NULL, 'Failed');
				}
			}
			catch(\Exception $e) 
			{
				LogsfLogs::postLogs('Create', 39, 0, ' - Zone Discussion Meeting - ' . $chapter . ' - ' . $e, NULL, NULL, 'Failed');
			}
		}
	}
}