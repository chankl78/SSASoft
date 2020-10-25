<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EventmEventShow extends Eloquent {

	protected $table = 'Event_m_EventShow';
	use SoftDeletingTrait;

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid)) { return $query; }
    }

    public function scopeSearch($query, $value, $value2)
    {
        return $query->where('value', 'Like', $value)->where('eventid', '=', EventmEvent::getid($value2));
    }

    public static function getFindDuplicateValue($value, $value2)
    {
        if (EventmEventShow::where('eventid', '=', $value2)->where('value', '=', $value)->count() >= 1) { return true; } else { return false; }
    }

    public function scopeEvent($query, $value)
    {
        return $query->where('eventid', EventmEvent::getid($value));
    }

    public function scopeEventSessionSizeNotExceedMax($query, $id)
    {
        return $query->leftjoin('Event_m_Registration', 'Event_m_EventShow.value', '=', 'Event_m_Registration.session')
        ->where('Event_m_EventShow.eventid', $id)
        ->havingRaw('count(Event_m_Registration.name) < Event_m_EventShow.sizelimit')
        ->groupby('Event_m_EventShow.value')
        ->select(DB::raw('Event_m_EventShow.value, Event_m_EventShow.sizelimit, Count(Event_m_Registration.name) as "total", Event_m_EventShow.sizelimit - Count(Event_m_Registration.name) as "reminder"'));
    }

    public function scopeEventSessionSizeWithTotal($query, $id)
    {
        return $query->leftjoin('Event_m_Registration', 'Event_m_EventShow.value', '=', 'Event_m_Registration.session')
        ->where('Event_m_EventShow.eventid', $id)
        ->groupby('Event_m_EventShow.value')
        ->select(DB::raw('Event_m_EventShow.value, Event_m_EventShow.sizelimit, Count(Event_m_Registration.name) as "total", Event_m_EventShow.sizelimit - Count(Event_m_Registration.name) as "reminder"'));
    }

    public static function getid($value)
    {
        $mid = DB::table('Event_m_EventShow')->where('uniquecode', $value)->pluck('id');
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
                        LogsfLogs::postLogs('Update', 28, $record->id, ' - Event Show - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 28, $record->id, ' - Event Show - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
