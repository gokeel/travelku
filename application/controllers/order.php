<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct() {

        parent::__construct();

    	$this->load->model('orders');
		$this->load->model('bank');
		$this->load->model('general');
	}
	
	function get_lion_captcha()
	{	
		$getdata = file_get_contents($this->config->item('api_server').'/flight_api/getLionCaptcha?token='.$this->session->userdata('token').'&output=json');
		$json = json_decode($getdata);
		$lion_captcha = $json->lioncaptcha;
		$lion_session_id = $json->lionsessionid;
		
		return array ($lion_captcha, $lion_session_id);
	}
	
	public function get_token()
	{
		$getdata = file_get_contents($this->config->item('api_server').'/apiv1/payexpress?method=getToken&secretkey=' . $this->config->item('api_key').'&output=json');
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
		$flight_id = $this->input->post('id', TRUE);
		//$ret_flight_id = $this->input->post('ret_flight_id', TRUE);
		$airline_name = $this->input->post('airlines_name', TRUE);
		$depart_date = $this->input->post('departing_date', TRUE);
		$route = $this->input->post('route', TRUE);
		$time_travel = $this->input->post('time_travel', TRUE);
		$tot_price = $this->input->post('total_price', TRUE);
		$admin_fee = $this->input->post('admin_fee', TRUE);
		$price_adult = $this->input->post('price_adult', TRUE);
		$price_child = $this->input->post('price_child', TRUE);
		$price_infant = $this->input->post('price_infant', TRUE);
		$tot_child = $this->input->post('tot_child', TRUE);
		$tot_adult = $this->input->post('tot_adult', TRUE);
		$tot_infant = $this->input->post('tot_infant', TRUE);
		$time_stamp = date ('Y-m-d H:i:s');
		/*$conSalutation = $this->input->post('conSalutation', TRUE);
		$conFirstName = $this->input->post('conFirstName', TRUE);
		$conLastName = $this->input->post('conLastName', TRUE);
		$conPhone = $this->input->post('conPhone', TRUE);
		$conEmailAddress = $this->input->post('conEmailAddress', TRUE);
		$conOtherPhone = $this->input->post('conOtherPhone', TRUE);
		*/
		
		/* for round trip*/
		$flight_id_ret = $this->input->post('flight_id_ret', TRUE);
		$airline_name_ret = $this->input->post('airlines_name_ret', TRUE);
		$depart_date_ret = $this->input->post('depart_date_ret', TRUE);
		$time_travel_ret = $this->input->post('time_travel_ret', TRUE);
		$route_ret = $this->input->post('route_ret', TRUE);
		$total_price_ret = $this->input->post('total_price_ret', TRUE);
		$price_adult_ret = $this->input->post('price_adult_ret', TRUE);
		$price_child_ret = $this->input->post('price_child_ret', TRUE);
		$price_infant_ret = $this->input->post('price_infant_ret', TRUE);
		
		if ($airline_name == 'LION' || $airline_name_ret =='LION')
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
			'account_id' => $account_id,
			'token' => $token,
			'trip_category' => 'flight',
			'airline_name' => $airline_name,
			'flight_id' => $flight_id,
			'flight_id_return' => ($flight_id_ret == '' ? '' : $flight_id_ret),
			'is_round_trip' => ($flight_id_ret == '' ? 'false' : 'true'),
			'route' => $route,
			'departing_date' => $depart_date,
			'returning_date' => $depart_date_ret,
			'time_travel' => $time_travel,
			'total_price' => $tot_price,
			'admin_fee' => $admin_fee,
			'adult' => $tot_adult,
			'price_adult' => $price_adult,
			'child' => $tot_child,
			'price_child' => $price_child,
			'infant' => $tot_infant,
			'price_infant' => $price_infant,
			'order_status' => 'Registered',
			'lion_captcha' => (isset($lioncaptcha) ? $lioncaptcha : ''),
			'lion_session_id' => (isset($lionsessionid) ? $lionsessionid : ''),
			'registered_date' => $time_stamp
		);
		
		$order_id = $this->orders->add_order($data);
		
		/* if round trip*/
		if($flight_id_ret<>''){
			$data_return = array(
				'account_id' => $account_id,
				'token' => $token,
				'trip_category' => 'flight',
				'airline_name' => $airline_name_ret,
				'is_return_flight' => 'true',
				'is_round_trip' => 'true',
				'flight_id' => $flight_id_ret,
				'flight_id_depart' => $flight_id,
				'route' => $route_ret,
				'departing_date' => $depart_date_ret,
				'time_travel' => $time_travel_ret,
				'total_price' => $total_price_ret,
				'admin_fee' => $admin_fee,
				'adult' => $tot_adult,
				'price_adult' => $price_adult_ret,
				'child' => $tot_child,
				'price_child' => $price_child_ret,
				'infant' => $tot_infant,
				'price_infant' => $price_infant_ret,
				'order_status' => 'Registered',
				'lion_captcha' => (isset($lioncaptcha) ? $lioncaptcha : ''),
				'lion_session_id' => (isset($lionsessionid) ? $lionsessionid : ''),
				'registered_date' => $time_stamp
			);
			$order_id_ret = $this->orders->add_order($data_return);
		}
		
		
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
					'nationality' => $this->input->post('passportnationalitya'.$i, TRUE),
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
					'airline_name' => $airline_name,
					'route' => $route,
					'departure_date' => $depart_date,
					'time_travel' => $time_travel,
					'adult' => $tot_adult,
					'child' => $tot_child,
					'infant' => $tot_infant,
					'total_price' => $tot_price,
					'admin_fee' => $admin_fee
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
				redirect(base_url('index.php/webfront/order_success/'.$order_id));
			}
			else
				redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function add_train_order()
	{
		$schedule_id = $this->input->post('id', TRUE);
		$train_id = $this->input->post('train_id', TRUE);
		$class = $this->input->post('class', TRUE);
		$subclass = $this->input->post('subclass', TRUE);
		$train_name = $this->input->post('train_name', TRUE);
		$depart_date = $this->input->post('departing_date', TRUE);
		$route = $this->input->post('route', TRUE);
		$time_travel = $this->input->post('time_travel', TRUE);
		$tot_price = $this->input->post('total_price', TRUE);
		$price_adult = $this->input->post('price_adult', TRUE);
		$price_child = $this->input->post('price_child', TRUE);
		$price_infant = $this->input->post('price_infant', TRUE);
		$tot_child = $this->input->post('tot_child', TRUE);
		$tot_adult = $this->input->post('tot_adult', TRUE);
		$tot_infant = $this->input->post('tot_infant', TRUE);
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
			'total_price' => $tot_price,
			'adult' => $tot_adult,
			'price_adult' => $price_adult,
			'child' => $tot_child,
			'price_child' => $price_child,
			'infant' => $tot_infant,
			'price_infant' => $price_infant,
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
					'total_price' => $tot_price,
					'admin_fee' => $admin_fee
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
				redirect(base_url('index.php/webfront/order_success/'.$order_id));
			}
			else
				redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function add_hotel_order()
	{
		$id = $this->input->post('hotel_id', TRUE);
		$name = $this->input->post('hotel_name', TRUE);
		$address = $this->input->post('hotel_address', TRUE);
		$regional = $this->input->post('regional', TRUE);
		$checkin = $this->input->post('checkin', TRUE);
		$checkout = $this->input->post('checkout', TRUE);
		$night = $this->input->post('night', TRUE);
		$room = $this->input->post('room', TRUE);
		$price = $this->input->post('price', TRUE);
		$tot_adult = $this->input->post('tot_adult', TRUE);
		$tot_child = $this->input->post('tot_child', TRUE);
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
			'departing_date' => $checkin,
			'returning_date' => $checkout,
			'time_travel' => $night,
			'total_price' => $price,
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
					'admin_fee' => $admin_fee
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
				
				redirect(base_url('index.php/webfront/order_success/'.$order_id));
			}
			else
				redirect(base_url('index.php/webfront/order_failed'));
		}
	}
	
	public function issued_order_by_system(){
		$id = $this->uri->segment(3);
		// check the payment status, if in status "requested" then refused to checkout
		list ($order_id, $status) = $this->bank->get_payment_id($id);
		if ($order_id==0){
			$responses['response'] = 'nok';
			$responses['message'] = 'Pelanggan belum melakukan konfirmasi pembayaran';
		}
		else {
			if ($status=='requested'){
				$responses['response'] = 'nok';
				$responses['message'] = 'Status pembayaran pelanggan belum divalidasi. Harap mengubah status pembayaran terlebih dahulu.';
			}
			else if ($status=='validated'){
				//$this->orders->update_order_status($id, 'Issued');
				$data = array(
					'order_status' => 'Issued',
					'issued_date' => date('Y-m-d H:i:s')
				);
				$this->general->update_data_on_table('orders', 'order_id', $id, $data);
				//redirect(base_url('index.php/admin/booking_page'));
				$responses['response'] = 'ok';
			}
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
		$date = $this->input->post('tgl_transfer');
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
		$response['responses']['general'] = array();
		// generate response general info
		foreach ($query->result_array() as $row){
			if ($cat == 'flight'){
				$general = array(
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'airline_name' => $row['airline_name'],
					'flight_id' => array('name' => 'flight_id', 'value' => $row['flight_id']),
					'token' => array('name' => 'token', 'value' => $row['token']),
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
					'price_infant' => $row['price_infant']
				);
			}
			else if ($cat == 'train'){
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
			}
			array_push($response['responses']['general'], $general);
		}
		
		$con = $this->orders->get_passenger($id, 'contact');
		$response['responses']['contact'] = array();
		foreach ($con->result_array() as $row){
			$contact = array(
				'title' => array('name' => 'conSalutation', 'value' => $row['title']),
				'firstname' => array('name' => 'conFirstName', 'value' => $row['first_name']),
				'lastname' => array('name' => 'conLastName', 'value' => $row['last_name']),
				'email' => array('name' => 'conEmailAddress', 'value' => $row['email']),
				'phone' => array('name' => 'conPhone', 'value' => $row['phone_1'])
			);
			array_push($response['responses']['contact'], $contact);
		}
		//fetch & generate passengers
		if ($cat != 'hotel') { // for hotel there is no need to show the passengers, only show the contact person
			//fetch & generate adult
			$con = $this->orders->get_passenger($id, 'adult');
			$response['responses']['adult'] = array();
			if ($cat=='flight'){
				foreach ($con->result_array() as $row){
					$adult = array(
						'title' => array('name' => 'titlea'.$row['order_list'], 'value' => $row['title']),
						'firstname' => array('name' => 'firstnamea'.$row['order_list'], 'value' => $row['first_name']),
						'lastname' => array('name' => 'lastnamea'.$row['order_list'], 'value' => $row['last_name']),
						'birthdate' => array('name' => 'birthdatea'.$row['order_list'], 'value' => $row['birthday']),
						'id' => array('name' => 'ida'.$row['order_list'], 'value' => $row['identity_number']),
						'baggage_direct' => array('name' => 'dcheckinbaggagea1'.$row['order_list'], 'value' => 'FALSE'),
						'baggage_transit' => array('name' => 'dcheckinbaggagea2'.$row['order_list'], 'value' => 'FALSE')
					);
					array_push($response['responses']['adult'], $adult);
				}
			}
			else if($cat=='train'){
				foreach ($con->result_array() as $row){
					$adult = array(
						'title' => array('name' => 'salutationAdult'.$row['order_list'], 'value' => $row['title']),
						'name' => array('name' => 'nameAdult'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
						'birthdate' => array('name' => 'birthDateAdult'.$row['order_list'], 'value' => $row['birthday']),
						'id' => array('name' => 'IdCardAdult'.$row['order_list'], 'value' => $row['identity_number']),
						'phone' => array('name' => 'noHpAdult'.$row['order_list'], 'value' => $row['phone_1'])
					);
					array_push($response['responses']['adult'], $adult);
				}
			}
			
			//fetch & generate child
			$con = $this->orders->get_passenger($id, 'child');
			$response['responses']['child'] = array();
			if ($cat=='flight'){
				foreach ($con->result_array() as $row){
					$child = array(
						'title' => array('name' => 'titlec'.$row['order_list'], 'value' => $row['title']),
						'firstname' => array('name' => 'firstnamec'.$row['order_list'], 'value' => $row['first_name']),
						'lastname' => array('name' => 'lastnamec'.$row['order_list'], 'value' => $row['last_name']),
						'birthdate' => array('name' => 'birthdatec'.$row['order_list'], 'value' => $row['birthday']),
						'id' => array('name' => 'idc'.$row['order_list'], 'value' => $row['identity_number']),
						'baggage_direct' => array('name' => 'dcheckinbaggagec1'.$row['order_list'], 'value' => 'FALSE'),
						'baggage_transit' => array('name' => 'dcheckinbaggagec2'.$row['order_list'], 'value' => 'FALSE')
					);
					array_push($response['responses']['child'], $child);
				}
			}
			else if($cat=='train'){
				foreach ($con->result_array() as $row){
					$child = array(
						'title' => array('name' => 'salutationChild'.$row['order_list'], 'value' => $row['title']),
						'name' => array('name' => 'nameChild'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
						'birthdate' => array('name' => 'birthDateChild'.$row['order_list'], 'value' => $row['birthday'])
					);
					array_push($response['responses']['child'], $child);
				}
			}
			//fetch & generate infant
			$con = $this->orders->get_passenger($id, 'infant');
			$response['responses']['infant'] = array();
			if ($cat=='flight'){
				foreach ($con->result_array() as $row){
					$infant = array(
						'title' => array('name' => 'titlei'.$row['order_list'], 'value' => $row['title']),
						'firstname' => array('name' => 'firstnamei'.$row['order_list'], 'value' => $row['first_name']),
						'lastname' => array('name' => 'lastnamei'.$row['order_list'], 'value' => $row['last_name']),
						'birthdate' => array('name' => 'birthdatei'.$row['order_list'], 'value' => $row['birthday']),
						'parent' => array('name' => 'parenti'.$row['order_list'], 'value' => $row['parent'])
					);
					array_push($response['responses']['infant'], $infant);
				}
			}
			else if($cat=='train'){
				foreach ($con->result_array() as $row){
					$infant = array(
						'title' => array('name' => 'salutationInfant'.$row['order_list'], 'value' => $row['title']),
						'name' => array('name' => 'nameInfant'.$row['order_list'], 'value' => $row['first_name'].' '.$row['last_name']),
						'birthdate' => array('name' => 'birthDateInfant'.$row['order_list'], 'value' => $row['birthday'])
					);
					array_push($response['responses']['infant'], $infant);
				}
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
				'status' => $row['status']
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
		$upd = $this->bank->update_payment_status($id, 'validated');
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
					$getdata = file_get_contents($this->config->item('api_server').'/order/add/flight?'.$post.'&output=json');
				else if ($cat=='train')
					//print_r($this->config->item('api_server').'/order/add/train?'.$post.'&output=json');
					$getdata = file_get_contents($this->config->item('api_server').'/order/add/train?'.$post.'&output=json');
				
				$json = json_decode($getdata);
				$status = $json->diagnostic->status;
				if ($status!="200")
					$this->show_message_page('menambah pesanan ke pihak ketiga', $json->diagnostic->error_msgs);
				else if ($status=="200"){
					// order
					$order_req = file_get_contents($this->config->item('api_server').'/order?token='.$token.'&output=json');
					$order_resp = json_decode($order_req);
					$order_status = $order_resp->diagnostic->status;
					$checkout_link = stripslashes($order_resp->checkout);
					if ($order_status!="200")
						$this->show_message_page('konfirmasi pesanan ke pihak ketiga', $order_resp->diagnostic->error_msgs);
					else if ($order_status=="200"){
						//linking to checkout link
						$checkout_req = file_get_contents($checkout_link.'?token'.$token.'&output=json');
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
		
		$data_order = array(
			'account_id' => $account_id,
			'post_id' => $this->input->post('post_id',TRUE),
			'trip_category' => 'paket',
			'order_status' => 'Registered',
			'registered_date' => date('Y-m-d H:i:s'),
			'total_price' => $price,
			'commission_to_agent' => $comm,
			'purchasing_price' => $purchase_price
		);
		$order_id = $this->orders->add_order($data_order);
		
		$data_passenger = array(
			'order_id' => $order_id,
			'passenger_level' => 'contact',
			'title' => $this->input->post('title', TRUE),
			'first_name' => $this->input->post('first_name', TRUE),
			'last_name' => $this->input->post('last_name', TRUE),
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
			'total_price' => $price
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
		$airline_name = $this->input->post('airline_name', TRUE);
		$airline_name_ret = $this->input->post('airline_name_ret', TRUE);
		$date_go = $this->input->post('date_go', TRUE);
		$error_passport_date = false;
		foreach($post as $key => $value){
			if($key<>'airline_name' or $key<>'airline_name_ret' or $key<>'date_go')
				$url_param .= $key.'='.$value.'&';
			if((strpos($key,'passportExpiryDate') !== false) and ($airline_name=='LION')){
				$datetime1 = date_create($date_go);
				$datetime2 = date_create($value);
				$interval = date_diff($datetime1, $datetime2);
				$diff = intval($interval->format('%a'));
				if($diff<=240)
					$error_passport_date = true;
			}
		}
		if($error_passport_date){
			$response = array(
				'status' => '210',
				'error' => 'Masa berakhir passport untuk maskapai LION harus lebih dari 6 bulan dari tanggal keberangkatan',
				'category' => 'flight'
			);
		}
		else{
			list ($lioncaptcha, $lionsessionid) = $this->get_lion_captcha();
			$url_param .= 'lioncaptcha='.$lioncaptcha.'&lionsessionid='.$lionsessionid;
			$url_param .= '&lang=id&output=json';
			$url = $this->config->item('api_server').'/order/add/flight?'.$url_param;
			
			$send_request = file_get_contents($url);
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
				$send_order = file_get_contents($url_order);
				$response_order = json_decode($send_order);
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
					$total_before_discount = intval($myorder->total_without_tax) + intval($myorder->data[0]->detail->baggage_fee) + intval($myorder->total_tax);
					//save to db
					$data_insert = array(
						'order_id' => $response_order->myorder->order_id,
						'category' => 'flight',
						'token' => $response_order->token,
						'delete_uri' => $myorder->data[0]->delete_uri,
						'price_no_discount' => $total_before_discount,
						'price_with_discount' => $total_before_discount - intval($myorder->discount_amount),
						'status' => 'checkout'
					);
					$internal_order_id = $this->orders->add_order_tiketcom($data_insert);
					
					//generate success page
					
					$response = array(
						'status' => $diagnose->status,
						'error' => '',
						'category' => 'flight',
						'internal_order_id' => $internal_order_id,
						'order_id' => $myorder->order_id,
						'price' => $myorder->total_without_tax,
						'baggage' => $myorder->data[0]->detail->baggage_fee,
						'tax' => $myorder->total_tax,
						'total_price' => $total_before_discount,
						'discount' => $myorder->discount_amount,
						'after_discount' => $total_before_discount - intval($myorder->discount_amount),
						'checkout_uri' => 'checkout_uri='.$response_order->checkout.'&token='.$response_order->token
					);
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
		$send_request = file_get_contents($url);
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
			$send_order = file_get_contents($url_order);
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
		
		$send_request = file_get_contents($url);
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
			$param = 'token='.$token.'&salutation=Mr&firstName=admin&lastName=travelku&emailAddress=tiketcom@travelku.co&phone=%2B628123081785&saveContinue=2&lang=id&output=json';
			$cc_url = $cc_uri.$param;
			$send_request_2 = file_get_contents($cc_url);
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
		$req_order_id = $this->general->get_afield_by_id('orders_in_tiketcom', 'id', $internal_order_id, 'order_id');
		foreach($req_order_id->result_array() as $row)
			$order_id = $row['order_id'];
		$req_price_no_discount = $this->general->get_afield_by_id('orders_in_tiketcom', 'id', $internal_order_id, 'price_no_discount');
		foreach($req_price_no_discount->result_array() as $row)
			$price_no_discount = $row['price_no_discount'];
		$req_price_with_discount = $this->general->get_afield_by_id('orders_in_tiketcom', 'id', $internal_order_id, 'price_with_discount');
		foreach($req_price_with_discount->result_array() as $row)
			$price_with_discount = $row['price_with_discount'];
		
		$url = $uri.'?token='.$token.'&lang=id&output=json';
		$send_request = file_get_contents($url);
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
			$json_response['price_no_discount'] = $price_no_discount;
			$json_response['price_with_discount'] = $price_with_discount;
			
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
			$url = $this->input->post('link');
			$param = '?token='.$this->input->post('token');
			$param .= '&user_bca='.$this->input->post('user_bca', TRUE);
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = file_get_contents($url.$param);
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
			$url = $this->input->post('link');
			$param = '?token='.$this->input->post('token');
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = file_get_contents($url.$param);
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
			$url = $this->input->post('link');
			$param = '?token='.$this->input->post('token');
			$param .= '&btn_booking=1&currency=IDR&lang=id&output=json';
			$send_request = file_get_contents($url.$param);
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
			}
		}
		
		/*$this->load->view('front_header');
		$this->load->view('front_after_choose_payment_tiketcom', $response);
		$data['column'] = (strpos('-second-faq', 'second')!==false ? '-second-faq' : '');
		$data['footer_column'] = (strpos('-second-faq', 'second')!==false ? '-second' : '');
		$this->load->view('front_right_sidebar', $data);
		$this->load->view('front_footer', $data);*/
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
		
		$send_request = file_get_contents($confirm_uri.'&'.$url_param);
		print_r($send_request);
	}
	
	public function tiketcom_cancel_order(){
		$order_id = $this->input->post('orderId', TRUE);
		$details = $this->general->get_detail_by_id('orders_in_tiketcom', 'order_id', $order_id);
		foreach ($details->result_array() as $row){
			$token = $row['token'];
			$delete_uri = $row['delete_uri'];
		}
		$send_request = file_get_contents($delete_uri.'&token='.$token.'&output=json&lang=id');
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
	
	
}