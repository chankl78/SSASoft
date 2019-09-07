<?php

class NricTest extends TestCase {

	public function testCreateFakeNric()
	{
		for ($i = 0; $i < 100; $i++) {
			# Select a random year with 2000 as the midpoint.
			$year = mt_rand(2000-date('Y')%2000,date('Y'));
			$nric = NricHelper::getFakeNric($year);
			
			# 2nd and 3rd characters of NRIC are the last two characters of year
			$this->assertEquals($year % 100, substr($nric, 1, 2));

			# If the year is before 2000, the first letter is S or F.
			# Otherwise, the first letter is T or G.
			if ($year < 2000) {
				$this->assertContains(substr($nric,0,1),['S','F']);
			} else {
				$this->assertContains(substr($nric,0,1),['T','G']);
			}

			# NRIC is valid.
			$this->assertTrue(NricHelper::validate($nric));

			# Test that random wrong digit does not validate.
			$replace_digit_position = mt_rand(1,7);
			$first_digit = substr($nric, $replace_digit_position, 1);
			$wrong_digit = ($first_digit + mt_rand(1, 9)) % 10;
			$wrong_nric = substr($nric, 0, $replace_digit_position) . $wrong_digit . substr($nric, $replace_digit_position+1);
			$this->assertFalse(NricHelper::validate($wrong_nric));
		}
	}

	public function testSearchNricAbsent()
	{
		$nric = 'S1234567B';
		$member = MembersmSSA::getIdByNric($nric);
		$this->assertTrue(is_null($member));
	}
}