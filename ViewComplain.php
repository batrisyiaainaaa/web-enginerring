<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewComplain extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('complain','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		
		$data['complain_data'] = $this -> complain -> getComplainData();

		$this->load->view('admin_header_logged');
		$this->load->view('admin_complain_view', $data);
		$this->load->view('footer');
	}

}//end of class