<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

class User extends Eloquent {
	protected $table = "users";
	protected $fillable = ['oauth_provider','oauth_token','contact_no','email','secret_key', 'verified_on'];
	use SoftDeletes;
	
	public function profile()
	{
		return $this->hasOne('Profile', 'user_id');
	}

	public function scopeDeliveryBoy($query)
	{
		return $query->whereHas('profile', function($profile) {
			$profile->where('role', 2);
		});
	}
	public function scopeCustomer($query)
	{
		return $query->whereHas('profile', function($profile) {
			$profile->where('role', 0);
		});
	}
}