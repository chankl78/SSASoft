<?php

class NricStressTestSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->removeSeedEntries();

		$totalNumberToAdd = 1000;
		
		for ($i=1;$i<=$totalNumberToAdd;++$i)
		{
			# Generate a random NRIC
			$nric = NricHelper::generateFakeNric(1)->current();
			# Personid is 1000000 + index, for testing data.
			$personid = 1000000 + $i;
			# Searchcode is the first three digits of the NRIC
			$searchcode = substr($nric, 1, 3);
			# Uniquecode is the date string
			# NRIC is the NRIC as blob
			# Name is NricStressTest . index
			$name = 'NricStressTest' . $i;

			# Create and save the member to database
			$post = new MembersmSSA;
			$post->personid = $personid;
			$post->nric = $nric;
			$post->name = $name;
			$post->uniquecode = date('dmY') . $i . date('His');
			$post->searchcode = $searchcode;
			$post->introducermobile = 'BLANK';
			$post->save();
		}
	}

	public function removeSeedEntries()
	{
		MembersmSSA::where('name','like', 'NricStressTest%')->forceDelete();
		MembersmSSA::where('name','like', 'NricStressTest%')->delete();
	}

}