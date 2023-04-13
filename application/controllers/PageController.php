<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageController extends CI_Controller {

	function index() {
		// redirect(base_url());
	}
	function error404()
	{
		if(ACCESS_GUARD=='api') {
			$this->output
				->set_content_type('application/json')
				->set_status_header(404)
				->set_output(json_encode(array(
						'status' => false,
					'message' => '404 page not found!'
				)));
		} else {
			$this->load->view('errors/html/error_404', ['heading' => '404 Page Not Found', 'message' => '<p>Oh Snap! You have hit the dead end!</p>']);
		}
	}
}