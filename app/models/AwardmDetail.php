<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AwardmDetail extends Eloquent {

	protected $table = 'Award_m_Detail';
	use SoftDeletingTrait;

    public function MembersmSSA()
    {
        return $this->belongsTo('MembersmSSA', 'id');
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

    public function scopeAward($query, $value)
    {
        return $query->where('awardid', '=', $value);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'Like', $value);
    }

    public static function getFindDuplicateValue($value, $value1)
    {
        if (AwardmDetail::where('memberid', '=', $value)->where('awardid', $value1)->count() >= 1) { return true; } 
        else { return false; }
    }

    public static function getid($value)
    {
        $mid = DB::table('Award_m_Detail')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($post)
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
