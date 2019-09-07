<?php

class MembersTest extends TestCase {

	/**
	 * Tests the Members module
	 *
	 * @return void
	 */
	
	public static function setUpBeforeClass()
	{
	}
	
	public function testCreateFakeMember()
	{
		$name_prefix = 'TestCreateFakeMember';
		$m = FakeMemberSeeder::createFakeMember($name_prefix);
		
		$this->assertRegexp('/^'.$name_prefix.'/', $m->name);
		
		# NRIC hash should be populated.
		$this->assertEquals($m->nrichash, md5($m->nric));

		# Search code should be populated.
		$this->assertEquals($m->searchcode, substr($m->nric, 1, 3));
	}

	public function testMemberModel()
	{
		/*
		# Find a test user
		$user = MembersmSSA::where('name','like','TestMemberData%')->first();
        $id = $user->id;
		$nric = $user->nric;
		$name = $user->name;
		$personid = $user->personid;
		print $name . ' ' . $nric . PHP_EOL;
		*/
	}

	public static function tearDownAfterClass()
	{
	}
}