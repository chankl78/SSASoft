<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VehiclemBooking extends Eloquent {

	protected $table = 'Vehicle_m_Booking';
	use SoftDeletingTrait;
}
