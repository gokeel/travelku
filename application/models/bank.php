<?php

class Bank extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function get_all_bank(){
		$this->db->order_by('bank_name asc');
		$query = $this->db->get('bank_accounts');
		return $query;
	}
	
	function get_all_bank_via(){
		$this->db->order_by('via asc');
		$query = $this->db->get('bank_via');
		return $query;
	}
	
	function add_to_table($table, $data){
		$insert = $this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function delete_from_table_by_id($table, $field_id, $id){
		$this->db->delete($table, array($field_id => $id));
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	public function get_detail_by_id($table, $field_id, $id){
		$this->db->where($field_id, $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function upd_bank($table, $field_id, $id, $data){
		$this->db->where($field_id, $id);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function add_confirm_payment($data){
		$this->db->insert('payments', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function get_payment_id($id){
		$this->db->select('order_id, status');
		$this->db->from('payments');
		$this->db->where('order_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			foreach ($query->result_array() as $row)
				$result = array ($row['order_id'], $row['status']);
		}
		else	$result = array(0, 0);
			
		return $result;
	}
	
	function get_order_id($id){
		$this->db->select('order_id');
		$this->db->from('payments');
		$this->db->where('payment_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			foreach ($query->result_array() as $row)
				$result = $row['order_id'];
		}
		else	$result = '';
			
		return $result;
	}
	
	function get_payment_list(){
		$this->db->select('trip_category, payments.*, bank_name, bank_account_number, orders.total_price, users.user_name, users.name as employee_name');
		$this->db->from('orders');
		$this->db->join('payments', 'orders.order_id = payments.order_id');
		$this->db->join('bank_accounts', 'payments.bank_receiver_id = bank_accounts.bank_id');
		$this->db->join('users', 'payments.validated_by = users.account_id', 'left');
		//$this->db->where('payments.status', 'requested');
		$this->db->order_by('payments.payment_id desc');
		$query = $this->db->get();
		return $query;
	}
	
	function update_payment_status($id, $status){
		$data = array('status' => $status);
		$this->db->where('payment_id', $id);
		$this->db->update('payments', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function get_exchanges($id=null){
		$this->db->from('exchange_rates');
		if($id<>null)
			$this->db->where('id', $id);
		$this->db->order_by('country_a');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_exchanges_by_detail($currency, $country){
		$this->db->from('exchange_rates');
		$this->db->where('currency_a', $currency);
		$this->db->where('country_a', $country);
		$this->db->order_by('country_a');
		$get = $this->db->get();
		if ($get->num_rows() > 0){
			foreach($get->result_array() as $row)
				return $row['rate_in_b'];
		}
		else
			return '0';
	}
}