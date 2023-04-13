<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends Eloquent {

	protected $table = "orders";

	protected $fillable = ['customer_id', 'delivery_boy_id', 'user_name', 'customer_email', 'customer_contact', 'items_count', 'items_qty', 'base_total', 'discount_total', 'delivery_charge', 'grand_total', 'coupon_code', 'order_status'];


	public function items() {
		return $this->hasMany(OrderItem::class, 'order_id', 'id');
	}

	public function address() {
		return $this->belongsTo(OrderAddress::class, 'id', 'order_id');
	}

	public function delivery_boy() {
		return $this->belongsTo(User::class, 'delivery_boy_id', 'id');
	}

	public function scopePendingOrders($query)
	{
		return $query->where('order_status', 'pending');
	}

	public function scopeAssignedOrders($query)
	{
		return $query->where('order_status', 'assigned');
	}

	public function scopeShippedOrders($query)
	{
		return $query->where('order_status', 'shipped');
	}
	
	public function scopeReadyToPickOrders($query)
	{
		return $query->where('order_status', 'ready_to_pick');
	}

	public function scopeCompletedOrders($query)
	{
		return $query->where('order_status', 'delivered');
	}
	
	public function scopeCancelledOrders($query)
	{
		return $query->where('order_status', 'rejected');
	}

	public function scopeNewOrders($query)
	{
		return $query->where(function($query) {
			$query->where('order_status', 'pending');
			$query->orWhere('order_status', 'ready_to_pick');
			$query->orWhere('order_status', 'assigned');
			$query->orWhere('order_status', 'shipped');
		});
	}
}