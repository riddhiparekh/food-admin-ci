<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginCtrl extends CI_Controller {

	public function login()
	{
		Auth::check(false);
		$data = array();
		if ($this->input->method() == 'post') {
			$creds['contact_no'] = $this->input->post('username',TRUE);
			$creds['secret_key'] = $this->input->post('password', TRUE);
			if(Auth::authenticate($creds)) {
				$this->session->set_flashdata('success_msg','Successfully Logged in!');
				redirect(base_url(''));
			} else {
				$data['errMsg'] = Auth::error();
			}
		}
		$this->load->view('login',$data);
	}
	public function logout()
	{
		$this->session->unset_userdata('auth_admin_data');
		redirect(base_url('login'));
	}
}
