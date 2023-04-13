<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContentCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
        Auth::check();
        $this->load->helper('file');
    }
	public function index($page = '')
	{
		$data = [];
		if ($page == 'dmca') {
			$layoutData['page'] = 'content/dmca';
		}
		if ($this->input->method()=='post') {
			$content = $this->input->post('content',false);
			if ($this->input->post('page_type')=='dmca') {
				if (write_file(VIEWPATH.'content/dmca.php', $content)) {
					$data['success_msg'] = 'DMCA page has been updated!';
				}else{
					$data['error_msg'] = 'Failed to Update!';
				}
			}
		}
		$layoutData['pageTitle'] = WEBSITE_TITLE.'- Admin Panel';
		$layoutData['pageData'] = $data;
		$this->load->view('layout',$layoutData);
	}
}
