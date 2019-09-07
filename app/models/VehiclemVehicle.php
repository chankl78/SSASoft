<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VehiclemVehicle extends Eloquent {

	protected $table = 'Vehicle_m_Vehicle';
	use SoftDeletingTrait;

	public function scopeRole($query)
	{
		if (AccessfCheck::getCheckSYS(Auth::user()->roleid)) {
			return $query;
		} else if (AccessfCheck::getCheckSOF(Auth::user()->roleid)) {
			return $query;
		} else {
			return $query;
		}
	}

	public static function getid($value)
	{
		$mid = DB::table('Vehicle_m_Vehicle')->where('uniquecode', $value)->pluck('id');
		return $mid;
	}

	public static function getFindDuplicateValue($value)
	{
		if (VehiclemVehicle::where('vehicleno', '=', $value)->count() >= 1) {
			return true;
		} else {
			return false;
		}
	}
}
