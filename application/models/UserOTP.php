<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class UserOTP extends Eloquent {

	protected $table = "user_otp_dtl";
	protected $fillable = ['contact_no', 'otp', 'valid_till', 'created_at'];
	public $timestamps= null;

	public function setValidTillAttribute($value) {
		$this->attributes['valid_till'] = \Carbon\Carbon::now()->addMinutes(15);
	}
	public function setCreatedAtAttribute($value) {
		$this->attributes['created_at'] = \Carbon\Carbon::now();
	}
}