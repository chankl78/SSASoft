<?php

set_time_limit(0);
ignore_user_abort(true);

class MembersmImportSSA extends Eloquent {

	protected $table = 'Members_m_ImportSSA';

	public static function transfermmstoboe()
    {
		try
		{
			// Get arrary from MMS
			$pdo = DB::connection("mysql2")->getPdo();
			$member = $pdo->query(DB::raw('SELECT * FROM person_view;'));
			// Insert into BOE
			$i = 1;
			foreach($member as $member)
			{
				//LogsfLogs::postLogs('Create', 39, 0, ' - MembersmImportSSA Model - ' . $member['id'], NULL, NULL, 'Failed');
				if (MembersmSSA::getcheckpersonidexist($member['id']) == false) 
				{
					$post = new MembersmSSA;
					$post->personid = $member['id'];
					$post->nric = substr($member['nric'], 2);
					if ($member['nric'] <> NULL)
					{
						$post->nrichash = md5(substr($member['nric'], 2));
						$post->searchcode = substr($member['nric'], 3, 3);
					}
					$post->mmsuuid = $member['uuid'];
					$post->name = $member['name'];
					$post->uniquecode = uniqid('',TRUE);
					$post->chinesename = $member['chinese_name'];
					$post->alias = $member['alias'];
					$post->nationality = $member['citizenship'];
					$post->language = $member['language_name'];
					$post->gender = $member['gender'];
					$post->dateofbirth = $member['date_of_birth'];
					$post->countryofbirth = $member['country_of_birth'];
					if($member['tel_home'] == ''){$post->tel = 'NIL';} else {$post->tel = $member['tel_home'];}
					if($member['tel_mobile'] == ''){$post->mobile = 'NIL';} else {$post->mobile = $member['tel_mobile'];}
					if($member['email'] == ''){$post->email = 'NIL';} 
					else {
						$post->email = $member['email'];
						$post->emailhash = md5($member['email']);
					}
					$post->rhq = $member['hq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['dist'];
					$post->position = $member['position'];
					if ($member['position'] == 'BEL') { $positionlevel = 'bel'; }
					elseif ($member['position'] == 'MEM') { $positionlevel = 'mem'; }
					else { $positionlevel = MemberszPosition::getPositionLevel($member['position']); }	
					$post->division = $member['division'];
					if($member['address1'] == ''){$post->address = 'NIL';} else {$post->address = $member['address1'];}
					if($member['buildingName'] == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $member['buildingName'];}
					if($member['address2'] == ''){$post->unitno = 'NIL';} else {$post->unitno = $member['address2'];}
					if($member['address3'] == ''){$post->postalcode = 'NIL';} else {$post->postalcode = substr($member['address3'],2);}
					$post->emergencytel = 'NIL'; 
					$post->emergencymobile = 'NIL';
					$post->introducermobile = 'NIL';
					$post->classification = $member['new_classification'];
					$post->status = $member['new_status'];
					$post->memsigned = $member['mem_signed'];
					$post->belsigned = $member['bel_signed'];
					if($member['bel_signed'] == 1){$post->believersigned = 1;}
					
					$post->save();
				}
				else
				{
					$post = MembersmSSA::find(MembersmSSA::getIdByPersonID($member['id']));
					$post->personid = $member['id'];
					$post->nric = substr($member['nric'], 2);
					if ($member['nric'] <> NULL)
					{
						$post->nrichash = md5(substr($member['nric'], 2));
						$post->searchcode = substr($member['nric'], 3, 3);
					}
					$post->mmsuuid = $member['uuid'];
					$post->name = $member['name'];
					$post->uniquecode = uniqid('',TRUE);
					$post->chinesename = $member['chinese_name'];
					$post->alias = $member['alias'];
					$post->nationality = $member['citizenship'];
					$post->language = $member['language_name'];
					$post->gender = $member['gender'];
					$post->dateofbirth = $member['date_of_birth'];
					$post->countryofbirth = $member['country_of_birth'];
					if($member['tel_home'] == ''){$post->tel = 'NIL';} else {$post->tel = $member['tel_home'];}
					if($member['tel_mobile'] == ''){$post->mobile = 'NIL';} else {$post->mobile = $member['tel_mobile'];}
					if($member['email'] == ''){$post->email = 'NIL';} 
					else {
						$post->email = $member['email'];
						$post->emailhash = md5($member['email']);
					}
					$post->rhq = $member['hq'];
					$post->zone = $member['zone'];
					$post->chapter = $member['chapter'];
					$post->district = $member['dist'];
					$post->position = $member['position'];
					if ($member['position'] == 'BEL') { $positionlevel = 'bel'; }
					elseif ($member['position'] == 'MEM') { $positionlevel = 'mem'; }
					else { $positionlevel = MemberszPosition::getPositionLevel($member['position']); }	
					$post->division = $member['division'];
					if($member['address1'] == ''){$post->address = 'NIL';} else {$post->address = $member['address1'];}
					if($member['buildingName'] == ''){$post->buildingname = 'NIL';} else {$post->buildingname = $member['buildingName'];}
					if($member['address2'] == ''){$post->unitno = 'NIL';} else {$post->unitno = $member['address2'];}
					if($member['address3'] == ''){$post->postalcode = 'NIL';} else {$post->postalcode = substr($member['address3'],2);}
					$post->emergencytel = 'NIL'; 
					$post->emergencymobile = 'NIL';
					$post->introducermobile = 'NIL';
					$post->classification = $member['new_classification'];
					$post->status = $member['new_status'];
					$post->memsigned = $member['mem_signed'];
					$post->belsigned = $member['bel_signed'];
					if($member['bel_signed'] == 1){$post->believersigned = 1;}

					$post->save();
				}

				$i++;
				if ($i == 5000 || $i == 10000 || $i == 15000 || $i == 20000 || $i == 25000 || $i == 30000 || $i == 35000 || $i == 40000 || $i == 45000 || $i == 50000 || $i == 55000 || $i == 60000)
				{
					LogsfLogs::postLogs('Update', 39, 0, ' - MembersmImportSSA Model - MMS to BOE Success - ' . $i, NULL, NULL, 'Success');
				}
			}

			LogsfLogs::postLogs('Update', 39, 0, ' - MembersmImportSSA Model - MMS to BOE Success ', NULL, NULL, 'Success');
		}
		catch(\Exception $e) 
		{
			LogsfLogs::postLogs('Create', 39, 0, ' - MembersmImportSSA Model - MMS to BOE Failed - ' . $member['id'] . ' ' . $e, NULL, NULL, 'Failed');
		}
	}
}
