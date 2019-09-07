<?php

class FakeMemberSeeder extends Seeder {
	
	private function getRandomPhoneNumber($prefix) {
		return $prefix . sprintf('%07d', rand(0,9999999));
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->removeSeedEntries();

		$totalNumberToAdd = 1;
		
		for ($i=1;$i<=$totalNumberToAdd;++$i)
		{
			# Generate a random NRIC
			$nric = NricHelper::generateFakeNric(1)->current();
			echo "Creating " . $nric . PHP_EOL;
			# Personid is 1000000 + index, for testing data.
			$personid = 1000000 + $i;
			# Searchcode is the first three digits of the NRIC
			$searchcode = substr($nric, 1, 3);
			# Uniquecode is the date string
			# NRIC is the NRIC as blob
			# Name is TestMemberData . index
			$name = 'TestMemberData' . $i;

			# Create and save the member to database
			$post = new MembersmSSA;
			$post->personid = $personid;
			$post->nric = $nric;
			$post->name = $name;
			$post->uniquecode = date('dmY') . $i . date('His');
			$post->searchcode = $searchcode;
			$post->introducermobile = 'BLANK';

            # Add random RZCD
            $org = MemberszOrgChart::orderbyRaw("RAND()")->limit(1)->get();
            $post->rhq = $org[0]['rhqabbv'];
            $post->zone = $org[0]['zoneabbv'];
            $post->chapter = $org[0]['chapabbv'];
            $post->district = $org[0]['district'];
            
            # Add random position
            $position = MemberszPosition::orderbyRaw("RAND()")->limit(1)->get();
            $post->position = $position[0]['code'];
			
            # Add division and gender
			$gender = ['F','M'];
			$post->gender = $gender[mt_rand(0, count($gender)-1)];
			if ($post->gender == 'F') {
				$division = ['YW','WD'];
				$post->division = $division[mt_rand(0,count($division)-1)];
			} else {
				$division = ['YM','MD'];
				$post->division = $division[mt_rand(0,count($division)-1)];
			}
            
            $post->dateofbirth = '1999-12-31';
			$post->tel = $this->getRandomPhoneNumber('6');
            $post->mobile = $this->getRandomPhoneNumber('9');
            $post->email = 'email@.' . str_random(10) . '.com';

			$post->address = str_random(10);
			$post->buildingname = str_random(10);
			$post->unitno = str_random(10);
			$post->postalcode = rand(100000,999999);
			
			$post->emergencytel = $this->getRandomPhoneNumber('6');
			$post->emergencymobile = $this->getRandomPhoneNumber('9');
			$post->introducermobile = 'NIL';
            $post->save();
		}

		Eloquent::reguard();
	}

	public function removeSeedEntries()
	{
		MembersmSSA::where('name','like', 'TestMemberData%')->forceDelete();
		MembersmSSA::where('name','like', 'TestMemberData%')->delete();
	}

}