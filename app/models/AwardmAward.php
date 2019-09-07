<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AwardmAward extends Eloquent {

	protected $table = 'Award_m_Award';
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
        return $query->where('awardtitle', 'Like', $value);
    }

    public static function getFindDuplicateValue($value, $value1)
    {
        if (AwardmAward::where('awarddate', DateTime::createFromFormat('d-m-Y', $value))->where('awardtitle', '=', $value1)->count() >= 1) { return false; } else { return false; }
    }

    public static function getid($value)
    {
        $mid = DB::table('Award_m_Award')->where('uniquecode', $value)->pluck('id');
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
                            LogsfLogs::postLogs('Update', 48, $record->id, ' - Award - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                        } 
                    }
                    catch(\Exception $e)
                    {
                        LogsfLogs::postLogs('Update', 48, $record->id, ' - Award - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 48, $record->id, ' - Award - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'awardtitle' => 'required|min:3',
                'awarddate' => 'required'
            )
        )->passes();
    }
}
