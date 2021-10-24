<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ConfigurationmDefault extends Eloquent {
	
	protected $table = 'Configuration_m_Default';
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

    public function scopeNFMDefaultCode($query)
    {
        $mid = DB::table('Configuration_m_Default')->where('key', 'NFM')->pluck('value');
        return $mid;
    }

    public function scopeSDRPDefaultCode($query)
    {
        $mid = DB::table('Configuration_m_Default')->where('key', 'SDRP')->pluck('value');
        return $mid;
    }

    public function scopeDefaultCode( $query, $value)
    {
        $mid = DB::table('Configuration_m_Default')->where('key', $value)->pluck('value');
        return $mid;
    }

    public function scopeNDPDefaultCode($query)
    {
        $mid = DB::table('Configuration_m_Default')->where('key', 'NDP')->pluck('value');
        return $mid;
    }

    public function scopeChingayDefaultCode($query)
    {
        $mid = DB::table('Configuration_m_Default')->where('key', 'CHIN')->pluck('value');
        return $mid;
    }
}
