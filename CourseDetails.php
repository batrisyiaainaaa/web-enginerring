<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseDetails extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('course','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{
		
		$data['course_data'] = $this -> course -> getCourseData();

		$this->load->view('student_header_logged');
		$this->load->view('course_details_view', $data);
		$this->load->view('footer');
	}

}//end of class