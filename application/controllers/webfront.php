<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webfront extends CI_Controller {

	public function index()
	{
		/* replaced with blue theme
		$this->session->set_userdata('akun_id', '2');
		$this->load->view('front_header');
		$this->load->view('front_tab_search_ticket');
		$this->load->view('front_homepage');
		$this->load->view('front_right_sidebar', array('column' => ''));
		$data['footer_column'] = '';
		$this->load->view('front_footer', $data);
		*/
		//get the image for image slider
		$this->load->model('posts');
		$slider = $this->posts->get_post_shown_image_slider();
		$index = 0;
		foreach($slider->result_array() as $row){
			$data['slider'][$index]['id'] = $row['post_id'];
			$data['slider'][$index]['mini_slogan'] = $row['mini_slogan'];
			$data['slider'][$index]['category'] = $row['category'];
			$data['slider'][$index]['image'] = $row['image_file'];
			$data['slider'][$index]['title'] = $row['title'];
			$data['slider'][$index]['currency'] = $row['currency'];
			$data['slider'][$index]['price'] = number_format($row['price'],0,',','.');
			$index++;
		}
		
		//get the latest post
		$top3 = $this->posts->get_posts_limited('0', '10');
		$index = 0;
		foreach($top3->result_array() as $row){
			$data['latest'][$index]['id'] = $row['post_id'];
			$data['latest'][$index]['category'] = ucwords($row['category_name']);
			$data['latest'][$index]['image'] = $row['image_file'];
			$data['latest'][$index]['title'] = $row['title'];
			$data['latest'][$index]['star_rating'] = $row['star_rating'];
			$data['latest'][$index]['currency'] = $row['currency'];
			$data['latest'][$index]['price'] = number_format($row['price'],0,',','.');
			$index++;
		}
		
		//get the umrah package
		$index = 0;
		$cat_array = array('umrah');
		$package = $this->posts->show_post_by_category($cat_array, '0', '3');
		foreach($package->result_array() as $row){
			$data['umrah'][$index]['id'] = $row['post_id'];
			$data['umrah'][$index]['category'] = ucwords($row['category_name']);
			$data['umrah'][$index]['image'] = $row['image_file'];
			$data['umrah'][$index]['title'] = $row['title'];
			$data['umrah'][$index]['star_rating'] = $row['star_rating'];
			$data['umrah'][$index]['currency'] = $row['currency'];
			$data['umrah'][$index]['price'] = number_format($row['price'],0,',','.');
			$index++;
		}
		
		//get the promo content
		$index = 0;
		$promo = $this->posts->show_post_in_promo('0', '6');
		foreach($promo->result_array() as $row){
			$data['promo'][$index]['id'] = $row['post_id'];
			$data['promo'][$index]['category'] = ucwords($row['category_name']);
			$data['promo'][$index]['image'] = $row['image_file'];
			$data['promo'][$index]['title'] = $row['title'];
			$data['promo'][$index]['star_rating'] = $row['star_rating'];
			$data['promo'][$index]['currency'] = $row['currency'];
			$data['promo'][$index]['price'] = number_format($row['price'],0,',','.');
			$index++;
		}
		
		//get the paket content
		$index = 0;
		$cat_array = array('tour','travel','umrah');
		$package = $this->posts->show_post_by_category($cat_array, '0', '6');
		foreach($package->result_array() as $row){
			$data['package'][$index]['id'] = $row['post_id'];
			$data['package'][$index]['image'] = $row['image_file'];
			$data['package'][$index]['title'] = $row['title'];
			$data['package'][$index]['currency'] = $row['currency'];
			$data['package'][$index]['price'] = number_format($row['price'],0,',','.');
			$index++;
		}
		
		
		//$this->load_theme('home_fs_offer', $data);
		$this->load_theme('home_3', $data);
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
	
	/*public function registrasi(){
		$this->load_general_page('front_registrasi','-second-reg');
	}*/
	
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
	
	/*public function confirm_payment(){
		$this->load_general_page('front_confirm_payment', '-second-contact');
	}
	
	public function confirm_payment_tiketcom(){
		$this->load_general_page('front_confirm_payment_tiketcom', '-second-contact');
	}
	
	public function cancel_order_tiketcom(){
		$this->load_general_page('front_cancel_order_tiketcom', '-second-contact');
	}*/
	
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
	
	public function load_theme($view, $additional_data=null){
		$theme_name = 'blue';
		
		$this->load->model('posts');
		$options = $this->posts->fetch_options();
		$data = array();
		
		foreach ($options->result_array() as $row)
			$data[$row['parameter']] = $row['value'];
		
		if(!empty($additional_data)){
			foreach($additional_data as $key => $val)
				$data[$key] = $val;
		}
		
		// get bank list
		$this->load->model('bank');
		$bank = $this->bank->get_all_bank();
		$index = 0;
		foreach ($bank->result_array() as $row){
			$data['bank'][$index]['id'] = $row['bank_id'];
			$data['bank'][$index]['image'] = $row['bank_logo'];
			$index++;
		}
		
		$this->load->view($theme_name.'/'.$view, $data);
	}
	public function show_packages(){
		$this->load->model('posts');
		
		//get paket pesawat
		$pesawat = $this->posts->show_post_by_category(explode('-','pesawat'), '0', '20');
		$index = 0;
		if($pesawat<>false){
			$data['pesawat_status'] = '200';
			foreach($pesawat->result_array() as $row){
				$data['pesawat'][$index]['id'] = $row['post_id'];
				$data['pesawat'][$index]['title'] = $row['title'];
				$data['pesawat'][$index]['price'] = number_format($row['price'],0,',','.');
				$index++;
			}
		}
		else
			$data['pesawat_status'] = '204';
	
		$this->load_theme('package_list', $data);
	}
	public function show_package_content(){
		$this->load->model('posts');
		$id = $this->uri->segment(3);
		
		//get content detail by ID
		$get = $this->posts->get_post_by_id($id);
		
		foreach ($get->result_array() as $row){
			$primary_image = $row['image_file'];
			$data = array(
				'post_id' => $row['post_id'],
				'post_category' => $row['category'],
				'post_title' => $row['title'],
				'post_content' => $row['content'],
				'post_price' => number_format($row['price'],0,',','.'),
				'post_image' => $row['image_file'],
				'post_mini_slogan' => $row['mini_slogan'],
				'post_publish_date' => $row['publish_date'],
				'currency' => $row['currency'],
				'post_star_rating' => $row['star_rating']
			);
		}
		// get the reviews
		$review = $this->posts->get_reviews_by_post_id($id);
		$index = 0;
		$user_rating = 0;
		if($review==false)
			$data['review_status'] = '204';
		else{
			$data['review_status'] = '200';
			foreach($review->result_array() as $row){
				$data['review'][$index]['name'] = $row['reviewer_name'];
				$data['review'][$index]['score'] = $row['evaluation_score'];
				$data['review'][$index]['title'] = $row['evaluation_title'];
				$data['review'][$index]['content'] = $row['evaluation_content'];
				$data['review'][$index]['date'] = date("d M Y", strtotime($row['submit_date']));
				$index++;
				$user_rating += intval($row['evaluation_score']);
			}
			$user_rating_avg = round($user_rating / $index, 1);
			$user_rating_rounded = round($user_rating_avg,0,PHP_ROUND_HALF_DOWN);
			$user_rating_percentage = ($user_rating_avg / 5)*100;
			$data['user_rating'] = $user_rating_avg;
			$data['user_rating_rounded'] = $user_rating_rounded;
			$data['user_rating_percentage'] = $user_rating_percentage;
			$data['total_review'] = $index;
		}
		
		
		//get images additional
		$data['images'] = array();
		array_push($data['images'], $primary_image);
		$images = $this->posts->get_images_by_post_id($id);
		if($images<>false){
			foreach($images->result_array() as $row){
				for($i=1;$i<=5;$i++){
					if($row['image_'.$i]<>'')
						array_push($data['images'], $row['image_'.$i]);
				}
			}
		}
		
		$this->load_theme('package_details', $data);
	}
	public function show_flight_list(){
		$this->load_theme('flight_list');
	}
	public function show_flight_return_list(){
		$this->load_theme('flight_list_return');
	}
	public function show_hotel_tiketcom_list(){
		$this->load_theme('hotel_tiketcom_list');
	}
	public function hotel_tiketcom_detail(){
		$this->load_theme('hotel_tiketcom_room_detail');
	}
	public function form_passenger_tiket(){
		$this->load_theme('form_passengers');
	}
	public function show_payment_methods(){
		$this->load_theme('payment_methods_tiketcom');
	}
	public function confirm_payment_tiketcom(){
		$this->load_theme('confirm_payment_tiketcom');
	}
	public function confirm_payment(){
		$this->load_theme('confirm_payment');
	}
	public function agent_registration(){
		$this->load_theme('agent_registration');
	}
	public function load_faq_content(){
		$this->load_theme('faq');
	}
	public function load_contact_content(){
		$this->load_theme('contact');
	}
	public function load_about_content(){
		$this->load_theme('about_us');
	}
	public function load_termcondition_content(){
		$this->load_theme('term_condition');
	}
	public function cancel_order_tiketcom(){
		$response = array(
			'status' => '',
			'message' => ''
		);
		$this->load_theme('cancel_order_tiketcom', $response);
	}
	
	public function package_buy_form(){
		$this->load->model('posts');
		$id = $this->uri->segment(3);
		$get = $this->posts->get_post_by_id($id);
		foreach ($get->result_array() as $row){
			$data = array(
				'id' => $row['post_id'],
				'category' => $row['category'],
				'title' => $row['title'],
				'content' => $row['content'],
				'is_promo' => $row['is_promo'],
				'currency' => $row['currency'],
				'price' => $row['price'],
				'status' => $row['status'],
				'enabled' => $row['enabled']				,
				'image' => $row['image_file'],
				'point_reward' => $row['point_reward']
			);
		}
		
		$this->load_theme('package_buyer_form', $data);
	}
	
	public function redirect_link(){
		$link = $this->input->get('redirect');
		redirect($link, 'refresh');
	}
	
	public function post_review(){
		$post = $this->input->post(NULL, TRUE);
		foreach($post as $key => $value)
			$data[$key] = $value;
		$data['submit_date'] = date('Y-m-d');
		$data['is_approved'] = 'false';
		
		$this->load->model('general');
		$insert = $this->general->add_to_table('post_reviews', $data);
		if($insert){
			//insert notification
			$notif = array(
				'category' => 'new-review',
				'message' => 'Review paket butuh di-approved',
				'created_datetime' => date('Y-m-d H:i:s')
			);
			$this->general->add_to_table('notifications', $notif);
			redirect(base_url().'index.php/webfront/show_package_content/'.$data['post_id'].'/success');
		}
		else
			redirect(base_url().'index.php/webfront/show_package_content/'.$data['post_id'].'/failed');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */