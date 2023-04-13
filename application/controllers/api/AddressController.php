<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hiren Faldu
 */
class AddressController extends CI_Controller {

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
		$addresses = Address::select('id', 'name', 'email', 'contact_no', 'address1', 'address2', 'state', 'city', 'pincode', 'is_default')->where('user_id', $token['user_id'])->latest()->get();
		if(!count($addresses)) {
			$response['message'] = 'No address found!';
			goto indexResponse;
		}
		$response['status'] = true;
		$response['data']['addresses'] = $addresses;

		indexResponse:
		die(json_encode($response));
	}

	function store() {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;

		$address['name'] = $this->input->post('name', true);
		$address['email'] = $this->input->post('email', true);
		$address['contact_no'] = $this->input->post('contact_no', true);
		$address['address1'] = $this->input->post('address1', true);
		$address['address2'] = $this->input->post('address2', true);
		$address['state'] = $this->input->post('state', true);
		$address['city'] = $this->input->post('city', true);
		$address['pincode'] = $this->input->post('pincode', true);
		$address['user_id'] = $token['user_id'];

		$status = Address::create($address);
		if(!$status) {
			$response['message'] = 'Something went wrong!';
			goto storeResponse;
		}

		$response['status'] = true;
		$response['message'] = 'Address stored successfully!';

		storeResponse:
		die(json_encode($response));
	}

	function update($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;

		$address['name'] = $this->input->post('name', true);
		$address['email'] = $this->input->post('email', true);
		$address['contact_no'] = $this->input->post('contact_no', true);
		$address['address1'] = $this->input->post('address1', true);
		$address['address2'] = $this->input->post('address2', true);
		$address['state'] = $this->input->post('state', true);
		$address['city'] = $this->input->post('city', true);
		$address['pincode'] = $this->input->post('pincode', true);

		$status = Address::where('user_id', $token['user_id'])->find($id);
		if(!$status) {
			$response['message'] = 'Invalid address selected!';
		}
		if($status->update($address)) {
			$response['status'] = true;
			$response['message'] = 'Address updted successfully!';
			goto updateResponse;
		}

		$response['status'] = false;
		$response['message'] = 'Something went wrong!';

		updateResponse:
		die(json_encode($response));
	}

	function show($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$address = Address::select('id', 'name', 'email', 'contact_no', 'address1', 'address2', 'state', 'city', 'pincode', 'is_default')->where('user_id', $token['user_id'])->find($id);
		if(!$address) {
			$response['message'] = 'No address found!';
			goto indexResponse;
		}
		$response['status'] = true;
		$response['data']['address'] = $address;

		indexResponse:
		die(json_encode($response));
	}

	function destroy($id) {
		Auth::check();
		$token = Auth::$access_user;
		$response['status'] = false;
		$address = Address::where('user_id', $token['user_id'])->find($id);

		if(!$address) {
			$response['message'] = 'Invalid Address!';
			goto destroy;
		}
		if($address->cart) {
			$response['message'] = 'Address is in use on cart!';
			goto destroy;
		}
		$address->delete();
		$response['status'] = true;
		$response['message'] = 'Address deleted successfully!';
		destroy:
		die(json_encode($response));
	}
}