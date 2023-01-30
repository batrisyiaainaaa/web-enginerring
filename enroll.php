<?php 

class Enroll extends CI_Model
{
    public function __construct() 
	{

		parent::__construct();
		//echo 'constructor';
	}

    function getSubjectData() 
	{
		$query = $this->db->get('subject');
		return $query->result();
    }

    function insertNewEnroll ($data){
        if($data){
            $this->db->trans_begin(true);

            $count = 0;

		if($count == 0) {
			$this->db->select_max('enrolId');
			$result = $this->db->get('Enrol');

			if($result->num_rows() > 0) {
				$cArray = $result->result_array();
				$cCount = $cArray[0]['enrolId'];
				$cNumber = $cCount + 1;
			} else {
				$cNumber = 10000;
			}

            $value = array(
				'subjectCode' => trim($data['sbjCode']),
                'studentId' => trim($data['stdId'])
			);

            $this->db->insert('enrol', $value);

        }
        else {
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
