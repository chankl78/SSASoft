<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SecuritymOccurance extends Eloquent {

	protected $table = 'Security_m_Occurance';
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
        else if (Auth::user()->roleid == 'Single Group Administrator' or Auth::user()->roleid == 'Single Group User')
        {
            $value4 = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->where('resourcecode', 'GP04')->where('deleted_at', NULL)->pluck('groupid');
            return $query->where('id', $value4);
        }
        else if (Auth::user()->roleid == 'Gakkai Administrator')
        {
            return $query;
        }
        else
        {
            return $query;
        }    
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'Like', $value);
    }

    public static function getFindDuplicateValue($value)
    {
        if (GroupmGroup::where('name', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public static function getid($value)
    {
        $mid = DB::table('Security_m_Occurance')->where('uniquecode', $value)->pluck('id');
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
                    try
                    {
                        $olddata = $record->getOriginal($field);
                        if ($olddata != $newdata)
                        {
                            LogsfLogs::postLogs('Update', 63, $record->id, ' - Security Occurance - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        } 
                    }
                    catch(\Exception $e)
                    {
                        LogsfLogs::postLogs('Update', 63, $record->id, ' - Security Occurance - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 63, $record->id, ' - Security Occurance - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'name' => 'required|min:3',
                'groupformed' => 'required'
            )
        )->passes();
    }
}
