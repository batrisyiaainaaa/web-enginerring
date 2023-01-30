<?php

class Evaluation extends CI_Model {

public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewEvaluation($data){
	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		$query = $this->db->get_where('loginstudent', array('email' => trim($data['studentId'])));
		$count = $query->num_rows();

		if($count == 0) {
			$this->db->select_max('stdId');
			$result = $this->db->get('student');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['stdId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'studentId' => trim($data['studentId']),
				'courseId' => trim($data['courseId']),
				'date' => trim($data['date']),
				'sectionNo' => trim($data['sectionNo']),
				'year' => trim($data['studYear']),
				'semester' => trim($data['stdCurrentSemester']),
				'rating' => trim($data['rating']),
			);


	$this->db->insert('courseevaluation', $value);
   
  
  } else {
   $this->db->trans_rollback();
   return false;
  }


  if ($this->db->trans_status() === FALSE)
  {
   $this->db->trans_rollback();
   return false;
  } else {
   $this->db->trans_commit();
   return true;
  }


 } else {
  return false;
 }

}

function getEvaluationData($cNumber) {
	$this->db->select('*');
	$this->db->from('student');
	$this->db->where('stdId', $cNumber);
	$query = $this->db->get();

	if($query->num_rows() == 1)
	{
		return $query->row_array();
	}else {
		return false;
	}



}//end of class
}