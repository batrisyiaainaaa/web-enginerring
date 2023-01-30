<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminMain extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['adminName']  = $this->session->userdata['logged_in']['name'];
		$this->load->view('admin_header_logged');
		$this->load->view('admin_main_view', $data);
		$this->load->view('footer');
	}

}//end of class