<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {
	public function __construct() {
		parent::__construct();

        $this->load->helper('form');
        $this->load->model('users');
		$this->load->model('agents');
		$this->load->model('bank');	
		$this->load->model('orders');	
		$this->load->model('general');	
	}
	
	public function home(){
		$this->page('agent_home');
		
	}
	
	/**********************************/
	/**			PAGES				 **/
	/**********************************/
	function page($page_request, $additional=null){
		//get data of current user logged in
		$id = $this->session->userdata('account_id');
		$get = $this->agents->get_agent_by_id_no_join($id);
		foreach ($get->result_array() as $row){
			$data_money['deposit'] = number_format($row['deposit_amount'], 0, ',', '.');
			$data_money['voucher'] = $row['voucher'];
			$data_money['point_reward'] = $row['point_reward'];
		}
		//get bank accounts
		$bank = $this->bank->get_all_bank();
		
		$data = array('money' => $data_money, 'bank' => $bank);
		$this->load->view('agent_header');
		$this->load->view($page_request, $additional);
		$this->load->view('agent_navigation', $data);
		$this->load->view('agent_footer');
	}
	
	public function order_page(){
		$this->page('agent_add_order');
	}
	
	public function topup_page(){
		$data = array('response'=>'');
		$this->page('agent_deposit_topup', $data);
	}
	
	public function withdraw_page(){
		$agent_id = $this->session->userdata('account_id');
		$get_deposit = $this->agents->get_afield_by_agent_id('deposit_amount', $agent_id);
		foreach($get_deposit->result_array() as $row)
			$deposit_amount = $row['deposit_amount'];
		$deposit_amount_after_cut = intval($deposit_amount)-50000;
		$data = array('response'=>'', 'deposit_amount' => number_format($deposit_amount_after_cut, 0, ',', '.'));
		$this->page('agent_deposit_withdraw', $data);
	}
	
	public function report_order(){
		$data = array(
			'uri' => $this->uri->segment(3)
		);
		$this->page('agent_report_booking', $data);
	}
	
	public function report_deposit(){
		$data = array(
			'uri' => $this->uri->segment(3)
		);
		$this->page('agent_report_deposit', $data);
	}
	
	public function landing_page(){
		$this->page('agent_landing_page');
	}
	
	//Cindy Nordiansyah
	public function manage_staff() {
		$this->page('agent_manage_staff');
	}
	//Cindy Nordiansyah
	public function profile_edit() {
		$this->page('agent_profile_edit');
	}
	//Cindy Nordiansyah
	public function edit_logo() {
		$data['message'] = '';
		$this->page('agent_edit_logo', $data);
	}
	//Cindy Nordiansyah
	public function change_password() {
		$data['message'] = '';
		$this->page('agent_change_password', $data);
	}
	public function login_airlines_page() {
		$data['message'] = '';
		$this->page('agent_login_airlines', $data);
	}
	/**********************************/
	/**			END-OF-PAGES				 **/
	/**********************************/
	
	public function add_deposit_request(){
		foreach ($this->input->post(NULL, TRUE) as $key => $value)
			$data[$key] = $value;
		$data['request_date'] = date('Y-m-d H:i:s');
		$ins = $this->agents->add_deposit_request($data);
		
		if ($ins){
			$query_email = $this->general->get_afield_by_id('agents', 'agent_id', $data['agent_id'], 'agent_email');
			foreach($query_email->result_array() as $row)
				$agent_email = $row['agent_email'];
			$query_username = $this->general->get_afield_by_id('agents', 'agent_id', $data['agent_id'], 'agent_username');
			foreach($query_username->result_array() as $row)
				$agent_username = $row['agent_username'];
			//preparing to send email
			$content = array(
				'username' => $agent_username,
				'nominal' => $data['nominal']
			);
				
			//get email disribution
			$this->load->model('notification');
			list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-topup-request');
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
			$this->email->to($agent_email);
			$this->email->cc($cc);
			$this->email->bcc($bcc);
					
			$this->email->subject('Request Top Up');
			$messages = $this->load->view('email_tpl/new_topup_request', $content, TRUE);
			$this->email->message($messages);

			$this->email->send();
			//insert notification
			$notif = array(
				'category' => 'new-topup-request',
				'message' => 'Request Topup Baru - Agent ID = '.$data['agent_id'].' - '.$agent_username,
				'created_datetime' => date('Y-m-d H:i:s')
			);
			$this->general->add_to_table('notifications', $notif);
			//end notif
			
			$resp['response'] = 'Data berhasil dimasukkan, kami akan segera memasukkan deposit ke akun anda.';
		}
			
		else
			$resp['response'] = 'Data tidak berhasil dimasukkan, mohon hubungi agen pusat / administrator.';
		$this->page('agent_deposit_topup', $resp);
	}
	
	public function add_withdraw_request(){
		// compare the deposit amount with the nominal request
		$nominal = $this->input->post('nominal', TRUE);
		$agent_id = $this->session->userdata('account_id');
		$get_deposit = $this->agents->get_afield_by_agent_id('deposit_amount', $agent_id);
		foreach($get_deposit->result_array() as $row)
			$deposit_amount = $row['deposit_amount'];
		if ($nominal <= $deposit_amount){
			foreach ($this->input->post(NULL, TRUE) as $key => $value)
				$data[$key] = $value;
			$data['request_date'] = date('Y-m-d H:i:s');
			$ins = $this->agents->add_withdraw_request($data);
			if ($ins){
				$query_email = $this->general->get_afield_by_id('agents', 'agent_id', $data['agent_id'], 'agent_email');
				foreach($query_email->result_array() as $row)
					$agent_email = $row['agent_email'];
				$query_username = $this->general->get_afield_by_id('agents', 'agent_id', $data['agent_id'], 'agent_username');
				foreach($query_username->result_array() as $row)
					$agent_username = $row['agent_username'];
				//preparing to send email
				$content = array(
					'username' => $agent_username,
					'nominal' => $nominal
				);
					
				//get email disribution
				$this->load->model('notification');
				list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-withdraw-request');
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
				$this->email->to($agent_email);
				$this->email->cc($cc);
				$this->email->bcc($bcc);
						
				$this->email->subject('Request Withdraw');
				$messages = $this->load->view('email_tpl/new_withdraw_request', $content, TRUE);
				$this->email->message($messages);

				$this->email->send();
				//insert notification
				$notif = array(
					'category' => 'new-withdraw-request',
					'message' => 'Request Withdraw Baru - Agent ID = '.$agent_id.' - '.$agent_username,
					'created_datetime' => date('Y-m-d H:i:s')
				);
				$this->general->add_to_table('notifications', $notif);
				//end notif
				
				$resp['response'] = 'Data berhasil dimasukkan, kami akan segera memproses dari akun anda.';
			}
			else
				$resp['response'] = 'Data tidak berhasil dimasukkan, mohon hubungi agen pusat / administrator.';
		}
		else
			$resp['response'] = 'Nominal yang anda inginkan tidak boleh melebihi maksimal penarikan.';
		
		$resp['deposit_amount'] = $deposit_amount;
		$this->page('agent_deposit_withdraw', $resp);
	}
	
	function get_topup_by_agent(){
		$id = $this->session->userdata('account_id');
		$topup = $this->agents->get_topup_by_agent_id($id);
		$number_row=0;
		foreach ($topup->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'agent_name' => $row['agent_name'],
				'bank_from' => $row['bank_from'],
				'sender_number' => $row['sender_account_number'],
				'sender_name' => $row['sender_account_name'],
				'bank_name' => $row['bank_name'],
				'transfer_date' => $row['transfer_date'],
				'nominal' => $row['nominal'],
				'status' => $row['status'],
				'request_date' => $row['request_date']
			);
		}
		echo json_encode($data);
	}
	
	function get_withdraw_by_agent(){
		$id = $this->session->userdata('account_id');
		$topup = $this->agents->get_withdraw_by_agent_id($id);
		$number_row=0;
		foreach ($topup->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'agent_name' => $row['agent_name'],
				'bank_to' => $row['bank_to'],
				'receiver_number' => $row['receiver_account_number'],
				'receiver_name' => $row['receiver_account_name'],
				'message' => $row['message'],
				'nominal' => $row['nominal'],
				'status' => $row['status'],
				'request_date' => $row['request_date']
			);
		}
		echo json_encode($data);
	}
	
	public function get_registered_order(){
		$category = $this->uri->segment(3);
		$account_id = $this->session->userdata('account_id');
		$query = $this->orders->get_registered_order($category, $account_id, true);
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row ++;
			if ($category=='flight')
				$data[] = array(
					'number_row' => $number_row,
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'airline_name' => $row['airline_name'],
					'flight_id' => $row['flight_id'],
					'route' => $row['route'],
					'departing_date' => $row['departing_date'],
					'time_travel' => $row['time_travel'],
					'total_price' => $row['total_price'],
					'adult' => $row['adult'],
					'price_adult' => $row['price_adult'],
					'child' => $row['child'],
					'price_child' => $row['price_child'],
					'infant' => $row['infant'],
					'price_infant' => $row['price_infant'],
					'payment_status' => $row['status']
				);
			else if ($category=='train')
				$data[] = array(
					'number_row' => $number_row,
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'name' => $row['train_name'],
					'id' => $row['train_id'],
					'subclass' => $row['train_class'],
					'route' => $row['route'],
					'departing_date' => $row['departing_date'],
					'time_travel' => $row['time_travel'],
					'total_price' => $row['total_price'],
					'adult' => $row['adult'],
					'price_adult' => $row['price_adult'],
					'child' => $row['child'],
					'price_child' => $row['price_child'],
					'infant' => $row['infant'],
					'price_infant' => $row['price_infant'],
					'payment_status' => $row['status']
				);
				else if ($category=='hotel')
				$data[] = array(
					'number_row' => $number_row,
					'order_id' => $row['order_id'],
					'agent_name' => $row['agent_name'],
					'name' => $row['hotel_name'],
					'id' => $row['hotel_id'],
					'address' => $row['hotel_address'],
					'regional' => $row['hotel_regional'],
					'checkin' => $row['departing_date'],
					'checkout' => $row['returning_date'],
					'night' => $row['time_travel'],
					'room' => $row['hotel_room'],
					'total_price' => $row['total_price'],
					'adult' => $row['adult'],
					'child' => $row['child'],
					'payment_status' => $row['status']
				);
		}
		echo json_encode($data);
	}
	
	public function get_daily_sales(){
		$yymm = $this->uri->segment(3);
		$query = $this->orders->order_sum_omzet_daily($yymm);
		foreach($query->result_array() as $row){
			$data[] = array(
				'day' => $row['day_of_transaction'],
				'total' => $row['transaction'],
				'omzet' => $row['omzet']
			);
		}
		echo json_encode($data);
	}
	
	public function get_monthly_sales(){
		$yy = $this->uri->segment(3);
		$query = $this->orders->order_sum_omzet_monthly($yy);
		foreach($query->result_array() as $row){
			$data[] = array(
				'month' => $row['month_of_transaction'],
				'total' => $row['transaction'],
				'omzet' => $row['omzet']
			);
		}
		echo json_encode($data);
	}
	
	//Cindy Nordiansyah
	public function profil_update() {
		$id = $this->session->userdata('account_id');
		$gets=$this->input->get(NULL,TRUE);
		foreach($gets as $key => $value){
			if ($key<>'_')
				$data[$key] = $value;
		}
		$upd = $this->general->update_data_on_table('agents','agent_id', $id, $data);
	}
	//Cindy Nordiansyah
	public function show_profil(){
		$id = $this->session->userdata('account_id');
		$query = $this->agents->get_agent_by_id($id);
		foreach ($query->result_array() as $row){
			$data = array(
				'nama_agent' => $row['agent_name'],
				'alamat_agent' => $row['agent_address'],
				'telp_agent' => $row['agent_phone'],
				'kota_agent' => $row['agent_city'],
				'kota' => $row['agent_city_name'],
				'fax_agent' => $row['agent_fax'],
				'ym_agent' => $row['agent_yahoo'],
				'website_agent' => $row['agent_website'],
				'email_agent' => $row['agent_email']
				
			);
		}
		echo json_encode($data);
	}
	//Cindy Nordiansyah
	public function user_change_password() {
		$id = $this->session->userdata('account_id');
		$check_pass = $this->users->get_password_by_id($id, $this->input->post('password-now', TRUE));
		if ($check_pass==false){
			echo "password salah";
			echo $this->input->post('password-now', TRUE);
			$data['message'] = 'Password salah, perubahan password gagal';
			$this->page('agent_change_password', $data);
		}	
		else{
			$data = array('password' => md5($this->input->post('password-new', TRUE)));
			$upd = $this->users->edit_user($id, $data);
			if($upd){
				$data['message'] = 'Password berhasil dirubah';
				$this->page('agent_change_password', $data);
			}
			else{
				$data['message'] = 'Gagal merubah password';
				$this->page('agent_change_password', $data);
			}
		}
		//}
	}
	//Cindy Nordiansyah
	public function do_upload_logo()
	{
		$id = $this->session->userdata('account_id');
		$config['upload_path'] = './assets/uploads/agent_logos/';
		$config['file_name'] = 'logo_'.$this->session->userdata('user_name');
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '2000';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$ext = end(explode(".", $this->upload->file_name));
			$namafile = 'logo_'.$this->session->userdata('user_name').'.'.$ext;
			$datalogo = array(
				'agent_logo' => $namafile
			);
			$upd = $this->agents->edit_agent($id, $datalogo);
			$data['message'] = '';
			$this->page('agent_edit_logo', $data);
			
				
		}
	}
	//Cindy Nordiansyah
	function show_logo() 
	{
		$id = $this->session->userdata('account_id');

		$query = $this->agents->get_afield_by_agent_id('agent_logo', $id);
		foreach ($query->result_array() as $row){
			$data = array(
				'logo_agent' => $row['agent_logo']				
			);
		}
		echo json_encode($data);
	}
}
?>