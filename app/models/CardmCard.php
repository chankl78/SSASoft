<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CardmCard extends Eloquent {

	protected $table = 'Card_m_Card';
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
                ->orwhere('cardno', 'Like', '%'.$sSearch.'%')
                ->orwhere('name', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%');
        });
    }

    public static function getid($value)
    {
        $mid = DB::table('Card_m_Card')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getcardid($value)
    {
        $mid = DB::table('Card_m_Card')->where('name', $value)->pluck('id');
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
                        LogsfLogs::postLogs('Update', 26, $record->id, ' - Event - From:  ' . $field . ' - From ' . $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
                    }
                }
                return true;
            }
            catch(\Exception $e)
            {
                LogsfLogs::postLogs('Update', 26, $record->id, ' - Event - ' . $field . ' - ' . $e, $olddata, $newdata, 'Failed');
            }
        });
    }

    public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'cardno' => 'required|min:3'
            )
        )->passes();
    }
}
