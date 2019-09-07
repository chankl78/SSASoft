<?php

class UserSeeder extends Seeder {
 
    public function run()
    {
    	// Access Rights
		Eloquent::unguard();

		DB::table('Access_m_Users')->truncate();
        AccessmUsers::create(array('name' => 'SSASoft Administrator', 'username' => 'ssasoft', 'uniquecode' => uniqid('',TRUE), 
        	'password' => Hash::make('ssasoft529014'), 'roleid' => 'System Administrator', 'tel' => '1234 5678', 
        	'mobile' => '1234 5678', 'email' => 'kuanleang@ssabuddhist.org', 'firstlogin' => 0));

        DB::table('Access_m_AccessRights')->truncate();
        AccessmAccessRights::create(array('userid' => 1, 'resourcegroup' => 'SYSA', 'resourcecode' => 'SYSA', 
        	'accesstypeid' => 0, 'startdate' => '0000-00-00', 'enddate' => '0000-00-00', 'starttime' => '00:00:00', 
        	'endtime' => '00:00:00', 'create' => true, 'read' => true, 'update' => true, 'delete' => true, 'void' => true, 
			'unvoid' => true, 'print' => true, 'uniquecode' => uniqid('',TRUE)));
			
		AccessmUsers::create(array('name' => 'Chan Kuan Leang', 'username' => 'chankl78', 'uniquecode' => uniqid('',TRUE), 
			'password' => Hash::make('Worldsoft10!'), 'roleid' => 'Software Administrator', 'tel' => '1234 5678', 
			'mobile' => '1234 5678', 'email' => 'kuanleang@ssabuddhist.org', 'firstlogin' => 0));

		AccessmAccessRights::create(array('userid' => 2, 'resourcegroup' => 'SYSA', 'resourcecode' => 'SYSA', 
			'accesstypeid' => 0, 'startdate' => '0000-00-00', 'enddate' => '0000-00-00', 'starttime' => '00:00:00', 
			'endtime' => '00:00:00', 'create' => true, 'read' => true, 'update' => true, 'delete' => true, 'void' => true, 
			'unvoid' => true, 'print' => true, 'uniquecode' => uniqid('',TRUE)));

		
    }
}