
<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class GroupmMember extends Eloquent {

	protected $table = 'Group_m_Member';
	use SoftDeletingTrait;

    // Relationships
    public function Member()
    {
        return $this->belongsTo('MembersmSSA', 'memberid');
    }

    public function EventRegistration()
    {
        return $this->hasMany('EventmRegistration', 'memberid', 'memberid');
    }

    public function Attendance()
    {
        return $this->hasMany('AttendancemPerson', 'memberid', 'memberid');
    }

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

    public function scopeGroup($query, $value)
    {
        return $query->where('groupid', '=', $value);
    }

    public function scopeStatusActive($query, $value)
    {
        return $query->where('status', 'Active');
    }

    public function scopeStatusOthers($query, $value)
    {
        return $query->where('status', '!=', 'Active');
    }

    public function scopeSearch($query, $value)
    {
        return $query->where(function($query) use ($value)
        {
            $query->where('name', 'Like', '%'.$value.'%')
                ->orwhere('contactgroup', 'Like', '%'.$value.'%')
                ->orwhere('rhq', 'Like', '%'.$value.'%')
                ->orwhere('zone', 'Like', '%'.$value.'%')
                ->orwhere('chapter', 'Like', '%'.$value.'%')
                ->orwhere('district', 'Like', '%'.$value.'%')
                ->orwhere('division', 'Like', '%'.$value.'%')
                ->orwhere('position', 'Like', '%'.$value.'%')
                ->orwhere('remark', 'Like', '%'.$value.'%');
        });
    }

    public static function getFindDuplicateValue($value, $value1)
    {
        if (GroupmMember::where('memberid', $value)->where('groupid', $value1)->where('deleted_at', NULL)->count() >= 1) { return true; } 
        else { return false; }
    }

    public static function getid($value)
    {
        $mid = DB::table('Group_m_Member')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getmemberid($value)
    {
        $mid = DB::table('Group_m_Member')->where('uniquecode', $value)->pluck('memberid');
        return $mid;
    }

    public static function getmembergroupall($value)
    {
        $mid = DB::table('Group_m_Member')->where('memberid', $value)->where('status', 'Active')->where('deleted_at', NULL)->select(array(DB::raw('GROUP_CONCAT(groupname SEPARATOR ", ") as groupall')))->pluck('groupall');
        return $mid;
    }

    public function scopeMemberGroup($query, $value)
    {
        if ($value == 0) { return $query->where('memberid', '16436'); }
        else  { return $query->where('memberid', $value); }
    } // For query to use a person with no group when NRIC is 0

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
                        LogsfLogs::postLogs('Update', 45, $record->id, ' - Group Member - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 45, $record->id, ' - Group Member - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
