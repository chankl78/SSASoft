<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CrisismDetail extends Eloquent {

	protected $table = 'Crisis_m_Detail';
    use SoftDeletingTrait;

    public function setContactnoAttribute($value) { $this->attributes['contactno'] = Crypt::encrypt($value); }
    public function getContactnoAttribute($value) { return Crypt::decrypt($value); }

	public function scopeRole($query)
    {
        return $query;  
    }

    public static function getid($value)
    {
        $mid = DB::table('Crisis_m_Detail')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public function scopeCrisis($query, $value)
    {
        return $query->where('crisisid', '=', CrisismCrisis::getid($value));
    }

    public static function getdetailremark($value)
    {
        $mid = DB::table('Crisis_m_Detail')->where('uniquecode', $value)->pluck('remark');
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
                    $olddata = $record->getOriginal($field);
                    if ($olddata != $newdata)
                    {
                        LogsfLogs::postLogs('Update', 69, $record->id, ' - Crisis Detail - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 69, $record->id, ' - Crisis Detail - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'crisisid' => 'required|min:1'
            )
        )->passes();
    }
}