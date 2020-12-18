<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class MemberszPostal extends Eloquent {

	protected $table = 'Members_z_Postal';
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
                $query->where('postaldistrict', 'Like', '%'.$sSearch.'%')
                    ->orwhere('postalsector', 'Like', '%'.$sSearch.'%')
                    ->orwhere('generallocation', 'Like', '%'.$sSearch.'%');
            });
    }

    public static function getFindDuplicateValue($value)
    {
        if (MemberszPostal::where('postalsector', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public static function getPostalDistrict($value)
    {
        $mid = DB::table('Members_z_Postal')->where('postalsector', $value)->pluck('postaldistrict');
        return $mid;
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
                        LogsfLogs::postLogs('Update', 37, $record->id, ' - Members Default Table Postal - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 26, $record->id, ' - Members Default Table Postal - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }
}
