<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CouponController extends CI_Controller {

	function index() {
		Auth::check();
		$token = Auth::$access_user;

		$response['status'] = true;
		$coupon = Coupon::valid()->select('id', 'title', 'code', 'description')->get();
		if(count($coupon)) {
			$response['data']['coupons'] = $coupon;
		} else {
			$response['status'] = false;
			$response['message'] = 'No coupon found!';
		}
		die(json_encode($response));
	}

	function store($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Invalid coupon!';
		$coupon = Coupon::valid()->find($id);
		if(!$coupon) {
			goto store;
		}
		$cart = Cart::where('user_id', $token['user_id'])->first();
		if($cart->base_total < $coupon->min_order_value) {
			$response['message'] = "Your order value is below {$cart->min_order_value}";
			goto store;
		}
		$discount = $coupon->amount_type == 'percentage' ? ($cart->base_total * $coupon->amount / 100): $coupon->amount;
		$discount = $discount > 0 ? $discount : 0;
		if(!$discount) {
			goto store;
		}
		$cart->coupon_id = $id;
		$cart->discount_total = $discount;
		$cart->grand_total = $cart->base_total - $discount;
		if($cart->save()) {
			$response['status'] = true;
			$response['message'] = 'Coupon applied successfully!';
		}
		store:
		die(json_encode($response));
	}

	function destroy() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';
		$cart = Cart::where('user_id', $token['user_id'])->first();
		if(!$cart) {
			goto destroy;
		}
		$cart->grand_total = $cart->base_total + $cart->delivery_charge;
		$cart->coupon_id = 0;

		if($cart->save()) {
			$response['status'] = true;
			$response['message'] = 'Coupon removed successfully!';
		}
		destroy:
		die(json_encode($response));
	}

}