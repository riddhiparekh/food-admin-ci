<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index($id)
	{
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$category = Category::select('id', 'name', 'sub_title', 'image', 'description', 'parent_id')->find($id);
		if(!$category) {
			$response['message'] = 'Category not found!';
			goto Response;
		}
		$response['data']['category'] = $category;
		if($category->parent_id) {
			$response['status'] = true;
			$response['data']['products'] = array();
			$response['data']['products'] = $category->products()->where('is_active', 1)->orderBy('id', 'desc')->get(['id', 'name', 'sub_title', 'price', 'images']);
			$response['data']['product_link'] = ASSET_URL.'images/product/';
		} else {
			$response['status'] = true;
			$response['data']['subcategories'] = Category::where('parent_id', $category->id)->select('id', 'name', 'sub_title', 'image')->get();
			unset($response['data']['category']['parent_id']);
		}
		
		Response:
		die(json_encode($response));
	}
}