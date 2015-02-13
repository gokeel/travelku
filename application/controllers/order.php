<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct() {

        parent::__construct();

    	$this->load->model('orders');
		$this->load->model('bank');
		$this->load->model('general');
	}
	
	function get_content($URL){
        $this->load->library('curl');
		$this->curl->create($URL);
		$this->curl->option('buffersize', 10);
		$this->curl->option('useragent', 'Mozilla/5.0 (twh:20782180; Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML like Gecko) Chrome/22.0.1229.94 Safari/537.4');
		$this->curl->option('returntransfer', 1);
		$this->curl->option('followlocation', 1);
		//$this->curl->option('HEADER', true);
		$this->curl->option('connecttimeout', 600);
		$data = $this->curl->execute();
		
		return $data;
    }
	
	function get_lion_captcha()
	{	
		$getdata = $this->get_content($this->config->item('api_server').'/flight_api/getLionCaptcha?token='.$this->session->userdata('token').'&output=json');
		$json = json_decode($getdata);
		$lion_captcha = $json->lioncaptcha;
		$lion_session_id = $json->lionsessionid;
		
		return array ($lion_captcha, $lion_session_id);
	}
	
	public function get_token()
	{
		$getdata = $this->get_content($this->config->item('api_server').'/apiv1/payexpress?method=getToken&secretkey=' . $this->config->item('api_key').'&output=json');
		$json = json_decode($getdata);
		$token = $json->token;
		// set session token
		$this->session->set_userdata('active_token', $token);
		return $token;
	}
	
	public function price_passenger()
	{
		$this->load->view('header');
		$this->load->view('price_passenger');
		$this->load->view('footer');
	}
	
	public function order_page()
	{
		$data = array(
			'title' => 'Form Pemesanan Tiket',
			'sub_title' => 'Cara mudah pesan tiket'
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('order_page');
		$this->load->view('footer');
	}
	
	public function success()
	{	$order_id = $this->uri->segment(3);
		$data = array(
			'title' => 'Pemesanan Selesai dan Info Pembayaran',
			'sub_title' => '',
			'order_id' => $order_id
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('order_success', $data);
		$this->load->view('footer');
	}
	
	public function failed()
	{
		$data = array(
			'title' => 'Proses Order Gagal',
			'sub_title' => 'Harap cek kembali input anda atau hubungi administrator web anda'
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('footer');
	}
	
	public function add_flight_order()
	{
		$response = '';
		$flight_id_dep = $this->input->post('flight_id', TRUE);
		//$ret_flight_id = $this->input->post('ret_flight_id', TRUE);
		$airline_name_dep = $this->input->post('airline_name_dep', TRUE);
		$depart_date = $this->input->post('date_go', TRUE);
		$route = $this->input->post('route', TRUE);
		$time_travel_dep = $this->input->post('time_travel_dep', TRUE);
		$tot_price = $this->input->post('total_price', TRUE);
		$total_price_dep = $this->input->post('total_price_dep', TRUE);
		$price_adult_dep = $this->input->post('price_adult_dep', TRUE);
		$price_child_dep = $this->input->post('price_child_dep', TRUE);
		$price_infant_dep = $this->input->post('price_infant_dep', TRUE);
		$tot_child = $this->input->post('child', TRUE);
		$tot_adult = $this->input->post('adult', TRUE);
		$tot_infant = $this->input->post('infant', TRUE);
		$time_stamp = date ('Y-m-d H:i:s');
		$conSalutation = $this->input->post('conSalutation', TRUE);
		$conFirstName = $this->input->post('conFirstName', TRUE);
		$conLastName = $this->input->post('conLastName', TRUE);
		$conPhone = $this->input->post('conPhone', TRUE);
		$conEmailAddress = $this->input->post('conEmailAddress', TRUE);
		$conOtherPhone = $this->input->post('conOtherPhone', TRUE);
		
		/* for round trip*/
		$flight_id_ret = $this->input->post('flight_id_ret', TRUE);
		$airline_name_ret = $this->input->post('airlines_name_ret', TRUE);
		$depart_date_ret = $this->input->post('date_ret', TRUE);
		$time_travel_ret = $this->input->post('time_travel_ret', TRUE);
		$total_price_ret = $this->input->post('total_price_ret', TRUE);
		$price_adult_ret = $this->input->post('price_adult_ret', TRUE);
		$price_child_ret = $this->input->post('price_child_ret', TRUE);
		$price_infant_ret = $this->input->post('price_infant_ret', TRUE);
		
		if ($airline_name_dep == 'LION' || $airline_name_ret =='LION')
			list ($lioncaptcha, $lionsessionid) = $this->get_lion_captcha();
		$token = $this->session->userdata('token');
		//$account_id = ($this->session->userdata('account_id')<>'' ? $this->session->userdata('account_id'): $account_id = $this->config->item('account_id'));
		if($this->session->userdata('account_id')<>''){
			if ($this->session->userdata('account_id')=='1')
				$account_id = $this->config->item('account_id');
			else
				$account_id = $this->session->userdata('account_id');
		}
		else
			$account_id = $this->config->item('account_id');
		
		/*inserting the general info*/
		$data = array(
			'order_system_id' => 'internal',
			'account_id' => $account_id,
			'token' => $token,
			'customer_email' => $this->input->post('conEmailAddress', TRUE),
			'trip_category' => 'flight',
			'airline_name_depart' => $airline_name_dep,
			'airline_name_return' => $airline_name_ret,
			'flight_id_depart' => $flight_id_dep,
			'flight_id_return' => $flight_id_ret,
			'is_round_trip' => ($flight_id_ret == '' ? 'false' : 'true'),
			'route' => $route,
			'departing_date' => $depart_date,
			'returning_date' => $depart_date_ret,
			'time_travel' => $time_travel_dep,
			'time_travel_ret' => $time_travel_ret,
			'total_price' => $tot_price,
			'total_price_dep' => $total_price_dep,
			'total_price_ret' => $total_price_ret,
			'admin_fee' => '10000',
			'admin_fee_ret' => ($flight_id_ret == '' ? '' : '10000'),
			'adult' => $tot_adult,
			'price_adult' => $price_adult_dep,
			'price_adult_ret' => $price_adult_ret,
			'child' => $tot_child,
			'price_child' => $price_child_dep,
			'price_child_ret' => $price_child_ret,
			'infant' => $tot_infant,
			'price_infant' => $price_infant_dep,
			'price_infant_ret' => $price_infant_ret,
			'order_status' => 'Registered',
			'lion_captcha' => (isset($lioncaptcha) ? $lioncaptcha : ''),
			'lion_session_id' => (isset($lionsessionid) ? $lionsessionid : ''),
			'registered_date' => $time_stamp
		);
		
		$order_id = $this->orders->add_order($data);
		
		if ($order_id > 0){
			/*inserting the passenger info*/
			$passenger = array();
			$contact_person = array(
				'order_id' => $order_id,
					'passenger_level' => 'contact',
					'title' => $this->input->post('conSalutation', TRUE),
					'first_name' => $this->input->post('conFirstName', TRUE),
					'last_name' => $this->input->post('conLastName', TRUE),
					'identity_number' => $this->input->post('conid', TRUE),
					'email' => $this->input->post('conEmailAddress', TRUE),
					'phone_1' => $this->input->post('conPhone', TRUE)
			);
			array_push($passenger, $contact_person);
			for($i=1; $i<=$tot_adult; $i++){
				$adult = array(
					'order_id' => $order_id,
					'passenger_level' => 'adult'.$i,
					'title' => $this->input->post('titlea'.$i, TRUE),
					'first_name' => $this->input->post('firstnamea'.$i, TRUE),
					'last_name' => $this->input->post('lastnamea'.$i, TRUE),
					'identity_number' => $this->input->post('ida'.$i, TRUE),
					'birthday' => $this->input->post('birthdatea'.$i, TRUE),
					'nationality' => $this->input->post('passportnationalitya'.$i, TRUE),
					'baggage' => $this->input->post('dcheckinbaggagea1'.$i, TRUE),
					'baggage_return' => $this->input->post('rcheckinbaggagea1'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $adult);
			}
			for($i=1; $i<=$tot_child; $i++){
				$child = array(
					'order_id' => $order_id,
					'passenger_level' => 'child'.$i,
					'title' => $this->input->post('titlec'.$i, TRUE),
					'first_name' => $this->input->post('firstnamec'.$i, TRUE),
					'last_name' => $this->input->post('lastnamec'.$i, TRUE),
					'identity_number' => $this->input->post('idc'.$i, TRUE),
					'birthday' => $this->input->post('birthdatec'.$i, TRUE),
					'nationality' => $this->input->post('passportnationalityc'.$i, TRUE),
					'baggage' => $this->input->post('dcheckinbaggagec1'.$i, TRUE),
					'baggage_return' => $this->input->post('rcheckinbaggagec1'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $child);
			}
			for($i=1; $i<=$tot_infant; $i++){
				$infant = array(
					'order_id' => $order_id,
					'passenger_level' => 'infant'.$i,
					'title' => $this->input->post('titlei'.$i, TRUE),
					'first_name' => $this->input->post('firstnamei'.$i, TRUE),
					'last_name' => $this->input->post('lastnamei'.$i, TRUE),
					'identity_number' => $this->input->post('idi'.$i, TRUE),
					'birthday' => $this->input->post('birthdatei'.$i, TRUE),
					'parent' => $this->input->post('parenti'.$i, TRUE),
					'nationality' => $this->input->post('passportnationalityi'.$i, TRUE),
					'baggage' => $this->input->post('dcheckinbaggagei1'.$i, TRUE),
					'baggage_return' => $this->input->post('rcheckinbaggagei1'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $infant);
			}
			//print_r($passenger);
			$anyerror = 0;
			foreach ($passenger as $array){
				$batch = $this->orders->add_passenger($array);
				if ($batch==false)
					$anyerror ++;
			}
			if ($anyerror==0){
				//preparing to send email
				$content = array(
					'title' => $conSalutation,
					'order_id' => $order_id,
					'first_name' => $conFirstName,
					'last_name' => $conLastName,
					'airline_name' => $airline_name_dep,
					'route' => $route,
					'departure_date' => $depart_date,
					'time_travel' => $time_travel_dep,
					'adult' => $tot_adult,
					'child' => $tot_child,
					'infant' => $tot_infant,
					'total_price' => $tot_price,
					'admin_fee' => '10.000',
					'customer_email' => $conEmailAddress
				);
				
				//get email disribution
				$this->load->model('notification');
				list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-order-request');
				//sending email
				$email_config = array(
					'protocol' => 'mail',
					'mailpath' => '/usr/sbin/sendmail',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'mailtype' => 'html'
				);
				$this->load->library('email', $email_config);
				
				$this->email->from($email_sender, $sender_name);
				$this->email->to($conEmailAddress);
				$this->email->cc($cc);
				$this->email->bcc($bcc);
				
				$this->email->subject('Order Berhasil');
				$messages = $this->load->view('email_tpl/new_internal_flight_order', $content, TRUE);
				$this->email->message($messages);

				$this->email->send();
				//insert notification
				$notif = array(
					'category' => 'new-order-request',
					'message' => 'Order baru - Pesawat',
					'created_datetime' => date('Y-m-d H:i:s')
				);
				$this->general->add_to_table('notifications', $notif);
				//end notif
				//redirect(base_url('index.php/webfront/order_success/'.$order_id));
				$response = array(
					'status' => '200',
					'message' => 'Anda akan segera dihubungi oleh admin kami untuk proses lebih lanjut dalam 3 jam.',
					'method' => 'tiket_internal',
					'order_id' => $order_id,
					'total' => $tot_price
				);
			}
			else{
				$response = array(
					'status' => '204'
				);
			}
			$this->load_theme('booking_finished_page', $response);
				//redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function add_train_order()
	{
		$schedule_id = $this->input->post('id', TRUE);
		$train_id = $this->input->post('train_id', TRUE);
		$class = $this->input->post('class', TRUE);
		$subclass = $this->input->post('subclass', TRUE);
		$train_name = $this->input->post('train_name', TRUE);
		$depart_date = $this->input->post('date', TRUE);
		$route = $this->input->post('route', TRUE);
		$time_travel = $this->input->post('time_travel', TRUE);
		$tot_price_dep = $this->input->post('total_price_dep', TRUE);
		$price_adult = $this->input->post('price_adult', TRUE);
		$price_child = $this->input->post('price_child', TRUE);
		$price_infant = $this->input->post('price_infant', TRUE);
		$tot_child = $this->input->post('child', TRUE);
		$tot_adult = $this->input->post('adult', TRUE);
		$tot_infant = $this->input->post('infant', TRUE);
		$conSalutation = $this->input->post('conSalutation', TRUE);
		$conFirstName = $this->input->post('conFirstName', TRUE);
		$conLastName = $this->input->post('conLastName', TRUE);
		$conPhone = $this->input->post('conPhone', TRUE);
		$conEmailAddress = $this->input->post('conEmailAddress', TRUE);
		$conOtherPhone = $this->input->post('conOtherPhone', TRUE);
		$token = $this->session->userdata('token');
		$time_stamp = date ('Y-m-d H:i:s');
		//$account_id = ($this->session->userdata('account_id')<>'' ? $this->session->userdata('account_id'): $account_id = $this->config->item('account_id'));
		if($this->session->userdata('account_id')<>''){
			if ($this->session->userdata('account_id')=='1')
				$account_id = $this->config->item('account_id');
			else
				$account_id = $this->session->userdata('account_id');
		}
		else
			$account_id = $this->config->item('account_id');
		
		
		/*inserting the general info*/
		$data = array(
			'account_id' => $account_id,
			'token' => $token,
			'trip_category' => 'train',
			'train_name' => $train_name,
			'train_id' => $train_id,
			'train_class' => $class,
			'train_subclass' => $subclass,
			'route' => $route,
			'departing_date' => $depart_date,
			'time_travel' => $time_travel,
			'total_price' => $tot_price_dep,
			'adult' => $tot_adult,
			'price_adult' => $price_adult,
			'child' => $tot_child,
			'price_child' => $price_child,
			'infant' => $tot_infant,
			'price_infant' => $price_infant,
			'order_status' => 'Registered',
			'registered_date' => $time_stamp,
			'admin_fee' => '10000'
		);
		
		$this->load->model('orders');
		$order_id = $this->orders->add_order($data);
		//print_r($id);
		
		if ($order_id > 0){
			/*inserting the passenger info*/
			$passenger = array();
			$contact_person = array(
				'order_id' => $order_id,
					'passenger_level' => 'contact',
					'title' => $this->input->post('conSalutation', TRUE),
					'first_name' => $this->input->post('conFirstName', TRUE),
					'last_name' => $this->input->post('conLastName', TRUE),
					'identity_number' => $this->input->post('conid', TRUE),
					'email' => $this->input->post('conEmailAddress', TRUE),
					'phone_1' => $this->input->post('conPhone', TRUE)
			);
			array_push($passenger, $contact_person);
			for($i=1; $i<=$tot_adult; $i++){
				$adult = array(
					'order_id' => $order_id,
					'passenger_level' => 'adult'.$i,
					'title' => $this->input->post('titlea'.$i, TRUE),
					'first_name' => $this->input->post('firstnamea'.$i, TRUE),
					'last_name' => $this->input->post('lastnamea'.$i, TRUE),
					'identity_number' => $this->input->post('ida'.$i, TRUE),
					'birthday' => $this->input->post('birthdatea'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $adult);
			}
			for($i=1; $i<=$tot_child; $i++){
				$child = array(
					'order_id' => $order_id,
					'passenger_level' => 'child'.$i,
					'title' => $this->input->post('titlec'.$i, TRUE),
					'first_name' => $this->input->post('firstnamec'.$i, TRUE),
					'last_name' => $this->input->post('lastnamec'.$i, TRUE),
					'identity_number' => $this->input->post('idc'.$i, TRUE),
					'birthday' => $this->input->post('birthdatec'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $child);
			}
			for($i=1; $i<=$tot_infant; $i++){
				$infant = array(
					'order_id' => $order_id,
					'passenger_level' => 'infant'.$i,
					'title' => $this->input->post('titlei'.$i, TRUE),
					'first_name' => $this->input->post('firstnamei'.$i, TRUE),
					'last_name' => $this->input->post('lastnamei'.$i, TRUE),
					'identity_number' => $this->input->post('idi'.$i, TRUE),
					'birthday' => $this->input->post('birthdatei'.$i, TRUE),
					'parent' => $this->input->post('parenti'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $infant);
			}
			//print_r($passenger);
			$anyerror = 0;
			foreach ($passenger as $array){
				$batch = $this->orders->add_passenger($array);
				if ($batch==false)
					$anyerror ++;
			}
			if ($anyerror==0){
				//preparing to send email
				$content = array(
					'title' => $conSalutation,
					'order_id' => $order_id,
					'first_name' => $conFirstName,
					'last_name' => $conLastName,
					'train_name' => $train_name.' Kelas: '.$class.' Subclass: '.$subclass,
					'route' => $route,
					'departure_date' => $depart_date,
					'time_travel' => $time_travel,
					'adult' => $tot_adult,
					'child' => $tot_child,
					'infant' => $tot_infant,
					'total_price' => $tot_price_dep,
					'admin_fee' => '10000'
				);
				
				//get email disribution
				$this->load->model('notification');
				list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-order-request');
				//sending email
				$email_config = array(
					'protocol' => 'mail',
					'mailpath' => '/usr/sbin/sendmail',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'mailtype' => 'html'
				);
				$this->load->library('email', $email_config);
				
				$this->email->from($email_sender, $sender_name);
				$this->email->to($conEmailAddress);
				$this->email->cc($cc);
				$this->email->bcc($bcc);
				
				$this->email->subject('Order Berhasil');
				$messages = $this->load->view('email_tpl/new_train_order_request', $content, TRUE);
				$this->email->message($messages);

				$this->email->send();
				//insert notification
				$notif = array(
					'category' => 'new-order-request',
					'message' => 'Order baru - Kereta Api',
					'created_datetime' => date('Y-m-d H:i:s')
				);
				$this->general->add_to_table('notifications', $notif);
				//end notif
				$response = array(
					'status' => '200',
					'message' => 'Anda akan segera dihubungi oleh admin kami untuk proses lebih lanjut dalam 3 jam.',
					'method' => 'tiket_internal',
					'order_id' => $order_id,
					'total' => $tot_price_dep
				);
			}
			else{
				$response = array(
					'status' => '204'
				);
			}
			$this->load_theme('booking_finished_page', $response);
				//redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function add_hotel_order()
	{
		$id = $this->input->post('hotel_id', TRUE);
		$name = $this->input->post('hotel_name', TRUE);
		$address = $this->input->post('hotel_address', TRUE);
		$regional = $this->input->post('regional', TRUE);
		$checkin = $this->input->post('startdate', TRUE);
		$checkout = $this->input->post('enddate', TRUE);
		$night = $this->input->post('night', TRUE);
		$room = $this->input->post('room', TRUE);
		$room_name = $this->input->post('room_name', TRUE);
		$price = $this->input->post('price', TRUE);
		$tot_adult = $this->input->post('adult', TRUE);
		$tot_child = $this->input->post('child', TRUE);
		$conSalutation = $this->input->post('conSalutation', TRUE);
		$conFirstName = $this->input->post('conFirstName', TRUE);
		$conLastName = $this->input->post('conLastName', TRUE);
		$conPhone = $this->input->post('conPhone', TRUE);
		$conEmailAddress = $this->input->post('conEmailAddress', TRUE);
		$conOtherPhone = $this->input->post('conOtherPhone', TRUE);
		$token = $this->session->userdata('token');
		$time_stamp = date ('Y-m-d H:i:s');
		//$account_id = ($this->session->userdata('account_id')<>'' ? $this->session->userdata('account_id'): $account_id = $this->config->item('account_id'));
		if($this->session->userdata('account_id')<>''){
			if ($this->session->userdata('account_id')=='1')
				$account_id = $this->config->item('account_id');
			else
				$account_id = $this->session->userdata('account_id');
		}
		else
			$account_id = $this->config->item('account_id');
		
		
		/*inserting the general info*/
		$data = array(
			'account_id' => $account_id,
			'token' => $token,
			'trip_category' => 'hotel',
			'hotel_name' => $name,
			'hotel_id' => $id,
			'hotel_address' => $address,
			'hotel_regional' => $regional,
			'hotel_room' => $room,
			'hotel_room_name' => $room_name,
			'departing_date' => $checkin,
			'returning_date' => $checkout,
			'time_travel' => $night,
			'total_price' => $price,
			'admin_fee' => '10000',
			'adult' => $tot_adult,
			'child' => $tot_child,
			'order_status' => 'Registered',
			'registered_date' => $time_stamp
		);
		
		$this->load->model('orders');
		$order_id = $this->orders->add_order($data);
		//print_r($id);
		
		if ($order_id > 0){
			/*inserting the passenger info*/
			$passenger = array();
			$contact_person = array(
				'order_id' => $order_id,
					'passenger_level' => 'contact',
					'title' => $this->input->post('conSalutation', TRUE),
					'first_name' => $this->input->post('conFirstName', TRUE),
					'last_name' => $this->input->post('conLastName', TRUE),
					'identity_number' => $this->input->post('conid', TRUE),
					'email' => $this->input->post('conEmailAddress', TRUE),
					'phone_1' => $this->input->post('conPhone', TRUE)
			);
			array_push($passenger, $contact_person);
			for($i=1; $i<=$tot_adult; $i++){
				$adult = array(
					'order_id' => $order_id,
					'passenger_level' => 'adult'.$i,
					'title' => $this->input->post('titlea'.$i, TRUE),
					'first_name' => $this->input->post('firstnamea'.$i, TRUE),
					'last_name' => $this->input->post('lastnamea'.$i, TRUE),
					'identity_number' => $this->input->post('ida'.$i, TRUE),
					'birthday' => $this->input->post('birthdatea'.$i, TRUE),
					'phone_1' => $this->input->post('phonea'.$i, TRUE),
					'order_list' => $i
				);
				array_push($passenger, $adult);
			}
			
			$anyerror = 0;
			foreach ($passenger as $array){
				$batch = $this->orders->add_passenger($array);
				if ($batch==false)
					$anyerror ++;
			}
			if ($anyerror==0){
				//preparing to send email
				$content = array(
					'title' => $conSalutation,
					'order_id' => $order_id,
					'first_name' => $conFirstName,
					'last_name' => $conLastName,
					'hotel_name' => $name,
					'address' => $address,
					'checkin' => $checkin,
					'checkout' => $checkout,
					'night' => $night,
					'room' => $room,
					'adult' => $tot_adult,
					'child' => $tot_child,
					'total_price' => $price,
					'admin_fee' => '10000'
				);
				
				//get email disribution
				$this->load->model('notification');
				list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-order-request');
				//sending email
				$email_config = array(
					'protocol' => 'mail',
					'mailpath' => '/usr/sbin/sendmail',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'mailtype' => 'html'
				);
				$this->load->library('email', $email_config);
				
				$this->email->from($email_sender, $sender_name);
				$this->email->to($conEmailAddress);
				$this->email->cc($cc);
				$this->email->bcc($bcc);
				
				$this->email->subject('Order Berhasil');
				$messages = $this->load->view('email_tpl/new_hotel_order_request', $content, TRUE);
				$this->email->message($messages);

				$this->email->send();
				//insert notification
				$notif = array(
					'category' => 'new-order-request',
					'message' => 'Order baru - Hotel',
					'created_datetime' => date('Y-m-d H:i:s')
				);
				$this->general->add_to_table('notifications', $notif);
				//end notif
				
				$response = array(
					'status' => '200',
					'message' => 'Anda akan segera dihubungi oleh admin kami untuk proses lebih lanjut dalam 3 jam.',
					'method' => 'tiket_internal',
					'order_id' => $order_id,
					'total' => $price
				);
			}
			else{
				$response = array(
					'status' => '204'
				);
			}
			$this->load_theme('booking_finished_page', $response);
				//redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function issued_order_by_system(){
		$id = $this->uri->segment(3);
		// check the payment status, if in status "requested" then refused to issued
		$not_ready = true;
		list ($order_id, $status) = $this->bank->get_payment_id($id);
		if ($order_id==0){
			$not_ready = false;
			$responses['response'] = 'nok';
			$responses['message'] = 'Pelanggan belum melakukan konfirmasi pembayaran.';
		}
		if($status=='requested'){
			$not_ready = false;
			$responses['response'] = 'nok';
			$responses['message'] = 'Status pembayaran pelanggan belum divalidasi. Harap mengubah status pembayaran terlebih dahulu.';
		}
		// check if the order doesn't have a booking code, then refused to issued
		$query = $this->general->get_afield_by_id('orders', 'order_id', $id, 'booking_code');
		if($query==false){
			$not_ready = false;
			$responses['response'] = 'nok';
			$responses['message'] = 'Pesanan belum mendapatkan booking code.';
		}
		else{
			$booking_code = $query->result_array()[0]['booking_code'];
			if($booking_code==""){
				$not_ready = false;
				$responses['response'] = 'nok';
				$responses['message'] = 'Booking code tidak boleh kosong.';
			}
		}
		
		//checking done, if all prerequisite ready then issued is permitted
		if($not_ready){
			$data = array(
				'order_status' => 'Issued',
				'issued_by' => $this->session->userdata('account_id'),
				'locked_by' => '0',
				'issued_date' => date('Y-m-d H:i:s')
			);
			$this->general->update_data_on_table('orders', 'order_id', $id, $data);
			$responses['response'] = 'ok';
			
		}
		echo json_encode($responses);
	}
	
	public function order_done(){
		$id=$this->uri->segment(3);
		$data = array(
			'order_status' => 'Done'
		);
		$this->general->update_data_on_table('orders', 'order_id', $id, $data);
		redirect(base_url('index.php/admin/booking_issued'));
	}
	
	public function get_banks(){
		$query = $this->bank->get_all_bank();
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'bank_id' => $row['bank_id'],
				'bank_name' => $row['bank_name'],
				'account_number' => $row['bank_account_number'],
				'holder' => $row['bank_holder_name'],
				'branch' => $row['bank_branch'],
				'city' => $row['bank_city'],
				'logo' => $row['bank_logo']
			);
		}
		echo json_encode($data);
	}
	
	public function confirm_payment(){
		$data = array(
			'title' => 'Konfirmasi Pembayaran',
			'sub_title' => '',
			'thank_you' => false
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('confirm_payment', $data);
		$this->load->view('footer');
	}
	
	public function confirm_payment_order(){
		
		$order_id = $this->input->post('order_id');
		$date = $this->input->post('tgl-transfer');
		$bank_receiver = $this->input->post('bank_tujuan');
		$total = $this->input->post('total');
		$sender = $this->input->post('sender');
		$note = $this->input->post('note');
		
		$data = array(
			'order_id' => $order_id,
			'sender_name' => $sender,
			'bank_receiver_id' => $bank_receiver,
			'transfer_date' => $date,
			'total_paid' => $total,
			'note' => $note,
			'status' => 'requested'
		);
		
		list ($check_order_id, $status) = $this->bank->get_payment_id($order_id);
		if ($check_order_id != 0){
			$any_error = array(
				'title' => 'Pesan Kesalahan',
				'sub_title' => 'Terjadi kesalahan pada saat memproses masukan anda',
				'error' => 'Anda sudah pernah melakukan konfirmasi atas Order ID = '. $order_id.'. Status pembayaran anda saat ini adalah "'.$status.'"'
			);
			redirect(base_url('index.php/webfront/confirm_payment/failed/'.$order_id.'/'.$status));
		}
		else {
			$query = $this->bank->add_confirm_payment($data);
			
			//get email disribution
			$this->load->model('notification');
			list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-confirm_payment');
			//sending email
			$email_config = array(
				'protocol' => 'mail',
				'mailpath' => '/usr/sbin/sendmail',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE,
				'mailtype' => 'html'
			);
			$this->load->library('email', $email_config);
			
			$this->email->from($email_sender, $sender_name);
			$this->email->to($to);
			$this->email->cc($cc);
			$this->email->bcc($bcc);
					
			$this->email->subject('Konfirmasi Pembayaran Baru');
			$content = array(
				'order_id' => $order_id
			);
			$messages = $this->load->view('email_tpl/new_confirmation_payment', $content, TRUE);
			$this->email->message($messages);

			$this->email->send();
			//insert notification
			$notif = array(
				'category' => 'new-confirm_payment',
				'message' => 'Konfirmasi pembayaran order ID '.$order_id,
				'created_datetime' => date('Y-m-d H:i:s')
			);
			$this->general->add_to_table('notifications', $notif);
			//end notif
			
			redirect(base_url('index.php/webfront/confirm_payment/success'));
		}
		
	}
	
	public function get_order_by_id(){
		$cat = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		if ($cat=='paket')
			$query = $this->orders->get_order_by_id($id, true);
		else
			$query = $this->orders->get_order_by_id($id);
		$response = array();
		$response['responses'] = array();
		//$response['responses']['general'] = array();
		// generate response general info
		foreach ($query->result_array() as $key => $value){
			//if ($cat == 'flight'){
				$response['responses']['general'][$key] = $value;
			//}
			/*else if ($cat == 'train'){
				list ($d_station, $a_station) = explode('-', $row['route']);
				$general = array(
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'token' => array('name' => 'token', 'value' => $row['token']),
					'train_name' => $row['train_name'],
					'train_id' => array('name' => 'train_id', 'value' => $row['train_id']),
					'route' => $row['route'],
					'depart_station' => array('name' => 'd', 'value' => $d_station),
					'arrival_station' => array('name' => 'a', 'value' => $a_station),
					'departing_date' => array('name' => 'date', 'value' => $row['departing_date']),
					'subclass' => array('name' => 'subclass', 'value' => $row['train_subclass']),
					'kelas' => $row['train_class'],
					'time_travel' => $row['time_travel'],
					'total_price' => $row['total_price'],
					'adult' => array('name' => 'adult', 'value' => $row['adult']),
					'price_adult' => $row['price_adult'],
					'child' => array('name' => 'child', 'value' => $row['child']),
					'price_child' => $row['price_child'],
					'infant' => array('name' => 'infant', 'value' => $row['infant']),
					'price_infant' => $row['price_infant']
				);
			}
			else if ($cat == 'hotel'){ // for hotel there is no need to proceed it with Tiket.com API
				$general = array(
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					//'token' => array('name' => 'token', 'value' => $row['token']),
					'hotel_name' => $row['hotel_name'],
					'hotel_id' => $row['hotel_id'],
					'hotel_address' => $row['hotel_address'],
					'hotel_regional' => $row['hotel_regional'],
					'room' => $row['hotel_room'],
					'checkin' => $row['departing_date'],
					'checkout' => $row['returning_date'],
					'night' => $row['time_travel'],
					'total_price' => $row['total_price'],
					'adult' => $row['adult'],
					'child' => $row['child']
				);
			}
			else if ($cat == 'paket'){ // for paket there is no need to proceed it with Tiket.com API
				$general = array(
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'total_price' => $row['total_price'],
					'commission' => $row['commission_to_agent'],
					'title' => $row['title'],
					'category' => $row['category'],
					'description' => $row['description']
				);
			}*/
			//array_push($response['responses']['general'], $general);
		}
		
		$con = $this->orders->get_passenger($id, 'contact');
		$response['responses']['contact'] = array();
		foreach ($con->result_array() as $row){
			/*$contact = array(
				'title' => array('name' => 'conSalutation', 'value' => $row['title']),
				'firstname' => array('name' => 'conFirstName', 'value' => $row['first_name']),
				'lastname' => array('name' => 'conLastName', 'value' => $row['last_name']),
				'email' => array('name' => 'conEmailAddress', 'value' => $row['email']),
				'phone' => array('name' => 'conPhone', 'value' => $row['phone_1'])
			);
			array_push($response['responses']['contact'], $contact);*/
			$response['responses']['contact'] = array(
				'title' => $row['title'],
				'fullname' => $row['first_name'].' '.$row['last_name'],
				'email' => $row['email'],
				'phone' => $row['phone_1']
			);
		}
		//fetch & generate passengers
		//fetch & generate adult
		$response['responses']['adult'] = array();
		$response['responses']['child'] = array();
		$response['responses']['infant'] = array();
			
		$get_adult = $this->orders->get_passenger($id, 'adult');
		$get_child = $this->orders->get_passenger($id, 'child');
		$get_infant = $this->orders->get_passenger($id, 'infant');
		if ($cat=='flight'){
			foreach ($get_adult->result_array() as $row){
				$adult = array(
					'order_list' => $row['order_list'],
					'title' => $row['title'],
					'first_name' => $row['first_name'],
					'last_name' => $row['last_name'],
					'birth_date' => $row['birthday'],
					'id' => $row['identity_number'],
					'nationality' => $row['nationality'],
					'baggage' => $row['baggage'],
					'baggage_return' => $row['baggage_return']
				);
				array_push($response['responses']['adult'], $adult);
			}
			foreach ($get_child->result_array() as $row){
				$child = array(
					'order_list' => $row['order_list'],
					'title' => $row['title'],
					'firstname' => $row['first_name'],
					'lastname' => $row['last_name'],
					'birthdate' => $row['birthday'],
					'id' => $row['identity_number'],
					'nationality' => $row['nationality'],
					'baggage' => $row['baggage'],
					'baggage_return' => $row['baggage_return']
				);
				array_push($response['responses']['child'], $child);
			}
			foreach ($get_infant->result_array() as $row){
				$infant = array(
					'order_list' => $row['order_list'],
					'title' => $row['title'],
					'firstname' => $row['first_name'],
					'lastname' => $row['last_name'],
					'birthdate' => $row['birthday'],
					'parent' => $row['parent'],
					'id' => $row['identity_number'],
					'nationality' => $row['nationality'],
					'baggage' => $row['baggage'],
					'baggage_return' => $row['baggage_return']
				);
				array_push($response['responses']['infant'], $infant);
			}
		}
		else if($cat=='train'){
			foreach ($get_adult->result_array() as $row){
				$adult = array(
					'title' => array('name' => 'salutationAdult'.$row['order_list'], 'value' => $row['title']),
					'name' => array('name' => 'nameAdult'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
					'birthdate' => array('name' => 'birthDateAdult'.$row['order_list'], 'value' => $row['birthday']),
					'id' => array('name' => 'IdCardAdult'.$row['order_list'], 'value' => $row['identity_number']),
					'phone' => array('name' => 'noHpAdult'.$row['order_list'], 'value' => $row['phone_1'])
				);
				array_push($response['responses']['adult'], $adult);
			}
			foreach ($get_child->result_array() as $row){
				$child = array(
					'title' => array('name' => 'salutationChild'.$row['order_list'], 'value' => $row['title']),
					'name' => array('name' => 'nameChild'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
					'birthdate' => array('name' => 'birthDateChild'.$row['order_list'], 'value' => $row['birthday'])
				);
				array_push($response['responses']['child'], $child);
			}
			foreach ($get_infant->result_array() as $row){
				$infant = array(
					'title' => array('name' => 'salutationInfant'.$row['order_list'], 'value' => $row['title']),
					'name' => array('name' => 'nameInfant'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
					'birthdate' => array('name' => 'birthDateInfant'.$row['order_list'], 'value' => $row['birthday'])
				);
				array_push($response['responses']['infant'], $infant);
			}
		}
	
		echo json_encode($response);
	}
	
	public function get_payment_list(){
		$list = $this->bank->get_payment_list();
		$number_row = 0;
		foreach ($list->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'category' => $row['trip_category'],
				'order_id' => $row['order_id'],
				'payment_id' => $row['payment_id'],
				'sender' => $row['sender_name'],
				'bank_name' => $row['bank_name'],
				'transfer_date' => $row['transfer_date'],
				'total_paid' => $row['total_paid'],
				'total_price' => $row['total_price'],
				'status' => $row['status'],
				'validated_by' => $row['user_name']
			);
		}
		echo json_encode($data);
	}
	
	public function get_booking_list(){
		$list = $this->orders->get_order_list();
		$number_row = 0;
		foreach ($list->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'agent_name' => $row['agent_name'],
				'category' => $row['trip_category'],
				'order_id' => $row['order_id'],
				'total_price' => $row['total_price'],
				'order_status' => $row['order_status'],
				'timestamp' => $row['registered_date'],
				'payment_status' => $row['status']
			);
		}
		echo json_encode($data);
	}
	
	public function validate_payment_id(){
		$id = $this->uri->segment(3);
		$data = array(
			'status' => 'validated',
			'validated_by' => $this->session->userdata('account_id')
		);
		//$upd = $this->bank->update_payment_status($id, 'validated');
		$upd = $this->general->update_data_on_table('payments', 'payment_id', $id, $data);
		//get order_id
		$order_id = $this->bank->get_order_id($id);
		//after validate payment, change order status to Paid
		$paid = $this->orders->update_order_status($order_id, 'Paid');
		redirect(base_url('index.php/admin/validate_payment'));
	}
	
	public function add_order_tiketcom(){
		$cat = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		// check the payment status, if in status "requested" then refused to checkout
		list ($order_id, $status) = $this->bank->get_payment_id($id);
		if ($order_id==0){
			$response = 'nok';
			$message = 'Pelanggan belum melakukan konfirmasi pembayaran';
		}
		else {
			if ($status=='requested'){
				$response = 'nok';
				$message = 'Status pembayaran pelanggan belum divalidasi. Harap mengubah status pembayaran terlebih dahulu.';
			}
			else if ($status=='validated'){
				$posts = $this->input->post(NULL, TRUE);
				$token = $this->input->post('token');
				$str = '';
				foreach($posts as $key => $value)
					$str .= $key.'='.$value.'&';
				$post = rtrim($str, '&');
				//add order
				if ($cat=='flight')
					$getdata = $this->get_content($this->config->item('api_server').'/order/add/flight?'.$post.'&output=json');
				else if ($cat=='train')
					//print_r($this->config->item('api_server').'/order/add/train?'.$post.'&output=json');
					$getdata = $this->get_content($this->config->item('api_server').'/order/add/train?'.$post.'&output=json');
				
				$json = json_decode($getdata);
				$status = $json->diagnostic->status;
				if ($status!="200")
					$this->show_message_page('menambah pesanan ke pihak ketiga', $json->diagnostic->error_msgs);
				else if ($status=="200"){
					// order
					$order_req = $this->get_content($this->config->item('api_server').'/order?token='.$token.'&output=json');
					$order_resp = json_decode($order_req);
					$order_status = $order_resp->diagnostic->status;
					$checkout_link = stripslashes($order_resp->checkout);
					if ($order_status!="200")
						$this->show_message_page('konfirmasi pesanan ke pihak ketiga', $order_resp->diagnostic->error_msgs);
					else if ($order_status=="200"){
						//linking to checkout link
						$checkout_req = $this->get_content($checkout_link.'?token'.$token.'&output=json');
						$checkout_resp = json_decode($checkout_req);
						$checkout_status = $checkout_resp->diagnostic->status;
						if ($checkout_status!="200")
							$this->show_message_page('melakukan proses checkout ke pihak ketiga', $checkout_resp->diagnostic->error_msgs.' '.$checkout_link.'?token='.$token.'&output=json');
						else if ($checkout_status=="200"){
							$this->orders->update_order_status($id, 'Processing');
							redirect(base_url('index.php/admin/booking_page'));
						}
					}
				}
				
				//$this->orders->update_order_status($id, 'Processing');
				//redirect(base_url('index.php/admin/booking_page'));
				$response = 'ok';
			}
		}
		if ($response=='nok')
			$this->show_message_page('melakukan pengecekan status pembayaran.', $message);
			
	}
	
	function show_message_page($in, $message){
		$data = array(
				'user_name' => $this->session->userdata('user_name'),
				'ip_address' => $this->session->userdata('ip_address'),
				'title' => 'Pesan Kesalahan',
				'subtitle' => 'Terjadi kesalahan pada saat '.$in,
				'message' => $message
			);
			$this->load->view('admin_page_header', $data);
			$this->load->view('admin_any_message', $data);
			$this->load->view('admin_page_footer');
	}
	
	public function add_order_paket(){
	
		if($this->session->userdata('account_id')<>''){
			if ($this->session->userdata('account_id')=='1')
				$account_id = $this->config->item('account_id');
			else
				$account_id = $this->session->userdata('account_id');
		}
		else
			$account_id = $this->config->item('account_id');
		//check account id is an agent
		$is_agent = $this->general->get_detail_by_id('agents', 'agent_id', $account_id);
		/* if a agent is ordering, set the commission*/
		//get the price and commission to agent
		$this->load->model('posts');
		$this->load->model('commission');
		$query_price = $this->general->get_afield_by_id('posts', 'post_id', $this->input->post('post_id',TRUE), 'price');
		foreach($query_price->result_array() as $row)
			$price = $row['price'];
		//get the currency
		$query_purchase_price = $this->general->get_afield_by_id('posts', 'post_id', $this->input->post('post_id',TRUE), 'currency');
		foreach($query_purchase_price->result_array() as $row)
			$currency = $row['currency'];
		//if USD get the rate
		if($currency=="USD"){
			$rate = $this->bank->get_exchanges_by_detail('USD', 'Amerika');
		}
		
		//get the purchasing price (harga beli)
		$query_purchase_price = $this->general->get_afield_by_id('posts', 'post_id', $this->input->post('post_id',TRUE), 'purchasing_price');
		foreach($query_purchase_price->result_array() as $row)
			$purchase_price = $row['purchasing_price'];
		
		$query_post_cat = $this->posts->get_post_cat_by_id($this->input->post('post_id',TRUE));
		foreach($query_post_cat->result_array() as $row)
			$post_cat = $row['category'];
		//check the commission
		// priority: peak-season is the highest, then off-peak-season, and last is normal
		if($is_agent <> false){
			$check_peak = $this->commission->check_is_in_active_condition('peak-season', $post_cat);
			if ($check_peak <> false)
				foreach ($check_peak->result_array() as $row)
					$comm = $row['nominal'];
			else {
				$check_off_peak = $this->commission->check_is_in_active_condition('off-peak-season', $post_cat);
				if ($check_off_peak <> false)
					foreach ($check_off_peak->result_array() as $row)
						$comm = $row['nominal'];
				else {
					$check_normal = $this->commission->check_is_in_active_condition('normal', $post_cat);
					if ($check_normal <> false)
						foreach ($check_normal->result_array() as $row)
							$comm = $row['nominal'];
					else $comm = '0';
				}
			}
		}
		
		//total person registered, then count the total price
		$total_person = intval($this->input->post('total_person_registered', TRUE));
		$total_price = intval($price) * $total_person;
		
		$data_order = array(
			'account_id' => $account_id,
			'order_system_id' => 'internal',
			'post_id' => $this->input->post('post_id',TRUE),
			'trip_category' => 'paket',
			'order_status' => 'Registered',
			'registered_date' => date('Y-m-d H:i:s'),
			'total_price' => $total_price,
			'commission_to_agent' => $comm,
			'purchasing_price' => $purchase_price,
			'total_person_registered' => $total_person,
			'customer_email' => $this->input->post('email',TRUE)
		);
		$order_id = $this->orders->add_order($data_order);
		
		$data_passenger = array(
			'order_id' => $order_id,
			'passenger_level' => 'contact',
			'title' => $this->input->post('title', TRUE),
			'first_name' => $this->input->post('first_name', TRUE),
			'phone_1' => $this->input->post('telp_no',TRUE),
			'email' => $this->input->post('email',TRUE)
		);
		$insert_id = $this->orders->add_passenger($data_passenger);
						
		//preparing to send email
		$content = array(
			'order_id' => $order_id,
			'title' => $this->input->post('title', TRUE),
			'first_name' => $this->input->post('first_name', TRUE),
			'last_name' => $this->input->post('last_name', TRUE),
			'total_price' => $total_price,
			'currency' => $currency,
			'rate' => $rate,
		);
		
		//get bank list
		$query = $this->bank->get_all_bank();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$content['banks'][$number_row]['bank_name'] = $row['bank_name'];
			$content['banks'][$number_row]['account_number'] = $row['bank_account_number'];
			$content['banks'][$number_row]['holder_name'] = $row['bank_holder_name'];
			$content['banks'][$number_row]['branch'] = $row['bank_branch'];
			$content['banks'][$number_row]['city'] = $row['bank_city'];
			$number_row++;
		}
			
		//get email disribution
		$this->load->model('notification');
		list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-order-request');
		//sending email
		$email_config = array(
			'protocol' => 'mail',
			'mailpath' => '/usr/sbin/sendmail',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE,
			'mailtype' => 'html'
		);
		$this->load->library('email', $email_config);
		
		$this->email->from($email_sender, $sender_name);
		$this->email->to($this->input->post('email',TRUE));
		$this->email->cc($cc);
		$this->email->bcc($bcc);
				
		$this->email->subject('Order Berhasil');
		$messages = $this->load->view('email_tpl/new_paket_order_request', $content, TRUE);
		$this->email->message($messages);

		$this->email->send();
		//insert notification
		$notif = array(
			'category' => 'new-order-request',
			'message' => 'Order baru - Paket',
			'created_datetime' => date('Y-m-d H:i:s')
		);
		$this->general->add_to_table('notifications', $notif);
		//end notif
		
		redirect(base_url('index.php/webfront/package_buy_form/'.$this->input->post('post_id',TRUE).'/success'));
	}
	
	public function tiketcom_add_flight_order(){
		$post = $this->input->post(NULL,TRUE);
		$url_param = '';
		// LION needs to check the expiry passport date
		$airline_name_dep = $this->input->post('airline_name', TRUE);
		$airline_name_ret = $this->input->post('airline_name_ret', TRUE);
		$date_go = $this->input->post('date_go', TRUE);
		$error_passport_date = false;
		
		//all post key & value will be passed except these keys
		$exception_post_key = array('airline_name', 'airline_name_ret', 'date_go', 'date_ret', 'admin_fee', 'price_adult', 'price_child', 'price_infant', 'price_adult_ret', 'price_child_ret', 'price_infant_ret', 'flight_number_dep', 'flight_number_ret', 'time_travel', 'time_travel_ret', 'total_price', 'total_price_ret', 'route'); 
		//end
		foreach($post as $key => $value){
			if(in_array($key, $exception_post_key)==false)
				$url_param .= $key.'='.$value.'&';
			if((strpos($key,'passportExpiryDate') !== false) and ($airline_name_dep=='LION')){
				$datetime1 = date_create($date_go);
				$datetime2 = date_create($value);
				$interval = date_diff($datetime1, $datetime2);
				$diff = intval($interval->format('%a'));
				if($diff<=240){
					$error_message = 'Masa berakhir passport untuk maskapai LION harus lebih dari 6 bulan dari tanggal keberangkatan';
					$error_passport_date = true;
				}
			}
			if(strpos($key,'passportissueddate') !== false){
				$datetime1 = date_create($date_go);
				$datetime2 = date_create($value);
				$interval = date_diff($datetime1, $datetime2);
				$diff = intval($interval->format('%a'));
				if($diff<0){
					$error_passport_date = true;
					$error_message = 'Tanggal penerbitan passport tidak boleh lebih dari hari ini.';
				}
			}
			//checking for ages
			if(strpos($key,'birthdatei') !== false){
				//$datetime1 = date_create($date_go); jaga2 kalo ternyata yg dipake adalah tanggal keberangkatan
				$datetime1 = date_create(date('Y-m-d'));
				$datetime2 = date_create($value);
				$interval = date_diff($datetime2, $datetime1);
				$diff = intval($interval->format('%r%a'));
				if($diff>730 or $diff<0){
					$error_passport_date = true;
					$error_message = 'Tanggal lahir bayi harus berumur kurang dari 2tahun di tanggal keberangkatan.';
				}
			}
		}
		if($error_passport_date){
			$response = array(
				'status' => '210',
				'error' => $error_message,
				'category' => 'flight'
			);
		}
		else{
			list ($lioncaptcha, $lionsessionid) = $this->get_lion_captcha();
			$url_param .= 'lioncaptcha='.$lioncaptcha.'&lionsessionid='.$lionsessionid;
			$url_param .= '&lang=id&output=json';
			$url = $this->config->item('api_server').'/order/add/flight?'.$url_param;
			$send_request = $this->get_content($url);
			if($send_request === FALSE){
				$response = array(
					'status' => '213',
					'error' => 'Terjadi kesalahan saat add order.',
					'category' => 'flight'
				);
			}
			else{
				//echo $send_request;
				$json = json_decode($send_request);
				$diagnose = $json->diagnostic;
				if($diagnose->status <> '200'){
					$response = array(
						'status' => $diagnose->status,
						'error' => $diagnose->error_msgs,
						'category' => 'flight'
					);
				}
				else {
					// continue to order
					$url_order = $this->config->item('api_server').'/order?token='.$json->token.'&lang=id&output=json';
					$send_order = $this->get_content($url_order);
					if($send_order === FALSE){
						$response = array(
							'status' => '213',
							'error' => 'Terjadi kesalahan saat order.',
							'category' => 'flight'
						);
					}
					else{
						$response_order = json_decode($send_order);
						//echo $send_order;
						$diagnose_order = $response_order->diagnostic;
						$myorder = $response_order->myorder;
						if($diagnose_order->status<>'200'){
							$response = array(
								'status' => $diagnose_order->status,
								'error' => $diagnose_order->error_msgs,
								'category' => 'flight'
							);
						}
						else{ //jika sukses
							/*
								rumusnya adalah sebagai berikut: (petunjuk berdasarkan Revisi ke-6)
								Sub Total = Value_Total Penumpang + Bagasi
								Biaya Pelayanan = [tax_and_charge] - [payment_discount]
								Grand_Total = Sub_total + Biaya Pelayanan							
							*/
							
							$subtotal_fee_dep = intval($myorder->data[0]->detail->price_adult) + intval($myorder->data[0]->detail->price_child) + intval($myorder->data[0]->detail->price_infant) + intval($myorder->data[0]->detail->baggage_fee);
							$tax_charge_dep = intval($myorder->data[0]->tax_and_charge);
							$subtotal_fee_ret = 0;
							$tax_charge_ret = 0;
							if(sizeof($myorder->data)==2){
								$subtotal_fee_ret = intval($myorder->data[1]->detail->price_adult) + intval($myorder->data[1]->detail->price_child) + intval($myorder->data[1]->detail->price_infant) + intval($myorder->data[1]->detail->baggage_fee);
								$tax_charge_ret = intval($myorder->data[1]->tax_and_charge);
							}
							$subtotal_fee = $subtotal_fee_dep + $subtotal_fee_ret;
							$tax_and_charge = $tax_charge_dep + $tax_charge_ret;
							$service_fee =  $tax_and_charge - intval($myorder->discount_amount);
							if($service_fee < 0)
								$service_fee = 0;
							$grand_total = $subtotal_fee + $service_fee;
							
							//save to internal database for order log
							if($this->session->userdata('account_id')<>''){
								if ($this->session->userdata('account_id')=='1')
									$account_id = $this->config->item('account_id');
								else
									$account_id = $this->session->userdata('account_id');
							}
							else
								$account_id = $this->config->item('account_id');
							
							$data_order = array(
								'3rd_party_order_id' => $myorder->order_id,
								'order_system_id' => 'tiketcom',
								'account_id' => $account_id,
								'token' => $response_order->token,
								'customer_email' => $this->input->post('conEmailAddress'),
								'trip_category' => 'flight',
								'airline_name_depart' => $airline_name_dep,
								'airline_name_return' => $airline_name_ret,
								'flight_id_depart' => $this->input->post('flight_number_dep'),
								'flight_id_return' => $this->input->post('flight_number_ret'),
								'route' => $this->input->post('route'),
								'departing_date' => $this->input->post('date_go'),
								'returning_date' => $this->input->post('date_ret'),
								'time_travel' => $this->input->post('time_travel'),
								'time_travel_ret' => $this->input->post('time_travel_ret'),
								'total_price' => $grand_total,
								'total_price_dep' => $subtotal_fee_dep,
								'total_price_ret' => $subtotal_fee_ret,
								'adult' => $this->input->post('adult'),
								'child' => $this->input->post('child'),
								'infant' => $this->input->post('infant'),
								'order_status' => 'Issued',
								'registered_date' => date('Y-m-d H:i:s')
								
							);
							$order_id = $this->orders->add_order($data_order);
							
							//generate success page
							$response = array(
								'status' => $diagnose->status,
								'error' => '',
								'category' => 'flight',
								'internal_order_id' => $order_id,
								'order_id' => $myorder->order_id,
								'grand_total' => $grand_total,
								'subtotal_fee' => $subtotal_fee,
								'service_fee' => $service_fee,
								'checkout_uri' => 'checkout_uri='.$response_order->checkout.'&token='.$response_order->token
							);
							
							//save data contact person to session
							$this->session->set_userdata('con_salutation', $this->input->post('conSalutation'));
							$this->session->set_userdata('con_firstname', $this->input->post('conFirstName'));
							$this->session->set_userdata('con_lastname', $this->input->post('conLastName'));
							$this->session->set_userdata('con_phone', $this->input->post('conPhone'));
							$this->session->set_userdata('con_email', $this->input->post('conEmailAddress'));
						}
					}					
				}
			}
			
		}
		$this->load_theme('issued_page', $response);
	}
	
	public function tiketcom_add_train_order(){
		$post = $this->input->post(NULL,TRUE);
		$param = '';
		foreach($post as $key => $value)
			$param .= $key.'='.$value.'&';
		$url_param = rtrim($param, '&');
		$url_param .= '&lang=id&output=json';
		$url = $this->config->item('api_server').'/order/add/train?'.$url_param;
		//print_r($url);
		$send_request = $this->get_content($url);
		$json = json_decode($send_request);
		$diagnose = $json->diagnostic;
		if($diagnose->status <> '200'){
			$response = array(
				'status' => $diagnose->status,
				'error' => $diagnose->error_msgs,
				'category' => 'train'
			);
		}
		else {
			// continue to order
			$url_order = $this->config->item('api_server').'/order?token='.$json->token.'&lang=id&output=json';
			$send_order = $this->get_content($url_order);
			$response_order = json_decode($send_order);
			$diagnose_order = $response_order->diagnostic;
			$myorder = $response_order->myorder;
			if($diagnose_order->status<>'200'){
				$response = array(
					'status' => $diagnose_order->status,
					'error' => $diagnose_order->error_msgs,
					'category' => 'train'
				);
			}
			else{ //jika sukses
				$total_before_discount = intval($myorder->total_without_tax) + intval($myorder->total_tax);
				$total_after_discount = $total_before_discount - intval($myorder->discount_amount);
					//save to db
				$data_insert = array(
					'order_id' => $response_order->myorder->order_id,
					'category' => 'train',
					'token' => $response_order->token,
					'delete_uri' => $myorder->data[0]->delete_uri,
					'price_no_discount' => $total_before_discount,
					'price_with_discount' => $total_after_discount,
					'status' => 'checkout'
				);
				$internal_order_id = $this->orders->add_order_tiketcom($data_insert);
				//generate success page
					
				$response = array(
					'status' => $diagnose->status,
					'error' => '',
					'category' => 'train',
					'internal_order_id' => $internal_order_id,
					'order_id' => $myorder->order_id,
					'price' => $myorder->total_without_tax,
					'tax' => $myorder->total_tax,
					'total_price' => $total_before_discount,
					'checkout_uri' => 'checkout_uri='.$response_order->checkout.'&token='.$response_order->token,
					'detail_id' => $myorder->data[0]->order_detail_id,
					'discount' => $myorder->discount_amount,
					'after_discount' => $total_before_discount - intval($myorder->discount_amount)
				);
			}
		}
		$this->load_theme('issued_page', $response);
	}
	
	public function tiketcom_checkoutlogin(){
		//checkout page request
		$uri = $this->input->get('checkout_uri',TRUE);
		$token = $this->input->get('token',TRUE);
		$url = $uri.'?token='.$token.'&lang=id&output=json';
		$http_url = str_replace('https','http',$url);
		
		$send_request = $this->get_content($http_url);
		$response = json_decode($send_request);
		$diagnose = $response->diagnostic;
		
		if($diagnose->status<>'200'){
			$json_response['status'] = $diagnose->status;
			$json_response['message'] = 'Terjadi kesalahan pada saat checkout page request';
			echo json_encode($json_response);
		}
		else{ //jika sukses
			$cc_uri = $response->next_checkout_uri.'?';
			$token = $response->token;
			$param = 'token='.$token.'&salutation='.$this->session->userdata('con_salutation').'&firstName='.$this->session->userdata('con_firstname').'&lastName='.$this->session->userdata('con_lastname').'&emailAddress='.$this->session->userdata('con_email').'&phone='.$this->session->userdata('con_phone').'&saveContinue=2&lang=id&output=json';
			$cc_url = str_replace('https','http',$cc_uri.$param);
			$send_request_2 = $this->get_content($cc_url);
			$response_2 = json_decode($send_request_2);
			$diagnose_2 = $response_2->diagnostic;
			
			if($diagnose_2->status<>'200'){
				$json_response['status'] = $diagnose_2->status;
				$json_response['message'] = 'Terjadi kesalahan pada saat checkout customer';
				echo json_encode($json_response);
			}
			else{
				$json_response['status'] = $diagnose_2->status;
				$json_response['token'] = $response_2->token;
				echo json_encode($json_response);
			}
		}
	}
	
	public function tiketcom_get_available_payment(){
		$uri = $this->config->item('api_server').'/checkout/checkout_payment';
		$token = $this->input->get('token',TRUE);
		$internal_order_id = $this->input->get('id',TRUE);
		//get tiketcom order id
		$req_order_id = $this->general->get_afield_by_id('orders', 'order_id', $internal_order_id, '3rd_party_order_id');
		$order_id = $req_order_id->result_array()[0]['3rd_party_order_id'];
		//get grand total
		$req_grand_total = $this->general->get_afield_by_id('orders', 'order_id', $internal_order_id, 'total_price');
		$grand_total = $req_grand_total->result_array()[0]['total_price'];
		//get available payment by tiketcom
		$url = $uri.'?token='.$token.'&lang=id&output=json';
		$send_request = $this->get_content($url);
		$response = json_decode($send_request);
		//print_r($send_request);
		$diagnose = $response->diagnostic;
		if($diagnose->status<>'200'){
			$json_response['status'] = $diagnose->status;
			$json_response['message'] = $diagnose->error_msgs;
			echo json_encode($json_response);
		}
		else{
			$payments = $response->available_payment;
			$json_response['status'] = $diagnose->status;
			$json_response['token'] = $response->token;
			$json_response['order_id'] = $order_id;
			$json_response['grand_total'] = $grand_total;
			
			foreach($payments as $payment){
				$json_response['list'][] = array(
					'link' => $payment->link,
					'text' => $payment->text,
					'message' => $payment->message
				);
			}
			echo json_encode($json_response);
		}
	}
	
	public function tiketcom_checkout_payment(){
		$method = $this->input->post('method');
		if($method=='KlikBCA'){
			$url = str_replace('https','http',$this->input->post('link'));
			$param = '?token='.$this->input->post('token');
			$param .= '&user_bca='.$this->input->post('user_bca', TRUE);
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = $this->get_content($url.$param);
			$json = json_decode($send_request);
			if($json->diagnostic->status<>'200'){
				$response = array(
					'status' => $json->diagnostic->status,
					'message' => $json->diagnostic->error_msgs
				);
			}
			else{
				$response = array(
					'status' => $json->diagnostic->status,
					'message' => $json->message,
					'method' => $method,
					'order_id' => $json->orderId,
					'total' => $json->grand_total
				);
				$resp = json_decode($send_request, true); //return as array
				$num = 0;
				//print_r($json->steps->step['0']);
				foreach($resp['steps']['step'] as $key => $value){
					$response['steps'][$num] = $value;
					$num++;
				}
				
			}
		}
		else if($method=='ATM Transfer'){
			$url = str_replace('https','http',$this->input->post('link'));
			$param = '?token='.$this->input->post('token');
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = $this->get_content($url.$param);
			$json = json_decode($send_request);
			if($json->diagnostic->status<>'200'){
				$response = array(
					'status' => $json->diagnostic->status,
					'message' => $json->diagnostic->error_msgs
				);
			}
			else{
				//update confirm_payment link
				$data = array('confirm_payment_uri' => $json->confirm_payment);
				$update = $this->general->update_data_on_table('orders_in_tiketcom', 'order_id', $json->orderId, $data);
				//create response
				$response = array(
					'status' => $json->diagnostic->status,
					'message' => $json->message,
					'method' => $method,
					'order_id' => $json->orderId,
					'total' => $json->grand_total
				);
				$resp = json_decode($send_request, true); //return as array
				$num = 0;
				//print_r($resp);
				//print_r($json->steps->step['0']);
				for($i=0; $i<sizeof($resp['steps']); $i++){
					$response['steps'][$num]['name'] = $resp['steps'][$i]['name'];
					$num_step = 0;
					foreach($resp['steps'][$i]['step'] as $key => $value){
						$response['steps'][$num]['step'][$num_step] = $value;
						$num_step++;
					}
					$num++;
				}
			}
		}
		else if($method=='Deposit'){
			$url = str_replace('https','http',$this->input->post('link'));
			$param = '?token='.$this->input->post('token');
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = $this->get_content($url.$param);
			$json = json_decode($send_request);
			$order_id = $json->orderId;
			$tot_price = $json->grand_total;
			if($json->diagnostic->status<>'200'){
				$response = array(
					'status' => $json->diagnostic->status,
					'message' => $json->diagnostic->error_msgs
				);
			}
			else{
				$response = array(
					'status' => $json->diagnostic->status,
					//'message' => $json->message,
					'message' => 'Segera lakukan pembayaran dalam waktu 60 menit.',
					'method' => $method,
					'order_id' => $json->orderId,
					'total' => $json->grand_total
				);
				
				
				//preparing to send email
				$content = array(
					'title' => $this->session->userdata('con_salutation'),
					'order_id' => $order_id,
					'first_name' => $this->session->userdata('con_firstname'),
					'last_name' => $this->session->userdata('con_lastname'),
					'total_price' => $tot_price,
					'admin_fee' => '10000'
				);
				
				//get bank list
				$query = $this->bank->get_all_bank();
				$number_row = 0;
				foreach ($query->result_array() as $row){
					$response['banks'][$number_row]['bank_name'] = $row['bank_name'];
					$response['banks'][$number_row]['account_number'] = $row['bank_account_number'];
					$response['banks'][$number_row]['holder_name'] = $row['bank_holder_name'];
					$response['banks'][$number_row]['branch'] = $row['bank_branch'];
					$response['banks'][$number_row]['city'] = $row['bank_city'];
					//for in email
					$content['banks'][$number_row]['bank_name'] = $row['bank_name'];
					$content['banks'][$number_row]['account_number'] = $row['bank_account_number'];
					$content['banks'][$number_row]['holder_name'] = $row['bank_holder_name'];
					$content['banks'][$number_row]['branch'] = $row['bank_branch'];
					$content['banks'][$number_row]['city'] = $row['bank_city'];
					$number_row++;
				}
				
				//get email disribution
				$this->load->model('notification');
				list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-order-request');
				//sending email
				$email_config = array(
					'protocol' => 'mail',
					'mailpath' => '/usr/sbin/sendmail',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'mailtype' => 'html'
				);
				$this->load->library('email', $email_config);
				
				$this->email->from($email_sender, $sender_name);
				$this->email->to($this->session->userdata('con_email'));
				$this->email->cc($cc);
				$this->email->bcc($bcc);
				
				$this->email->subject('Pesanan Tiket Pesawat Berhasil');
				$messages = $this->load->view('email_tpl/new_flight_order_request', $content, TRUE);
				$this->email->message($messages);

				$this->email->send();
				//insert notification
				$notif = array(
					'category' => 'new-order-request',
					'message' => 'Order baru - Pesawat',
					'created_datetime' => date('Y-m-d H:i:s')
				);
				$this->general->add_to_table('notifications', $notif);
				//end notif
				
			}
		}
		
		$this->load_theme('booking_finished_page', $response);
	}
	
	public function tiketcom_confirm_payment(){
		$order_id = $this->input->post('orderId', TRUE);
		$posts = $this->input->post(NULL,TRUE);
		$url_param = '';
		foreach($posts as $key => $value)
			if($key<>'orderId')
				$url_param .= $key.'='.$value.'&';
		$details = $this->general->get_detail_by_id('orders_in_tiketcom', 'order_id', $order_id);
		foreach ($details->result_array() as $row){
			$token = $row['token'];
			$confirm_uri = $row['confirm_payment_uri'];
		}
		$url_param .= '&token='.$token.'&lang=id&output=json';
		
		$send_request = $this->get_content($confirm_uri.'&'.$url_param);
		print_r($send_request);
	}
	
	public function tiketcom_cancel_order(){
		$order_id = $this->input->post('orderId', TRUE);
		$details = $this->general->get_detail_by_id('orders_in_tiketcom', 'order_id', $order_id);
		foreach ($details->result_array() as $row){
			$token = $row['token'];
			$delete_uri = $row['delete_uri'];
		}
		$send_request = $this->get_content($delete_uri.'&token='.$token.'&output=json&lang=id');
		$json = json_decode($send_request);
		if($json->diagnostic->status<>'200'){
			$response = array(
				'status' => $json->diagnostic->status,
				'message' => $json->diagnostic->error_msgs
			);
		}
		else{
			$response = array(
				'status' => $json->diagnostic->status,
				'message' => $json->updateStatus
			);
		}
		$this->load_theme('cancel_order_tiketcom', $response);
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
	
	public function check_order(){
		/*checking order will be internal database or 3rd party
		*/
		$order_id = $this->input->get('order_id',NULL);
		$email = $this->input->get('email',NULL);
		$get_order_system = $this->general->get_afield_by_id('orders', 'order_id', $order_id, 'order_system_id');
		if($get_order_system==false)
			$get_order_system = $this->general->get_afield_by_id('orders', '3rd_party_order_id', $order_id, 'order_system_id');
		$source_db = $get_order_system->result_array()[0]['order_system_id'];
		
		$response = array();
		switch ($source_db){
			case "internal":
				$get_order_type = $this->general->get_afield_by_id('orders', 'order_id', $order_id, 'trip_category');
				$order_type = $get_order_type->result_array()[0]['trip_category'];
				if($order_type=="paket")
					$query = $this->orders->get_order_by_id($order_id, true);
				else
					$query = $this->orders->get_order_by_id($order_id);
				
				$order_timestamp = new DateTime($query->result_array()[0]['registered_date']);
				$limit_order_timestamp = $order_timestamp->add(new DateInterval('PT1H'));
				
				//$response = array();
				//$response['responses'] = array();
				//$response['responses']['general'] = array();
				// generate response general info
				foreach ($query->result_array() as $row){
					if ($order_type == 'flight'){
						$response = array(
							'order_id' => $row['order_id'],
							'order_type' => $order_type,
							'order_system' => 'internal',
							'agent_name' => $row['agent_name'],
							'airline_name' => $row['airline_name_depart'],
							'lion_captcha' => array('name' => 'lioncaptcha', 'value' => $row['lion_captcha']),
							'lion_session_id' => array('name' => 'lionsessionid', 'value' => $row['lion_session_id']),
							'route' => $row['route'],
							'departing_date' => $row['departing_date'],
							'time_travel' => $row['time_travel'],
							'total_price' => $row['total_price'],
							'adult' => array('name' => 'adult', 'value' => $row['adult']),
							'price_adult' => $row['price_adult'],
							'child' => array('name' => 'child', 'value' => $row['child']),
							'price_child' => $row['price_child'],
							'infant' => array('name' => 'infant', 'value' => $row['infant']),
							'price_infant' => $row['price_infant'],
							'payment_status' => $row['payment_status']
						);
						$response['cart_detail']['category'] = $order_type;
						$response['cart_detail']['order_name'] = $row['route'];
						$response['cart_detail']['order_name_detail'] = $row['flight_id_depart'];
					}
					else if ($order_type == 'train'){
						list ($d_station, $a_station) = explode('-', $row['route']);
						$response = array(
							'order_id' => $row['order_id'],
							'order_type' => $order_type,
							'agent_name' => $row['agent_name'],
							'token' => array('name' => 'token', 'value' => $row['token']),
							'train_name' => $row['train_name'],
							'train_id' => array('name' => 'train_id', 'value' => $row['train_id']),
							'route' => $row['route'],
							'depart_station' => array('name' => 'd', 'value' => $d_station),
							'arrival_station' => array('name' => 'a', 'value' => $a_station),
							'departing_date' => array('name' => 'date', 'value' => $row['departing_date']),
							'subclass' => array('name' => 'subclass', 'value' => $row['train_subclass']),
							'kelas' => $row['train_class'],
							'time_travel' => $row['time_travel'],
							'total_price' => $row['total_price'],
							'adult' => array('name' => 'adult', 'value' => $row['adult']),
							'price_adult' => $row['price_adult'],
							'child' => array('name' => 'child', 'value' => $row['child']),
							'price_child' => $row['price_child'],
							'infant' => array('name' => 'infant', 'value' => $row['infant']),
							'price_infant' => $row['price_infant'],
							'payment_status' => $row['payment_status']
						);
					}
					else if ($order_type == 'hotel'){ // for hotel there is no need to proceed it with Tiket.com API
						$response = array(
							'order_id' => $row['order_id'],
							'order_type' => $order_type,
							'agent_name' => $row['agent_name'],
							//'token' => array('name' => 'token', 'value' => $row['token']),
							'hotel_name' => $row['hotel_name'],
							'hotel_id' => $row['hotel_id'],
							'hotel_address' => $row['hotel_address'],
							'hotel_regional' => $row['hotel_regional'],
							'room' => $row['hotel_room'],
							'checkin' => $row['departing_date'],
							'checkout' => $row['returning_date'],
							'night' => $row['time_travel'],
							'total_price' => $row['total_price'],
							'adult' => $row['adult'],
							'child' => $row['child'],
							'payment_status' => $row['payment_status']
						);
					}
					else if ($order_type == 'paket'){ // for paket there is no need to proceed it with Tiket.com API
						$response['order_id'] = $row['order_id'];
						$response['order_timestamp'] = date_format(new DateTime($row['registered_date']), 'd M Y H:i:s');
						$response['limit_order_timestamp'] = date_format($limit_order_timestamp, 'd M Y H:i:s');
						$response['payment_timestamp'] = date_format(new DateTime($row['transfer_date']), 'd M Y H:i:s');
						$response['payment_status'] = strtolower($row['payment_status']);
						$response['total_customer_price'] = number_format($row['total_price'], 0, ',', '.');
						$response['customer_currency'] = $row['currency'];
						$response['order_type'] = 'paket';
						$response['cart_detail']['category'] = $row['category'];
						$response['cart_detail']['order_name'] = $row['title'];
						$response['cart_detail']['order_name_detail'] = $row['mini_slogan'];
					}
					//array_push($response['responses']['general'], $general);
				}
				$con = $this->orders->get_passenger($order_id, 'contact');
				$column = $con->result_array()[0];
				$response['contact']['name'] = $column['title'].' '.$column['first_name'];
				$response['contact']['email'] = $column['email'];
				$response['contact']['phone'] = $column['phone_1'];
				
				break;
			case "tiketcom":
				$token = $this->get_token();
				$url = $this->config->item('api_server').'/check_order?token='.$token.'&order_id='.$order_id.'&email='.$email.'&lang=id&output=json';
				$check_order = $this->get_content($url);
				$json = json_decode($check_order);
				
				$order_timestamp = new DateTime($json->result->order_timestamp);
				$limit_order_timestamp = $order_timestamp->add(new DateInterval('PT1H'));
				
				$response['order_id'] = $json->result->order_id;
				$response['order_system'] = 'tiketcom';
				$response['order_timestamp'] = date_format(new DateTime($json->result->order_timestamp), 'd M Y H:i:s');
				$response['limit_order_timestamp'] = date_format($limit_order_timestamp, 'd M Y H:i:s');
				$response['payment_timestamp'] = date_format(new DateTime($json->result->payment_timestamp), 'd M Y H:i:s');
				$response['payment_status'] = strtolower($json->result->payment_status);
				$response['total_customer_price'] = number_format($json->result->total_customer_price, 0, ',', '.');
				$response['customer_currency'] = $json->result->customer_currency;
				$response['contact_phone'] = $json->result->mobile_phone;
				$response['order_type'] = $json->result->all_order_type;
				
				$cart_detail = $json->result->order__cart_detail;
				for($i=0; $i<sizeof($cart_detail); $i++){
					$response['cart_detail'][$i]['order_type'] = $cart_detail[$i]->order_type;
					$response['cart_detail'][$i]['order_name'] = $cart_detail[$i]->order_name;
					$response['cart_detail'][$i]['order_name_detail'] = $cart_detail[$i]->order_name_detail;
					$response['cart_detail'][$i]['ticket_status'] = strtolower($cart_detail[$i]->detail->ticket_status);
					if(strtolower($json->result->payment_status)=="paid"){
						$response['cart_detail'][$i]['send_voucher'] = $cart_detail[$i]->send_uri;
						$response['cart_detail'][$i]['print_voucher'] = $cart_detail[$i]->print_uri;
					}
					
					if($cart_detail[$i]->order_type=="flight"){
						$response['cart_detail'][$i]['departure_date'] = date_format(new DateTime($cart_detail[$i]->detail->departure_time), 'd M Y');
						$response['cart_detail'][$i]['arrival_date'] = date_format(new DateTime($cart_detail[$i]->detail->arrival_time), 'd M Y');
						$response['cart_detail'][$i]['departure_time'] = date_format(new DateTime($cart_detail[$i]->detail->departure_time), 'H:i');
						$response['cart_detail'][$i]['arrival_time'] = date_format(new DateTime($cart_detail[$i]->detail->arrival_time), 'H:i');
						$response['cart_detail'][$i]['booking_code'] = $cart_detail[$i]->detail->booking_code;
						$passenger = $cart_detail[$i]->passanger;
						$idx_adult = 0;
						$idx_child = 0;
						$idx_infant = 0;
						for($j=0;$j<sizeof($passenger);$j++){
							if($passenger[$j]->passenger_age_group=='adult'){
								$response['passenger'][$i]['adult'][$idx_adult]['baggage'] = $passenger[$j]->passanger_baggage;
								$response['passenger'][$i]['adult'][$idx_adult]['name'] = $passenger[$j]->passenger_name;
								$response['passenger'][$i]['adult'][$idx_adult]['age_group'] = $passenger[$j]->passenger_age_group;
								$response['passenger'][$i]['adult'][$idx_adult]['id_number'] = $passenger[$j]->passenger_id_number;
								$response['passenger'][$i]['adult'][$idx_adult]['birth_date'] = date_format(new DateTime($passenger[$j]->passenger_birth_date), 'd M Y');
								$response['passenger'][$i]['adult'][$idx_adult]['ticket_number'] = $passenger[$j]->passenger_ticket_number;
								$idx_adult++;
							}
							if($passenger[$j]->passenger_age_group=='child'){
								$response['passenger'][$i]['child'][$idx_child]['baggage'] = $passenger[$j]->passanger_baggage;
								$response['passenger'][$i]['child'][$idx_child]['name'] = $passenger[$j]->passenger_name;
								$response['passenger'][$i]['child'][$idx_child]['age_group'] = $passenger[$j]->passenger_age_group;
								$response['passenger'][$i]['child'][$idx_child]['id_number'] = $passenger[$j]->passenger_id_number;
								$response['passenger'][$i]['child'][$idx_child]['birth_date'] = date_format(new DateTime($passenger[$j]->passenger_birth_date), 'd M Y');
								$response['passenger'][$i]['child'][$idx_child]['ticket_number'] = $passenger[$j]->passenger_ticket_number;
								$idx_child++;
							}
							if($passenger[$j]->passenger_age_group=='infant'){
								$response['passenger'][$i]['infant'][$idx_infant]['baggage'] = $passenger[$j]->passanger_baggage;
								$response['passenger'][$i]['infant'][$idx_infant]['name'] = $passenger[$j]->passenger_name;
								$response['passenger'][$i]['infant'][$idx_infant]['age_group'] = $passenger[$j]->passenger_age_group;
								$response['passenger'][$i]['infant'][$idx_infant]['id_number'] = $passenger[$j]->passenger_id_number;
								$response['passenger'][$i]['infant'][$idx_infant]['birth_date'] = date_format(new DateTime($passenger[$j]->passenger_birth_date), 'd M Y');
								$response['passenger'][$i]['infant'][$idx_infant]['ticket_number'] = $passenger[$j]->passenger_ticket_number;
								$idx_infant++;
							}
						}
					}					
				}
				break;
		}
		echo json_encode($response);
	}
}