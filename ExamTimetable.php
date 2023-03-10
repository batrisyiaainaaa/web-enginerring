<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamTimetable extends CI_Controller {
	
	function __construct(){
		
		parent::__construct();

		$this->load->model('exam','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{	
		$stdId = $this->session->userdata['logged_in']['id'];
		$data['examtimetable_data'] = $this -> exam -> getExamTimetableData($stdId);

		$this->load->view('student_header_logged');
		$this->load->view('exam_timetable_view', $data);
		$this->load->view('footer');
	}

}//end of class