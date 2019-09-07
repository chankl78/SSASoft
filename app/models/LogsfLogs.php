<?php

class LogsfLogs extends Eloquent {

	public static function postLogs($value, $value2, $value3, $value4, $value5, $value6, $value7)
	{
		try
		{
			$plog = new LogsmLogs; 
			$plog->userid = Auth::user()->id; 
			$plog->logtype = $value;
			$plog->resourceid = $value2; 
			$plog->resourcecode = $value3;
			$plog->ipaddress = Request::ip();
			$plog->session = Session::getId();
			$plog->description = Auth::user()->username . $value4; 
			$plog->From = $value5;
			$plog->To = $value6;
			$plog->status = $value7;
			$plog->save();

			return true;
		}
		catch(\Exception $e)
		{
			$plog = new LogsmLogs; 
			$plog->userid = 0; 
			$plog->logtype = $value;
			$plog->resourceid = $value2; 
			$plog->resourcecode = $value3;
			$plog->ipaddress = Request::ip(); 
			$plog->session = Session::getId();
			$plog->description = $value4;
			$plog->From = $value5;
			$plog->To = $value6;
			$plog->status = $value7;
			$plog->save();
		}
		
	}
}
