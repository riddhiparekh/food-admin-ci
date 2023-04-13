<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Wishlist extends Eloquent {

	protected $table = "wishlist";

	public $timestamps= null;

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function product() {
		return $this->hasOne('Product', 'id', 'product_id');
	}
}