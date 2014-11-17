<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webfront extends CI_Controller {

	public function index()
	{
		/* replaced with blue theme*/
		$this->session->set_userdata('akun_id', '2');
		$this->load->view('front_header');
		$this->load->view('front_tab_search_ticket');
		$this->load->view('front_homepage');
		$this->load->view('front_right_sidebar', array('column' => ''));
		$data['footer_column'] = '';
		$this->load->view('front_footer', $data);
		
		//$this->load->view('blue/home_fs_offer');
		//$this->load->view('homepage');
	}
	
	public function lama(){
		$this->load->view('header');
		$this->load->view('homepage');
		$this->load->view('footer');
	}
	
	function load_general_page($page_request, $design_column){
		$this->load->view('front_header');
		$this->load->view($page_request);
		$data['column'] = (strpos($design_column, 'second')!==false ? $design_column : '');
		$data['footer_column'] = (strpos($design_column, 'second')!==false ? '-second' : '');
		$this->load->view('front_right_sidebar', $data);
		$this->load->view('front_footer', $data);
	}
	
	public function faq(){
		$this->load_general_page('front_faq', '-second-faq');
	}
	
	public function contact(){
		$this->load_general_page('front_contact', '-second-contact');
	}
	
	public function registrasi(){
		$this->load_general_page('front_registrasi','-second-reg');
	}
	
	public function search_ticket(){
		$this->load_general_page('front_search_ticket', '-second-faq');
	}
	
	public function show_post(){
		$this->load_general_page('front_show_post', '-second-contact');
	}
	
	public function show_post_tour(){
		$this->load_general_page('front_post_in_tour', '-second-faq');
	}
	
	public function show_post_promo(){
		$this->load_general_page('front_post_in_promo', '-second-faq');
	}
	
	public function show_post_hotel(){
		$this->load_general_page('front_post_in_hotel', '-second-faq');
	}
	
	public function order_paket(){
		$this->load_general_page('front_order_paket', '-second-contact');
	}
	
	public function form_passengers(){
		$this->load_general_page('front_form_passengers', '-second-faq');
	}
	
	public function order_success(){
		$this->load_general_page('front_order_succeed', '-second-faq');
	}
	
	public function order_failed(){
		$this->load_general_page('front_order_failed', '-second-faq');
	}
	
	public function confirm_payment(){
		$this->load_general_page('front_confirm_payment', '-second-contact');
	}
	
	public function confirm_payment_tiketcom(){
		$this->load_general_page('front_confirm_payment_tiketcom', '-second-contact');
	}
	
	public function cancel_order_tiketcom(){
		$this->load_general_page('front_cancel_order_tiketcom', '-second-contact');
	}
	
	public function payment_method(){
		$this->load_general_page('front_payment_methods', '-second-contact');
	}
	
	public function tiketcom_choose_payment(){
		$this->load_general_page('front_tiketcom_choose_payment', '-second-faq');
	}
	
	//cindy nordiansyah
	public function form_detil_hotel(){
		$this->load_general_page('front_detail_hotel', '-second-faq');
	}
	//cindy nordiansyah
	public function order_hotel(){
		$this->load_general_page('front_order_hotel', '-second-faq');
	}
	
	//cindy nordiansyah
	public function customer_checkout(){
		$this->load_general_page('front_form_passengers', '-second-faq');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	public function paketwisata(){
		$this->load->view('header');
		$this->load->view('wisata');
		$this->load->view('footer');
	}
	
	public function agen(){
		$this->load->view('header');
		$this->load->view('agen');
		$this->load->view('footer');
	}
	
	public function hotel(){
		$this->load->view('header');
		$this->load->view('hotel');
		$this->load->view('footer');
	}
	
	public function tentang(){
		$this->load->view('header');
		$this->load->view('tentang');
		$this->load->view('footer');
	}
	
	public function promo(){
		$this->load->view('header');
		$this->load->view('promo');
		$this->load->view('footer');
	}
	
		public function kontak(){
		$this->load->view('header');
		$this->load->view('kontak');
		$this->load->view('footer');
	}
	
		public function paketdetailbelitung(){
		$this->load->view('header');
		$this->load->view('paketdetailbelitung');
		$this->load->view('footer');
	}
	
	public function paketdetailrajaampat(){
		$this->load->view('header');
		$this->load->view('paketdetailrajaampat');
		$this->load->view('footer');
	}
	
	
	
	
	
	public function subdomain(){
		$username = $this->input->get('username');
		$this->load->model('users');
		$account_id = $this->users->get_account_id_by_username($username);
		$this->session->set_userdata('akun_id', $account_id);
		$this->session->set_userdata('user_name', $username);
		
		$this->load->view('header');
		$this->load->view('homepage');
		$this->load->view('footer');
	}
	public function test(){
		print_r($this->config->item('account_id'));
		$this->config->set_item('account_id', '2');
		print_r($this->config->item('account_id'));
	}
	
	public function get_post_by_category(){
		$cat = $this->uri->segment(3);
		$cat_array = explode('-',$cat);
		$limit_start = $this->uri->segment(4);
		$limit_count = $this->uri->segment(5);
		$this->load->model('posts');
		$query = $this->posts->show_post_by_category($cat_array, $limit_start, $limit_count);
		foreach($query->result_array() as $row){
			$data[] = array(
				'id' => $row['post_id'],
				'category' => $row['category_name'],
				'content' => $row['content'],
				'title' => $row['title'],
				'is_promo' => $row['is_promo'],
				'price' => $row['price'],
				'author' => $row['user_name'],
				'point_reward' => $row['point_reward'],
				'image_file' => $row['image_file'],
				'point_reward' => $row['point_reward']
			);
		}
		echo json_encode($data);
	}
	public function count_post_by_category(){
		$cat = $this->uri->segment(3);
		$cat_array = explode('-',$cat);
		$this->load->model('posts');
		$query = $this->posts->count_post_by_category($cat_array);
		$data = array(
				'count' => $query
			);
		
		echo json_encode($data);
	}
	
	public function get_post_promo(){
		$limit_start = $this->uri->segment(3);
		$limit_count = $this->uri->segment(4);
		$this->load->model('posts');
		$query = $this->posts->show_post_in_promo($limit_start, $limit_count);
		foreach($query->result_array() as $row){
			$data[] = array(
				'id' => $row['post_id'],
				'category' => $row['category_name'],
				'content' => $row['content'],
				'title' => $row['title'],
				'is_promo' => $row['is_promo'],
				'price' => $row['price'],
				'author' => $row['user_name'],
				'point_reward' => $row['point_reward'],
				'image_file' => $row['image_file'],
				'point_reward' => $row['point_reward']
			);
		}
		echo json_encode($data);
	}
	
	public function count_post_promo(){
		$this->load->model('posts');
		$query = $this->posts->count_post_promo();
		$data = array(
				'count' => $query
			);
		
		echo json_encode($data);
	}
	
	public function load_theme($view, $data=null){
		$theme_name = 'blue';
		$this->load->view($theme_name.'/'.$view, $data);
	}
	public function show_packages(){
		$this->load_theme('package_list');
	}
	public function show_package_content(){
		$this->load_theme('package_details');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */