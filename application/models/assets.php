<?php
//cindy nordiansyah
class Assets extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function get_data($table) {
		$sql = $this->db->get($table);
		return $sql;
	}
	
	function add_data($table,$data) {
		$insert = $this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function upd_data($table, $field_id, $id, $data){
		$this->db->where($field_id, $id);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	public function get_detail_by_id($table, $field_id, $id){
		$this->db->where($field_id, $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function del_data($table,$field_id,$id){
		$this->db->delete($table, array($field_id => $id));
		if ($this->db->affected_rows() > 0)
			return TRUE;
		else return FALSE;
	}
	
		
}

?>