<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StaffzDepartment extends Eloquent {

	protected $table = 'Staff_z_Department';
    use SoftDeletingTrait;

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
                $query->where('value', 'Like', '%'.$sSearch.'%');
            });
    }
}
