<?php

class GroupTest extends TestCase {

	/**
	 * Tests the Groups module
	 *
	 * @return void
	 */
	
	public static function setUpBeforeClass()
	{
	}
	
	public function testContactGroupsAndPositions()
	{
		# Get contact groups of Student Division
		$array = GroupzContactGroup::GroupName("Student Division")->lists('value','id');
		$this->assertNotEmpty($array);
		$array = GroupzPosition::GroupName("Student Division")->lists('value','id');
		$this->assertNotEmpty($array);
	}
	
	public static function tearDownAfterClass()
	{
	}
}