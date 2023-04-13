<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
        Auth::check();
    }
	public function index()
	{
		$data = array();
		$this->load->model('CommonModel');
		$layoutData['page'] = 'dashboard/dashboard';
		$layoutData['pageTitle'] = WEBSITE_TITLE.'- Admin Panel';
		$layoutData['pageData'] = $data;
		$this->load->view('layout',$layoutData);
	}
}
