<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hiren Faldu
 */
class CartController extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	/**
	 * @param none
	 * @return JSON Object of cart
	 */
	function index() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$cart = Cart::select('id', 'items_count', 'items_qty', 'base_total', 'discount_total', 'delivery_charge', 'grand_total', 'address_id')->where('user_id', $token['user_id'])->first();
		$address_id = $cart->address_id;
		if(!$cart) {
			$response['message'] = 'Cart is empty!';
			goto indexResponse;
		}
		$response['status'] = true;
		$response['data']['cart_items'] = CartItem::join('products', 'products.id', '=', 'cart_items.product_id')->where('cart_id', $cart->id)->get(['cart_items.id', 'cart_items.product_id', 'cart_items.price', 'cart_items.qty', 'cart_items.total', 'cart_items.message', 'products.name', 'products.sub_title']);
		unset($cart->id);
		unset($cart->address_id);
		$response['data']['cart'] = $cart;
		$response['data']['address'] = Address::select('id', 'name', 'email', 'contact_no', 'address1', 'address2', 'state', 'city', 'pincode')->where('user_id', $token['user_id'])->find($address_id);
		indexResponse:
		die(json_encode($response));
	}
	/**
	 * @param add item in cart
	 * @return status & cart
	 */
	function store() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;

		$product = $this->input->post('product_id');
		$qty = $this->input->post('qty') ?? 1;
		$message = $this->input->post('message');

		$item = Product::find($product);
		if(!$item) {
			$response['message'] = 'Invalid Product!';
			goto cartResponse;
		}
		$cart = Cart::where('user_id', $token['user_id'])->first();

		$total = $item->price * $qty;
		$cart_details = array();
		$cart_details['items_count'] = 1;
		$cart_details['items_qty'] = $qty;
		$cart_details['base_total'] = $total;
		$cart_details['address_id'] = 0;
		if($cart) {
			$cart_details['address_id'] = $cart->address_id;
			$cart_item = CartItem::updateOrCreate(
				['cart_id' => $cart->id, 'product_id' => $item->id],
				['price' => $item->price, 'qty' => $qty, 'total' => $total]
			);
			$cart_details = CartItem::selectRaw('count(product_id) as items_count, SUM(qty) as items_qty, SUM(total) as base_total')->where('cart_id', $cart->id)->first()->toArray();
			$cart_details['grand_total'] = $cart_details['base_total'];
			$status = Cart::updateOrCreate(
				['user_id' => $token['user_id']],
				$cart_details
			);
		} else {
			$cart_details['grand_total'] = $total;
			$cart_details['user_id'] = $token['user_id'];
			$cart = Cart::create($cart_details);
			$cart_item = array();
			$cart_item['cart_id'] = $cart->id;
			$cart_item['product_id'] = $item->id;
			$cart_item['price'] = $item->price;
			$cart_item['qty'] = $qty;
			$cart_item['total'] = $total;
			$status = CartItem::create($cart_item);
		}
		if($status) {
			$response['status'] = true;
			$response['message'] = 'Item Added to cart!';
		} else {
			$response['message'] = 'Failed to add item in cart!';
		}
		cartResponse:
		die(json_encode($response));
	}
	/**
	 * @param update item in cart
	 * @return status & updated cart
	 */
	function update($id) {
		Auth::check();
		$token = Auth::$access_user;
		// address update
		$address = Address::where('user_id', $token['user_id'])->find($id);
		$response['status'] = false;
		if(!$address) {
			$response['message'] = 'Invalid address selected!';
			goto updateResponse;
		}
		$cart = Cart::where('user_id', $token['user_id'])->first();
		if(!$cart) {
			$response['message'] = 'Cart is empty!';
			goto updateResponse;
		}
		$cart->address_id = $id;
		if($cart->save()) {
			$response['status'] = true;
			$response['message'] = 'Address selected!';
			goto updateResponse;
		}
		$response['message'] = 'Something went wrong!';

		updateResponse:
		die(json_encode($response));
	}
	/**
	 * @param remove item from cart
	 * @return status & new cart
	 */
	function destroy($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';
		if(!$id) {
			$response['message'] = 'Invalid Item to remove!';
		}
		$cart_item = CartItem::find($id);
		if(!$cart_item) {
			$response['message'] = 'Cart doesn\'t exists!';
			goto destroyResponse;
		}
		$cart_details = CartItem::selectRaw('count(product_id) as items_count, SUM(qty) as items_qty, SUM(total) as base_total')->where('cart_id', $cart_item->cart_id)->where('id','<>', $cart_item->id)->first()->toArray();
		$cart = Cart::find($cart_item->cart_id);
		if($cart->user_id != $token['user_id']) {
			$response['message'] = 'Unauthorized User!';
			goto destroyResponse;
		}
		if($cart_details['items_count'] == 0) {
			$cart->delete();
		} else {
			$cart->update($cart_details);
		}
		$cart_item->delete();
		$response['status'] = true;
		$response['message'] = 'Item has been removed from Cart!';

		destroyResponse:
		die(json_encode($response));
	}

}