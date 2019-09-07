<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class MembersmRequest extends Eloquent {

	protected $table = 'Members_m_Request';
	use SoftDeletingTrait;
}
