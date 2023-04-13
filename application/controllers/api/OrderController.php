<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function index() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$orders = Order::with('items')->where('customer_id', $token['user_id'])->get();
		if(!$orders) {
			$response['message'] = 'No order found!';
		} else {
			$response['status'] = true;
			$response['data']['orders'] = $orders;
		}
		die(json_encode($response));
	}

	function show($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$orders = Order::with('items', 'address')->where('customer_id', $token['user_id'])->find($id);
		if(!$orders) {
			$response['message'] = 'No order found!';
		} else {
			$response['status'] = true;
			$response['data']['order'] = $orders;
		}
		die(json_encode($response));
	}

	function store() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Something went wrong.';
		$payment_method = $this->input->post('payment_method', true);
		if(!$payment_method) {
			$response['message'] = 'Please select payment mode.';
			goto store;
		}
		$cart = Cart::where('user_id', $token['user_id'])->first();
		if(!$cart) {
			$response['message'] = 'Cart is empty!';
			goto store;
		}
		if(!$cart->address_id) {
			$response['message'] = 'Please select address to move ahead!';
			goto store;
		}

		$order_data['customer_id'] = $token['user_id'];
		$order_data['delivery_boy_id'] = 0;
		$order_data['user_name'] = $cart->user->profile->name;
		$order_data['customer_email'] = $cart->user->email;
		$order_data['customer_contact'] = $cart->user->contact_no;
		$order_data['items_count'] = $cart->items_count;
		$order_data['items_qty'] = $cart->items_qty;
		$order_data['base_total'] = $cart->base_total;
		$order_data['discount_total'] = $cart->discount_total;
		$order_data['delivery_charge'] = $cart->delivery_charge;
		$order_data['grand_total'] = $cart->grand_total;
		$order_data['coupon_code'] = $cart->coupon ? $cart->coupon->code : null;
		$order_data['order_status'] = 'pending';
		$order = Order::create($order_data);
		if($order) {
			// Insert order items
			$cart_items = $cart->items;
			foreach ($cart_items as $item) {
				$order_item_data['order_id'] = $order->id;
				$order_item_data['product_id'] = $item->product_id;
				$order_item_data['product_name'] = $item->product->name;
				$order_item_data['qty'] = $item->qty;
				$order_item_data['price'] = $item->price;
				$order_item_data['total'] = $item->total;
				$order_item_data['message'] = $item->message;

				OrderItem::create($order_item_data);
			}
			// Insert shipping address
			$address = $cart->address;
			$order_address['name'] = $address->name;
			$order_address['email'] = $address->email;
			$order_address['contact_no'] = $address->contact_no;
			$order_address['address1'] = $address->address1;
			$order_address['address2'] = $address->address2;
			$order_address['state'] = $address->state;
			$order_address['city'] = $address->city;
			$order_address['pincode'] = $address->pincode;
			$order_address['order_id'] = $order->id;
			OrderAddress::create($order_address);
			// Insert Order payment details
			$payment['order_id'] = $order->id;
			$payment['payable_amount'] = $order->grand_total;
			$payment['paid_amount'] = 0;
			$payment['payment_method'] = $payment_method;
			$payment['payment_response'] = null;
			$payment['paid_on'] = null;
			if($payment_method != 'cod') {
				$payment['payment_response'] = $this->input->post('payment_response', true);
				$payment['paid_amount'] = $order->grand_total;
				$payment['paid_on'] = \Carbon\Carbon::now();
			}
			OrderPayment::create($payment);
			$cart->items()->delete();
			$cart->delete();
			$response['status'] = true;
			$response['message'] = 'Order placed successfully!';
		}
		store:
		die(json_encode($response));
	}
}