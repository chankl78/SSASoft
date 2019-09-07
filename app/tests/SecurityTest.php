<?php

class SecurityTest extends TestCase {

	/**
	 * Tests the Security module
	 *
	 * @return void
	 */
	
	public static function setUpBeforeClass()
	{
		$s = new SecurityTestSeeder;
		$s->run();
	}
	
	public function testSecurityDashboard()
	{
		$this->call('GET', '/Security');
		$this->assertResponseOk();
	}

	public function testSecurityAttendance()
	{
		$this->call('GET', '/Security/Attendance');
		$this->assertResponseOk();
	}
	
	public function testSecurityAttendanceCreate()
	{
		# Find a security user
		$user = MembersmSSA::where('name','like','SecurityTest%')->first();
		$nric = $user->nric;
		$name = $user->name;
		$personid = $user->personid;
		#var_dump('User  ' . $name . ' ' . $nric . ' ' . $personid);
		
		# Test the attendance creation
		Session::start();
		$response = $this->call('POST', '/Security/postSignIn', array(
			'nricsearch' => $nric,
			'shifttype' => 'Evening'
		));
		#var_dump(SecuritymAttendance::count());
		#var_dump($response);
		$this->assertResponseStatus(200);

		# Assert the record exists
		$this->assertTrue(SecuritymAttendance::where('personid', $personid)->count() >= 1, 'The attendance record was not created!');

		# Delete the created attendance record
		SecuritymAttendance::where('personid', $personid)->forceDelete();
		SecuritymAttendance::where('personid', $personid)->delete();
	}

	public function testSecurityAttendanceCreateNricAbsent()
	{
		# Find an absent user
		$nric = 'S0000000I';
		$member = MembersmSSA::getByNric($nric);
		$this->assertTrue(is_null($member));
		
		# Test the attendance creation
		Session::start();
		$response = $this->call('POST', '/Security/postSignIn', array(
			'nricsearch' => $nric,
			'shifttype' => 'Evening'
		));
		#var_dump(SecuritymAttendance::count());
		$this->assertResponseStatus(400, 'Absent NRIC did not trigger error.');
		
		$data = $response->getData(true);
		$this->assertArrayHasKey('ErrType', $data, 'Absent NRIC response did not contain "ErrType"');
		$this->assertEquals($data['ErrType'], 'Does Not Exist', 'Expected ErrType "Does Not Exist", actual was "' . $data['ErrType'] . '"');
	}

	public static function tearDownAfterClass()
	{
		$s = new SecurityTestSeeder;
		$s->removeSeedEntries();
	}
}