<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class GroupmGroup extends Eloquent {

	protected $table = 'Group_m_Group';
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
        $mid = DB::table('Group_m_Group')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getidbyname($value)
    {
        $mid = DB::table('Group_m_Group')->where('name', $value)->pluck('id');
        return $mid;
    }

    public static function getnamebyid($value)
    {
        $mid = DB::table('Group_m_Group')->where('id', $value)->pluck('name');
        return $mid;
    }

    public static function getgroupnamepart($value)
    {
        $mid = DB::table('Group_m_Group')->where('uniquecode', $value)->pluck('name');
        return $mid;
    }

    public function scopeActiveStatus($query)
    {
        return $query->where('status', 'Active');
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
                            LogsfLogs::postLogs('Update', 45, $record->id, ' - Group - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        } 
                    }
                    catch(\Exception $e)
                    {
                        LogsfLogs::postLogs('Update', 45, $record->id, ' - Group - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 45, $record->id, ' - Group - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
