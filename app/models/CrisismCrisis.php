<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CrisismCrisis extends Eloquent {

    protected $table = 'Crisis_m_Crisis';
    use SoftDeletingTrait;

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

    public static function getid($value)
    {
        $mid = DB::table('Crisis_m_Crisis')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getFindDuplicateValue($location, $date, $shift)
    {
        if (CrisismCrisis::where('location', $location)->whereDate('resourcedate', '=', $date->format('Y-m-d'))->where('shift', $shift)->count() >= 1) { return true; } else { return false; }
    }

    public static function getcrisisdescription($value)
    {
        $mid = DB::table('crisis_m_crisis')->where('uniquecode', $value)->select(DB::raw('concat(resourcedate, " - ", location, " [ ", shift, " ]") as description'))->pluck('description');
        return $mid;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($post)
        {
            return $post->isValid(); 
        });

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
                        LogsfLogs::postLogs('Update', 74, $record->id, ' - Crisis - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 74, $record->id, ' - Crisis - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'location' => 'required|min:1'
            )
        )->passes();
    }
}
