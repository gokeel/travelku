<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {
	public function php_curl(){
		//echo "test curl";
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'http://api.sandbox.tiket.com/apiv1/payexpress?method=getToken&secretkey=34f08bda20602f4694c1466eefdd4a8e&output=json');
        if (curl_exec($ch) === FALSE) {
		   die("Curl Failed: " . curl_error($ch));
		} else {
		   echo curl_exec($ch);
		}
	}
	
	public function ci_curl($url){
		$this->load->library('curl');
		$this->curl->create($url);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (twh:20782180; Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML like Gecko) Chrome/22.0.1229.94 Safari/537.4');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		//$this->curl->option('HEADER', true);
		$this->curl->option('connecttimeout', 600);
		$data = $this->curl->execute();
		
		return $data;
	}
	
	function insert_event_logging($event_name, $request, $response, $method){
		$data = array(
			'event_name' => $event_name,
			'request_text' => $request,
			'response_text' => $response,
			'request_method' => $method
		);
		$this->load->model('general');
		$insert = $this->general->add_to_table('event_logs', $data);
	}
	
	public function get_token()
	{
		$url = 'http://'.$this->config->item('api_server').'/apiv1/payexpress?method=getToken&secretkey=' . $this->config->item('api_key_hotel').'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('get token', $url, $getdata, 'ci curl');
		
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
		$url = 'http://'.$this->config->item('api_server').'/search/autocomplete/hotel?q='.$area.'&token='.$this->get_token().'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel search autocomplete', $url, $getdata, 'ci curl');
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
		
		$token = $this->get_token();
		$this->session->set_userdata('token', $token);
		
		$url = 'http://'.$this->config->item('api_server').'/search/hotel?q='.$query.'&startdate='.$checkin.'&night='.$night.'&enddate='.$checkout.'&room='.$room.'&adult='.$adult.'&child='.$child.'&token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('search hotels', $url, $getdata, 'ci curl');
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
		$this->session->set_userdata('hotel_name', $nama_hotel); // save data to session
		
		$checkin = $this->input->get('startdate', TRUE);
		$checkout = $this->input->get('enddate', TRUE);
		$room = $this->input->get('room', TRUE);
		$night = $this->input->get('night', TRUE);
		$adult = $this->input->get('adult', TRUE);
		$child = $this->input->get('child', TRUE);
		$uid = $this->input->get('uid', TRUE);
		$token = '';
		if ($token =='') {
			$token = $this->get_token();
			$this->session->set_userdata('token', $token);
		}
		$url='http://'.$this->config->item('api_server').'/'.$nama_hotel.'?startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&uid='.$uid.'&token='.$token.'&output=json';
		//print_r($url);
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('show hotel rooms', $url, $getdata, 'ci curl');
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
		
		$url = 'http://'.$this->config->item('api_server').'/order/add/hotel?&startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&minstar='.$minstar.'&maxstar='.$maxstar.'&minprice='.$minprice.'&maxprice='.$maxprice.'&hotelname='.$hotelname.'&room_id='.$room_id.'&hasPromo='.$hasPromo.'&token='.$token.'&output=json';
		
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel add order', $url, $getdata, 'ci curl');
		
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
				$url_order = 'http://'.$this->config->item('api_server').'/order?token='.$json->token.'&lang=id&output=json';
				$send_order = $this->ci_curl($url_order);
				$this->insert_event_logging('hotel order', $url_order, $send_order, 'ci curl');
				
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
					//save to internal database for order log
					if($this->session->userdata('account_id')<>''){
						if ($this->session->userdata('account_id')=='1')
							$account_id = $this->config->item('account_id');
						else
							$account_id = $this->session->userdata('account_id');
					}
					else
						$account_id = $this->config->item('account_id');
							
					$total = $myorder->total;
					//save to db
					$data_insert = array(
						'3rd_party_order_id' => $myorder->order_id,
						'order_system_id' => 'tiketcom',
						'account_id' => $account_id,
						'trip_category' => 'hotel',
						'customer_email' => $this->input->post('conEmailAddress'),
						'hotel_id' => $room_id,
						'hotel_name' => $myorder->data[0]->order_name,
						'hotel_address' => $this->input->post('hotel_address'),
						'hotel_regional' => $this->input->post('regional'),
						'hotel_room_name' => $myorder->data[0]->order_name_detail,
						'hotel_room' => $room,
						'departing_date' => $checkin,
						'returning_date' => $checkout,
						'time_travel' => $night,
						'total_price' => $total,
						'admin_fee' => '10000',
						'adult' => $adult,
						'child' => $child,
						'order_status' => 'booked',
						'registered_date' => date('Y-m-d H:i:s')
					);
					$this->load->model('orders');
					$internal_order_id = $this->orders->add_order($data_insert);
					
					$contact_person = array(
						'order_id' => $internal_order_id,
						'passenger_level' => 'contact',
						'title' => $this->input->post('conSalutation', TRUE),
						'first_name' => $this->input->post('conFirstName', TRUE),
						'last_name' => $this->input->post('conLastName', TRUE),
						'identity_number' => $this->input->post('conid', TRUE),
						'email' => $this->input->post('conEmailAddress', TRUE),
						'nationality' => $this->input->post('country', TRUE),
						'phone_1' => $this->input->post('conPhone', TRUE)
					);
					$batch = $this->orders->add_passenger($contact_person);
					
					//generate parameter for form_passenger.php
					$response = array(
						'status' => $diagnose->status,
						'error' => '',
						'category' => 'hotel',
						'internal_order_id' => $internal_order_id,
						'order_id' => $myorder->order_id,
						'total_price' => $myorder->total,
						'checkout_uri' => $response_order->checkout,
						'token' => $response_order->token,
						'detail_id' => $myorder->data[0]->order_detail_id,
						'conEmailAddress' => $this->input->post('conEmailAddress', TRUE),
						'conFirstName' => $this->input->post('conFirstName', TRUE),
						'conLastName' => $this->input->post('conLastName', TRUE),
						'conPhone' => $this->input->post('conPhone', TRUE),
						'conSalutation' => $this->input->post('conSalutation', TRUE)
					);
					
					//save data contact person to session
					$this->session->set_userdata('con_salutation', $this->input->post('conSalutation'));
					$this->session->set_userdata('con_firstname', $this->input->post('conFirstName'));
					$this->session->set_userdata('con_lastname', $this->input->post('conLastName'));
					$this->session->set_userdata('con_phone', $this->input->post('conPhone'));
					$this->session->set_userdata('con_email', $this->input->post('conEmailAddress'));
					$this->session->set_userdata('country', $this->input->post('country'));
				}
			}
		$this->load_theme('issued_page', $response);
		
	}
	//cindy nordiansyah
	public function tiketcom_delete_order_hotel(){
		$token = $this->session->userdata('token');
		$order_detail_id = $this->input->get('order_detail_id', TRUE);
		
		$url = 'http://'.$this->config->item('api_server').'/order/delete_order?&order_detail_id='.$order_detail_id.'&token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('delete order', $url, $getdata, 'ci curl');
		
		$json = json_decode($getdata);
		//echo ($this->config->item('api_server').'/order/delete_order?order_detail_id='.$order_detail_id.'&token='.$token.'&output=json');
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
		$url = 'http://'.$this->config->item('api_server').'/order?&token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel show order', $url, $getdata, 'ci curl');
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
		$url = 'http://'.$this->config->item('api_server').'/order/checkout/'.$order_id.'/'.$currency.'?token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel checkout order', $url, $getdata, 'ci curl');
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
		
		$url = 'http://'.$this->config->item('api_server').'/checkout/checkout_customer?token='.$token.'&salutation='.$salutation.'&firstName='.$firstName.'&lastName='.$lastName.'&emailAddress='.$emailAddress.'&phone='.$phone.'&saveContinue='.$saveContinue.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel checkout login', $url, $getdata, 'ci curl');
		
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
		
		$url = 'http://'.$this->config->item('api_server').'/checkout/checkout_customer?token='.$token.'&salutation='.$salutation.'&firstName='.$firstName.'&lastName='.$lastName.'&emailAddress='.$emailAddress.'&phone='.$phone.'&detail_id='.$detailId.'&country='.$country.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel checkout customer', $url, $getdata, 'ci curl');
		
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
		
		$getdata = $this->ci_curl('http://'.$this->config->item('api_server').'/checkout/checkout_payment?token='.$token.'&output=json');
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
		
		$url = 'http://'.$this->config->item('api_server').'/checkout/checkout_payment?token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel checkout payment', $url, $getdata, 'ci curl');
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
		
		$url_1 = str_replace('https','http',$uri).'?'.$params.'lang=id&output=json';
		$checkout_page_request = $this->ci_curl($url_1);
		$this->insert_event_logging('hotel checkout', $url_1, $checkout_page_request, 'ci curl');
		if($checkout_page_request==""){
			$json_response['status'] = '1000';
			$json_response['message'] = 'Respon NULL pada checkout page request. Harap laporkan pada customer service kami.';
		}
		else{
			$response_1 = json_decode($checkout_page_request);
			$diagnose_1 = $response_1->diagnostic;
			if($diagnose_1->status<>'200'){
				$json_response['status'] = $diagnose_1->status;
				$json_response['message'] = 'Terjadi kesalahan pada saat checkout page request';
			}
			else
			{ //jika sukses, checkout login
				$cl_url = str_replace('https','http',$response_1->next_checkout_uri).'?';
				$token = $response_1->token;
				$param = 'token='.$token. '&salutation='.$this->session->userdata('con_salutation').'&firstName='.$this->session->userdata('con_firstname').'&lastName='.$this->session->userdata('con_lastname').'&emailAddress='.$this->session->userdata('con_email').'&phone='.$this->session->userdata('con_phone').'&saveContinue=2&lang=id&output=json';
				$cl_url .= $param;
				//print_r($cc_url);
				$send_request_2 = $this->ci_curl($cl_url);
				$this->insert_event_logging('hotel checkout login', $cl_url, $send_request_2, 'ci curl');
				if($send_request_2==""){
					$json_response['status'] = '1000';
					$json_response['message'] = 'Respon NULL pada checkout login. Harap laporkan pada customer service kami.';
				}
				else{
					$response_2 = json_decode($send_request_2);
					$diagnose_2 = $response_2->diagnostic;
					
					if($diagnose_2->status<>'200'){
						$json_response['status'] = $diagnose_2->status;
						$json_response['message'] = 'Terjadi kesalahan pada saat checkout login';
					}
					else{//jika sukses, checkout customer
						$cc_url = str_replace('https','http',$response_1->next_checkout_uri).'?';
						$params .=  '&salutation='.$this->session->userdata('con_salutation').'&firstName='.$this->session->userdata('con_firstname').'&lastName='.$this->session->userdata('con_lastname').'&emailAddress='.$this->session->userdata('con_email').'&phone='.$this->session->userdata('con_phone').'&country='.$this->session->userdata('country').'&lang=id&output=json';
						$cc_url .= $params;
						//print_r($cc_url);
						$send_request_3 = $this->ci_curl($cc_url);
						$this->insert_event_logging('hotel checkout customer', $cc_url, $send_request_3, 'ci curl');
						if($send_request_3==""){
							$json_response['status'] = '1000';
							$json_response['message'] = 'Respon NULL pada checkout customer. Harap laporkan pada customer service kami.';
						}
						else{
							$response_3 = json_decode($send_request_3);
							$diagnose_3 = $response_3->diagnostic;
							
							if($diagnose_2->status<>'200'){
								$json_response['status'] = $diagnose_3->status;
								$json_response['message'] = 'Terjadi kesalahan pada saat checkout login';
							}
							else{
								$json_response['status'] = $diagnose_3->status;
								$json_response['token'] = $response_3->token;
							}
						}						
					}
				}				
			}
		}
				
		echo json_encode($json_response);
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
	
	public function tiketcom_detail_room() {
		$nama_hotel = $this->session->userdata('hotel_name');
		$checkin = $this->input->get('startdate', TRUE);
		$checkout = $this->input->get('enddate', TRUE);
		$room = $this->input->get('room', TRUE);
		$night = $this->input->get('night', TRUE);
		$adult = $this->input->get('adult', TRUE);
		$child = $this->input->get('child', TRUE);
		$uid = $this->input->get('uid', TRUE);
		$token = $this->input->get('token', TRUE);
		if ($token =='') {
			$token = $this->get_token();
			$this->session->set_userdata('token', $token);
		}
		$url = 'http://'.$this->config->item('api_server').'/'.$nama_hotel.'?&startdate='.$checkin.'&enddate='.$checkout.'&night='.$night.'&room='.$room.'&adult='.$adult.'&child='.$child.'&uid='.$uid.'&token='.$token.'&output=json';
		$getdata = $this->ci_curl($url);
		$this->insert_event_logging('hotel detail room', $url, $getdata, 'ci curl');
		$json = json_decode($getdata);
		
		$array = array();
		$array[] = (object)$json;
		 
		if (isset($_GET['callback'])) {
				echo $_GET['callback'] . '('.json_encode($array).')';
			}
		else{
				echo '{"items":'. json_encode($array) .'}';
			}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */