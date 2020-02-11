<?php

class ConfigurationmBranch extends Eloquent {
	
	protected $table = 'Configuration_m_Branch';

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid))
        {
            return $query;
        }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid))
        {
            return $query->whereNotIn('id', array(1));
        }
        else
        {
            return $query->whereNotIn('id', array(1, 2));
        }    
    }
}
