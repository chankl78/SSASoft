<?php

class ConfigurationmResource extends Eloquent {
	
	protected $table = 'Configuration_m_Resource';

	public function ConfigResource()
	{
		return $this->belongsTo('ConfigurationmResourceGroup');
	}

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid))
        {
            return $query;
        }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid))
        {
            return $query;
        }
        else
        {
            return $query;
        }    
    }

    public static function getResourceGroupCode($value)
    {
        $value2 = DB::table('Configuration_m_Resource')->where('code', $value)->pluck('resourcegroupcode');
        return $value2;
    }

    public static function getResourceID($value)
    {
        $value1 = DB::table('Configuration_m_Resource')->where('code', $value)->pluck('id');
        return $value1;
    }
}
