<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {
	public function get_token()
	{
		$getdata = file_get_contents($this->config->item('api_server').'/apiv1/payexpress?method=getToken&secretkey=' . $this->config->item('api_key').'&output=json');
		$json = json_decode($getdata);
		$token = $json->token;
		return $token;
	}
	
	public function page()
	{
		$data = array(
			'title' => 'Pencarian Pesawat',
			'sub_title' => 'Pencarian cepat pesawat sesuai dengan kebutuhan anda.'
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('search_flight');
		$this->load->view('footer');
		
	}
	//cindy nordiansyah
	public function tiketcom_search_autocomplete(){
		$area = $this->input->get('area', TRUE);
		$getdata = file_get_contents($this->config->item('api_server').'/search/autocomplete/hotel?q='.$area.'&token='.$this->get_token().'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
	}
	//cindy nordiansyah
	public function tiketcom_search_hotels(){
		$query = $this->input->get('query', TRUE);
		$checkin = $this->input->get('checkin', TRUE);
		$checkout = $this->input->get('checkout', TRUE);
		$room = $this->input->get('room', TRUE);
		$night = $this->input->get('night', TRUE);
		$adult = $this->input->get('dewasa', TRUE);
		$child = $this->input->get('anak', TRUE);
		
		//$token = $this->session->userdata('token');
		//if ($token =='') {
			$token = $this->get_token();
			$this->session->set_userdata('token', $token);
		//}
		//echo ($this->config->item('api_server').'/search/hotel?q='.$query.'&startdate='.$checkin.'&night='.$night.'&enddate='.$checkout.'&room='.$room.'&adult='.$adult.'&child='.$child.'&token='.$token.'&output=json');
		$getdata = file_get_contents($this->config->item('api_server').'/search/hotel?q='.$query.'&startdate='.$checkin.'&night='.$night.'&enddate='.$checkout.'&room='.$room.'&adult='.$adult.'&child='.$child.'&token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
	}
	//cindy nordiansyah
	public function tiketcom_show_hotel_rooms() {
		$nama_hotel = $this->uri->segment(3);
		
		$checkin = $this->input->get('startdate', TRUE);
		$checkout = $this->input->get('enddate', TRUE);
		$room = $this->input->get('room', TRUE);
		$night = $this->input->get('night', TRUE);
		$adult = $this->input->get('adult', TRUE);
		$child = $this->input->get('child', TRUE);
		$uid = $this->input->get('uid', TRUE);
		$token = $this->input->get('uid', TRUE);
		if ($token =='') {
			$token = $this->get_token();
			$this->session->set_userdata('token', $token);
		}
		//$this->session->set_userdata('token', $token);
		//$getdata = file_get_contents($this->config->item('api_server').'/search/hotel?q='.$query.'&startdate='.$checkin.'&enddata='.$checkout.'&room='.$room.'&night='.$night.'&adult='.$adult.'&child='.$child.'&token='.$token.'&output=json');
		//echo ($this->config->item('api_server').'/'.$nama_hotel.'?&startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&uid='.$uid.'&token='.$token.'&output=json');
		$getdata = file_get_contents($this->config->item('api_server').'/'.$nama_hotel.'?&startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&uid='.$uid.'&token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		//https://api.master18.tiket.com/the-101-legian?startdate=2012-06-11&enddate=2012-06-12&night=1&room=1&adult=2&child=0&uid=business%3A4108&token=1c78d7bc29690cd96dfce9e0350cfc51&output=json				
	}
	//cindy nordiansyah
	public function tiketcom_add_order_hotel() {
		$token = $this->input->post('token',TRUE);
		/*if ($token =='') {
			$token = $this->get_token();
			$this->session->set_userdata('token', $token);
		}*/
		$checkin = $this->input->post('startdate', TRUE);
		$checkout = $this->input->post('enddate', TRUE);
		$room = $this->input->post('room', TRUE);
		$night = $this->input->post('night', TRUE);
		$adult = $this->input->post('adult', TRUE);
		$child = $this->input->post('child', TRUE);
		$minstar = $this->input->post('minstar', TRUE);
		$maxstar = $this->input->post('maxstar', TRUE);
		$minprice = $this->input->post('minprice', TRUE);
		$maxprice = $this->input->post('maxprice', TRUE);
		$hotelname = $this->input->post('hotelname', TRUE);
		$room_id = $this->input->post('room_id', TRUE);
		$hasPromo = $this->input->post('hasPromo', TRUE);
		
		$getdata = file_get_contents($this->config->item('api_server').'/order/add/hotel?&startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&minstar='.$minstar.'&maxstar='.$maxstar.'&minprice='.$minprice.'&maxprice='.$maxprice.'&hotelname='.$hotelname.'&room_id='.$room_id.'&hasPromo='.$hasPromo.'&token='.$token.'&output=json');
		$json = json_decode($getdata);
		$diagnose = $json->diagnostic;
			if($diagnose->status <> '200'){
				$response = array(
					'status' => $diagnose->status,
					'error' => $diagnose->error_msgs,
					'category' => 'hotel'
				);
			}
			else {
				// continue to order
				$url_order = $this->config->item('api_server').'/order?token='.$json->token.'&lang=id&output=json';
				$send_order = file_get_contents($url_order);
				$response_order = json_decode($send_order);
				$diagnose_order = $response_order->diagnostic;
				$myorder = $response_order->myorder;
				if($diagnose_order->status<>'200'){
					$response = array(
						'status' => $diagnose_order->status,
						'error' => $diagnose_order->error_msgs,
						'category' => 'hotel'
					);
				}
				else{ //jika sukses
					$total_before = intval($myorder->total_without_tax) + intval($myorder->total_tax);
					//save to db
					$data_insert = array(
						'order_id' => $response_order->myorder->order_id,
						'category' => 'hotel',
						'token' => $response_order->token,
						'delete_uri' => $myorder->data[0]->delete_uri,
						'price_no_discount' => $total_before,
						'price_with_discount' => $total_before - intval($myorder->discount_amount),
						'status' => 'checkout'
					);
					$this->load->model('orders');
					$internal_order_id = $this->orders->add_order_tiketcom($data_insert);
					
					//generate parameter for form_passenger.php
					$response = array(
						'status' => $diagnose->status,
						'error' => '',
						'category' => 'hotel',
						'internal_order_id' => $internal_order_id,
						'order_id' => $myorder->order_id,
						'price' => $myorder->total_without_tax,
						'tax' => $myorder->total_tax,
						'total_price' => $total_before,
						'checkout_uri' => $response_order->checkout,
						'token' => $response_order->token,
						'detail_id' => $myorder->data[0]->order_detail_id,
						'conEmailAddress' => $this->input->post('conEmailAddress', TRUE),
						'conFirstName' => $this->input->post('conFirstName', TRUE),
						'conLastName' => $this->input->post('conLastName', TRUE),
						'conPhone' => $this->input->post('conPhone', TRUE),
						'conSalutation' => $this->input->post('conSalutation', TRUE)
					);
				}
			}
		$this->load_theme('issued_page', $response);
		
	}
	//cindy nordiansyah
	public function tiketcom_delete_order_hotel(){
		$token = $this->session->userdata('token');
		$order_detail_id = $this->input->get('order_detail_id', TRUE);
		$getdata = file_get_contents($this->config->item('api_server').'/order/delete_order?&order_detail_id='.$order_detail_id.'&token='.$token.'&output=json');
		$json = json_decode($getdata);
		echo ($this->config->item('api_server').'/order/delete_order?order_detail_id='.$order_detail_id.'&token='.$token.'&output=json');
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		redirect(base_url('index.php/webfront/order_hotel'));
		//https://api.master18.tiket.com/order/delete_order?order_detail_id=31406
	}
	//cindy nordiansyah
	public function tiketcom_show_order_hotel(){
		$token = $this->session->userdata('token');
		//echo ($this->config->item('api_server').'/order?&token='.$token.'&output=json');
		$getdata = file_get_contents($this->config->item('api_server').'/order?&token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		//https://api.master18.tiket.com/order?token=8f683005261f872fe5c044f9b7085162&output=json
	}
	//cindy nordiansyah
	public function tiketcom_checkout_order() {
		$token = $this->session->userdata('token');

		$order_id = $this->uri->segment(3);
		$currency = $this->uri->segment(4);
		//echo ($this->config->item('api_server').'/order/checkout/'.$order_id.'/'.$currency.'?token='.$token.'&output=json');
		$getdata = file_get_contents($this->config->item('api_server').'/order/checkout/'.$order_id.'/'.$currency.'?token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		redirect(base_url('index.php/webfront/customer_checkout/hotel'));
		//https://api.master18.tiket.com/order/checkout/120152/IDR
	}
	//cindy nordiansyah
	public function tiketcom_checkout_login() {
		$token = $this->session->userdata('token');
		$salutation = $this->input->get('salutation', TRUE);
		$firstName = $this->input->get('firstName', TRUE);
		$lastName = $this->input->get('lastName', TRUE);
		$emailAddress = $this->input->get('emailAddress', TRUE);
		$phone = $this->input->get('phone', TRUE);
		$saveContinue = $this->input->get('saveContinue', TRUE);
		$getdata = file_get_contents($this->config->item('api_server').'/checkout/checkout_customer?token='.$token.'&salutation='.$salutation.'&firstName='.$firstName.'&lastName='.$lastName.'&emailAddress='.$emailAddress.'&phone='.$phone.'&saveContinue='.$saveContinue.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		//https://api.master18.tiket.com/checkout/checkout_customer?token=87da88eaaa429d5513a3a3658b01701e&salutation=Ms&firstName=ba&lastName=ca&emailAddress=testing@yahoocom&phone=%2B62878434343&saveContinue=2&output=json
	}
	//cindy nordiansyah
	public function tiketcom_checkout_customer() {
		$token = $this->session->userdata('token');
		$salutation = $this->input->get('salutation', TRUE);
		$firstName = $this->input->get('firstName', TRUE);
		$lastName = $this->input->get('lastName', TRUE);
		$emailAddress = $this->input->get('emailAddress', TRUE);
		$phone = $this->input->get('phone', TRUE);
		$conSalutation = $this->input->get('conSalutation', TRUE);
		$conFirstName = $this->input->get('conFirstName', TRUE);
		$conLastName = $this->input->get('conLastName', TRUE);
		$conEmailAddress = $this->input->get('conEmailAddress', TRUE);
		$conPhone = $this->input->get('conPhone', TRUE);
		$detailId = $this->input->get('detailId', TRUE);
		$country = $this->input->get('country', TRUE);
		
		$getdata = file_get_contents($this->config->item('api_server').'/checkout/checkout_customer?token='.$token.'&salutation='.$salutation.'&firstName='.$firstName.'&lastName='.$lastName.'&emailAddress='.$emailAddress.'&phone='.$phone.'&detail_id='.$detailId.'&country='.$country.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
	
		//https://api.master18.tiket.com/checkout/checkout_customer?token=8f683005261f872fe5c044f9b7085162&salutation=Mrs&firstName=ba&lastName=ca&emailAddress=bibi@yahoocom&phone=%2B628888843&conSalutation=Mrs&conFirstName=a&conLastName=a&conEmailAddress=bibi@yahoocom&conPhone=%2B628888843&detailId=31406&country=id&output=json
	}
	//cindy nordiansyah
	public function tiketcom_available_payment() {
		$token = $this->session->userdata('token');
		
		$getdata = file_get_contents($this->config->item('api_server').'/checkout/checkout_payment?token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		//http://api.master18.tiket.com/checkout/checkout_payment?token=87da88eaaa429d5513a3a3658b01701e
	}
	//cindy nordiansyah
	public function tiketcom_checkout_payment() {
		$token = $this->session->userdata('token');
		
		$getdata = file_get_contents($this->config->item('api_server').'/checkout/checkout_payment?token='.$token.'&output=json');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}else{
				echo '{"items":'. json_encode($array) .'}';
			}
		//http://api.master18.tiket.com/checkout/checkout_payment?token=87da88eaaa429d5513a3a3658b01701e
	}
	public function tiketcom_checkout_all(){
		//checkout page request
		$gets = $this->input->post(NULL,TRUE);
		$params = '';
		foreach($gets as $key => $value)
			if($key<>'link')
				$params .= $key.'='.$value.'&';
		$uri = $this->input->post('link',TRUE);
		
		$url_1 = $uri.'?'.$params.'lang=id&output=json';
		$checkout_page_request = file_get_contents($url_1);
		$response_1 = json_decode($checkout_page_request);
		$diagnose_1 = $response_1->diagnostic;
		if($diagnose_1->status<>'200'){
			$json_response['status'] = $diagnose_1->status;
			$json_response['message'] = 'Terjadi kesalahan pada saat checkout page request';
			echo json_encode($json_response);
		}
		else
		{ //jika sukses, checkout login
			$cl_url = $response_1->next_checkout_uri.'?';
			$token = $response_1->token;
			$param = 'token='.$token. '&salutation=Mr&firstName=admin&lastName=hellotraveler&emailAddress=tiketcom@hellotraveler.co.id&phone=%2B628123081785&saveContinue=2&lang=id&output=json';
			$cl_url .= $param;
			//print_r($cc_url);
			$send_request_2 = file_get_contents($cl_url);
			$response_2 = json_decode($send_request_2);
			$diagnose_2 = $response_2->diagnostic;
			
			if($diagnose_2->status<>'200'){
				$json_response['status'] = $diagnose_2->status;
				$json_response['message'] = 'Terjadi kesalahan pada saat checkout login';
				echo json_encode($json_response);
			}
			else{//jika sukses, checkout customer
				$cc_url = $response_1->next_checkout_uri.'?';
				$params .=  '&salutation=Mr&firstName=admin&lastName=hellotraveler&emailAddress=tiketcom@hellotraveler.co.id&phone=%2B628123081785&country=id&lang=id&output=json';
				$cc_url .= $params;
				//print_r($cc_url);
				$send_request_3 = file_get_contents($cc_url);
				$response_3 = json_decode($send_request_3);
				$diagnose_3 = $response_3->diagnostic;
				
				if($diagnose_2->status<>'200'){
					$json_response['status'] = $diagnose_3->status;
					$json_response['message'] = 'Terjadi kesalahan pada saat checkout login';
					echo json_encode($json_response);
				}
				else{
					$json_response['status'] = $diagnose_3->status;
					$json_response['token'] = $response_3->token;
					echo json_encode($json_response);
				}
			}
		}
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
		
		$this->load->view($theme_name.'/'.$view, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */