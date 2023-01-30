<?php

class Student extends CI_Model {

public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewStudent($data){
	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		$query = $this->db->get_where('loginstudent', array('email' => trim($data['studEmail'])));
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
				'stdId' => $cNumber,
				'stdName' => trim($data['studName']),
				'stdGender' => trim($data['studName']),
				'stdGender' => trim($data['studGender']),
				'stdProgram' => trim($data['studProgram']),
				'stdCurrentYear' => trim($data['studYear']),
				'stdPhoneNo' => trim($data['studPhone']),
				'stdAddress1' => trim($data['studAdd1']),
				'stdAddress2' => trim($data['studAdd2']),
				'stdCity' => trim($data['studCity']),
				'stdState' => trim($data['studState']),
				'stdPostalCode' => trim($data['studCode']),
				'stdCountry' => trim($data['studCountry']),
			);

			$this->db->insert('student', $value);
			
			$valuelogin = array(
				'studentId' => $cNumber,
				'email' => trim($data['studEmail']),
				'password' => sha1($data['studPassword'])
			);
			$this->db->insert('loginstudent', $valuelogin);
		
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
}//end of addNewCustomer

function verifyLogin($email, $password)
{
	//echo sha1($password);
	$this->db->select('loginstudent.studentId, student.stdName');
	$this->db->from('loginstudent');
	$this->db->join('student', 'student.stdId = loginstudent.studentId');
	$this->db->where('loginstudent.email', $email);
	$this->db->where('loginstudent.password', sha1($password));

	$this->db->limit(1);
	$query = $this->db->get();

	//echo "1";
	$query->row_array();

	if($query->num_rows() == 1)
	{
		return $query->result();
		//echo "2";
	}
	else
	{
		//echo "3";
		return false;
	}

}

function getStudentData($stdId) {
	$this->db->select('*');
	$this->db->from('student');
	$this->db->where('stdId', $stdId);
	$query = $this->db->get();

	if($query->num_rows() == 1)
	{
		return $query->row_array();
	}else {
		return false;
	}
}

 public function getAllStudentData() {

	 	$query = $this->db->get('student');

	 	return $query->result();
	 }

public function updateStudent($data)
	{
		$value = array(
			'stdId' => trim($data['stdId']),
			'stdName' => trim($data['stdName']),
			'stdGender' => trim($data['stdGender']),
			'stdProgram' => trim($data['stdProgram']),
			'stdCurrentYear' => trim($data['stdCurrentYear']),
			'stdPhoneNo' => trim($data['stdPhoneNo']),
			'stdEmail' => trim($data['stdEmail']),
			'stdAddress1' => trim($data['stdAddress1']),
			'stdAddress2' => trim($data['stdAddress2']),
			'stdCity' => trim($data['stdCity']),
			'stdState' => trim($data['stdState']),
			'stdPostalCode' => trim($data['stdPostalCode']),
			'stdCountry' => trim($data['stdCountry']),
		);

		$this->db->where('stdId',$data['stdId']);

		if ($this -> db -> update('student',$value)) 
		{
		// echo 'update success';
		return true;
		} else 
		{
		// echo 'update error'
		return false;
		}

	}

}//end of class
?>