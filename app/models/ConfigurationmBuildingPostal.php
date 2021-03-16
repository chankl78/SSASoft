<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ConfigurationmBuildingPostal extends Eloquent {

	protected $table = 'Configuration_m_BuildingPostal';
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

    public static function getid($value)
    {
        $mid = DB::table('Configuration_m_BuildingPostal')->where('postcode', $value)->pluck('id');
        return $mid;
    }

    public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
            {
                $query->where('postcode', 'Like', '%'.$sSearch.'%')
                	->orwhere('bldgno', 'Like', '%'.$sSearch.'%')
                    ->orwhere('streetname', 'Like', '%'.$sSearch.'%')
                    ->orwhere('bldgname', 'Like', '%'.$sSearch.'%');
            });
    }

    public static function getFindDuplicateValue($value)
    {
        if (MemberszPosition::where('postcode', '=', $value)->count() >= 1) { return true; } else { return false; }
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
                        LogsfLogs::postLogs('Update', 26, $record->id, ' - Configuration Building Postal - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 26, $record->id, ' - Configuration Building Postal - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }
}
