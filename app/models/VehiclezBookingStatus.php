<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class VehiclezBookingStatus extends Eloquent {

	protected $table = 'Vehicle_z_BookingStatus';
	use SoftDeletingTrait;

	public static function getFindDuplicateValue($value)
	{
		if (VehiclezBookingStatus::where('value', '=', $value)->count() >= 1) {
			return true;
		} else {
			return false;
		}
	}
}
