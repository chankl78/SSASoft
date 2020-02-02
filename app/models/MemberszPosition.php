<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MemberszPosition extends Eloquent {

	protected $table = 'Members_z_Position';
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
                $query->where('name', 'Like', '%'.$sSearch.'%')
                	->orwhere('code', 'Like', '%'.$sSearch.'%');
            });
    }

    public static function getFindDuplicateValue($value)
    {
        if (MemberszPosition::where('name', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public static function getPositionLevel($value)
    {
        $mid = DB::table('Members_z_Position')->where('code', $value)->pluck('level');
        return $mid;
    }

    public function scopePositionLevel($query)
    {
        return $query->groupBy('level')->orderBy('level');
    }

    public static function boot()
    {
        parent::boot();
        static::updating(function($record)
        {
            try
            {
                $dirty = $record->getDirty();
                foreach ($dirty as $field => $newdata)
                {
                    $olddata = $record->getOriginal($field);
                    if ($olddata != $newdata)
                    {
                        LogsfLogs::postLogs('Update', 26, $record->id, ' - Event Default Table Role - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 26, $record->id, ' - Event Default Table Role - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }
}
