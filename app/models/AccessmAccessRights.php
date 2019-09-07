<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AccessmAccessRights extends Eloquent {

	protected $table = 'Access_m_AccessRights';
	use SoftDeletingTrait;
	
	public function getStartdateAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setStartDateAttribute($value)
	{
	    $this->attributes['startdate'] = Crypt::encrypt($value);
	}

	public function getEnddateAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setEndDateAttribute($value)
	{
	    $this->attributes['enddate'] = Crypt::encrypt($value);
	}

	public function getStarttimeAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setStarttimeAttribute($value)
	{
	    $this->attributes['starttime'] = Crypt::encrypt($value);
	}

	public function getEndtimeAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setEndtimeAttribute($value)
	{
	    $this->attributes['endtime'] = Crypt::encrypt($value);
	}

	public function getCreateAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setCreateAttribute($value)
	{
	    $this->attributes['create'] = Crypt::encrypt($value);
	}

	public function getReadAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setReadAttribute($value)
	{
	    $this->attributes['read'] = Crypt::encrypt($value);
	}

	public function getUpdateAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setUpdateAttribute($value)
	{
	    $this->attributes['update'] = Crypt::encrypt($value);
	}

	public function getDeleteAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setDeleteAttribute($value)
	{
	    $this->attributes['delete'] = Crypt::encrypt($value);
	}

	public function getVoidAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setVoidAttribute($value)
	{
	    $this->attributes['void'] = Crypt::encrypt($value);
	}

	public function getUnvoidAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setUnvoidAttribute($value)
	{
	    $this->attributes['unvoid'] = Crypt::encrypt($value);
	}

	public function getPrintAttribute($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setPrintAttribute($value)
	{
	    $this->attributes['print'] = Crypt::encrypt($value);
	}

	public static function getAccessRights($value, $value2)
	{
		if ($value == 1)  { return 't'; } else { return 'f'; } 
	}

	public static function getResourceAdministratorAccessRights($value, $value2)
	{	
		try
		{
			if (AccessmAccessRights::where('userid', '=', $value2)->where('resourcecode', '=', $value)
				->where('resourcegroup', '=', $value)->count() == 1)
			{
				return true;
			}
			else { return false; }
		}
		catch(\Exception $e)
		{
			return false;
		}
	}

	public static function getResourceAccessRights($value, $value2)
	{
		try
		{
			if (DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value2)->pluck('read'))
			{
				$RECheck = Crypt::decrypt(DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value2)->pluck('read'));
				if ($RECheck == 1)
				{
					if(DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value2)->pluck('accesstypeid') == 1)
					{ return 't'; }
					elseif (DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value2)->pluck('accesstypeid') == 2)
					{ return 't'; }
					elseif (DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value2)->pluck('accesstypeid') == 3)
					{ return 't'; }
				}
				else { return 'f'; }
			} 
		}
		catch(\Exception $e)
		{
			LogsfLogs::postLogs('Read', 4, 0, ' - Access Rights - ' . $value . ' - ' . $e, NULL, NULL, 'Failed');
			return 'f';
		}
	}

	public static function getResourceCRUDAccessRights($value, $value2, $value3)
	{
		try
		{
			$RECheck = Crypt::decrypt(DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value3)->whereNull('deleted_at')->pluck($value2));
			if ($RECheck == 1)
			{
				if(DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value3)->pluck('accesstypeid') == 1)
				{ return true; }
				elseif (DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value3)->pluck('accesstypeid') == 2)
				{ return true; }
				elseif (DB::table('Access_m_AccessRights')->where('resourcecode', $value)->where('userid', $value3)->pluck('accesstypeid') == 3)
				{ return true; }
			}
			else { return false; }
		}
		catch(\Exception $e)
		{
			return false;
		}
	}

	public static function getFindResource($value, $value2, $value3, $value4)
	{
		if (AccessfCheck::getCheckSYS($value3)){ return true; }
        else if (AccessfCheck::getCheckSOF($value3)){ return true; }
        else if (DB::table('Access_m_AccessRights')
        		->where('resourcecode', 'like', $value)->where('eventid', $value4)
        		->where('userid', '=', $value2)->where('deleted_at', NULL)
        		->get()){ return true; } 
    	else { return false; }
	}

	public static function getid($value)
    {
        $mid = DB::table('Access_m_AccessRights')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getacid($value)
    {
        $mid = DB::table('Access_m_AccessRights')->where('userid', $value)->pluck('id');
        return $mid;
    }
}