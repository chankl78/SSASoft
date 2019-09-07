<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AwardzType extends Eloquent {

	protected $table = 'Award_z_Type';
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

    public static function getFindDuplicateValue($value)
    {
        if (AwardzType::where('value', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($post)
        {
            return $post->isValid(); 
        });

        static::updating(function($post)
        {
            return $post->isValid(); 
        });

        static::saving(function($record)
        {
            try
            {
                $dirty = $record->getDirty();
                foreach ($dirty as $field => $newdata)
                {
                    $olddata = $record->getOriginal($field);
                    if ($olddata != $newdata)
                    {
                        LogsfLogs::postLogs('Update', 48, $record->id, ' - Award Type - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 48, $record->id, ' - Award Type - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
