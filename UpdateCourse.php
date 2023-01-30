<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateCourse extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('course','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		// form validation
		$this->load->library('form_validation');
		$data ['content'] = "formUpdate";

		//define the rules of input validation
		$this->form_validation->set_rules('cName', 'Course Name', 'trim|required');
		$this->form_validation->set_rules('cDesc', 'Course Desription', 'trim|required');
		$this->form_validation->set_rules('cSyllabus', 'Course Syllabus', 'trim|required');
		$this->form_validation->set_rules('cCredits', 'Course Credits', 'trim|required');
		$this->form_validation->set_rules('cFee', 'Course Fee', 'trim|required');
		$this->form_validation->set_rules('lID', 'Lecturer ID', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the  Information Again!</div>');
			
			$courseId = $this->input->post('cID');
			$data = $this-> course ->getCourseData($courseId);
			$this-> load->view('admin_header_logged');
			$this-> load->view('course_details_view', $data);
			$this-> load->view('edit_course_view', $data);
			$this-> load->view('footer');
		}
		else
		{
			//Binding form data from view to array $data
			//$data['adminNumber'] = $this->session->userdata['logged_in']['id'];
			$data['courseId'] = $this->input->post('cID');
			$data['courseName'] = $this->input->post('cName');
			$data['courseDesc'] = $this->input->post('cDesc');
			$data['syllabus'] = $this->input->post('cSyllabus');
			$data['credits'] = $this->input->post('cCredits');
			$data['courseFee'] = $this->input->post('cFee');
			$data['lecturerId'] = $this->input->post('lID');

			//Pass the $data to model
			$this->load->model('Course', '', TRUE);
			$result = $this-> course -> updateCourse($data);

			if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">New Information was Updated Successfully!</div>');
				$courseId = $this->input->post('cID');
				$data['course_data'] = $this -> course -> getCourseData();
				$this-> load->view('admin_header_logged');
				$this-> load->view('course_details_view', $data);
				$this-> load->view('edit_course_view', $data);
				$this-> load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$data['course_data'] = $this -> course -> getCourseData();
				$this-> load->view('admin_header_logged');
				$this-> load->view('course_details_view', $data);
				$this-> load->view('edit_course_view', $data);
				$this-> load->view('footer');
			}
		} //form validation
	} //index function
}//class