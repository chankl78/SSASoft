<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VehiclemMaintenance extends Eloquent {

	protected $table = 'Vehicle_m_Maintenance';
	use SoftDeletingTrait;
}
