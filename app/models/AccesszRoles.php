<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AccesszRoles extends Eloquent {

	protected $table = 'Access_z_Roles';
	use SoftDeletingTrait;

    public function AccessUsers()
    {
        return $this->belongsTo('AccessmUsers');
    }

    public static function getFindAccessRole($value)
	{
		if (DB::table('Access_z_Roles')->where('value', 'like', $value)->get()) { return true; } else { return false; }
	}

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

    public function scopeSearch($query, $value)
    {
        return $query->where('value', 'Like', $value);
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
                        LogsfLogs::postLogs('Update', 6, $record->id, ' - Access Rights Roles - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 6, $record->id, ' - Access Rights - Roles - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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