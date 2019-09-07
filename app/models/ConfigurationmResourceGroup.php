<?php

class ConfigurationmResourceGroup extends Eloquent {
	
	protected $table = 'Configuration_m_ResourceGroup';

	public function ConfigResourceGroup()
	{
		return $this->hasMany('ConfigurationmResource');
	}

	public static function getRGCheck($value)
	{
		try
		{	// Step 1: Check enabled
			$RGCheck = Crypt::decrypt(DB::table('Configuration_m_ResourceGroup')->where('code', $value)->pluck('enabled'));
			if ($RGCheck == 1)
			{ // Check if any sub menu exists
				$usercount = AccessmAccessRights::where('resourcegroup', '=', $value)->where('userid', '=', Auth::user()->id) ->count();
				if ($usercount > 0)
				{
					return true;
				}
				else { return false; }
			}
			else 
			{	// Step 2: Check for Trial Access
				$Trial = Crypt::decrypt(DB::table('Configuration_m_ResourceGroup')->where('code', $value)->pluck('trial'));
				if ($Trial == null) { return false; }
				else
				{
					// Check for Trial Date
					$tStartDate = Crypt::decrypt(DB::table('Configuration_m_ResourceGroup')->where('code', $value)->pluck('trialstartdate'));
					$tEndDate = Crypt::decrypt(DB::table('Configuration_m_ResourceGroup')->where('code', $value)->pluck('trialenddate'));
					// Not Complete.. Need to carry on due to encrypt
				}
				// Check for Trial Date
				return false; 
			} 
		}
		catch(\Exception $e)
		{
			return false; 
		}
	}
}