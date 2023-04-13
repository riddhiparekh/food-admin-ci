<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Cart extends Eloquent {
	protected $table = "cart"; // table name
	
	protected $fillable = ['user_id', 'address_id', 'items_count', 'items_qty' ,'base_total', 'discount_total', 'delivery_charge', 'grand_total', 'coupon_id'];

	protected $casts = [
		'items_qty' => 'double',
		'base_total' => 'double',
		'discount_total' => 'double',
		'grand_total' => 'double'
	];
	public function items() {
		return $this->hasMany(CartItem::class, 'cart_id', 'id');
	}
	public function user() {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
	public function coupon() {
		return $this->hasOne(Coupon::class, 'id', 'coupon_id');
	}
	public function address() {
		return $this->hasOne(Address::class, 'id', 'address_id');
	}

}