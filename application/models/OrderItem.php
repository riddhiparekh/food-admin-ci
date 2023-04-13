<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class OrderItem extends Eloquent {
	protected $table = "order_items"; // table name

	protected $fillable = ['order_id', 'product_id', 'product_name', 'qty', 'price', 'total' ,'message'];

	protected $casts = [
		'qty' => 'double',
		'price' => 'double',
		'total' => 'double'
	];
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
}