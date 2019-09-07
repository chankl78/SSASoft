<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StaffmStaff extends Eloquent {

	protected $table = 'Staff_m_Staff';
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
                    ->orwhere('position', 'Like', '%'.$sSearch.'%')
                    ->orwhere('department', 'Like', '%'.$sSearch.'%')
                    ->orwhere('stafftype', 'Like', '%'.$sSearch.'%')
                    ->orwhere('status', 'Like', '%'.$sSearch.'%');
            });
    }

    public function scopeStatus($query)
    {
        return $query->where('status', '=', 'Active');
    }

    public static function getFindDuplicateStaff($value)
    {
        if (StaffmStaff::where('name', '=', $value)->count() == 1) {return true; } else { return false; }
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
                    try
                    {
                        $olddata = $record->getOriginal($field);
                        if ($olddata != $newdata)
                        {
                            LogsfLogs::postLogs('Update', 11, $record->id, ' - Staff - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        } 
                    }
                    catch(\Exception $e)
                    {
                        LogsfLogs::postLogs('Update', 11, $record->id, ' - Staff - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 11, $record->id, ' - Staff - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
