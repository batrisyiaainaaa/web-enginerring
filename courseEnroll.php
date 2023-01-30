<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseEnroll extends CI_Controller{
    
    function __construct(){
		
		parent::__construct();

		$this->load->model('enroll','',TRUE);
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index()
	{

        $data['subject_data'] = $this -> enroll -> getSubjectData();
        
		$this->load->view('student_header_logged');
		$this->load->view('course_enroll_view', $data);
		$this->load->view('footer');
	}

    function addEnroll(){
        $this->load->library('form_validation');
		$data ['content'] = "formEnroll";

		//define the rules of input validation
		$this->form_validation->set_rules('subjectCode', 'subjectCode', 'trim|required');

        
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if($this->form_validation->run() === FALSE)
		{
			//field validation failed. user redirected to signup page
			$this-> session->set_flashdata('status', '<div class="alert alert-danger text-center" style="width:60%">Error! Please Enter the  Information Again!</div>');
			$this->load->view('student_header_logged');
		    $this->load->view('course_enroll_view', $data);
		    $this->load->view('footer');
		}
		else
		{
            $data['sbjCode'] = $this->input->post('subjectCode');
            $data['stdId'] = $this->session->userdata['logged_in']['id'];

            //Pass the $data to model
			$this->load->model('enroll', '', TRUE);
			$result = $this-> enroll -> insertNewEnroll($data);

            if($result){
				$this->session->set_flashdata('status', '<div class="alert_green" style="width:60%">Enrolled Succesfully!</div>');
                $data['subject_data'] = $this -> enroll -> getSubjectData();
				$this->load->view('student_header_logged');
				$this->load->view('course_enroll_view', $data);
				$this->load->view('footer');
			}else{
				$this->session->set_flashdata('status', '<div class="alert" style="width:500px">Error! Please Try Again!</div>');
				$this->load->view('student_header_logged');
				$this->load->view('course_enroll_view', $data);
				$this->load->view('footer');
			}
        }
    }
}