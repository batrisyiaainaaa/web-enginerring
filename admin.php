<?php

class Admin extends CI_Model {

public function __construct() {

	parent::__construct();
	//echo 'constructor';
}

function insertNewAdmin($data){
	if($data){
		$this->db->trans_begin(true);

		//check the duplication of account
		$query = $this->db->get_where('loginadmin', array('email' => trim($data['adminEmail'])));
		$count = $query->num_rows();

		if($count == 0) {
			$this->db->select_max('adminId');
			$result = $this->db->get('admin');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['adminId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

			$value = array(
				'adminId' => $cNumber,
				'adminName' => trim($data['adminName']),
				'adminGender' => trim($data['adminName']),
				'adminGender' => trim($data['adminGender']),
				'adminPhoneNo' => trim($data['adminPhone']),
				'adminEmail' => trim($data['adminEmail']),
				'adminAddress1' => trim($data['adminAdd1']),
				'adminAddress2' => trim($data['adminAdd2']),
				'adminCity' => trim($data['adminCity']),
				'adminState' => trim($data['adminState']),
				'adminPostalCode' => trim($data['adminCode']),
				'adminCountry' => trim($data['adminCountry']),
			);

			$this->db->insert('admin', $value);
			
			$valuelogin = array(
				'adminId' => $cNumber,
				'email' => trim($data['adminEmail']),
				'password' => sha1($data['adminPassword'])
			);
			$this->db->insert('loginadmin', $valuelogin);
		
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
	$this->db->select('loginadmin.adminId, admin.adminName');
	$this->db->from('loginadmin');
	$this->db->join('admin', 'admin.adminId = loginadmin.adminId');
	$this->db->where('loginadmin.email', $email);
	$this->db->where('loginadmin.password', sha1($password));

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

function getAdminData($cNumber) {
	$this->db->select('*');
	$this->db->from('admin');
	$this->db->where('adminId', $cNumber);
	$query = $this->db->get();

	if($query->num_rows() == 1)
	{
		return $query->row_array();
	}else {
		return false;
	}

}

}//end of class
?>