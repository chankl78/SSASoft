<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class VehiclezMaintenanceType extends Eloquent {

	protected $table = 'Vehicle_z_MaintenanceType';
	use SoftDeletingTrait;
}
