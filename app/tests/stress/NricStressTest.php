<?php

class NricStressTest extends TestCase {

	public static function setUpBeforeClass()
	{
		$s = new NricStressTestSeeder;
		$s->run();
	}

	public function testSearchByNric()
	{
		$totalMembers = MembersmSSA::count();
		$totalSearches = 10;
		var_dump('Searching ' . $totalSearches . ' times in ' . $totalMembers . ' entries');
		for ( $i=1; $i<=$totalSearches; ++$i )
		{
			$index = rand(0,$totalMembers-1);
			$memberToSearch = MembersmSSA::all()->get($index);
			$nricToSearch = $memberToSearch->nric;
			$foundMember = MembersmSSA::getByNric($nricToSearch);
			$returnedNric = $foundMember->nric;
			$this->assertFalse(is_null($foundMember), 'NRIC ' . $nricToSearch . ' not found when it is the database[' . $index . '] entry.');
			$this->assertEquals($nricToSearch, $returnedNric, 'The returned NRIC ' . $returnedNric . ' does not match the requested NRIC ' . $nricToSearch);
		}
	}

	public static function tearDownAfterClass()
	{
		$s = new NricStressTestSeeder;
		$s->removeSeedEntries();
	}
}