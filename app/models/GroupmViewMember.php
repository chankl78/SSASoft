
<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class GroupmViewMember extends Eloquent {

	protected $table = 'view_z_groupmember';
	use SoftDeletingTrait;

    public function scopeGroup($query, $value)
    {
        return $query->where('groupid', '=', $value);
    }

    public function scopeStatusActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeStatusOthers($query)
    {
        return $query->where('status', '!=', 'Active');
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
