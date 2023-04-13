<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index($id)
	{
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$product = Product::select('id', 'name', 'sub_title', 'images', 'price', 'description')->find($id);

		if(!$product) {
			$response['message'] = 'Product not found!';
			goto Response;
		}
		$cartStatus = CartItem::join('cart', 'cart.id', '=', 'cart_items.cart_id')->select('cart_items.qty')->where('user_id', $token['user_id'])->where('product_id', $id)->first();
		$response['data']['product'] = $product->toArray();
		$response['data']['product']['added_to_cart'] = false;
		$wishStatus = Wishlist::where('user_id', $token['user_id'])->where('product_id', $id)->count();
		$response['data']['product']['liked'] = $wishStatus ? true : false;
		if($cartStatus) {
			$response['data']['product']['added_to_cart'] = true;
			$response['data']['product']['qty'] = $cartStatus->qty;
		}
		
		$response['data']['product_link'] = ASSET_URL.'images/product/';

		Response:
		die(json_encode($response));
	}
}