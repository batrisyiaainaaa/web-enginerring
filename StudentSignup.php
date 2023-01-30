<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentSignup extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Student','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('student_signup_view');
		$this->load->view('footer');
	}

	function addnewStudent() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "studentFormSignUp";

		//define the rules of input validation
		$this->form_validation->set_rules('stdName', 'Student Name', 'trim|required');
		$this->form_validation->set_rules('stdProgram', 'Program Name', 'trim|required');
		$this->form_validation->set_rules('stdYear', 'Current year', 'trim|required');
		$this->form_validation->set_rules('stdPhone', 'Phone', 'trim|required|regex_match[/^[0-9]{11}$/]');
		$this->form_validation->set_rules('stdAdd1', 'Add1', 'trim|required');
		$this->form_validation->set_rules('stdCity', 'City', 'trim|required');
		$this->form_validation->set_rules('stdState', 'State', 'trim|required');
		$this->form_validation->set_rules('stdPostalCode', 'PostalCode', 'trim|required');
		$this->form_validation->set_rules('stdCountry', 'Country', 'trim|required');
		$this->form_validation->set_rules('stdEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('stdPassword', 'Password', 'trim|required|min_length[6]|max_length[20]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the Correct Information!</div>');
			$this-> load->view('header');
			$this-> load->view('student_signup_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['studName'] = $this->input->post('stdName');
			$data['studGender'] = $this->input->post('stdGender');
			$data['studProgram'] = $this->input->post('stdProgram');
			$data['studYear'] = $this->input->post('stdYear');
			$data['studPhone'] = $this->input->post('stdPhone');
			$data['studAdd1'] = $this->input->post('stdAdd1');
			$data['studAdd2'] = $this->input->post('stdAdd2');
			$data['studCity'] = $this->input->post('stdCity');
			$data['studState'] = $this->input->post('stdState');
			$data['studCode'] = $this->input->post('stdPostalCode');
			$data['studCountry'] = $this->input->post('stdCountry');
			$data['studEmail'] = $this->input->post('stdEmail');
			$data['studPassword'] = $this->input->post('stdPassword');

			//Pass the $data to model
			$this->load->model('Student', '', TRUE);
			$result = $this-> Student -> insertNewStudent($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Student was Added Succesfully!</div>');
				$this->load->view('header');
				$this->load->view('student_signup_view', $data);
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('header');
				$this->load->view('student_signup_view');
				$this->load->view('footer');
			}
		}
	}//end of addnew
}//end of class