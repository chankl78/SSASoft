<?php

class SecurityTestSeeder extends Seeder {
	
	/**
	 * Seed the database with values for Security(Gajokai) tests.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->removeSeedEntries();

		# Add members
		$numberOfTestUsersToAdd = 10;
		
		for ( $i=1; $i<=$numberOfTestUsersToAdd; ++$i )
		{
			# Generate a random NRIC
			$nric = NricHelper::generateFakeNric(1)->current();
			# Personid is 2000000 + index, for SecurityTest data.
			$personid = 2000000 + $i;
			# Searchcode is the first three digits of the NRIC
			$searchcode = substr($nric, 1, 3);
			# Uniquecode is the date string
			# NRIC is the NRIC as blob
			# Name is SecurityTest . index
			$name = 'SecurityTest' . $i;

			# Create and save the member to database
			$m = new MembersmSSA;
			$m->personid = $personid;
			$m->nric = $nric;
			$m->name = $name;
			$m->uniquecode = date('dmY') . $i . date('His');
			$m->searchcode = $searchcode;
			$m->introducermobile = 'BLANK';
			$m->save();

			echo 'Created ' , $nric , ' ' , $name , PHP_EOL;
		}
	}

	public function removeSeedEntries()
	{
		MembersmSSA::where('name','like', 'SecurityTest%')->forceDelete();
		MembersmSSA::where('name','like', 'SecurityTest%')->delete();
	}

}