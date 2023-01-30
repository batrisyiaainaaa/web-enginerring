<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();
		$this->load->library('session');

	}

	function index(){

		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('http://localhost/group_project', 'refresh');
	}
}//end of class