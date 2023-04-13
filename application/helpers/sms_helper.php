<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hiren Faldu
 */
class SMS {
	private $message = "";
	private $recipient = array();
	private $instance = "";
	private $otp = "";
	private $error_msg = "";

	function __construct()
	{
		$this->instance =& get_instance();
		$this->instance->config->load('sms');
	}

	function otp($otp) {
		$this->otp = $otp;
	}
	function message($msg_type) {
		switch ($msg_type) {
			case 'register_otp':
			$this->message = $this->instance->config->item($msg_type, 'sms');
			$this->message = str_replace('@OTP@', $this->otp, $this->message);
			break;

			default:
			$this->message = $this->instance->config->item('default', 'sms');
			break;
		}
	}
	function to() {
		$this->recipient = func_get_args();
	}

	function send() {
		if($this->message == '') {
			$this->error_msg = 'missing message!';
			return false;
		}
		if(!count($this->recipient)) {
			$this->error_msg = 'Invalid recipient(s)!';
			return false;
		}

		$curl = curl_init();
		$post_fields = array();
		$post_fields['sender'] = $this->instance->config->item('sender', 'sms');
		$post_fields['route'] = $this->instance->config->item('route', 'sms');
		$post_fields['country'] = $this->instance->config->item('country', 'sms');
		$post_fields['sms'][0] = array(
			'message' => $this->message,
			'to' => $this->recipient
		);
		$authkey = $this->instance->config->item('authkey', 'sms');
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->instance->config->item('url', 'sms'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($post_fields),
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTPHEADER => array(
				"authkey: ".$authkey,
				"content-type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			$this->error_msg = $err;
			return false;
		} else {
			$this->message = "";
			$this->recipient = array();
			$this->otp = "";
			$this->error_msg = "";
			return $response;
		}
	}

	function error() {
		return $this->error_msg;
	}
}
