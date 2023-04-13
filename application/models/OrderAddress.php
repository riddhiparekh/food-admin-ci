<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class OrderAddress extends Eloquent {
	protected $table = "order_addresses"; // table name

	protected $fillable = ['name', 'email', 'contact_no', 'address1', 'address2', 'state', 'city', 'pincode', 'pincode', 'order_id'];
}