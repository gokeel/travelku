<?php
class Commission extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function get_commission_by_type($cat){
		$this->db->select('*')->from('commissions')->where('trip_category', $cat)->order_by('id asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function get_admin_fee($cat){
		$this->db->select('name, nominal');
		$this->db->from('commissions');
		$this->db->where('is_for_agent', 'false');
		$this->db->where('is_active', 'true');
		$this->db->where('trip_category', $cat);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function check_is_in_active_condition($match_season, $trip_category){
		$this->db->select('*');
		$this->db->from('commissions');
		$this->db->where('match_name', $match_season);
		$this->db->where('trip_category', $trip_category);
		$this->db->where('is_for_agent', 'true');
		$this->db->where('is_active', 'true');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	
}