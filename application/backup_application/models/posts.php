<?php

class Posts extends CI_Model {
	public function __construct() {
        parent::__construct();
    }
	
	function add_category($data){
		$this->db->insert('post_categories', $data);
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		else return false;
	}
	
	function get_categories(){
		$this->db->select('*')->from('post_categories')->order_by('id asc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_category_by_id($id){
		$this->db->select('*')->from('post_categories')->where('id', $id);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function edit_category($id, $data){
		$this->db->where('id', $id);
		$upd = $this->db->update('post_categories', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function del_category($id){
		$this->db->delete('post_categories', array('id' => $id));
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function del_post($id){
		$this->db->delete('posts', array('post_id' => $id));
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function add_blank_post(){
		$this->db->insert('posts', array('status'=>'draft', 'creation_date' => date('Y-m-d')));
		if ($this->db->affected_rows() > 0)
			return $this->db->insert_id();
		else return false;
	}
	
	function update_post($id, $data){
		$this->db->where('post_id', $id);
		$this->db->update('posts', $data);
		if ($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
	
	function get_posts(){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->order_by('post_categories.category asc, posts.post_id desc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_post_by_id($id){
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('post_id', $id);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_post_cat_by_id($id){
		$this->db->select('post_categories.*');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->where('post_id', $id);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function show_post_by_category($cat, $limit_start, $limit_count){ // $cat is array
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		if($cat_size==1)
			$this->db->where('post_categories.category', $cat[0]);
		else if ($cat_size>1){
			$cat_string='';
			foreach($cat as $val)
				$cat_string .= 'post_categories.category = "'.$val.'" OR ';
			$cat_fix = rtrim($cat_string, 'OR ');
			$this->db->where($cat_fix);
		}
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->order_by('posts.post_id desc');
		$this->db->limit($limit_count, $limit_start);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function count_post_by_category($cat){ // $cat is array
		$cat_size = sizeof($cat); // jika hanya 1 kategori, select where untuk 1 kategori saja. jika lebih dari 1, where bersifat OR
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		if($cat_size==1)
			$this->db->where('post_categories.category', $cat[0]);
		else if ($cat_size>1){
			$cat_string='';
			foreach($cat as $val)
				$cat_string .= 'post_categories.category = "'.$val.'" OR ';
			$cat_fix = rtrim($cat_string, 'OR ');
			$this->db->where($cat_fix);
		}
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->order_by('posts.post_id desc');
		$get = $this->db->get();
		
		return $get->num_rows();
	}
	
	function show_post_in_promo($limit_start, $limit_count){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('is_promo', 'true');
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->order_by('posts.post_id desc');
		$this->db->limit($limit_count, $limit_start);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function count_post_promo(){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('is_promo', 'true');
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->order_by('posts.post_id desc');
		$get = $this->db->get();
		
		return $get->num_rows();
		
	}
}

?>