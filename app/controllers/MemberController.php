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
			->orderBy('position', 'ASC')->orderBy('name', 'ASC')->get(array('uniquecode', 'name', 'rhq', 'chapter', 'district', 'zone', 'position', 'chinesename', 'classification', 'created_at', 'alias', 'email', 'mobile', 'division', 'mobile'))->toarray();
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

	public function post2019Members()
	{
		DB::table('zz_2019_Members')->truncate();

		DB::statement('INSERT INTO zz_2019_Members (created_at, updated_at, source, uniquecode, id, name, chinesename, rhq, zone, chapter, district, division, position, positionlevel, belsigned, memsigned, gender, age, agegroup, below13, `1316`, `1723`, `2430`, `3135`, `3640`, `4145`, `4650`, `5155`, `5660`, `6165`, `6670`, `7175`, above75, dmjan, dmfeb, dmmar, dmapr, dmmay, dmjun, dmjul, dmaug, dmsep, dmoct, dmnov, dmdec, dmtotal, dmunique, sgistudyjan, irstudymar, irstudyjun, studytotal, rythemofpeace, sokastallion, ojokai, sokaknights, peonydancegroup, tulipchoir, sunshineaunty, kanekogroup, dendrobium, carnationgroup, sokapassiongroup, happycreativegroup, whitephoenix, courageousmusician, ymdgymcoregroup, goldenliondancetroupe, gajokai, younglion, vanguard, fearlessgroup, sunflower, kotekitai, ikedakayokai, byakuren, bluebelle, juniorchoir, sydc, futuredivision, studentdivision, snco, sokachorus, rco, smg, svg, propsgroup, skalumni) 
			SELECT mssa.created_at, mssa.updated_at, mssa.source, mssa.uniquecode, mssa.id, mssa.name, mssa.chinesename, mssa.rhq, mssa.zone, mssa.chapter, mssa.district, mssa.division, mssa.position, mssa.positionlevel, mssa.belsigned, mssa.memsigned, mssa.gender, Year(now()) - Year(mssa.dateofbirth) as age, CASE WHEN (Year(now()) - Year(mssa.dateofbirth)) <= 6 THEN "0 to 6" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 7 and (Year(now()) - Year(mssa.dateofbirth)) <= 12 THEN "7 to 12" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 13 and (Year(now()) - Year(mssa.dateofbirth)) <= 16 THEN "13 to 16" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 17 and (Year(now()) - Year(mssa.dateofbirth)) <= 23 THEN "17 to 23" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 24 and (Year(now()) - Year(mssa.dateofbirth)) <= 30 THEN "24 to 30" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 31 and (Year(now()) - Year(mssa.dateofbirth)) <= 35 THEN "31 to 35" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 36 and (Year(now()) - Year(mssa.dateofbirth)) <= 40 THEN "36 to 40" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 41 and (Year(now()) - Year(mssa.dateofbirth)) <= 45 THEN "41 to 45" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 46 and (Year(now()) - Year(mssa.dateofbirth)) <= 50 THEN "46 to 50" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 51 and (Year(now()) - Year(mssa.dateofbirth)) <= 55 THEN "51 to 55" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 56 and (Year(now()) - Year(mssa.dateofbirth)) <= 60 THEN "56 to 60" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 61 and (Year(now()) - Year(mssa.dateofbirth)) <= 65 THEN "61 to 65" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 66 and (Year(now()) - Year(mssa.dateofbirth)) <= 70 THEN "66 to 70" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 71 and (Year(now()) - Year(mssa.dateofbirth)) <= 75 THEN "71 to 75" WHEN (Year(now()) - Year(mssa.dateofbirth)) >= 76 and (Year(now()) - Year(mssa.dateofbirth)) <= 120 THEN "Above 75" WHEN (Year(mssa.dateofbirth)) IS NULL THEN "Unknown" ELSE "Unknown" END as agegroup, CASE WHEN Year(now()) - Year(mssa.dateofbirth) < 13 THEN 1 ELSE 0 END as "below13", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 13 and Year(now()) - Year(mssa.dateofbirth) <= 16 THEN 1 ELSE 0 END as "1316", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 17 and Year(now()) - Year(mssa.dateofbirth) <= 23 THEN 1 ELSE 0 END as "1723", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 24 and Year(now()) - Year(mssa.dateofbirth) <= 30 THEN 1 ELSE 0 END as "2430", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 31 and Year(now()) - Year(mssa.dateofbirth) <= 35 THEN 1 ELSE 0 END as "3135", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 36 and Year(now()) - Year(mssa.dateofbirth) <= 40 THEN 1 ELSE 0 END as "3640", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 41 and Year(now()) - Year(mssa.dateofbirth) <= 45 THEN 1 ELSE 0 END as "4145", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 46 and Year(now()) - Year(mssa.dateofbirth) <= 50 THEN 1 ELSE 0 END as "4650", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 51 and Year(now()) - Year(mssa.dateofbirth) <= 55 THEN 1 ELSE 0 END as "5155", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 56 and Year(now()) - Year(mssa.dateofbirth) <= 60 THEN 1 ELSE 0 END as "5660", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 61 and Year(now()) - Year(mssa.dateofbirth) <= 65 THEN 1 ELSE 0 END as "6165", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 66 and Year(now()) - Year(mssa.dateofbirth) <= 70 THEN 1 ELSE 0 END as "6670", CASE WHEN Year(now()) - Year(mssa.dateofbirth) >= 71 and Year(now()) - Year(mssa.dateofbirth) <= 75 THEN 1 ELSE 0 END as "7175", CASE WHEN Year(now()) - Year(mssa.dateofbirth) > 76 THEN 1 ELSE 0 END as "above75", 0 as dmjan, 0 as dmfeb, 0 as dmmar, 0 as dmapr, 0 as dmmay, 0 as dmjun, 0 as dmjul, 0 as dmaug, 0 as dmsep, 0 as dmoct, 0 as dmnov, 0 as dmdec, 0 as dmtotal, 0 as dmunique, 0 as sgistudyjan, 0 as irstudymar, 0 as irstudyjun, 0 as studytotal, "" as "rythemofpeace", "" as "sokastallion", "" as "ojokai", "" as "sokaknights", "" as "peonydancegroup", "" as "tulipchoir", "" as "sunshineaunty", "" as "kanekogroup", "" as "dendrobium", "" as "carnationgroup", "" as "sokapassiongroup", "" as "happycreativegroup", "" as "whitephoenix", "" as "courageousmusician", "" as "ymdgymcoregroup", "" as "goldenliondancetroupe", "" as "gajokai", "" as "younglion", "" as vanguard, "" as "fearlessgroup", "" as "sunflower", "" as "kotekitai", "" as "ikedakayokai", "" as "byakuren", "" as "bluebelle", "" as "juniorchoir", "" as "sydc", "" as "futuredivision", "" as "studentdivision", "" as "snco", "" as "sokachorus", "" as "rco", "" as "smg", "" as "svg", "" as "propsgroup", "" as "skalumni"
			FROM Members_m_SSA mssa
			WHERE mssa.deleted_at IS NULL and mssa.division IN ("MD", "WD", "YM", "YW", "PD", "YC")
			ORDER BY mssa.rhq, mssa.zone, mssa.chapter, mssa.district, mssa.division, mssa.position, mssa.positionlevel, mssa.name;');

		DB::statement('CREATE TABLE zz_2019_dm (SELECT ap.memberid, mssa.uniquecode,
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 1) THEN 1 ELSE 0 END as dmjan, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 2) THEN 1 ELSE 0 END as dmfeb, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 3) THEN 1 ELSE 0 END as dmmar, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 4) THEN 1 ELSE 0 END as dmapr, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 5) THEN 1 ELSE 0 END as dmmay, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 6) THEN 1 ELSE 0 END as dmjun, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 7) THEN 1 ELSE 0 END as dmjul, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 8) THEN 1 ELSE 0 END as dmaug, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 9) THEN 1 ELSE 0 END as dmsep, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 10) THEN 1 ELSE 0 END as dmoct, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 11) THEN 1 ELSE 0 END as dmnov, 
			CASE WHEN SUM(ap.attendancestatus = "Attended" and month(aa.attendancedate) = 12) THEN 1 ELSE 0 END as dmdec,
			SUM(CASE WHEN ap.attendancestatus = "Attended" THEN 1 ELSE 0 END) as dmtotal,
			CASE WHEN (SUM(CASE WHEN ap.attendancestatus = "Attended" THEN 1 ELSE 0 END) > 0) THEN 1 ELSE 0 END as dmunique
			FROM Attendance_m_Person ap LEFT JOIN Attendance_m_Attendance aa on ap.attendanceid = aa.id LEFT JOIN Members_m_SSA mssa on mssa.id = ap.memberid
			WHERE aa.attendancetype IN ("Discussion Meeting") and aa.deleted_at IS NULL and year(aa.attendancedate) = 2019 and ap.deleted_at IS NULL and ap.memberid != 0 and ap.division in ("MD", "WD", "YM", "YW", "PD", "YC")
			GROUP BY ap.memberid ORDER BY ap.memberid);');
		
		DB::statement('UPDATE zz_2019_Members m INNER JOIN zz_2019_dm mdm on m.id = mdm.memberid
			SET m.dmjan = mdm.dmjan, m.dmfeb = mdm.dmfeb, m.dmmar = mdm.dmmar, m.dmapr = mdm.dmapr, m.dmmay = mdm.dmmay, m.dmjun = mdm.dmjun, m.dmjul = mdm.dmjul, m.dmaug = mdm.dmaug, m.dmsep = mdm.dmsep, m.dmoct = mdm.dmoct, m.dmnov = mdm.dmnov, m.dmdec = mdm.dmdec, m.dmtotal = mdm.dmtotal, m.dmunique = mdm.dmunique;');

		DB::statement('DROP TABLE zz_2019_dm;');

		DB::statement('CREATE TABLE zz_2019_Study (SELECT ap.memberid, mssa.uniquecode,
			CASE WHEN SUM(ap.attendanceid IN (11846, 11847, 11848, 11849, 11850, 11851, 11852, 11853, 11854, 11855, 11856)) THEN 1 ELSE 0 END as sgistudyjan,
			CASE WHEN SUM(ap.eventid IN (192)) THEN 1 ELSE 0 END as irstudymar,
			CASE WHEN SUM(ap.eventid IN (230)) THEN 1 ELSE 0 END as irstudyjun
			FROM Attendance_m_Person ap LEFT JOIN Attendance_m_Attendance aa on aa.id = ap.attendanceid LEFT JOIN Members_m_SSA mssa on mssa.id = ap.memberid
			WHERE ap.eventid IN (171, 172, 192, 230) and ap.deleted_at IS NULL and memberid != 0
			GROUP BY ap.memberid ORDER BY ap.memberid);');
		
		DB::statement('UPDATE zz_2019_Members m INNER JOIN zz_2019_Study s on m.id = s.memberid
			SET m.sgistudyjan = s.sgistudyjan, m.irstudymar = s.irstudymar, m.irstudyjun = s.irstudyjun, m.studytotal = s.sgistudyjan + s.irstudymar + s.irstudyjun;');

		DB::statement('DROP TABLE zz_2019_Study;');

		DB::statement('CREATE TABLE zz_2019_culturefunction (SELECT gm.memberid, mssa.uniquecode,
		CASE WHEN SUM(gm.groupid IN (13)) THEN gm.position ELSE "" END as sokastallion,
		CASE WHEN SUM(gm.groupid IN (15)) THEN gm.position ELSE "" END as ojokai,
		CASE WHEN SUM(gm.groupid IN (18)) THEN gm.position ELSE "" END as rythemofpeace,
		CASE WHEN SUM(gm.groupid IN (30)) THEN gm.position ELSE "" END as sokaknights,
		CASE WHEN SUM(gm.groupid IN (6)) THEN gm.position ELSE "" END as peonydancegroup,
		CASE WHEN SUM(gm.groupid IN (19)) THEN gm.position ELSE "" END as tulipchoir,
		CASE WHEN SUM(gm.groupid IN (21)) THEN gm.position ELSE "" END as sunshineaunty,
		CASE WHEN SUM(gm.groupid IN (28)) THEN gm.position ELSE "" END as kanekogroup,
		CASE WHEN SUM(gm.groupid IN (31)) THEN gm.position ELSE "" END as dendrobium,
		CASE WHEN SUM(gm.groupid IN (34)) THEN gm.position ELSE "" END as carnationgroup,
		CASE WHEN SUM(gm.groupid IN (42)) THEN gm.position ELSE "" END as sokapassiongroup,
		CASE WHEN SUM(gm.groupid IN (44)) THEN gm.position ELSE "" END as happycreativegroup,
		CASE WHEN SUM(gm.groupid IN (45)) THEN gm.position ELSE "" END as whitephoenix,
		CASE WHEN SUM(gm.groupid IN (2)) THEN gm.position ELSE "" END as ymdgymcoregroup,
		CASE WHEN SUM(gm.groupid IN (5)) THEN gm.position ELSE "" END as goldenliondancetroupe,
		CASE WHEN SUM(gm.groupid IN (33)) THEN gm.position ELSE "" END as courageousmusician,
		CASE WHEN SUM(gm.groupid IN (14)) THEN gm.position ELSE "" END as gajokai,
		CASE WHEN SUM(gm.groupid IN (12)) THEN gm.position ELSE "" END as younglion,
		CASE WHEN SUM(gm.groupid IN (46)) THEN gm.position ELSE "" END as vanguard,
		CASE WHEN SUM(gm.groupid IN (48)) THEN gm.position ELSE "" END as fearlessgroup,
		CASE WHEN SUM(gm.groupid IN (7)) THEN gm.position ELSE "" END as sunflower,
		CASE WHEN SUM(gm.groupid IN (32)) THEN gm.position ELSE "" END as kotekitai,
		CASE WHEN SUM(gm.groupid IN (29)) THEN gm.position ELSE "" END as ikedakayokai,
		CASE WHEN SUM(gm.groupid IN (11)) THEN gm.position ELSE "" END as byakuren,
		CASE WHEN SUM(gm.groupid IN (43)) THEN gm.position ELSE "" END as bluebelle,
		CASE WHEN SUM(gm.groupid IN (8)) THEN gm.position ELSE "" END as juniorchoir,
		CASE WHEN SUM(gm.groupid IN (16)) THEN gm.position ELSE "" END as sydc,
		CASE WHEN SUM(gm.groupid IN (4)) THEN gm.position ELSE "" END as futuredivision,
		CASE WHEN SUM(gm.groupid IN (3)) THEN gm.position ELSE "" END as studentdivision,
		CASE WHEN SUM(gm.groupid IN (9)) THEN gm.position ELSE "" END as snco,
		CASE WHEN SUM(gm.groupid IN (10)) THEN gm.position ELSE "" END as sokachorus,
		CASE WHEN SUM(gm.groupid IN (25)) THEN gm.position ELSE "" END as rco,
		CASE WHEN SUM(gm.groupid IN (27)) THEN gm.position ELSE "" END as smg,
		CASE WHEN SUM(gm.groupid IN (36)) THEN gm.position ELSE "" END as svg,
		CASE WHEN SUM(gm.groupid IN (35)) THEN gm.position ELSE "" END as propsgroup,
		CASE WHEN SUM(gm.groupid IN (49)) THEN gm.position ELSE "" END as skalumni
		FROM Group_m_Member gm LEFT JOIN Group_m_Group gg on gm.groupid = gg.id LEFT JOIN Members_m_SSA mssa on gm.memberid = mssa.id
		WHERE gg.deleted_at IS NULL and gm.deleted_at IS NULL and gm.status = "Active" 
		GROUP BY gm.memberid ORDER BY gm.memberid);');

		DB::statement('UPDATE zz_2019_Members m INNER JOIN zz_2019_culturefunction cf on m.id = cf.memberid
			SET m.sokastallion = cf.sokastallion, m.ojokai = cf.ojokai, m.rythemofpeace = cf.rythemofpeace, m.sokaknights = cf.sokaknights, m.peonydancegroup = cf.peonydancegroup, m.tulipchoir = cf.tulipchoir, m.sunshineaunty = cf.sunshineaunty, m.kanekogroup = cf.kanekogroup, m.dendrobium = cf.dendrobium, m.carnationgroup = cf.carnationgroup, m.sokapassiongroup = cf.sokapassiongroup, m.happycreativegroup = cf.happycreativegroup, m.whitephoenix = cf.whitephoenix, m.ymdgymcoregroup = cf.ymdgymcoregroup, m.goldenliondancetroupe = cf.goldenliondancetroupe, m.courageousmusician = cf.courageousmusician, m.gajokai = cf.gajokai, m.younglion = cf.younglion, m.vanguard = cf.vanguard, m.fearlessgroup = cf.fearlessgroup, m.sunflower = cf.sunflower, m.kotekitai = cf.kotekitai, m.ikedakayokai = cf.ikedakayokai, m.byakuren = cf.byakuren, m.bluebelle = cf.bluebelle, m.juniorchoir = cf.juniorchoir, m.sydc = cf.sydc, m.futuredivision = cf.futuredivision, m.studentdivision = cf.studentdivision, m.snco = cf.snco, m.sokachorus = cf.sokachorus, m.rco = cf.rco, m.smg = cf.smg, m.svg = cf.svg, m.propsgroup = cf.propsgroup, m.skalumni = cf.skalumni;');

		DB::statement('DROP TABLE zz_2019_culturefunction;');
	}

	public function posttransfermmsboe()
	{
		try
		{
			MembersmImportSSA::transfermmstoboe();
			return Response::json(array('info' => 'Success'), 200);
		}
		catch (\Exception $e)
		{
			return Response::json(array('info' => 'Failed'), 400);
		}
		
	}

	public function posttransfermmsboedesc()
	{
		try
		{
			MembersmImportSSA::transfermmstoboedesc();
			return Response::json(array('info' => 'Success'), 200);
		}
		catch (\Exception $e)
		{
			return Response::json(array('info' => 'Failed'), 400);
		}
		
	}

	public function postConvertAuto()
	{
		LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convertion Starts', NULL, NULL, 'Success');
		$pdo = DB::connection("mysql2")->getPdo();
		$member = $pdo->query(DB::raw('SELECT * FROM person_view;'));
		$convertcount = $pdo->query(DB::raw('SELECT countid FROM person_view;'));
		for($i = Input::get('startnumber'); $i <= Input::get('endnumber'); $i++)
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
				catch(\Exception $e) { }

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
					}
				}
				catch(\Exception $e) 
				{
				}
			}
			catch(\Exception $e) 
			{
			}
		}

		LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convertion from MMS to BOE Successfully Completed with Start Number: ' . Input::get('startnumber') . ' End Number: ' . Input::get('endnumber'), NULL, NULL, 'Success');
		return Response::json(array('info' => 'Success', 'numbercount' => $convertcount), 200);
	}

	public function postConvertAutoOld()
	{
		LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convertion Starts', NULL, NULL, 'Success');
		$convertcount = DB::table('Members_m_ImportSSA')->count();
		for($i = Input::get('startnumber'); $i <= Input::get('endnumber'); $i++)
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
				catch(\Exception $e) { }

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
					}
				}
				catch(\Exception $e) 
				{
				}
			}
			catch(\Exception $e) 
			{
			}
		}

		LogsfLogs::postLogs('Update', 39, 0, ' - Members - Convertion from MMS to BOE Successfully Completed with Start Number: ' . Input::get('startnumber') . ' End Number: ' . Input::get('endnumber'), NULL, NULL, 'Success');
		return Response::json(array('info' => 'Success', 'numbercount' => $convertcount), 200);
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