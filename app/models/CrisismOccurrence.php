<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CrisismOccurrence extends Eloquent {

	protected $table = 'Crisis_m_Occurrence';
    use SoftDeletingTrait;

	public function scopeRole($query)
    {
        return $query;  
    }

    public static function getid($value)
    {
        $mid = DB::table('Crisis_m_Occurrence')->where('uniquecode', $value)->pluck('id');
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
                        LogsfLogs::postLogs('Update', 69, $record->id, ' - Crisis Occurrence - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 69, $record->id, ' - Crisis Occurrence - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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