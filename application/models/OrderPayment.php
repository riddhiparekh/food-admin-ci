<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class OrderPayment extends Eloquent {
	protected $table = "order_payments"; // table name

	protected $fillable = ['order_id', 'payment_method', 'payable_amount', 'paid_amount', 'payment_response', 'paid_on'];
}