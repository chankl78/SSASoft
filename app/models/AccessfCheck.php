<?php

class AccessfCheck extends Eloquent {

	public static function getSystemAdmin($value, $value2)
	{
		if ($value == 'System Administrator'){ return 't'; } else { return 'f'; } 
	}

	public static function getSoftwareAdmin($value, $value2)
	{
		// Step 1: Check Role
		if ($value == 'System Administrator' || $value == 'Software Administrator') { return 't'; } else { return 'f'; } 
	}

	public static function getAccessAdmin($value, $value2, $value3)
	{
		if ($value == 'System Administrator' or $value == 'Software Administrator') { return 't'; }
		elseif ($value == 'Resource Administrator')
		{ 
			if(AccessmAccessRights::getResourceAdministratorAccessRights($value2, Auth::user()->id) == true) { return 't'; }
			else { return 'f'; }
		}
		elseif (ConfigurationmResourceGroup::getRGCheck($value2) == true) { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceAccess($value, $value2, $value3, $value4)
	{
		if ($value == 'System Administrator' or $value == 'Software Administrator')  { return 't'; }
		elseif ($value == 'Resource Administrator')
		{
			$rgc = ConfigurationmResource::getResourceGroupCode($value2);
			if(AccessmAccessRights::getResourceAdministratorAccessRights($rgc, $value4) == true) { return 't'; }
			else { return 'f'; }
		}
		elseif (AccessmAccessRights::getResourceAccessRights($value2, $value4) == true) { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceCRUDAccess($value, $value2, $value3)
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator')  { return 't'; }
		elseif (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User')  { return 't'; }
		elseif (Auth::user()->roleid == 'Resource Administrator')
		{
			$rgc = ConfigurationmResource::getResourceGroupCode($value2);
			if(AccessmAccessRights::getResourceAdministratorAccessRights($rgc, Auth::user()->id) == true) { return 't'; }
			else { return 'f'; }
		}
		else 
		{
			if (AccessmAccessRights::getResourceCRUDAccessRights($value2, $value3, Auth::user()->id) == true) { return 't'; }
			else { return 'f'; }
		}
	}

	public static function getResourceAdministratorReport()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator' or Auth::user()->roleid == 'Event Administrator')  { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceEventRoleReport()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator' or Auth::user()->roleid == 'Event Administrator')  { return 't'; }
		else if  (Auth::user()->roleid == 'Single Event Administrator' or Auth::user()->roleid == 'Single Event User' or Auth::user()->roleid == 'Gakkai Administrator') { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceGakkaiRole()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator' or Auth::user()->roleid == 'Event Administrator')  { return 't'; }
		else if  (Auth::user()->roleid == 'Gakkai Administrator' or Auth::user()->roleid == 'Gakkai User') { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceEventItemRoleReport()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator')  { return 't'; }
		else if  (Auth::user()->roleid == 'Single Event Item User') { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceGroupRoleReport()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator')  { return 't'; }
		else if  (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User' or Auth::user()->roleid == 'Gakkai Administrator') { return 't'; }
		else { return 'f'; }
	}

	public static function getResourceRoleTrainer()
	{
		if (Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'Resource Administrator')  { return 't'; }
		else if  (Auth::user()->roleid == 'Event Administrator' or Auth::user()->roleid == 'Gakkai Administrator') { return 't'; }
		else { return 'f'; }
	}

	public static function getSHQUser()
	{
		if (Session::get('gakkaiuserpositionlevel') == 'shq')  
		{ return 't'; } else { return 'f'; }
	}

	public static function getRegionUser()
	{
		if (Session::get('gakkaiuserpositionlevel') == 'rhq')  
		{ return 't'; } else { return 'f'; }
	}

	public static function getZoneUser()
	{
		if (Session::get('gakkaiuserpositionlevel') == 'zone')  
		{ return 't'; } else { return 'f'; }
	}

	public static function getChapterUser()
	{
		if (Session::get('gakkaiuserpositionlevel') == 'chapter')  
		{ return 't'; } else { return 'f'; }
	}

	public static function getDistrictUser()
	{
		if (Session::get('gakkaiuserpositionlevel') == 'district')  
		{ return 't'; } else { return 'f'; }
	}

	public static function getCheckSYS($value)
	{
		if ($value == 'System Administrator'){ return true; } else { return false; } 
	}

	public static function getCheckSOF($value)
	{
		if ($value == 'Software Administrator') { return true; } else { return false; } 
	}

	public static function getCheckEventAccess($value)
	{
		// Step 1: Check Role
		if (Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Event Administrator' or Auth::user()->roleid == 'Gakkai Administrator') { return true; } 
		else if (Auth::user()->roleid == 'Single Event Administrator' or Auth::user()->roleid == 'Single Event User')
		{
			if (DB::table('Access_m_AccessRights')->where('eventid', $value)->where('userid', Auth::user()->id)->count() >= 1)
			{
				return true;
			}
			else { return false; }
		}
		else if (Auth::user()->roleid == 'Single Event Item User' or Auth::user()->roleid == 'Event Trainer' or Auth::user()->roleid == 'Event Chief Trainer')
		{
			if (DB::table('Access_m_AccessRights')->where('eventid', $value)->where('userid', Auth::user()->id)->count() >= 1)
			{
				return true;
			}
			else { return false; }
		}
		else if (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User')
		{
			if (DB::table('Event_m_Group')->where('eventid', $value)->count() >= 1)
			{
				return true;
			}
			else { return false; }
		}
		else {	return false; } 
	}

	public static function getCheckAttendanceAccess($value)
	{
		// Step 1: Check Role
		if (Auth::user()->roleid == 'Software Administrator' or Auth::user()->roleid == 'System Administrator' or Auth::user()->roleid == 'Event Administrator' or Auth::user()->roleid == 'Gakkai Administrator') { return true; } 
		else 
		{
			if (AccessfCheck::getResourceCRUDAccess(Auth::user()->id, 'AT04', 'read') == true)
			{
				if (Auth::user()->roleid == 'Event Trainer')
				{
					$value1 = DB::table('Attendance_m_Attendance')->where('id', $value)->pluck('eventid');
					try
					{
						if (DB::table('Access_m_AccessRights')->where('eventid', $value1)->where('code', 'AT04')->where('userid', Auth::user()->id)->where('deleted_at', NULL)->count() >= 1)
						{
							return true;
						}
						else { return false; };
					}
					catch(\Exception $e) 
					{
						return false;
					}
				}
				else { return false; }
				
			}
			else { return false; }
		} 
	}
}
