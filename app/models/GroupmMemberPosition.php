<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class GroupmMemberPosition extends Eloquent {

	protected $table = 'Group_m_MemberPosition';
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

    public function scopeSearch($query, $value)
    {
        return $query->where('groupmemberid', 'Like', $value);
    }

    public static function getFindDuplicateValue($value, $value2)
    {
        if (GroupmMemberPosition::where('groupmemberid', '=', $value)->where('position', $value2)->count() >= 1) { return true; } 
        else { return false; }
    }

    public function scopeMemberGroup($query, $value)
    {
        return $query->where('groupmemberid', $value);
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
                        LogsfLogs::postLogs('Update', 45, $record->id, ' - Group Position - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 45, $record->id, ' - Group Position - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'groupmemberid' => 'required'
            )
        )->passes();
    }
}
