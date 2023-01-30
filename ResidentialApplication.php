<?php

class ResidentialApplication extends CI_Model {

	public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewResidentialApplication ($data){

	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		//$query = $this->db->get_where('Login', array('email' => trim($data['custEmail'])));
		$count = 0;

		if($count == 0) {
			$this->db->select_max('applicationId');
			$result = $this->db->get('ResidentialApplication');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['applicationId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'session' => trim($data['residentialApplicationSession']),
				'semester' => trim($data['residentialApplicationSemester']),
				'collegeRequest' => trim($data['residentialApplicationCollegeRequest']),
				'date' => trim($data['residentialApplicationDate']),
				'stdId' => trim($data['studentId']),
			);

			$this->db->insert('ResidentialApplication', $value);
			
			// $valuelogin = array(
			// 	'customerNumber' => $cNumber,
			// 	'email' => trim($data['custEmail']),
			// 	'password' => sha1($data['custPassword'])
			// );
			// $this->db->insert('login', $valuelogin);
		
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

function getResidentialApplicationData($stdId) 
	{
		$this->db->select('*');
		$this->db->from('ResidentialApplication');
		$this->db->where('stdId', $stdId);
		$query = $this->db->get();
		return $query->result();
	}
}
?>