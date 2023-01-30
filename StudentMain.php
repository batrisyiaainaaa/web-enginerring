<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentMain extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['stdName']  = $this->session->userdata['logged_in']['name'];
		$this->load->view('student_header_logged');
		$this->load->view('student_main_view', $data);
		$this->load->view('footer');
	}

}//end of class