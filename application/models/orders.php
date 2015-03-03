<?php

class Orders extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function add_order($data){
		$id_inserted = 0;
		$ins = $this->db->insert('orders', $data);
		if ($this->db->affected_rows() > 0)
			$id_inserted = $this->db->insert_id();
		return $id_inserted;
	}
	
	function add_order_tiketcom($data){
		$id_inserted = 0;
		$ins = $this->db->insert('orders_in_tiketcom', $data);
		if ($this->db->affected_rows() > 0)
			$id_inserted = $this->db->insert_id();
		return $id_inserted;
	}
	
	function add_passenger($data){
		$this->db->insert('passenger_lists', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function get_registered_order($cat, $account_id=null, $all=null){
		$this->db->select('orders.*, agents.agent_name, payments.status, users.user_name as locked_by_name');
		$this->db->from('orders');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->join('users', 'orders.locked_by = users.account_id', 'left');
		if($all==null)
			$this->db->where("order_system_id = 'internal' and trip_category ='". $cat."' and (order_status = 'Registered' or order_status = 'Booked' or order_status = 'Paid')");
		else if($all==true)
			$this->db->where("order_system_id = 'internal' and trip_category ='". $cat);
		if($account_id<>null)
			$this->db->where('orders.account_id', $account_id);
		$this->db->order_by('orders.order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_issued_order($cat){
		$this->db->select('orders.*, agents.agent_name, payments.status as payment_status');
		$this->db->from('orders');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->where("order_system_id = 'internal' and trip_category ='". $cat."' and (order_status = 'Done' or order_status = 'Issued')");
		$this->db->order_by('orders.order_id desc');
		//$this->db->where("order_status = 'Registered' or order_status = 'Paid'");
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_cancelled_rejected_order_internal_nonpaket($cat, $status){
		$this->db->select('orders.*, agents.agent_name, payments.status as payment_status, reasons.reason');
		$this->db->from('orders');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->join('reasons', 'orders.order_id = reasons.order_id', 'left');
		$this->db->where("trip_category ='". $cat."' and order_status = '$status'");
		$this->db->order_by('orders.order_id desc');
		//$this->db->where("order_status = 'Registered' or order_status = 'Paid'");
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_order_list($all=null){
		$this->db->select('orders.*, agents.agent_name, agents.agent_username, payments.status, payments.transfer_date');
		$this->db->from('orders');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		if($all<>null)
			$this->db->where("order_status = 'Registered' or order_status = 'Booked' or order_status = 'booked'");
		$this->db->order_by('orders.order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_order_by_id($id, $is_paket=false){
		if($is_paket==false){
			$this->db->select('orders.*, agents.*, payments.status as payment_status, payments.transfer_date');
			$this->db->from('orders');
			$this->db->join('agents', 'orders.account_id = agents.agent_id');
			$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
			$this->db->where('orders.order_id', $id);
		}
			
		else {
			$this->db->select('orders.*, posts.title, posts.mini_slogan, posts.currency, post_categories.category, post_categories.description, agents.agent_name, payments.status as payment_status, payments.transfer_date');
			$this->db->from('orders');
			$this->db->join('posts', 'orders.post_id = posts.post_id');
			$this->db->join('post_categories', 'posts.category = post_categories.id');
			$this->db->join('agents', 'orders.account_id = agents.agent_id');
			$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
			$this->db->where('orders.order_id', $id);
		}
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_passenger($id, $level){
		$this->db->select('*');
		$this->db->from('passenger_lists');
		$this->db->where('order_id', $id);
		$this->db->like('passenger_level', $level);
		$this->db->order_by('order_list asc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function update_order_status($id, $status){
		$data = array('order_status' => $status);
		$this->db->where('order_id', $id);
		$this->db->update('orders', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function get_order_status($id){
		$this->db->select('order_status');
		$this->db->from('orders');
		$this->db->where('order_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			foreach ($query->result_array() as $row)
				$result = $row['order_status'];
		}
		else	$result = 0;
			
		return $result;
	}
	
	function add_edit_reason($id, $reason){
		$data = array(
			'order_id' => $id,
			'reason' => $reason
		);
		//cek exist
		$this->db->select('id');
		$this->db->from('reasons');
		$this->db->where('order_id', $id);
		$check = $this->db->get();
		
		if ($check->num_rows() == 0)
			$this->db->insert('reasons', $data);
		else {
			foreach ($check->result_array() as $row)
				$get_id = $row['id'];
			$this->db->where('id', $get_id);
			$this->db->update('reasons', $data);
		}
	}
	
	public function order_sum_omzet_daily($yymm){
		$query = $this->db->query('select substr(issued_date,1,10) as day_of_transaction, count(*) as transaction, sum(total_price) as omzet
								from orders
								where (order_status = "Issued" or order_status = "Done") and substr(issued_date,1,7)="'.$yymm.'"
								and account_id = '.$this->session->userdata('account_id').'
								group by substr(issued_date,1,10)
								order by substr(issued_date,1,10)');
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	public function order_sum_omzet_monthly($yy){
		$query = $this->db->query('select substr(issued_date,1,7) as month_of_transaction, count(*) as transaction, sum(total_price) as omzet
								from orders
								where (order_status = "Issued" or order_status = "Done") and substr(issued_date,1,4)="'.$yy.'"
								and account_id = '.$this->session->userdata('account_id').'
								group by substr(issued_date,1,7)
								order by substr(issued_date,1,7)');
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	public function get_order_paket_by_cat($cat, $order_status){
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		
	}
	
	public function get_registered_order_paket($cat, $account_id=null, $all=null){
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		
		$this->db->select('orders.*, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		// splitting categories into OR
		$where_string = '';
		if($cat_size==1)
			$where_string .= "post_categories.category = '".$cat[0]."'";
		else if ($cat_size>1){
			$cat_string='';
			$where = '(';
			foreach($cat as $val)
				$where .= 'post_categories.category = "'.$val.'" OR ';
			$where_string .= rtrim($where, 'OR ').')';
		}
		if($all==null)
			$where_string .= " and trip_category = 'paket' and (order_status = 'Registered' or order_status = 'Paid')";
		if($account_id<>null)
			$where_string .= " and account_id = '".$account_id."'";
		$this->db->where($where_string);
		$this->db->order_by('order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	public function get_registered_order_paket_2(){
		$this->db->select('orders.*, posts.currency, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status, users.user_name as locked_by_name');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->join('users', 'orders.locked_by = users.account_id', 'left');
		$where_string = "trip_category = 'paket' and (order_status = 'Registered' or order_status = 'Paid')";
		$this->db->where($where_string);
		$this->db->order_by('order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_issued_order_paket($cat){
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		
		$this->db->select('orders.*, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		// splitting categories into OR
		$where_string = '';
		if($cat_size==1)
			$where_string .= 'post_categories.category = "'.$cat[0].'"';
		else if ($cat_size>1){
			$cat_string='';
			$where = '(';
			foreach($cat as $val)
				$where .= 'post_categories.category = "'.$val.'" OR ';
			$where_string .= rtrim($where, 'OR ').')';
		}
		$where_string .= " and trip_category = 'paket' and (order_status = 'Done' or order_status = 'Issued')";
		$this->db->where($where_string);
		$this->db->order_by('order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_issued_order_paket_2(){
		$this->db->select('orders.*, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$where_string = "trip_category = 'paket' and (order_status = 'Done' or order_status = 'Issued')";
		$this->db->where($where_string);
		$this->db->order_by('order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_cancelled_order_paket($cat){
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		
		$this->db->select('orders.*, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status, reasons.reason');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->join('reasons', 'orders.order_id = reasons.order_id', 'left');
		// splitting categories into OR
		$where_string = '';
		if($cat_size==1)
			$where_string .= 'post_categories.category = "'.$cat[0].'"';
		else if ($cat_size>1){
			$cat_string='';
			$where = '(';
			foreach($cat as $val)
				$where .= 'post_categories.category = "'.$val.'" OR ';
			$where_string .= rtrim($where, 'OR ').')';
		}
		$where_string .= " and trip_category = 'paket' and (order_status = 'Cancelled' or order_status = 'Rejected')";
		$this->db->where($where_string);
		$this->db->order_by('orders.order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_cancelled_rejected_order_paket($status){
		$this->db->select('orders.*, posts.title, post_categories.category, post_categories.description, agents.agent_name, payments.status, reasons.reason');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->join('reasons', 'orders.order_id = reasons.order_id', 'left');
		$where_string = "trip_category = 'paket' and order_status = '$status'";
		$this->db->where($where_string);
		$this->db->order_by('orders.order_id desc');
		
		$query = $this->db->get();
		return $query;
	}
	
	function get_token_by_orderid($orderid){
		$this->db->select('token');
		$this->db->from('orders_in_tiketcom');
		$this->db->where('order_id', $orderid);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row)
				$token = $row['token'];
			return $token;
		}
		else
			return false;
	}
	
	function get_tiketcom_active_order_in_last_spesific_hours($datetime){
		$query = $this->db->query("select * from orders where order_system_id = 'tiketcom' and order_status <> 'issued' and order_status <> 'canceled' and registered_date >= '$datetime'");
		if($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function get_tiketcom_active_order_more_than_spesific_hours($datetime){
		$query = $this->db->query("select * from orders where order_system_id = 'tiketcom' and order_status <> 'issued' and order_status <> 'canceled' and registered_date < '$datetime'");
		if($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function get_tiketcom_orders_by_status($status){
		$this->db->select('orders.*, agents.agent_name, agents.agent_username, payments.status, payments.transfer_date');
		$this->db->from('orders');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		//$this->db->where('order_system_id', 'tiketcom');
		if($status=='booked')
			$this->db->where("order_system_id = 'tiketcom' and (order_status = 'Booked' or order_status = 'booked')");
		else if($status=='issued')
			$this->db->where("order_system_id = 'tiketcom' and (order_status = 'Issued' or order_status = 'issued')");
		else if($status=='canceled')
			$this->db->where("order_system_id = 'tiketcom' and (order_status = 'Cancelled' or order_status = 'Cancelled' or order_status = 'Canceled' or order_status = 'canceled')");
		else if($status=='rejected')
			$this->db->where("order_system_id = 'tiketcom' and (order_status = 'Rejected' or order_status = 'rejected')");
		
		$this->db->order_by('orders.order_id desc');
		//echo $this->db->get_compiled_select();
		$query = $this->db->get();
		if($query->num_rows > 0)
			return $query;
		else
			return false;
	}
	
	function agent_get_order_flight($agent_id){
		// collect order data in internal and tiketcom orders
		$query = $this->db->query("select if(order_system_id='internal', a.order_id, 3rd_party_order_id) as orderid, a.*, b.status as payment_status
					from orders a 
					left join payments b on a.order_id=b.order_id 
					where account_id = '$agent_id' and trip_category = 'flight' order by a.order_id desc");
		if($query->num_rows > 0)
			return $query;
		else
			return false;
	}
	
	function agent_get_order_hotel($agent_id){
		// collect order data in internal and tiketcom orders
		$query = $this->db->query("select if(order_system_id='internal', a.order_id, 3rd_party_order_id) as orderid, a.*, b.status as payment_status
					from orders a 
					left join payments b on a.order_id=b.order_id 
					where account_id = '$agent_id' and trip_category = 'hotel' order by a.order_id desc");
		if($query->num_rows > 0)
			return $query;
		else
			return false;
	}
	
	function agent_get_order_paket($agent_id){
		// collect order data in internal and tiketcom orders
		$this->db->select('orders.*, posts.title, posts.mini_slogan, posts.currency, post_categories.category, post_categories.description, agents.agent_name, payments.status as payment_status, payments.transfer_date');
		$this->db->from('orders');
		$this->db->join('posts', 'orders.post_id = posts.post_id');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('agents', 'orders.account_id = agents.agent_id');
		$this->db->join('payments', 'orders.order_id = payments.order_id', 'left');
		$this->db->where('orders.account_id', $agent_id);
		$this->db->order_by('orders.order_id desc');
		$query = $this->db->get();
		if($query->num_rows > 0)
			return $query;
		else
			return false;
	}
}

?>