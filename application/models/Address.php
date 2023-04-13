<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Address extends Eloquent {

	protected $table = "addresses";

	protected $fillable = ['name', 'email', 'contact_no', 'address1', 'address2', 'state', 'city', 'pincode', 'is_default', 'user_id'];

	public function cart() {
		return $this->hasOne(Cart::class, 'address_id', 'id');
	}
}