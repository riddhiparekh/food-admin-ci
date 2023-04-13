<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	function index()
	{
		$response = array();
		$credentials['contact_no'] = $this->input->post('username');
		$credentials['secret_key'] = $this->input->post('password');

		if(Auth::authenticate($credentials)) {
			$response['Authenticationkey'] = Auth::$access_token;
			$response['status'] = true;
			$response['message'] = 'Login Successful!';
			goto LoginResponse;
		}

		$response['status'] = false;
		$response['message'] = Auth::error();

		LoginResponse:
		die(json_encode($response));
	}

	function logout() {
		Auth::check();
		$user = Auth::$access_user;
		$status = UserSession::where('user_id', $user['user_id'])->delete();
		$response['status'] = false;
		$response['message'] = 'Failed to logout!';
		if($status) {
			$response['status'] = true;
			$response['message'] = 'Logout succcessful!';
		}
		die(json_encode($response));
	}

}