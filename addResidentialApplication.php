<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddResidentialApplication extends CI_Controller {

		function __construct()
		{
	        parent::__construct();

	        $this->load->model('ResidentialApplication','',TRUE);
	        $this->load->library('session');
	        $this->load->helper('form');
	        $this->load->helper('url');
	    }

	    public function index()
	    {
	        $stdId = $this->session->userdata['logged_in']['id'];
	    	$data['resident_data'] = $this -> ResidentialApplication -> getResidentialApplicationData($stdId);
	        $this->load->view('student_header_logged');
	        $this->load->view('add_residentialapplication_view', $data);
	        $this->load->view('footer');
	    }

	    function addnew() {
		//application form validation
		$this->load->library('form_validation');
		$data ['content'] = "formResidentialApplication";

		//define the rules of input validation
		$this->form_validation->set_rules('rSession', 'Session', 'trim|required');
		$this->form_validation->set_rules('rSemester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('rCollegeRequest', 'College Request', 'trim|required');
		$this->form_validation->set_rules('rDate', 'Date', 'trim|required');


		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to Residential Application page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the Correct Information!</div>');
			$stdId = $this->session->userdata['logged_in']['id'];
	    	$data['resident_data'] = $this -> ResidentialApplication -> getResidentialApplicationData($stdId);
			$this-> load->view('student_header_logged');
			$this-> load->view('add_residentialapplication_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['residentialApplicationSession'] = $this->input->post('rSession');
			$data['residentialApplicationSemester'] = $this->input->post('rSemester');
			$data['residentialApplicationCollegeRequest'] = $this->input->post('rCollegeRequest');
			$data['residentialApplicationDate'] = $this->input->post('rDate');
			$data['studentId'] = $this->session->userdata['logged_in']['id'];
		

			//Pass the $data to model
			$this->load->model('ResidentialApplication', '', TRUE);
			$result = $this-> ResidentialApplication -> insertNewResidentialApplication($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Information has been submitted successfully!</div>');
				$stdId = $this->session->userdata['logged_in']['id'];
	    		$data['resident_data'] = $this -> ResidentialApplication -> getResidentialApplicationData($stdId);
				$this->load->view('student_header_logged');
				$this->load->view('add_residentialapplication_view', $data);
				$this->load->view('footer');
			}
			else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('add_residentialapplication_view');
				$this->load->view('footer');
			}
		}
	}
}