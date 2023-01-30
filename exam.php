<?php

class Exam extends CI_Model {


	public function __construct() {

	parent::__construct();
	//echo 'constructor';
	}


public function getExamTimetableData($stdId) {

	$this->db->select('*');
	$this->db->from('enrol');
	$this->db->join('subject', 'subject.subjectCode = enrol.subjectCode');
	$this->db->where('enrol.studentId', $stdId);

	$query = $this->db->get();

	return $query->result();
}

}