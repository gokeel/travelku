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
	
	function get_categories($is_paket=''){
		$this->db->select('*');
		$this->db->from('post_categories');
		if($is_paket<>'')
			$this->db->where('is_package', $is_paket);
		$this->db->order_by('id asc');
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
	
	function get_posts($paket){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('post_categories.is_package',$paket);
		$this->db->order_by('post_categories.category asc, posts.post_id desc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_posts_limited($limit_start, $limit_count){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->where('post_categories.is_package', 'true');
		$this->db->order_by('posts.post_id desc');
		$this->db->limit($limit_count, $limit_start);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_post_by_id($id, $images_additional=false){
		$select = 'posts.*, post_categories.category as category_name';
		if($images_additional)
			$select .= ', post_additional_images.*';
		$this->db->select($select);
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category=post_categories.id');
		if($images_additional)
			$this->db->join('post_additional_images', 'posts.post_id = post_additional_images.post_id','left');
		$this->db->where('posts.post_id', $id);
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
	
	function show_package_regular($limit_start, $limit_count){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('is_promo', 'false');
		$this->db->where('post_categories.is_package', 'true');
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
	
	function count_package_regular(){
		$this->db->select('posts.*, post_categories.category as category_name, users.user_name');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category = post_categories.id');
		$this->db->join('users', 'posts.author = users.account_id');
		$this->db->where('is_promo', 'false');
		$this->db->where('post_categories.is_package', 'true');
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
	
	function fetch_options(){
		$this->db->order_by('parameter asc');
		$get = $this->db->get('options');
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_post_shown_image_slider(){
		$this->db->select('posts.post_id, posts.mini_slogan, posts.image_file, posts.title, posts.currency, posts.price, post_categories.category');
		$this->db->from('posts');
		$this->db->join('post_categories', 'posts.category=post_categories.id');
		$this->db->where('shown_in_image_slider', 'true');
		$this->db->where('posts.status', 'publish');
		$this->db->where('posts.enabled', 'true');
		$this->db->order_by('posts.post_id desc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_reviews_by_post_id($id){
		$this->db->select('*');
		$this->db->from('post_reviews');
		$this->db->where('post_id', $id);
		$this->db->where('is_approved', 'true');
		$this->db->order_by('id desc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_images_by_post_id($id){
		$this->db->select('*');
		$this->db->from('post_additional_images');
		$this->db->where('post_id', $id);
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
	
	function get_reviews(){
		$this->db->select('posts.title, post_reviews.*');
		$this->db->from('posts');
		$this->db->join('post_reviews', 'posts.post_id=post_reviews.post_id');
		$this->db->order_by('id desc');
		$get = $this->db->get();
		if ($get->num_rows() > 0)
			return $get;
		else
			return false;
	}
}

?>