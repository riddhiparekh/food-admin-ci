<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WishlistController extends CI_Controller {

	function index() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = true;
		$wishlist = Product::join('wishlist', 'wishlist.product_id', '=', 'products.id')->where('wishlist.user_id', $token['user_id'])->select('products.id', 'products.name', 'products.sub_title', 'products.price', 'products.images')->get();
		if(count($wishlist)) {
			$response['data']['products'] = $wishlist;
			$response['data']['product_link'] = ASSET_URL.'images/product/';
		} else {
			$response['status'] = false;
			$response['message'] = 'No Products found!';
		}
		
		die(json_encode($response));
	}

	function store() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';
		$product = $this->input->post('product_id');
		$existing = Wishlist::where('product_id', $product)->where('user_id', $token['user_id'])->first();
		if($existing) {
			$existing = Wishlist::where('product_id', $existing->product_id)->where('user_id', $existing->user_id)->delete();
			if($existing) {
				$response['status'] = true;
				$response['message'] = 'Product removed from your wishlist!';
			}
		} else {
			$wishlist = new Wishlist;
			$wishlist->product_id = $product;
			$wishlist->user_id = $token['user_id'];
			if($wishlist->save()) {
				$response['status'] = true;
				$response['message'] = 'Product added to your wishlist!';
			}
		}

		die(json_encode($response));
	}
}