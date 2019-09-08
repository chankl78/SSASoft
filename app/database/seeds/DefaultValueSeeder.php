<?php

class DefaultValueSeeder extends Seeder {
 
    public function run()
    {
    	// Access Rights
        DB::table('Access_z_AccessTypes')->delete();
        AccesszAccessTypes::create(array('value' => 'Module'));
		AccesszAccessTypes::create(array('value' => 'Temporany'));
		AccesszAccessTypes::create(array('value' => 'Time-Based'));

		DB::table('Access_z_Roles')->delete();
		AccesszRoles::create(array('value' => 'System Administrator'));
		AccesszRoles::create(array('value' => 'Software Administrator'));
		AccesszRoles::create(array('value' => 'Resource Administrator'));
		AccesszRoles::create(array('value' => 'User'));
		AccesszRoles::create(array('value' => 'Event Administrator'));
		AccesszRoles::create(array('value' => 'Single Event Administrator'));
		AccesszRoles::create(array('value' => 'Single Event User'));		

		DB::table('Access_z_Status')->delete();
		AccesszStatus::create(array('value' => 'Active'));
		AccesszStatus::create(array('value' => 'Inactive'));
		AccesszStatus::create(array('value' => 'Banned'));

		DB::table('Access_m_Users')->delete();
        AccessmUsers::create(array('name' => 'SSASoft Administrator', 'username' => 'ssasoft', 'uniquecode' => date('YmdHis') - 239042, 
        	'password' => Hash::make('123456789'), 'roleid' => 'System Administrator', 'tel' => '1234 5678', 
        	'mobile' => '1234 5678', 'email' => 'c@c.abc', 'firstlogin' => 0));

        DB::table('Access_m_AccessRights')->delete();
        AccessmAccessRights::create(array('userid' => 1, 'resourcegroup' => 'SYSA', 'resourcecode' => 'SYSA', 
        	'accesstypeid' => 0, 'startdate' => '0000-00-00', 'enddate' => '0000-00-00', 'starttime' => '00:00:00', 
        	'endtime' => '00:00:00', 'create' => true, 'read' => true, 'update' => true, 'delete' => true, 'void' => true, 
        	'unvoid' => true, 'print' => true, 'uniquecode' => date('YmdHis') - 345678));

		// Staffs
		DB::table('Staff_z_Department')->delete();
		StaffzDepartment::create(array('value' => 'Accounts'));
		StaffzDepartment::create(array('value' => 'Gakkai'));
		StaffzDepartment::create(array('value' => 'General Admin'));
		StaffzDepartment::create(array('value' => 'Human Resource'));
		StaffzDepartment::create(array('value' => 'Publication'));
		StaffzDepartment::create(array('value' => 'Sales'));

		DB::table('Staff_z_Position')->delete();
		StaffzPosition::create(array('value' => 'General Director'));
		StaffzPosition::create(array('value' => 'Director'));
		StaffzPosition::create(array('value' => 'Senior Manager'));
		StaffzPosition::create(array('value' => 'Manager'));
		StaffzPosition::create(array('value' => 'Staff'));

		DB::table('Staff_z_Type')->delete();
		StaffzType::create(array('value' => 'Full-Time'));
		StaffzType::create(array('value' => 'Part-Time'));
		StaffzType::create(array('value' => 'Vendor'));

		DB::table('Staff_z_Status')->delete();
		StaffzStatus::create(array('value' => 'Active'));
		StaffzStatus::create(array('value' => 'Resigned'));
		StaffzStatus::create(array('value' => 'Fired'));

		// Common Tables
		DB::table('Common_z_Status')->delete();
		CommonzStatus::create(array('value' => 'Active'));
		CommonzStatus::create(array('value' => 'Closed'));
		CommonzStatus::create(array('value' => 'Void'));

		//Configuration Table
		DB::table('Configuration_m_Company')->delete();
		ConfigurationmCompany::create(array(
			'name' => 'Singapore Soka Association',
			'address' => '10 Tampines Street 81',
			'postalcode' => '529014',
			'country' => 'Singapore',
			'tel' => '67873255',
			'website' => 'www.ssabuddhist.org',
			'uenno' => 'S72SS0009K',
			'gstno' => 'M4-0006007-0',
			'googlemap' => 'http://goo.gl/maps/JVpc6'
		));

		DB::table('Configuration_m_Branch')->delete();
		ConfigurationmBranch::create(array( // GSC
			'code' => 'GSC',
			'name' => 'Geylang Soka Centre',
			'address' => '57 Lorong 18 Geylang',
			'postalcode' => '398827',
			'country' => 'Singapore',
			'tel' => '67443119',
			'googlemap' => 'http://goo.gl/maps/da1L5'
		));
		ConfigurationmBranch::create(array( // SPC
			'code' => 'SPC',
			'name' => 'Soka Peace Centre',
			'address' => '91 Wishart Road',
			'postalcode' => '098728',
			'country' => 'Singapore',
			'tel' => '67873255',
			'googlemap' => 'http://goo.gl/maps/in4vw'
		));
		ConfigurationmBranch::create(array( // SYC
			'code' => 'SYC',
			'name' => 'Soka Youth Centre',
			'address' => '156 Pasir Panjang Road',
			'postalcode' => '118554',
			'country' => 'Singapore',
			'tel' => '64731711',
			'googlemap' => 'http://goo.gl/maps/0tYPj'
		));
		ConfigurationmBranch::create(array( // SSAHQ
			'code' => 'SSAHQ',
			'name' => 'SSA Headquarter',
			'address' => '10 Tampines Street 81',
			'postalcode' => '529014',
			'country' => 'Singapore',
			'tel' => '67873255',
			'googlemap' => 'http://goo.gl/maps/JVpc6'
		));
		ConfigurationmBranch::create(array( // SKC
			'code' => 'SKC',
			'name' => 'Soka Kindergarten',
			'address' => '7 Tampines Street 92',
			'postalcode' => '528888',
			'country' => 'Singapore',
			'tel' => '67844232',
			'googlemap' => 'http://goo.gl/maps/hkB5y'
		));
		ConfigurationmBranch::create(array( // TSC
			'code' => 'TSC',
			'name' => 'Tampines Soka Centre',
			'address' => '5 Tampines Street 92',
			'postalcode' => '528890',
			'country' => 'Singapore',
			'tel' => '67830052',
			'googlemap' => 'http://goo.gl/maps/QIehe'
		));
		ConfigurationmBranch::create(array( // SCC
			'code' => 'SCC',
			'name' => 'Soka Culture Centre',
			'address' => '8 Jurong West Street 76',
			'postalcode' => '648369',
			'country' => 'Singapore',
			'tel' => '67933600',
			'googlemap' => 'http://goo.gl/maps/aZz1g'
		));
		ConfigurationmBranch::create(array( // SSC
			'code' => 'SSC',
			'name' => 'Senja Soka Centre',
			'address' => '11 Senja Road',
			'postalcode' => '677739',
			'country' => 'Singapore',
			'tel' => '67668674',
			'googlemap' => 'http://goo.gl/maps/LoyIH'
		));

		DB::table('Configuration_m_Default')->delete();
		ConfigurationmDefault::create(array( // Main Server (HQ)
			'description' => 'Main Server (HQ)',
			'value' => '1',
			'key' => 'SVHQ'
		));
		ConfigurationmDefault::create(array( // Branch Server
			'description' => 'Branch Server',
			'value' => '0',
			'key' => 'SVBR'
		));
		ConfigurationmDefault::create(array( // Default Branch Code
			'description' => 'Default Branch Code',
			'value' => 'SSAHQ',
			'key' => 'SVBC'
		));
		ConfigurationmDefault::create(array( // Default Software Header
			'description' => 'Default Company Header',
			'value' => 'SSASoft - Office Automation',
			'key' => 'SOFT'
		));

		DB::table('Configuration_m_License')->delete();
		ConfigurationmLicense::create(array(
			'company' => Crypt::encrypt('Singapore Soka Association'),
			'licenseno' => Crypt::encrypt('soka 18112013'),
			'noofusers' => Crypt::encrypt('0'),
			'noofbranches' => Crypt::encrypt('0')
		));

		DB::table('Configuration_m_ResourceGroup')->delete();
		ConfigurationmResourceGroup::create(array( // Access Rights (ACRI)
			'resourcegroup' => 'Access Rights',
			'code' => 'ACRI',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Common Tables (CMTA)
			'resourcegroup' => 'Common Tables',
			'code' => 'CMTA',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Configuration (CNFI)
			'resourcegroup' => 'Configuration',
			'code' => 'CNFI',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Logs (LOGS)
			'resourcegroup' => 'Logs',
			'code' => 'LOGS',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Vehicle (VEHI)
			'resourcegroup' => 'Vehicle',
			'code' => 'VEHI',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Event (EVEN)
			'resourcegroup' => 'Event',
			'code' => 'EVEN',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Attendance (ATTE)
			'resourcegroup' => 'Attendance',
			'code' => 'ATTE',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // SSA Members (SSAM)
			'resourcegroup' => 'SSA Members',
			'code' => 'SSAM',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Groups (GRPS)
			'resourcegroup' => 'Groups',
			'code' => 'GRPS',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));
		ConfigurationmResourceGroup::create(array( // Users (USER)
			'resourcegroup' => 'Users',
			'code' => 'USER',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));

		ConfigurationmResourceGroup::create(array( // Certificate / Gifts / Award (CERT)
			'resourcegroup' => 'Certificate / Gift / Award',
			'code' => 'CERT',
			'enabled' => Crypt::encrypt('1'),
			'applicationversion' => '1.00.0000', // version, minor enhancement, bugs
			'databaseversion' => '1.00.0000'
		));

		// Legend (Admin -> Access Rights & Other Important Stuffs, Record -> Individual Record)
		DB::table('Configuration_m_Resource')->delete();
		ConfigurationmResource::create(array( // Users (Dashboard - US01)
			'resource' => 'Users\Dashboard',
			'code' => 'US01',
			'resourcegroupcode' => 'USER'
		));
		ConfigurationmResource::create(array( // Users (Profile - US02)
			'resource' => 'Users\Profile',
			'code' => 'US02',
			'resourcegroupcode' => 'USER'
		));
		ConfigurationmResource::create(array( // Users (Login - US03)
			'resource' => 'Users\Login',
			'code' => 'US03',
			'resourcegroupcode' => 'USER'
		));
		ConfigurationmResource::create(array( // Users (Logout - US04)
			'resource' => 'Users\Logout',
			'code' => 'US04',
			'resourcegroupcode' => 'USER'
		));

		ConfigurationmResource::create(array( // Access Rights (Admin - AR01)
			'resource' => 'Access Rights\Admin',
			'code' => 'AR01',
			'resourcegroupcode' => 'ACRI'
		));
		ConfigurationmResource::create(array( // Access Rights (Default Table - AR02)
			'resource' => 'Access Rights\Default Tables',
			'code' => 'AR02',
			'resourcegroupcode' => 'ACRI'
		));
		ConfigurationmResource::create(array( // Access Rights (Listing - AR03)
			'resource' => 'Access Rights\Listing',
			'code' => 'AR03',
			'resourcegroupcode' => 'ACRI'
		));
		ConfigurationmResource::create(array( // Access Rights (Record - AR04)
			'resource' => 'Access Rights\Record',
			'code' => 'AR04',
			'resourcegroupcode' => 'ACRI'
		));
		ConfigurationmResource::create(array( // Access Rights (Report - AR04)
			'resource' => 'Access Rights\Report',
			'code' => 'AR05',
			'resourcegroupcode' => 'ACRI'
		));

		ConfigurationmResource::create(array( // Common Tables (Default Table - CT01)
			'resource' => 'Common Tables\Default Tables',
			'code' => 'CT01',
			'resourcegroupcode' => 'CMTA'
		));

		ConfigurationmResource::create(array( // Common Tables (Default Table - CT02)
			'resource' => 'Common Tables\Record',
			'code' => 'CT02',
			'resourcegroupcode' => 'CMTA'
		));

		ConfigurationmResource::create(array( // Configuration (Admin - CO01)
			'resource' => 'Configuration\Admin',
			'code' => 'CO01',
			'resourcegroupcode' => 'CNFI'
		));

		ConfigurationmResource::create(array( // Logs (Logs - LO01)
			'resource' => 'Logs\Default Tables',
			'code' => 'LO01',
			'resourcegroupcode' => 'LOGS'
		));
		ConfigurationmResource::create(array( // Logs (Listing - LO02)
			'resource' => 'Logs\Listing',
			'code' => 'LO02',
			'resourcegroupcode' => 'LOGS'
		));
		ConfigurationmResource::create(array( // Logs (Report - LO03)
			'resource' => 'Logs\Report',
			'code' => 'LO03',
			'resourcegroupcode' => 'LOGS'
		));

		ConfigurationmResource::create(array( // Vehicle (Admin - VE01)
			'resource' => 'Vehicle\Admin',
			'code' => 'VE01',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Default Table - VE02)
			'resource' => 'Vehicle\Default Tables',
			'code' => 'VE02',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Listing - VE03)
			'resource' => 'Vehicle\Listing',
			'code' => 'VE03',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Record - VE04)
			'resource' => 'Vehicle\Record',
			'code' => 'VE04',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Booking Listing - VE05)
			'resource' => 'Vehicle\Booking Listing',
			'code' => 'VE05',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Booking Record - VE06)
			'resource' => 'Vehicle\Booking Record',
			'code' => 'VE06',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Cashcard - VE07)
			'resource' => 'Vehicle\Cashcard',
			'code' => 'VE07',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Maintenance - VE08)
			'resource' => 'Vehicle\Maintenance',
			'code' => 'VE08',
			'resourcegroupcode' => 'VEHI'
		));
		ConfigurationmResource::create(array( // Vehicle (Report - VE09)
			'resource' => 'Vehicle\Report',
			'code' => 'VE09',
			'resourcegroupcode' => 'VEHI'
		));

		ConfigurationmResource::create(array( // Event (Admin - EV01)
			'resource' => 'Event\Admin',
			'code' => 'EV01',
			'resourcegroupcode' => 'EVEN'
		));
		ConfigurationmResource::create(array( // Event (Default Table - EV02)
			'resource' => 'Event\Default Table',
			'code' => 'EV02',
			'resourcegroupcode' => 'EVEN'
		));
		ConfigurationmResource::create(array( // Event (Listing - EV03)
			'resource' => 'Event\Listing',
			'code' => 'EV03',
			'resourcegroupcode' => 'EVEN'
		));
		ConfigurationmResource::create(array( // Event (Record - EV04)
			'resource' => 'Event\Record',
			'code' => 'EV04',
			'resourcegroupcode' => 'EVEN'
		));
		ConfigurationmResource::create(array( // Event (Report - EV05)
			'resource' => 'Event\Report',
			'code' => 'EV05',
			'resourcegroupcode' => 'EVEN'
		));
		ConfigurationmResource::create(array( // Event (Registration - EV06)
			'resource' => 'Event\Registration',
			'code' => 'EV06',
			'resourcegroupcode' => 'EVEN'
		));

		ConfigurationmResource::create(array( // Attendance (Admin - AT01)
			'resource' => 'Attendance\Admin',
			'code' => 'AT01',
			'resourcegroupcode' => 'ATTE'
		));
		ConfigurationmResource::create(array( // Attendance (Default Table - AT02)
			'resource' => 'Attendance\Default Table',
			'code' => 'AT02',
			'resourcegroupcode' => 'ATTE'
		));
		ConfigurationmResource::create(array( // Attendance (Attendance - AT03)
			'resource' => 'Attendance\Listing',
			'code' => 'AT03',
			'resourcegroupcode' => 'ATTE'
		));
		ConfigurationmResource::create(array( // Attendance (Record - AT04)
			'resource' => 'Attendance\Record',
			'code' => 'AT04',
			'resourcegroupcode' => 'ATTE'
		));
		ConfigurationmResource::create(array( // Attendance (Report - AT05)
			'resource' => 'Attendance\Report',
			'code' => 'AT05',
			'resourcegroupcode' => 'ATTE'
		));
		
		ConfigurationmResource::create(array( // Members (Admin - ME01)
			'resource' => 'Members\Admin',
			'code' => 'ME01',
			'resourcegroupcode' => 'SSAM'
		));
		ConfigurationmResource::create(array( // Members (Default Table - ME02)
			'resource' => 'Members\Default Table',
			'code' => 'ME02',
			'resourcegroupcode' => 'SSAM'
		));
		ConfigurationmResource::create(array( // Members (Listing - ME03)
			'resource' => 'Members\Listing',
			'code' => 'ME03',
			'resourcegroupcode' => 'SSAM'
		));
		ConfigurationmResource::create(array( // Members (Record - ME04)
			'resource' => 'Members\Record',
			'code' => 'ME04',
			'resourcegroupcode' => 'SSAM'
		));
		ConfigurationmResource::create(array( // Members (Report - ME05)
			'resource' => 'Members\Report',
			'code' => 'ME05',
			'resourcegroupcode' => 'SSAM'
		));
		ConfigurationmResource::create(array( // Members (Request - ME06)
			'resource' => 'Members\Request',
			'code' => 'ME06',
			'resourcegroupcode' => 'SSAM'
		));

		ConfigurationmResource::create(array( // Groups (Admin - GP01)
			'resource' => 'Groups\Admin',
			'code' => 'GP01',
			'resourcegroupcode' => 'GRPS'
		));
		ConfigurationmResource::create(array( // Groups (Default Table - GP02)
			'resource' => 'Groups\Default Table',
			'code' => 'GP02',
			'resourcegroupcode' => 'GRPS'
		));
		ConfigurationmResource::create(array( // Groups (Listing - GP03)
			'resource' => 'Groups\Listing',
			'code' => 'GP03',
			'resourcegroupcode' => 'GRPS'
		));
		ConfigurationmResource::create(array( // Groups (Record - GP04)
			'resource' => 'Groups\Record',
			'code' => 'GP04',
			'resourcegroupcode' => 'GRPS'
		));
		ConfigurationmResource::create(array( // Groups (Report - GP05)
			'resource' => 'Groups\Report',
			'code' => 'GP05',
			'resourcegroupcode' => 'GRPS'
		));

		ConfigurationmResource::create(array( // Certificate / Gift / Award (Admin - CE01)
			'resource' => 'Certificate\Admin',
			'code' => 'CE01',
			'resourcegroupcode' => 'CERT'
		));
		ConfigurationmResource::create(array( // Certificate / Gift / Award (Default Table - CE02)
			'resource' => 'Certificate\Default Table',
			'code' => 'CE02',
			'resourcegroupcode' => 'CERT'
		));
		ConfigurationmResource::create(array( // Certificate / Gift / Award (Listing - CE03)
			'resource' => 'Certificate\Listing',
			'code' => 'CE03',
			'resourcegroupcode' => 'CERT'
		));
		ConfigurationmResource::create(array( // Certificate / Gift / Award (Record - CE04)
			'resource' => 'Certificate\Record',
			'code' => 'CE04',
			'resourcegroupcode' => 'CERT'
		));
		ConfigurationmResource::create(array( // Certificate / Gift / Award (Report - CE05)
			'resource' => 'Certificate\Report',
			'code' => 'CE05',
			'resourcegroupcode' => 'CERT'
		));

		DB::table('Logs_z_LogType')->delete();
		LogszLogType::create(array('value' => 'Login'));
		LogszLogType::create(array('value' => 'Logout'));
		LogszLogType::create(array('value' => 'Create'));
		LogszLogType::create(array('value' => 'Read'));
		LogszLogType::create(array('value' => 'Update'));
		LogszLogType::create(array('value' => 'Delete'));
		LogszLogType::create(array('value' => 'Void'));
		LogszLogType::create(array('value' => 'Unvoid'));
		LogszLogType::create(array('value' => 'Print'));
		LogszLogType::create(array('value' => 'Error'));
		LogszLogType::create(array('value' => 'Unknown'));

		DB::table('Logs_z_Status')->delete();
		LogszStatus::create(array('value' => 'Success'));
		LogszStatus::create(array('value' => 'Failed'));

		DB::table('Vehicle_z_MaintenanceType')->delete();
		VehiclezMaintenanceType::create(array('value' => 'Servicing'));
		VehiclezMaintenanceType::create(array('value' => 'Fill-up Petrol'));
		VehiclezMaintenanceType::create(array('value' => 'Others'));

		DB::table('Vehicle_m_Vehicle')->delete();
        VehiclemVehicle::create(array('vehicleno' => 'SGK7939E', 'status' => 'Active'));
		VehiclemVehicle::create(array('vehicleno' => 'SFY9830J', 'status' => 'Active'));
		VehiclemVehicle::create(array('vehicleno' => 'GBB4915A', 'status' => 'Active'));

		DB::table('Vehicle_z_BookingStatus')->delete();
		VehiclezBookingStatus::create(array('value' => 'Processing'));
		VehiclezBookingStatus::create(array('value' => 'Approved'));
		VehiclezBookingStatus::create(array('value' => 'Rejected'));

		DB::table('Event_z_EventType')->delete();
		EventzEventType::create(array('value' => 'Culture'));
		EventzEventType::create(array('value' => 'Meeting'));
		EventzEventType::create(array('value' => 'Study'));

		DB::table('Event_z_Language')->delete();
		EventzLanguage::create(array('value' => 'English'));
		EventzLanguage::create(array('value' => 'Chinese'));

		DB::table('Event_z_RegistrationStatus')->delete();
		EventzRegistrationStatus::create(array('value' => 'Processing'));
		EventzRegistrationStatus::create(array('value' => 'Accepted'));
		EventzRegistrationStatus::create(array('value' => 'Rejected'));
		EventzRegistrationStatus::create(array('value' => 'Reserved'));
		EventzRegistrationStatus::create(array('value' => 'Pending'));
		EventzRegistrationStatus::create(array('value' => 'Withdrawn'));

		DB::table('Event_z_Role')->delete();
		EventzRole::create(array('value' => 'Performer', 'abbv' => 'PFR')); // For Culture Performance
		EventzRole::create(array('value' => 'Trainer', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Chief Trainer', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Assistant Chief Trainer', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Cheorographer', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Assistant Cheorographer', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Display IC', 'abbv' => 'DISP'));
		EventzRole::create(array('value' => 'Admin', 'abbv' => 'ADM'));
		EventzRole::create(array('value' => 'Admin IC', 'abbv' => 'ADM'));
		EventzRole::create(array('value' => 'Staff Support', 'abbv' => 'ADM'));
		EventzRole::create(array('value' => 'Logistic', 'abbv' => 'LOG'));
		EventzRole::create(array('value' => 'Logistics IC', 'abbv' => 'LOG'));
		EventzRole::create(array('value' => 'Chairperson', 'abbv' => 'CCM'));
		EventzRole::create(array('value' => 'Assistant Chairperson', 'abbv' => 'CCM'));
		EventzRole::create(array('value' => 'Security'));
		EventzRole::create(array('value' => 'Security IC'));
		EventzRole::create(array('value' => 'Medical', 'abbv' => 'MED'));
		EventzRole::create(array('value' => 'Medical IC', 'abbv' => 'MED'));
		EventzRole::create(array('value' => 'Hospitality', 'abbv' => 'HOS'));
		EventzRole::create(array('value' => 'Hospitality IC', 'abbv' => 'HOS'));
		EventzRole::create(array('value' => 'Others'));
		EventzRole::create(array('value' => 'Participant')); // For Event Participantation other than Culture

		DB::table('Attendance_z_Type')->delete();
		AttendancezType::create(array('value' => 'Actual', 'description' => 'Attendance for Actual Day'));
		AttendancezType::create(array('value' => 'Training', 'description' => 'Attendance for Training Day like NDP or Chingay towards the Actual Day'));

		DB::table('Attendance_z_Status')->delete();
		AttendancezStatus::create(array('value' => 'Active'));
		AttendancezStatus::create(array('value' => 'Closed'));
		AttendancezStatus::create(array('value' => 'Void'));

		DB::table('Members_z_Status')->delete();
		MemberszStatus::create(array('value' => 'Processing'));
		MemberszStatus::create(array('value' => 'Completed'));
		MemberszStatus::create(array('value' => 'Rejected'));
		MemberszStatus::create(array('value' => 'Void'));

		DB::table('Members_z_OrgChart')->delete();
		MemberszOrgChart::create(array('rhq' => '-', 'rhqabbv' => '-', 'zone' => '-', 'zoneabbv' => '-', 'chapter' => '-', 'chapabbv' => '-'));
		MemberszOrgChart::create(array('zone' => 'Unknown', 'zoneabbv' => 'UNK', 'chapter' => 'Unknown', 'chapabbv' => 'UNK'));
		// RHQ 1
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Bedok', 'zoneabbv' => 'BDK', 'chapter' => 'Bedok Central', 'chapabbv' => 'BC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Bedok', 'zoneabbv' => 'BDK', 'chapter' => 'Bedok East', 'chapabbv' => 'BE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Bedok', 'zoneabbv' => 'BDK', 'chapter' => 'Bedok Rise', 'chapabbv' => 'BRS', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Bedok', 'zoneabbv' => 'BDK', 'chapter' => 'Bedok Vista', 'chapabbv' => 'BDV', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Bedok', 'zoneabbv' => 'BDK', 'chapter' => 'Bedok West', 'chapabbv' => 'BW', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'East Coast', 'zoneabbv' => 'ECT', 'chapter' => 'Bedok South', 'chapabbv' => 'BS', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'East Coast', 'zoneabbv' => 'ECT', 'chapter' => 'Katong', 'chapabbv' => 'KAT', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'East Coast', 'zoneabbv' => 'ECT', 'chapter' => 'Marine Parade', 'chapabbv' => 'MP', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'East Coast', 'zoneabbv' => 'ECT', 'chapter' => 'Siglap', 'chapabbv' => 'SIG', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tampines', 'zoneabbv' => 'TAM', 'chapter' => 'Pasir Ris', 'chapabbv' => 'PR', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tampines', 'zoneabbv' => 'TAM', 'chapter' => 'Tampines Central', 'chapabbv' => 'TPC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tampines', 'zoneabbv' => 'TAM', 'chapter' => 'Tampines East', 'chapabbv' => 'TPE', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tampines', 'zoneabbv' => 'TAM', 'chapter' => 'Tampines North', 'chapabbv' => 'TPN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tampines', 'zoneabbv' => 'TAM', 'chapter' => 'Tampines West', 'chapabbv' => 'TPW', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tanah Merah', 'zoneabbv' => 'TNM', 'chapter' => 'Tanah Merah Central', 'chapabbv' => 'TMC', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tanah Merah', 'zoneabbv' => 'TNM', 'chapter' => 'Tanah Merah East', 'chapabbv' => 'TME', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ1', 'rhqabbv' => 'H1', 'zone' => 'Tanah Merah', 'zoneabbv' => 'TNM', 'chapter' => 'Tanah Merah Garden', 'chapabbv' => 'TMG', 'district' => 4));
		// RHQ 2
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Ang Mo Kio', 'zoneabbv' => 'AMK', 'chapter' => 'Ang Mo Kio Central', 'chapabbv' => 'AMC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Ang Mo Kio', 'zoneabbv' => 'AMK', 'chapter' => 'Ang Mo Kio East', 'chapabbv' => 'AME', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Ang Mo Kio', 'zoneabbv' => 'AMK', 'chapter' => 'Ang Mo Kio North', 'chapabbv' => 'AMN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Ang Mo Kio', 'zoneabbv' => 'AMK', 'chapter' => 'Ang Mo Kio South', 'chapabbv' => 'AMS', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Ang Mo Kio', 'zoneabbv' => 'AMK', 'chapter' => 'Ang Mo Kio West', 'chapabbv' => 'AMW', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Cheng San', 'zoneabbv' => 'CS', 'chapter' => 'Cheng San East', 'chapabbv' => 'CSE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Cheng San', 'zoneabbv' => 'CS', 'chapter' => 'Cheng San North', 'chapabbv' => 'CSN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Cheng San', 'zoneabbv' => 'CS', 'chapter' => 'Khatib', 'chapabbv' => 'KTB', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Cheng San', 'zoneabbv' => 'CS', 'chapter' => 'Kuo Chuan', 'chapabbv' => 'KC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Cheng San', 'zoneabbv' => 'CS', 'chapter' => 'Yio Chu Kang', 'chapabbv' => 'YCK', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Hougang', 'zoneabbv' => 'HG', 'chapter' => 'Hougang Central', 'chapabbv' => 'HGC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Hougang', 'zoneabbv' => 'HG', 'chapter' => 'Hougang South', 'chapabbv' => 'HGS', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Hougang', 'zoneabbv' => 'HG', 'chapter' => 'Kovan', 'chapabbv' => 'KOV', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Hougang', 'zoneabbv' => 'HG', 'chapter' => 'Teck Ghee', 'chapabbv' => 'TG', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Sengkang', 'zoneabbv' => 'SK', 'chapter' => 'Sengkang Central', 'chapabbv' => 'SKC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Sengkang', 'zoneabbv' => 'SK', 'chapter' => 'Sengkang East', 'chapabbv' => 'SKE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ2', 'rhqabbv' => 'H2', 'zone' => 'Sengkang', 'zoneabbv' => 'SK', 'chapter' => 'Sengkang South', 'chapabbv' => 'SKS', 'district' => 3));
		// RHQ 3
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Bugis', 'zoneabbv' => 'BG', 'chapter' => 'Farrer', 'chapabbv' => 'FRR', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Bugis', 'zoneabbv' => 'BG', 'chapter' => 'Norfolk', 'chapabbv' => 'NOR', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Bugis', 'zoneabbv' => 'BG', 'chapter' => 'Victoria', 'chapabbv' => 'VIC', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'City', 'zoneabbv' => 'CIT', 'chapter' => 'Havelock', 'chapabbv' => 'HVL', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'City', 'zoneabbv' => 'CIT', 'chapter' => 'New Bridge', 'chapabbv' => 'NB', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'City', 'zoneabbv' => 'CIT', 'chapter' => 'Outram', 'chapabbv' => 'OT', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Clementi', 'zoneabbv' => 'CLM', 'chapter' => 'Buona Vista', 'chapabbv' => 'BV', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Clementi', 'zoneabbv' => 'CLM', 'chapter' => 'Clementi Woods', 'chapabbv' => 'CW', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Clementi', 'zoneabbv' => 'CLM', 'chapter' => 'Kent Ridge', 'chapabbv' => 'KR', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Clementi', 'zoneabbv' => 'CLM', 'chapter' => 'Nan Hua', 'chapabbv' => 'NH', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Delta', 'zoneabbv' => 'DT', 'chapter' => 'Bukit Purmei', 'chapabbv' => 'BPM', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Delta', 'zoneabbv' => 'DT', 'chapter' => 'Tiong Bahru', 'chapabbv' => 'TB', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Delta', 'zoneabbv' => 'DT', 'chapter' => 'Telok Blangah', 'chapabbv' => 'TLB', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Lavender', 'zoneabbv' => 'LAV', 'chapter' => 'Cambridge', 'chapabbv' => 'CAM', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Lavender', 'zoneabbv' => 'LAV', 'chapter' => 'Newton', 'chapabbv' => 'NT', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Lavender', 'zoneabbv' => 'LAV', 'chapter' => 'Owen', 'chapabbv' => 'OW', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Queenstown', 'zoneabbv' => 'QST', 'chapter' => 'Alexandra', 'chapabbv' => 'ALX', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Queenstown', 'zoneabbv' => 'QST', 'chapter' => 'Bukit Merah ', 'chapabbv' => 'BM', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ3', 'rhqabbv' => 'H3', 'zone' => 'Queenstown', 'zoneabbv' => 'QST', 'chapter' => 'Henderson', 'chapabbv' => 'HDS', 'district' => 4));
		// RHQ 4
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Chinese Garden', 'zoneabbv' => 'CGD', 'chapter' => 'Jurong East', 'chapabbv' => 'JE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Chinese Garden', 'zoneabbv' => 'CGD', 'chapter' => 'Pandan', 'chapabbv' => 'PAN', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Chinese Garden', 'zoneabbv' => 'CGD', 'chapter' => 'Yu Hua', 'chapabbv' => 'YH', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Hong Kah', 'zoneabbv' => 'HK', 'chapter' => 'Hong Kah Central', 'chapabbv' => 'HKC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Hong Kah', 'zoneabbv' => 'HK', 'chapter' => 'Lakeside', 'chapabbv' => 'LS', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Hong Kah', 'zoneabbv' => 'HK', 'chapter' => 'Nanyang', 'chapabbv' => 'NY', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Jurong', 'zoneabbv' => 'JUR', 'chapter' => 'Boon Lay', 'chapabbv' => 'BL', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Jurong', 'zoneabbv' => 'JUR', 'chapter' => 'Jurong Central', 'chapabbv' => 'JC', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'Jurong', 'zoneabbv' => 'JUR', 'chapter' => 'Toh Guan', 'chapabbv' => 'TGN', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'West Coast', 'zoneabbv' => 'WCT', 'chapter' => 'Commonwealth', 'chapabbv' => 'CWH', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'West Coast', 'zoneabbv' => 'WCT', 'chapter' => 'Holland', 'chapabbv' => 'HOL', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ4', 'rhqabbv' => 'H4', 'zone' => 'West Coast', 'zoneabbv' => 'WCT', 'chapter' => 'Pasir Panjang', 'chapabbv' => 'PP', 'district' => 5));
		// RHQ 5
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Bishan', 'zoneabbv' => 'BIS', 'chapter' => 'Bishan Central', 'chapabbv' => 'BSC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Bishan', 'zoneabbv' => 'BIS', 'chapter' => 'Bishan East', 'chapabbv' => 'BSE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Bishan', 'zoneabbv' => 'BIS', 'chapter' => 'Bishan North', 'chapabbv' => 'BSN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Bishan', 'zoneabbv' => 'BIS', 'chapter' => 'Bishan South', 'chapabbv' => 'BSS', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Bishan', 'zoneabbv' => 'BIS', 'chapter' => 'Bishan West', 'chapabbv' => 'BSW', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Thomson', 'zoneabbv' => 'THM', 'chapter' => 'Braddell', 'chapabbv' => 'BDL', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Thomson', 'zoneabbv' => 'THM', 'chapter' => 'Crawford', 'chapabbv' => 'CF', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Thomson', 'zoneabbv' => 'THM', 'chapter' => 'Goldhill', 'chapabbv' => 'GHL', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Thomson', 'zoneabbv' => 'THM', 'chapter' => 'Rochor', 'chapabbv' => 'ROC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Toa Payoh', 'zoneabbv' => 'TPY', 'chapter' => 'Toa Payoh East', 'chapabbv' => 'TYE', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Toa Payoh', 'zoneabbv' => 'TPY', 'chapter' => 'Toa Payoh North', 'chapabbv' => 'TYN', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Toa Payoh', 'zoneabbv' => 'TPY', 'chapter' => 'Toa Payoh South', 'chapabbv' => 'TYS', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Toa Payoh', 'zoneabbv' => 'TPY', 'chapter' => 'Toa Payoh West', 'chapabbv' => 'TYW', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Whampoa', 'zoneabbv' => 'WHM', 'chapter' => 'Serangoon North', 'chapabbv' => 'SRN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Whampoa', 'zoneabbv' => 'WHM', 'chapter' => 'Serangoon South', 'chapabbv' => 'SRS', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Whampoa', 'zoneabbv' => 'WHM', 'chapter' => 'Whampoa East', 'chapabbv' => 'WPE', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ5', 'rhqabbv' => 'H5', 'zone' => 'Whampoa', 'zoneabbv' => 'WHM', 'chapter' => 'Whampoa West', 'chapabbv' => 'WPW', 'district' => 5));
		// RHQ 6
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Aljunied', 'zoneabbv' => 'AJ', 'chapter' => 'Aljunied East', 'chapabbv' => 'AJE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Aljunied', 'zoneabbv' => 'AJ', 'chapter' => 'Aljunied North', 'chapabbv' => 'AJN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Aljunied', 'zoneabbv' => 'AJ', 'chapter' => 'Aljunied South', 'chapabbv' => 'AJS', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Aljunied', 'zoneabbv' => 'AJ', 'chapter' => 'Aljunied West', 'chapabbv' => 'AJW', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Eunos', 'zoneabbv' => 'EUN', 'chapter' => 'Eunos Central', 'chapabbv' => 'ENC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Eunos', 'zoneabbv' => 'EUN', 'chapter' => 'Eunos East', 'chapabbv' => 'ENE', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Eunos', 'zoneabbv' => 'EUN', 'chapter' => 'Eunos South', 'chapabbv' => 'ENS', 'district' => 3));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Eunos', 'zoneabbv' => 'EUN', 'chapter' => 'Eunos West', 'chapabbv' => 'ENW', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Geylang', 'zoneabbv' => 'GEY', 'chapter' => 'Geylang Central', 'chapabbv' => 'GYC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Geylang', 'zoneabbv' => 'GEY', 'chapter' => 'Geylang North', 'chapabbv' => 'GYN', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Geylang', 'zoneabbv' => 'GEY', 'chapter' => 'Geylang South', 'chapabbv' => 'GYS', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Geylang', 'zoneabbv' => 'GEY', 'chapter' => 'Geylang West', 'chapabbv' => 'GYW', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Geylang', 'zoneabbv' => 'GEY', 'chapter' => 'Macpherson', 'chapabbv' => 'MAC', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Paya Lebar', 'zoneabbv' => 'PL', 'chapter' => 'Paya Lebar East', 'chapabbv' => 'PLE', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Paya Lebar', 'zoneabbv' => 'PL', 'chapter' => 'Paya Lebar North', 'chapabbv' => 'PLN', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Paya Lebar', 'zoneabbv' => 'PL', 'chapter' => 'Paya Lebar South', 'chapabbv' => 'PLS', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ6', 'rhqabbv' => 'H6', 'zone' => 'Paya Lebar', 'zoneabbv' => 'PL', 'chapter' => 'Paya Lebar West', 'chapabbv' => 'PLW', 'district' => 5));
		// RHQ 7
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Bukit Panjang', 'zoneabbv' => 'BP', 'chapter' => 'Marsiling', 'chapabbv' => 'MLG', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Bukit Panjang', 'zoneabbv' => 'BP', 'chapter' => 'Woodlands', 'chapabbv' => 'WDS', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Bukit Panjang', 'zoneabbv' => 'BP', 'chapter' => 'Zheng Hua', 'chapabbv' => 'ZH', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Choa Chu Kang', 'zoneabbv' => 'CCK', 'chapter' => 'Bukit Batok', 'chapabbv' => 'BB', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Choa Chu Kang', 'zoneabbv' => 'CCK', 'chapter' => 'Teck Whye', 'chapabbv' => 'TW', 'district' => 6));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Choa Chu Kang', 'zoneabbv' => 'CCK', 'chapter' => 'Yew Tee', 'chapabbv' => 'YT', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Sembawang', 'zoneabbv' => 'SBW', 'chapter' => 'Admiralty', 'chapabbv' => 'AMT', 'district' => 7));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Sembawang', 'zoneabbv' => 'SBW', 'chapter' => 'Chong Pang', 'chapabbv' => 'CP', 'district' => 4));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Sembawang', 'zoneabbv' => 'SBW', 'chapter' => 'Lentor', 'chapabbv' => 'LT', 'district' => 5));
		MemberszOrgChart::create(array('rhq' => 'RHQ7', 'rhqabbv' => 'H7', 'zone' => 'Sembawang', 'zoneabbv' => 'SBW', 'chapter' => 'Yishun', 'chapabbv' => 'YIS', 'district' => 4));

		DB::table('Group_z_Status')->delete();
		GroupzStatus::create(array('value' => 'Active'));
		GroupzStatus::create(array('value' => 'Creased'));

		DB::table('Group_z_GroupType')->delete();
		GroupzGroupType::create(array('value' => 'Culture'));
		GroupzGroupType::create(array('value' => 'Function'));
		GroupzGroupType::create(array('value' => 'Special'));

		DB::table('Group_z_MemberStatus')->delete();
		GroupzMemberStatus::create(array('value' => 'Active'));
		GroupzMemberStatus::create(array('value' => 'Inactive'));
		GroupzMemberStatus::create(array('value' => 'Graduated'));
		GroupzMemberStatus::create(array('value' => 'Withdrawn'));
		GroupzMemberStatus::create(array('value' => 'Alumni'));
    }
}