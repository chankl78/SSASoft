<?php

class EventsTest extends TestCase {

	/**
	 * Tests the Events, Registration module
	 *
	 * @return void
	 */
	
	public static function setUpBeforeClass()
	{
	}
	
	public function testEventRegistrationViews()
	{
		$this->call('GET', '/sdkenshu');
		$this->assertResponseOk();
		$this->call('GET', '/friendshipmeeting');
		$this->assertResponseOk();
	}

	public function testEventRegistrationCreate()
	{
		# Find a security user
		$user = MembersmSSA::where('name','like','TestMemberData%')->first();
		$id = $user->id;
		$nric = $user->nric;
		$name = $user->name;
		$personid = $user->personid;
		
		# Test the attendance creation
		$response = $this->action('POST', 'EventMemRegistrationController@postRegisterForEvent', array(),
			array('memberid' => $id, 'eventid' => 20170201134021));
		
		# The resulting query statement:
		$query = EventmRegistration::where('memberid', $id)->where('eventid',57);
		
		# Assert the record exists
		$this->assertEquals($query->count(), 1, 'The event registration record was not created!');
		
		# Remove the just created record
		$query->forceDelete();
		$query->delete();
	}
	
	public static function tearDownAfterClass()
	{
	}
}