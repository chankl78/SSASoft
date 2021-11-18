<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AccessmUsersDecrypt extends Eloquent {

	protected $table = 'Access_m_UsersDecrypt';
	use SoftDeletingTrait;

}
