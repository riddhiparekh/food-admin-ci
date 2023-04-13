<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebMainController extends CI_Controller {
	function __construct() {
        parent::__construct();
    }
	public function index()
	{
		$data = array();
		$layoutData['page'] = 'web/home/home';
		$layoutData['pageTitle'] = WEBSITE_TITLE;
		$layoutData['pageData'] = $data;
		$this->load->view('web/layout',$layoutData);
	}
}
