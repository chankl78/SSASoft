<?php

class LogsmLogs extends Eloquent {

	protected $table = 'Logs_m_Logs';

	public function scopeSearch($query, $sSearch)
    {
        return $query->where(function($query) use ($sSearch)
        {
            $query->where('created_at', 'Like', '%'.$sSearch.'%')
                ->orwhere('logtype', 'Like', '%'.$sSearch.'%')
                ->orwhere('ipaddress', 'Like', '%'.$sSearch.'%')
                ->orwhere('status', 'Like', '%'.$sSearch.'%');
        });
    }
}