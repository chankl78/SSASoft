<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CrisismDutyStaff extends Eloquent {

	protected $table = 'Crisis_m_DutyStaff';
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
        $mid = DB::table('Crisis_m_DutyStaff')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public function scopeCrisis($query, $value)
    {
        return $query->where('crisisid', '=', CrisismDutyStaff::getid($value));
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
                        LogsfLogs::postLogs('Update', 69, $record->id, ' - Campaign Detail - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 69, $record->id, ' - Campaign Detail - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'name' => 'required|min:3'
            )
        )->passes();
    }
}