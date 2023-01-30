<?php

class Complain extends CI_Model {


	public function __construct() {

	parent::__construct();
	//echo 'constructor';
	}


function getComplainData() {

	$query = $this->db->get('complain');

	return $query->result();
}

function insertNewComplain($data){
	if($data){
		$this->db->trans_begin(true);

		// //check the duplication of account
		// $query = $this->db->get_where('loginstudent', array('email' => trim($data['studentId'])));
		$count = 0;

		if($count == 0) {
			$this->db->select_max('complainId');
			$result = $this->db->get('complain');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['complainId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'email' => trim($data['email']),
				'complainerName' => trim($data['complainerName']),
				'complainTitle' => trim($data['complainTitle']),
				'complainContent' => trim($data['complainContent']),
				'date' => trim($data['date']),
			);


	$this->db->insert('complain', $value);
   
  
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


}