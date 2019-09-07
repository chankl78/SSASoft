<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CardmCardDetail extends Eloquent {

	protected $table = 'Card_m_CardDetail';
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

    public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('created_at', 'Like', '%'.$sSearch.'%')
                ->orwhere('returndatetime', 'Like', '%'.$sSearch.'%')
                ->orwhere('eventname', 'Like', '%'.$sSearch.'%')
                ->orwhere('groupname', 'Like', '%'.$sSearch.'%')
                ->orwhere('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('cardno', 'Like', '%'.$sSearch.'%')
                ->orwhere('cardname', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%');
        });
    }

    public static function getid($value)
    {
        $mid = DB::table('Card_m_CardDetail')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getcardbarcodeid($value)
    {
        $mid = DB::table('Card_m_CardDetail')->where('cardname', $value)->where('deleted_at', NULL)->pluck('id');
        return $mid;
    }

    public static function getcardid($value, $value2)
    {
        $mid = DB::table('Card_m_CardDetail')->where('eventid', $value)->where('cardname', $value2)->where('deleted_at', NULL)->pluck('id');
        return $mid;
    }

    public static function getcardregid($value)
    {
        $mid = DB::table('Card_m_CardDetail')->where('uniquecode', $value)->where('deleted_at', NULL)->pluck('eventdetailid');
        return $mid;
    }

    public function scopeEvent($query, $value)
    {
        return $query->where('eventid', '=', EventmEvent::getid($value));
    }

    public static function getFindDuplicateValue($value, $value2, $value3)
    {
        if (CardmCardDetail::where('eventid', $value2)->where('eventdetailid', $value3)
            ->where('cardno', $value)->where('deleted_at', NULL)->count() >= 1) { return true; } else { return false; }
    }
    
    public static function getFindDuplicateCard($value, $value2)
    {
        if (CardmCardDetail::where('eventid', $value2)->where('cardname', $value)
            ->where('deleted_at', NULL)->count() >= 1) { return true; } else { return false; }
    }
    
    public static function getFindDuplicateName($value, $value2)
    {
        if (CardmCardDetail::where('eventid', $value2)->where('eventdetailid', $value)->where('returndatetime', NULL)
            ->where('deleted_at', NULL)->count() >= 1) { return true; } else { return false; }
    }

    public static function getSecurityPass($value, $value1)
    {
        $mid = DB::table('Card_m_CardDetail')->where('cardno', $value)->where('eventid', $value1)->where('deleted_at', NULL)->pluck('eventdetailid');
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
                        LogsfLogs::postLogs('Update', 26, $record->id, ' - Event Card - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 26, $record->id, ' - Event Card - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
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
