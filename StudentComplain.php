<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentComplain extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Complain','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('student_header_logged');
		$this->load->view('student_complain_view');
		$this->load->view('footer');
	}

	function addnewComplain() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "studentFormComplain";

		//define the rules of input validation
		$this->form_validation->set_rules('cEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('cName', 'Complainer Name', 'trim|required');
		$this->form_validation->set_rules('cTitle', 'Complain Title', 'trim|required');
		$this->form_validation->set_rules('cContent', 'Complain Content', 'trim|required');
		$this->form_validation->set_rules('date', 'Complain Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the Correct Information!</div>');
			$this-> load->view('student_header_logged');
			$this-> load->view('student_complain_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['complainId'] = $this->input->post('cID');
			$data['email'] = $this->input->post('cEmail');
			$data['complainerName'] = $this->input->post('cName');
			$data['complainTitle'] = $this->input->post('cTitle');
			$data['complainContent'] = $this->input->post('cContent');
			$data['date'] = $this->input->post('date');

			//Pass the $data to model
			$this->load->model('complain', '', TRUE);
			$result = $this-> complain -> insertNewComplain($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Complain was Added Succesfully!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('student_complain_view');
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('student_complain_view');
				$this->load->view('footer');
			}
		}
	}//end of addnew

}//end of class