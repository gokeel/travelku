<?php
//Cindy Nordiansyah
class Wisata_model extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	function add_order($data){
		$this->db->insert('orders', $data);
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		else return false;
	}
	
	function add_passenger($data){
		$this->db->insert('passenger_lists', $data);
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		else return false;
	}
}	