<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Hiren Faldu
 */

class Auth {
	public static $error_msg = "";
	public static $access_token = "";
	public static $access_user = array();
	/**
	 * @param request array
	 * @return authentication status
	 */
	static function authenticate($request) {

		$instance =& get_instance();
		$instance->load->library('Password');

		if (!array_key_exists('contact_no', $request) && $request['contact_no'] == '') {
			self::$error_msg = 'Contact can\'t be empty!';
			return false;
		}
		if (!array_key_exists('secret_key', $request) && $request['secret_key'] == '') {
			self::$error_msg = 'Password can\'t be empty!';
			return false;
		}
		$contact = $request['contact_no'];
		$secret_key = $request['secret_key'];
		unset($request['contact_no']);
		unset($request['secret_key']);
		$user = User::where(function($query) use($contact) {
			$query->where('contact_no', $contact);
			$query->orWhere('email', $contact);
		});
		if(count($request) > 0) {
			foreach ($request as $column => $value) {
				$user->where($column, $value);
			}
		}
		$user = $user->first();
		if(!empty($user)) {
			if($instance->password->verify_hash($secret_key ,$user->secret_key)) {
				if(ACCESS_GUARD == 'api') {
					$token = self::generateToken($user->id);
					if($token == 'Token exists') {
						self::$error_msg = 'User Already Logged in!';
						return false;
					}
					$lastLog = Profile::find($user->id);
					$lastLog->last_login = Carbon\Carbon::now();
					$lastLog->save();
					self::$access_token = $token;
					return true;
				}
				$user->profile = $user->profile->user_role;
				$users = $user->toArray();
				$instance->session->set_userdata('auth_admin_data',$user);
				return true;
			}
			self::$error_msg = "Invalid Credentials!";
			return false;
		}
		self::$error_msg = "Invalid Credentials!";
		return false;
	}

	static function error() {
		return self::$error_msg;
	}

	static function check($status = true) {
		$instance =& get_instance();
		if(ACCESS_GUARD == 'api') {
			$headers = $instance->input->request_headers();
			if(array_key_exists('Authenticationkey', $headers)) {
				$status = UserSession::where('token', $headers['Authenticationkey'])->first();
				if($status) {
					self::$access_user = $status->toArray();
					return true;
				} else {
					die(json_encode(['status'=>false, 'message'=> 'Token Expired!']));
				}
			} else {
				die(json_encode(['status'=> false, 'message' => 'Unauthorized access!']));
			}
		} else {
			if(!$instance->session->userdata('auth_admin_data') && $status) {
				redirect(base_url('login'));
			} else if(!$status && $instance->session->userdata('auth_admin_data')) {
				redirect(base_url(''));
			}
		}
	}

	static function get($param = '') {
		$instance =& get_instance();
		$userdata = $instance->session->userdata('auth_admin_data');
		if($param)
			return @$userdata[$param];
		return $userdata;
	}

	static function can($permission) {
		$instance =& get_instance();
		$userdata = $instance->session->userdata('auth_admin_data');
		if($userdata['profile']['user_role'] == 'super-admin') {
			return true;
		}
		return false;
	}

	static function generateToken($user_id)
	{
		$instance =& get_instance();
		$exists = UserSession::where('user_id', $user_id)->first();
		if(!$instance->config->item('single_login') && $exists)
			return $exists->token;
		if($exists)
			return 'Token exists';
		$instance->load->helper('string');
		$instance->load->library('Password');
		do{
			$string = random_string(12);
			$token = $instance->password->hash($string);
			$status = UserSession::where('token', $token)->first();
		} while ($status);
		$session = new UserSession;
		$session->token = $token;
		$session->user_id = $user_id;
		$session->save();
		return $session->token;
	}
}