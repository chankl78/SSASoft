<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class GroupzContactGroup extends Eloquent {

	protected $table = 'Group_z_ContactGroup';
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
        return $query->where('value', 'Like', $value);
    }

    public function scopeGroup($query, $value)
    {
        $id = GroupmGroup::getid($value);
        return $query->where('groupid', '=', $id);
    }

    public function scopeGroupName($query, $value)
    {
        $id = GroupmGroup::getidbyname($value);
        return $query->where('groupid', '=', $id);
    }

    public static function getFindDuplicateValue($value, $value1)
    {
        if (GroupzPosition::where('value', '=', $value)->where('groupid', $value1)->count() >= 1) { return true; } else { return false; }
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
                        LogsfLogs::postLogs('Update', 43, $record->id, ' - Group Contact Group - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 43, $record->id, ' - Group Contact Group - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'value' => 'required|min:3'
            )
        )->passes();
    }
}
