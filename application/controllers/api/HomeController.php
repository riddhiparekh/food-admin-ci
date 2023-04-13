<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index()
	{
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$categories = Category::where('is_active', 1)->where('parent_id', NULL)->select('id', 'name', 'sub_title', 'description', 'image')->get();
		if($categories) {
			$response['status'] = true;
			$response['data']['categories'] = $categories;
		} else {
			$response['message'] = 'Something went wrong!';
		}
		HomeResponse:
		die(json_encode($response));
	}
	
}