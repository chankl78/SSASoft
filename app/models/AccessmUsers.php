<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AccessmUsers extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'Access_m_Users';
	use SoftDeletingTrait;

	protected $hidden = array('password');

    public function getAuthIdentifier() { return $this->getKey(); }
    public function getAuthPassword() { return $this->password; }
    public function getReminderEmail() { return $this->email; }
    public function getRememberToken() { return $this->remember_token; }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

	public function getNameAttribute($value) { return Crypt::decrypt($value); }
    public function setNameAttribute($value) { $this->attributes['name'] = Crypt::encrypt($value); }
	public function getRoleidAttribute($value) { return Crypt::decrypt($value); }
    public function setRoleidAttribute($value) { $this->attributes['roleid'] = Crypt::encrypt($value); }
	public function getTelAttribute($value) { return Crypt::decrypt($value); }
    public function setTelAttribute($value) { $this->attributes['tel'] = Crypt::encrypt($value); }
	public function getMobileAttribute($value) { return Crypt::decrypt($value); }
    public function setMobileAttribute($value) { $this->attributes['mobile'] = Crypt::encrypt($value); }
	public function getEmailAttribute($value) { return Crypt::decrypt($value); }
    public function setEmailAttribute($value) { $this->attributes['email'] = Crypt::encrypt($value); }
    public function getEncryptedCodeAttribute($value) { return Crypt::decrypt($value); }
    public function setEncryptedCodeAttribute($value) { $this->attributes['encryptedcode'] = Crypt::encrypt($value); }

	public function scopeRole($query)
    {
        if (AccessfCheck::getCheckSYS(Auth::user()->roleid))
        {
            return $query;
        }
        else if (AccessfCheck::getCheckSOF(Auth::user()->roleid))
        {
            return $query->whereNotIn('id', array(1));
        }
        else
        {
            return $query->whereNotIn('id', array(1, 2));
        }    
    }

    public function scopeSearch($query, $value)
    {
        return $query->where(function($query) use ($value)
        {
            $query->where('username', 'Like', '%'.$value.'%')
                ->orwhere('name', 'Like', '%'.$value.'%');
        });
    }

    public function scopeEvent($query, $value)
    {
        return $query->where('eventid', '=', EventmEvent::getid($value));
    }

    public static function getuserid($value)
    {
        $mid = DB::table('Access_m_Users')->where('username', $value)->pluck('id');
        return $mid;
    }

    public static function getusermemberid($value)
    {
        $mid = DB::table('Access_m_Users')->where('username', $value)->pluck('memberid');
        return $mid;
    }

    public static function getcheckmemberid($value)
    {
        if(AccessmUsers::where('username', $value)->pluck('memberid') == 0) { return true; }
        else { return false; }
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
                        LogsfLogs::postLogs('Update', 2, $record->id, ' - User Profile - Update - ' . $field . ' - From: ' .  $olddata . ' To: ' . $newdata, $olddata, $newdata, 'Success');
			        }
			    }
			    return true;
		    }
		    catch(\Exception $e)
			{
				LogsfLogs::postLogs('Update', 2, $record->id, ' - User Profile - Update - ' . $e, NULL, NULL, 'Failed');
			}
		});
    }

	public function isValid()
    {
        return Validator::make(
            $this->toArray(),
            array(
                'name' => 'required|min:3',
                'username' => 'sometimes|required|min:6',
                'password' => 'sometimes|required|min:6',
                'email' => 'required'
            )
        )->passes();
    }

    public static function getName($value)
    {
    	$value1 = DB::table('Access_m_Users')->where('id', $value)->pluck('name');
        return Crypt::decrypt($value1);
    }

    public static function getRole($value)
    {
    	$value1 = DB::table('Access_m_Users')->where('id', $value)->pluck('roleid');
        return Crypt::decrypt($value1);
    }

    public static function getid($value)
    {
        $mid = DB::table('Access_m_Users')->where('uniquecode', $value)->pluck('id');
        return $mid;
    }

    public static function getFindDuplicateValue($value)
    {
        if (AccessmUsers::where('username', $value)->count() >= 1) { return true; } else { return false; }
    }
}
