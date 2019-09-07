<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EventmEventItem extends Eloquent {

	protected $table = 'Event_m_EventItem';
	use SoftDeletingTrait;

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid)) { return $query; }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid)) { return $query; }
        else 
        {
            if (Auth::user()->roleid == 'Single Event Item User')
            {
                $value = DB::table('Access_m_AccessRights')->where('userid', Auth::user()->id)->groupBy('userid')->pluck('eventitem');
                return $query->where('name', $value); 
            }
            else { return $query; }
        }    
    }

    public function scopeSearch($query, $value, $value2)
    {
        return $query->where('name', 'Like', $value)->where('eventid', '=', EventmEvent::getid($value2));
    }

    public static function getFindDuplicateValue($value, $value2)
    {
        if (EventmEventItem::where('eventid', '=', $value2)->where('name', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public function scopeEvent($query, $value)
    {
        return $query->where('eventid', '=', EventmEvent::getid($value));
    }

    public static function getid($value)
    {
        $mid = DB::table('Event_m_EventItem')->where('uniquecode', $value)->pluck('id');
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
                        LogsfLogs::postLogs('Update', 28, $record->id, ' - Event Item - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 28, $record->id, ' - Event Item - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
