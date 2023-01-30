<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSignup extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Admin','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('admin_header_logged');
		$this->load->view('admin_signup_view');
		$this->load->view('footer');
	}

	function addnewAdmin() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "adminFormSignup";

		//define the rules of input validation
		$this->form_validation->set_rules('admName', 'Name', 'trim|required');
		$this->form_validation->set_rules('admPhone', 'Phone', 'trim|required|regex_match[/^[0-9]{11}$/]');
		$this->form_validation->set_rules('admAdd1', 'Add1', 'trim|required');
		$this->form_validation->set_rules('admCity', 'City', 'trim|required');
		$this->form_validation->set_rules('admState', 'State', 'trim|required');
		$this->form_validation->set_rules('admPostalCode', 'PostalCode', 'trim|required');
		$this->form_validation->set_rules('admCountry', 'Country', 'trim|required');
		$this->form_validation->set_rules('admEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('admPassword', 'Password', 'trim|required|min_length[6]|max_length[20]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the Correct Information!</div>');
			$this-> load->view('admin_header_logged');
			$this-> load->view('admin_signup_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['adminName'] = $this->input->post('admName');
			$data['adminGender'] = $this->input->post('admGender');
			$data['adminPhone'] = $this->input->post('admPhone');
			$data['adminAdd1'] = $this->input->post('admAdd1');
			$data['adminAdd2'] = $this->input->post('admAdd2');
			$data['adminCity'] = $this->input->post('admCity');
			$data['adminState'] = $this->input->post('admState');
			$data['adminCode'] = $this->input->post('admPostalCode');
			$data['adminCountry'] = $this->input->post('admCountry');
			$data['adminEmail'] = $this->input->post('admEmail');
			$data['adminPassword'] = $this->input->post('admPassword');


			//Pass the $data to model
			$this->load->model('Admin', '', TRUE);
			$result = $this-> Admin -> insertNewAdmin($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Admin was Added Succesfully!</div>');
				$this->load->view('admin_header_logged');
				$this->load->view('admin_signup_view', $data);
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('admin_header_logged');
				$this->load->view('admin_signup_view');
				$this->load->view('footer');
			}
		}
	}//end of addnew
}//end of class