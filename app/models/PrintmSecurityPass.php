<?php

class PrintmSecurityPass extends Eloquent {

	protected $table = 'Print_m_SecurityPass';

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

	public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('rhq', 'Like', '%'.$sSearch.'%')
                ->orwhere('zone', 'Like', '%'.$sSearch.'%')
                ->orwhere('chapter', 'Like', '%'.$sSearch.'%')
                ->orwhere('district', 'Like', '%'.$sSearch.'%');
        });
    }

    public function scopeEvent($query, $value)
    {
        return $query->where('eventid', '=', $value);
    }

    public static function getFindSPDuplicate($value, $value2)
    {
        if (PrintmSecurityPass::where('userid', '=', $value)->where('eventdetailid', '=', $value2)->count() >= 1) 
        { return true; } else { return false; }
    }

    public static function deleteAllSecurityPass($value)
    {
        DB::table('Print_m_SecurityPass')->where('userid', '=', $value)->delete();
        return true;
    }
}
