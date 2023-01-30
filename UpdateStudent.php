<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateStudent extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('student','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		// form validation
		$this->load->library('form_validation');
		$data ['content'] = "formStudent";

		//define the rules of input validation
		$this->form_validation->set_rules('sName', 'Student Name', 'trim|required');
		$this->form_validation->set_rules('sGender', 'Student Gender', 'trim|required');
		$this->form_validation->set_rules('sProgram', 'Student Program', 'trim|required');
		$this->form_validation->set_rules('sCurrentYear', 'Current Year', 'trim|required');
		$this->form_validation->set_rules('sPhoneNo', 'Student Phone Number', 'trim|required|regex_match[/^[0-9]{11}$/]');
		$this->form_validation->set_rules('sEmail', 'Student Email', 'trim|required');
		$this->form_validation->set_rules('sAddress1', 'Student Address1', 'trim|required');
		$this->form_validation->set_rules('sCity', 'Student City', 'trim|required');
		$this->form_validation->set_rules('sState', 'Student State', 'trim|required');
		$this->form_validation->set_rules('sPostalCode', 'Student Postal Code', 'trim|required');
		$this->form_validation->set_rules('sCountry', 'Student Country', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the  Information Again!</div>');
			
			$stdId = $this->input->post('sID');
			$data = $this-> student ->getStudentData($stdId);
			$this-> load->view('student_header_logged');
			$this-> load->view('edit_student_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['stdId'] = $this->session->userdata['logged_in']['id'];
			$data['stdName'] = $this->input->post('sName');
			$data['stdGender'] = $this->input->post('sGender');
			$data['stdProgram'] = $this->input->post('sProgram');
			$data['stdCurrentYear'] = $this->input->post('sCurrentYear');
			$data['stdPhoneNo'] = $this->input->post('sPhoneNo');
			$data['stdEmail'] = $this->input->post('sEmail');
			$data['stdAddress1'] = $this->input->post('sAddress1');
			$data['stdAddress2'] = $this->input->post('sAddress2');
			$data['stdCity'] = $this->input->post('sCity');
			$data['stdState'] = $this->input->post('sState');
			$data['stdPostalCode'] = $this->input->post('sPostalCode');
			$data['stdCountry'] = $this->input->post('sCountry');

			//Pass the $data to model
			$this->load->model('student', '', TRUE);
			$result = $this-> student -> updateStudent($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Information was Updated Successfully!</div>');
				$stdId = $this->input->post('sID');
				//$data['student_data'] = $this -> student -> getStudentData();
				$this-> load->view('student_header_logged');
				$this-> load->view('edit_student_view', $data);
				$this-> load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$data['student_data'] = $this -> student -> getStudentData();
				$this-> load->view('student_header_logged');
				$this-> load->view('edit_student_view', $data);
				$this-> load->view('footer');
			}
		} //form validation
	} //index function
}//class