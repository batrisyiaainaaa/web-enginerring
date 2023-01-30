<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Student','',TRUE);
		$this->load->model('Admin','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('login_view');
		$this->load->view('footer');
	}

	function verifyUser() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('cEmail', 'Login Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('cPassword', 'Login Password', 'trim|required|min_length[6]|max_length[20]');

		if($this->input->post('cUsertype') == 1)
		{
			if($this->form_validation->run() === FALSE)
			{
				//field validation failed. user redirected to login page
				$this->load->helper(array('form'));
				$this-> load->view('header');
				$this-> load->view('login_view');
				$this-> load->view('footer');
				$this-> session->set_flashdata('login_status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter a valid user email and login password!</div>');
			}
			else
			{
				//passed validation. Continue to verify user login details
				$email = $this->input->post('cEmail');
				$password = $this->input->post('cPassword');
				$cNumber = $this->checkStudentDatabase($email, $password);
				$data = $this->Student->getStudentData($cNumber);
				//var_dump($data);


				$this->load->view('student_header_logged');
				$this->load->view('student_main_view', $data);
				$this->load->view('footer');
			}
		}
		else if($this->input->post('cUsertype') == 2)
		{
			if($this->form_validation->run() === FALSE)
			{
				//field validation failed. user redirected to login page
				$this->load->helper(array('form'));
				$this-> load->view('header');
				$this-> load->view('login_view');
				$this-> load->view('footer');
				$this-> session->set_flashdata('login_status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter a valid user email and login password!</div>');
			}
			else
			{
				//passed validation. Continue to verify user login details
				$email = $this->input->post('cEmail');
				$password = $this->input->post('cPassword');
				$cNumber = $this->checkAdminDatabase($email, $password);
				$data = $this->Admin->getAdminData($cNumber);
				//var_dump($data);


				$this->load->view('admin_header_logged');
				$this->load->view('admin_main_view', $data);
				$this->load->view('footer');
			}
		}

		
	}

	function checkStudentDatabase($email, $password){

		//query the database
		$result = $this->Student->verifyLogin($email, $password);

		if($result)
		{
			$sess_array = array ();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->studentId,
					'name' => $row->stdName,
					'email' => $email
				);

				$studId = $row->studentId;
				$this->session->set_userdata('logged_in', $sess_array);
			}
			//var_dump($sess_array);
			return $studId;
		}
		else
		{
			$this->session->set_flashdata('login_status','<div class="alert" style="width:50%">User Record Not Found! Please enter a correct username and password.</div>');
			$this->load->view('header');
			$this->load->view('login_view');
			$this->load->view('footer');
		}
	}//end of checkDatabase

	function checkAdminDatabase($email, $password){

		//query the database
		$result = $this->Admin->verifyLogin($email, $password);

		if($result)
		{
			$sess_array = array ();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->adminId,
					'name' => $row->adminName,
					'email' => $email
				);

				$adminId = $row->adminId;
				$this->session->set_userdata('logged_in', $sess_array);
			}
			//var_dump($sess_array);
			return $adminId;
		}
		else
		{
			$this->session->set_flashdata('login_status','<div class="alert" style="width:50%">User Record Not Found! Please enter a correct username and password.</div>');
			$this->load->view('header');
			$this->load->view('login_view');
			$this->load->view('footer');
		}
	}//end of checkDatabase

}//end of class