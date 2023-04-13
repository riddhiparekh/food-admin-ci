<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class CartItem extends Eloquent {
	protected $table = "cart_items"; // table name

	protected $fillable = ['product_id', 'qty', 'price', 'total' ,'message', 'cart_id'];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
}