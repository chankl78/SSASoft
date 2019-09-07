<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AccesszAccessTypes extends Eloquent {
	protected $table = 'Access_z_AccessTypes';
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
        if (AccesszAccessTypes::where('value', '=', $value)->count() >= 1) { return true; } else { return false; }
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
                            LogsfLogs::postLogs('Update', 6, $record->id, ' - Access Types - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        } 
                    }
                    catch(\Exception $e)
                    {
                        LogsfLogs::postLogs('Update', 6, $record->id, ' - Access Types - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 6, $record->id, ' - Access Types- ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
