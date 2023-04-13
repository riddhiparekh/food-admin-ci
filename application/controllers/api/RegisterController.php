<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller {

	function index() {
		Auth::check();
		$user = Auth::$access_user;
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';
		$auth_user = array();
		if($this->input->post('password', true)) {
			$auth_user['password'] = $this->input->post('password', true);
			$this->load->library('Password');
			$auth_user['secret_key'] = $this->password->hash($auth_user['password']);
		}
		if($this->input->post('email', true)) {
			$auth_user['email'] = $this->input->post('email', true);
		}
		$auth_user['name'] = $this->input->post('name', true);

		if(in_array('', $auth_user)) {
			$response['message'] = 'Fill Required Data!';
			goto RegisterResponse;
		}

		$status = User::find($user['user_id'])->update($auth_user);
		if(!$status) {
			goto RegisterResponse;
		}
		$profile = Profile::updateOrCreate(['user_id' => $user['user_id']], $auth_user);
		if($profile) {
			$response['status'] = true;
			$response['message'] = 'Registration Completed!';
		}

		RegisterResponse:
		die(json_encode($response));
	}
	function otp() {
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';

		$contact = $this->input->post('contact_no');
		if($contact == '') {
			$response['message'] = 'Please Enter mobile no!';
			goto OTPResponse;
		}
		UserOTP::where('contact_no', $contact)->delete();
		$otp = mt_rand(100000, 999999);
		$status = UserOTP::create([
			'contact_no' => $contact,
			'otp' => $otp,
			'valid_till' => '',
			'created_at' => ''
		]);
		if(!$status) {
			goto OTPResponse;
		}
		$this->load->helper('sms');
		$sms = new SMS();
		$sms->otp($otp);
		$sms->message('register_otp');
		$sms->to($contact);
		if($sms->send()) {
			$response['status'] = true;
			$response['message'] = 'OTP has been sent to your no. Please check your inbox!';
		}

		OTPResponse:
		die(json_encode($response));
	}

	function verify() {
		$response['status'] = false;
		$response['message'] = 'Something went wrong!';
		$response['redirect'] = 'register';
		$now = \Carbon\Carbon::now();
		$contact = $this->input->post('contact_no');
		$otp = $this->input->post('otp');
		$status = UserOTP::where('contact_no', $contact)->where('valid_till', '>=', $now)->first();
		if(!$status) {
			$response['message'] = 'OTP Expired!';
			$response['redirect'] = 'otp';
			goto VerifyResponse;
		}

		if($status->otp != $otp) {
			$response['message'] = 'Invalid OTP!';
			$response['redirect'] = 'verify';
			goto VerifyResponse;
		}
		
		$user = User::where('contact_no', $status->contact_no)->first();
		UserOTP::where('contact_no', $contact)->delete();
		if($user) {
			$token = Auth::generateToken($user->id);
			if($token == 'Token exists') {
				$response['message'] = 'User already logged in!';
				$response['redirect'] = 'login';
				goto VerifyResponse;
			}
			$profile = Profile::find($user->id);
			$response['status'] = true;
			$response['Authenticationkey'] = $token;
			if($profile) {
				$profile->update(['last_login' => \Carbon\Carbon::now()]);
				$response['message'] = 'Login Successful!';
				$response['redirect'] = 'home';
			} else {
				$response['message'] = 'Registration Successful!';
				$response['redirect'] = 'profile';
			}
			goto VerifyResponse;
		}

		$this->load->library('Password');
		$this->load->helper('string');
		$auth_user = array();
		$auth_user['contact_no'] = $status->contact_no;
		$auth_user['secret_key'] = $this->password->hash(random_string());
		$auth_user['oauth_provider'] = 'local';
		$auth_user['oauth_token'] = null;
		$status = User::create($auth_user);
		if(!$status) {
			$response['message'] = 'Something went wrong!';
			$response['redirect'] = 'register';
			goto VerifyResponse;
		}
		$response['status'] = true;
		$response['message'] = 'Registration Successful!';
		$response['redirect'] = 'profile';
		$response['Authenticationkey'] = Auth::generateToken($status->id);

		VerifyResponse:
		die(json_encode($response));
	}
}