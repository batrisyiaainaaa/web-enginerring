<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseEvaluation extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('Evaluation','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('student_header_logged');
		$this->load->view('CourseEvaluation_view');
		$this->load->view('footer');
	}

	function addnewEvaluation() {
		//signup form validation
		$this->load->library('form_validation');
		$data ['content'] = "formCourseEvaluation";

		//define the rules of input validation
		$this->form_validation->set_rules('courseId', 'Course', 'trim|required');
		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('sectionNo', 'Section Number', 'trim|required');
		$this->form_validation->set_rules('stdYear', 'Current year', 'trim|required');
		$this->form_validation->set_rules('stdCurrentSemester', 'Semester', 'trim|required');
		$this->form_validation->set_rules('rating', 'Rating', 'trim|required');
		

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to Course Evaluation page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the Correct Information!</div>');
			$this-> load->view('student_header_logged');
			$this-> load->view('CourseEvaluation_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			$data['studentId'] = $this->session->userdata['logged_in']['id'];
			$data['courseId'] = $this->input->post('courseId');
			$data['date'] = $this->input->post('date');
			$data['sectionNo'] = $this->input->post('sectionNo');
			$data['studYear'] = $this->input->post('stdYear');
			$data['stdCurrentSemester'] = $this->input->post('stdCurrentSemester');
			$data['rating'] = $this->input->post('rating');
			

			//Pass the $data to model
			$this->load->model('Evaluation', '', TRUE);
			$result = $this-> Evaluation -> insertNewEvaluation($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">Course Evaluation was Added Succesfully!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('CourseEvaluation_view', $data);
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('CourseEvaluation_view');
				$this->load->view('footer');
			}
		}
	}
}