<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {

        parent::__construct();

        $this->load->helper('form');
        $this->load->model('general');
        $this->load->model('users');
		$this->load->model('agents');
		$this->load->model('bank');
		$this->load->model('orders');
		$this->load->model('posts');
		$this->load->model('cities');
		$this->load->model('yahoo_messenger');
		$this->load->model('assets');
	}
	
	public function index() {
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('user_level')=='administrator')
				redirect(base_url('index.php/admin/admin_page'));
			else if ($this->session->userdata('user_level')=='agent')
				redirect(base_url('index.php/agent/home'));
		} else {
			$this->warning = '';
			$this->load_theme('login');
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
	
	function check_session($user_level){
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('user_level')==$user_level)
				return true;
			else return false;
		} else return false;
	}
	function login() {
		$this->warning = '';
		$this->load->view('admin_login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('index.php/admin'));
	}

	function cek_login(){
		$data['warning'] = '';
        if ($this->input->post('username') and $this->input->post('password')) {

            if ($this->users->login($this->input->post('username'), md5($this->input->post('password'))) ){
				if ($this->session->userdata('user_level')=='administrator')
					redirect(base_url('index.php/admin/admin_page'));
				else if ($this->session->userdata('user_level')=='agent')
					redirect(base_url('index.php/agent/home'));
			}
				
            else $this->warning = '<p style="color:#f30;">Username atau Password Anda Salah..! Silahkan ulangi lagi </p>';
		}
		$this->load_theme('login');
	}
	/*******************************************/
	
	/**				Any pages will be here	  **/
	
	/*******************************************/
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
	
	function show_success_page($message){
		$data = array(
				'user_name' => $this->session->userdata('user_name'),
				'ip_address' => $this->session->userdata('ip_address'),
				'title' => 'Pesan Berhasil',
				'subtitle' => '',
				'message' => $message
			);
			$this->load->view('admin_page_header', $data);
			$this->load->view('admin_any_message', $data);
			$this->load->view('admin_page_footer');
	}
	
	
	function page($page_request, $additional=null){
		$data = array(
			'user_name' => $this->session->userdata('user_name'),
			'ip_address' => $this->session->userdata('ip_address')
		);
		if ($additional != null)
			$data['by_status'] = $additional;
		$this->load->view('admin_page_header', $data);
		if (strpos($page_request, 'admin_agent') !== false)
			$this->load->view('admin_agent_header');
		if (strpos($page_request, 'admin_setting') !== false)
			$this->load->view('admin_setting_header');
		if (strpos($page_request, 'admin_booking') !== false)
			$this->load->view('admin_booking_header');
		if (strpos($page_request, 'admin_deposit') !== false)
			$this->load->view('admin_deposit_header');
		if (strpos($page_request, 'admin_cms') !== false)
			$this->load->view('admin_cms_header');
		if (strpos($page_request, 'admin_assets') !== false)
			$this->load->view('admin_assets_header');
		$this->load->view($page_request, $additional);
		$this->load->view('admin_page_footer');
	}
	
	public function admin_page(){
		if($this->check_session('administrator'))
			$this->page('admin_page');
		else
			$this->no_right_access();
	}
	function no_right_access(){
		$this->page('admin_no_right_access');
	}
	public function agent_page(){
		if($this->check_session('administrator'))
			$this->page('admin_agent');
		else
			$this->no_right_access();
	}
	
	public function setting_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting');
		else
			$this->no_right_access();
	}
	
	public function deposit_page(){
		if($this->check_session('administrator'))
			$this->page('admin_deposit');
		else
			$this->no_right_access();
	}
	
	public function agent_page_by_status(){
		if($this->check_session('administrator')){
			$status = $this->uri->segment(3);
			$this->page('admin_agent_by_status', $status);
		}
		else
			$this->no_right_access();
		
	}
	
	public function setting_bank_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_bank');
		else
			$this->no_right_access();
		
	}
	
	public function booking_page(){
		if($this->check_session('administrator'))
			$this->page('admin_booking_page');
		else
			$this->no_right_access();
		
	}
	
	public function booking_issued(){
		if($this->check_session('administrator'))
			$this->page('admin_booking_page_issued');
		else
			$this->no_right_access();
		
	}
	
	public function booking_cancelled(){
		if($this->check_session('administrator'))
			$this->page('admin_booking_page_cancelled');
		else
			$this->no_right_access();
		
	}
	
	public function validate_payment(){
		if($this->check_session('administrator'))
			$this->page('admin_booking_validate_payment');
		else
			$this->no_right_access();
		
	}
	
	public function setting_user_page(){
		if($this->check_session('administrator')){
			$uri3= $this->uri->segment(3);
			if ($uri3=='office')
				$this->page('admin_setting_user_office');
			else if ($uri3=='tiket')
				$this->page('admin_setting_user_tiket');
			else if ($uri3=='uas')
				$this->page('admin_setting_user_uas');
		}
		else
			$this->no_right_access();
		
	}
	
	public function setting_commission_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_commission');
		else
			$this->no_right_access();
		
	}
	
	public function setting_commission_modify(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_commission_modify');
		else
			$this->no_right_access();
		
	}

	public function setting_city_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_city');
		else
			$this->no_right_access();
			
	}
	
	public function setting_yahoo_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_yahoo');
		else
			$this->no_right_access();
		
	}
	
	public function setting_agent_news_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_news_agent');
		else
			$this->no_right_access();
		
	}
	
	public function setting_kurs_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_kurs');
		else
			$this->no_right_access();
		
	}
	
	public function setting_kurs_modify(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_kurs_modify');
		else
			$this->no_right_access();
		
	}
	
	public function setting_deposit_topup(){
		if($this->check_session('administrator'))
			$this->page('admin_deposit_topup_page');
		else
			$this->no_right_access();
		
	}
	
	public function setting_deposit_withdraw(){
		if($this->check_session('administrator'))
			$this->page('admin_deposit_withdraw_page');
		else
			$this->no_right_access();
		
	}
	
	public function any_message(){
		$data = array(
				'user_name' => $this->session->userdata('user_name'),
				'ip_address' => $this->session->userdata('ip_address'),
				'title' => 'Pesan Kesalahan',
				'subtitle' => 'Terjadi kesalahan pada saat memproses masukan anda',
				'message' => 'Ono error jeh'
			);
			$this->load->view('admin_page_header', $data);
			$this->load->view('admin_any_message', $data);
			$this->load->view('admin_page_footer');
	}
	public function agent_data_page(){
		if($this->check_session('administrator'))
			$this->page('admin_agent_data_modify');
		else
			$this->no_right_access();
		
	}
	public function edit_agent(){
		if($this->check_session('administrator'))
			$this->page('admin_agent_data_modify');
		else
			$this->no_right_access();
		
	}
	public function user_edit_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_user_modify');
		else
			$this->no_right_access();
		
	}
	
	public function my_account_page(){
		if($this->check_session('administrator'))
			$this->page('admin_my_account_page');
		else
			$this->no_right_access();
		
	}
	
	public function cms_page(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_page');
		else
			$this->no_right_access();
		
	}
	
	public function content_category_page(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_content_category');
		else
			$this->no_right_access();
	}
	public function content_review(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_content_review');
		else
			$this->no_right_access();
		
	}
	public function edit_content_category(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_content_category_modify');
		else
			$this->no_right_access();
		
	}
	public function content_add_page(){
		if($this->check_session('administrator')){
			//create a blank row and insert to post, finally get the inserted ID
		$get_id = $this->posts->add_blank_post();
		$this->page('admin_cms_content_add', array('id' => $get_id));
		}
		else
			$this->no_right_access();
	}
	
	public function content_add_nonpaket_page(){
		if($this->check_session('administrator')){
			//create a blank row and insert to post, finally get the inserted ID
			$get_id = $this->posts->add_blank_post();
			$this->page('admin_cms_content_add_nonpaket', array('id' => $get_id));
		}
		else
			$this->no_right_access();
	}
	
	public function content_modify(){
		if($this->check_session('administrator')){
			$id = $this->uri->segment(3);
			$this->page('admin_cms_content_modify', array('id' => $id));
		}
		else
			$this->no_right_access();
		
	}
	
	public function content_modify_nonpaket(){
		if($this->check_session('administrator')){
			$id = $this->uri->segment(3);
			$this->page('admin_cms_content_modify_nonpaket', array('id' => $id));
		}
		else
			$this->no_right_access();
		
	}
	
	public function setting_email_dist(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_email_dist');
		else
			$this->no_right_access();
		
	}
	
	public function setting_email_dist_modify(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_email_dist_modify');
		else
			$this->no_right_access();
	}
	
	public function notification_page(){
		if($this->check_session('administrator'))
			$this->page('admin_notification');
		else
			$this->no_right_access();
	}
	
	public function option_setting(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_option_setting');
		else
			$this->no_right_access();
	}
	
	public function option_modify(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_option_modify');
		else
			$this->no_right_access();
	}
	
	public function agent_news(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_agent_news');
		else
			$this->no_right_access();
	}
	
	public function agent_news_add(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_agent_news_add');
		else
			$this->no_right_access();
	}
	
	public function agent_news_modify(){
		if($this->check_session('administrator'))
			$this->page('admin_cms_agent_news_modify');
		else
			$this->no_right_access();
	}
	
	//cindy nordiansyah
	public function assets_page(){
		if($this->check_session('administrator'))
			$this->page('admin_assets');
		else
			$this->no_right_access();
	}
	
	public function setting_switch_order_page(){
		if($this->check_session('administrator'))
			$this->page('admin_setting_switch_order_system');
		else
			$this->no_right_access();
	}
	/******************************/
	
	/**		PAGES END			 **/
	
	/******************************/
	
	public function delete_agent(){
		$id = $this->uri->segment(3);
		//delete on table agents
		$query = $this->agents->del_agent($id);
		//also delete the user on table users
		$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/agent_page'));
	}
	
	public function detail_agent(){
		$data = array(
			'user_name' => $this->session->userdata('user_name'),
			'ip_address' => $this->session->userdata('ip_address')
		);
		$this->load->view('admin_page_header', $data);
		$this->load->view('admin_agent_data_detail');
		$this->load->view('admin_page_footer');
	}
	
	public function proceed_order(){
		$data = array(
			'user_name' => $this->session->userdata('user_name'),
			'ip_address' => $this->session->userdata('ip_address')
		);
		$this->load->view('admin_page_header', $data);
		$this->load->view('admin_booking_checkout');
		$this->load->view('admin_page_footer');
	}

	
	public function agent_add(){
		/*$config['upload_path'] = './assets/uploads/agent_license_files';
		$config['file_name'] = $this->input->post('lisensi_number',TRUE);
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('lisensi_file'))
			$this->show_message_page('mengunggah foto',$this->upload->display_errors());
		else {
			$upload_data = $this->upload->data(); 
			$file_name =   $upload_data['file_name'];
		}
		*/
		$data_user = array(
			'user_name' => $this->input->post('username', TRUE),
			'email_login' => $this->input->post('email',TRUE),
			'password' => md5($this->input->post('password',TRUE)),
			'user_level' => 'agent',
			'registered_date' => date('Y-m-d')
		);
		$this->load->model('users');
		$insert_id = $this->users->add_user($data_user);
		
		$data = array(
			'agent_id' => $insert_id,
			'agent_name' => $this->input->post('company_name', TRUE),
			'agent_username' => $this->input->post('username', TRUE),
			'agent_type_id' => $this->input->post('member_type',TRUE),
			'join_date' => $this->input->post('join_date',TRUE),
			'agent_address' => $this->input->post('address',TRUE),
			'agent_phone' => $this->input->post('telp_no',TRUE),
			'agent_city' => $this->input->post('id_kota',TRUE),
			'agent_fax' => $this->input->post('fax',TRUE),
			'agent_yahoo' => $this->input->post('yahoo_account',TRUE),
			'agent_website' => $this->input->post('website',TRUE),
			'agent_email' => $this->input->post('email',TRUE),
			//'license_number' => $this->input->post('lisensi_number',TRUE),
			//'license_file' => $file_name,
			'agent_manager_name' => $this->input->post('manager_name',TRUE),
			'agent_manager_phone' => $this->input->post('manager_phone',TRUE),
			'agent_manager_email' => $this->input->post('manager_email',TRUE),
			'parent_agent_id' => $this->input->post('id_agen_upline',TRUE),
			'password' => md5($this->input->post('password',TRUE)),
			'deposit_amount' => $this->input->post('deposit_amount',TRUE),
			'voucher' => $this->input->post('voucher',TRUE),
			'approved' => $this->input->post('approve',TRUE),
			'point_reward' => $this->input->post('point_reward',TRUE)
		);
		$add = $this->agents->add_agent($data);
		
		//preparing to send email
		$content = array(
			'name' => $this->input->post('company_name', TRUE),
			'username' => $this->input->post('username', TRUE),
			'password' => $this->input->post('password', TRUE)
		);
		
		//get email disribution
		$this->load->model('notification');
		list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-agent-register');
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
		
		$this->email->subject('Registrasi Agen Berhasil');
		$messages = $this->load->view('email_tpl/registrasi_agen_berhasil', $content, TRUE);
		$this->email->message($messages);

		$this->email->send();
		//insert notification
		$notif = array(
			'category' => 'new-agent-register',
			'message' => 'Agen baru terdaftar dengan username '.$this->input->post('username', TRUE),
			'created_datetime' => date('Y-m-d H:i:s')
		);
		$this->general->add_to_table('notifications', $notif);
		
		redirect(base_url('index.php/admin/agent_page'));
	}
	
	public function agent_register(){
		$data_user = array(
			'user_name' => $this->input->post('username', TRUE),
			'email_login' => $this->input->post('email',TRUE),
			'password' => md5($this->input->post('password',TRUE)),
			'user_level' => 'agent',
			'registered_date' => date('Y-m-d')
		);
		$this->load->model('users');
		$insert_id = $this->users->add_user($data_user);
		
		$data = array(
			'agent_id' => $insert_id,
			'agent_name' => $this->input->post('company_name', TRUE),
			'agent_username' => $this->input->post('username', TRUE),
			'agent_type_id' => $this->input->post('member_type',TRUE),
			'join_date' => date('Y-m-d'),
			'agent_address' => $this->input->post('address',TRUE),
			'agent_phone' => $this->input->post('telp_no',TRUE),
			'agent_city' => $this->input->post('id_kota',TRUE),
			'agent_yahoo' => $this->input->post('yahoo_account',TRUE),
			'agent_email' => $this->input->post('email',TRUE),
			//'license_number' => $this->input->post('lisensi_number',TRUE),
			//'license_file' => $file_name,
			'agent_manager_name' => $this->input->post('company_name',TRUE),
			'agent_manager_phone' => $this->input->post('telp_no',TRUE),
			'agent_manager_email' => $this->input->post('email',TRUE),
			'parent_agent_id' => $this->input->post('id_agen_upline',TRUE),
			'password' => md5($this->input->post('password',TRUE)),
			'approved' => 'Trial'
		);
		$add = $this->agents->add_agent($data);
		
		//preparing to send email
		$content = array(
			'name' => $this->input->post('company_name', TRUE),
			'username' => $this->input->post('username', TRUE),
			'password' => $this->input->post('password', TRUE)
		);
		
		//get email disribution
		$this->load->model('notification');
		list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('new-agent-register');
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
		
		$this->email->subject('Registrasi Agen Berhasil');
		$messages = $this->load->view('email_tpl/registrasi_agen_berhasil', $content, TRUE);
		$this->email->message($messages);

		$this->email->send();
		//insert notification
		$notif = array(
			'category' => 'new-agent-register',
			'message' => 'Agen baru terdaftar dengan username '.$this->input->post('username', TRUE),
			'created_datetime' => date('Y-m-d H:i:s')
		);
		$this->general->add_to_table('notifications', $notif);

		
		redirect(base_url('index.php/webfront/agent_registration/success'));
	}
	
	public function agent_edit(){
		$id = $this->uri->segment(3);
		
		/*$config['upload_path'] = './assets/uploads/agent_license_files';
		$config['file_name'] = $this->input->post('lisensi_number',TRUE);
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$file_name = '';
		if (isset($_FILES['lisensi_file'])){
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('lisensi_file'))
				$this->show_message_page('mengunggah foto',$this->upload->display_errors());
			else {
				$upload_data = $this->upload->data(); 
				$file_name =   $upload_data['file_name'];
			}
		}
		*/
		$data = array(
			'agent_name' => $this->input->post('company_name', TRUE),
			'agent_type_id' => $this->input->post('member_type',TRUE),
			'join_date' => $this->input->post('join_date',TRUE),
			'agent_address' => $this->input->post('address',TRUE),
			'agent_phone' => $this->input->post('telp_no',TRUE),
			'agent_city' => $this->input->post('id_kota',TRUE),
			'agent_fax' => $this->input->post('fax',TRUE),
			'agent_yahoo' => $this->input->post('yahoo_account',TRUE),
			'agent_website' => $this->input->post('website',TRUE),
			'agent_email' => $this->input->post('email',TRUE),
			//'license_number' => $this->input->post('lisensi_number',TRUE),
			'agent_manager_name' => $this->input->post('manager_name',TRUE),
			'agent_manager_phone' => $this->input->post('manager_phone',TRUE),
			'agent_manager_email' => $this->input->post('manager_email',TRUE),
			'parent_agent_id' => $this->input->post('id_agen_upline',TRUE),
			//'password' => $this->input->post('password',TRUE),
			'deposit_amount' => $this->input->post('deposit_amount',TRUE),
			'voucher' => $this->input->post('voucher',TRUE),
			'approved' => $this->input->post('approve',TRUE),
			'point_reward' => $this->input->post('point_reward',TRUE)
		);
		//if ($file_name <> '')
		//	$data['license_file'] = $file_name;
			
		$edit = $this->agents->edit_agent($id, $data);
		//email dikirim dengan berita berdasarkan perubahan status approval
		$get_username = $this->general->get_afield_by_id('agents', 'agent_id', $id, 'agent_username');
		$username = $get_username->result_array()[0]['agent_username'];
		//preparing to send email
		$content = array(
			'name' => $this->input->post('company_name', TRUE),
			'username' => $username
		);
		//get email disribution
		$this->load->model('notification');
		if($this->input->post('approve')=="Yes"){
			list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('agent-approved');
			$subject = 'Permintaan Keagenan Disetujui';
			$template = 'agent_approved';
		}
		else if($this->input->post('approve')=="No"){
			list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('agent-not-active');
			$subject = 'Keagenan Di-Non-Aktifkan';
			$template = 'agent_not_active';
		}
		else if($this->input->post('approve')=="Rejected"){
			list ($to, $cc, $bcc, $email_sender, $sender_name) = $this->notification->get_email_distribution('agent-rejected');
			$subject = 'Permintaan Keagenan Ditolak';
			$template = 'agent_rejected';
		}
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
				
		$this->email->subject($subject);
		$messages = $this->load->view('email_tpl/'.$template, $content, TRUE);
		$this->email->message($messages);

		$this->email->send();
		
		//$response[0]['response'] = $edit;
		//$response[] = array('response' => $add);
		//echo json_encode($response);
		redirect(base_url('index.php/admin/agent_page'));
	}
	
	public function get_agents(){
		$query = $this->agents->get_agents();
		foreach ($query->result_array() as $row){
			$data[] = array(
				'value' => $row['agent_id'],
				'name' => $row['agent_name']
			);
		}
		echo json_encode($data);
	}
	
	public function get_cities(){
		$number_row = 0;
		$query = $this->agents->get_cities();;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'value' => $row['id'],
				'name' => $row['city']
			);
		}
		echo json_encode($data);
	}
	
	public function get_agent_types(){
		$query = $this->agents->get_agent_types();;
		foreach ($query->result_array() as $row){
			$data[] = array(
				'value' => $row['id'],
				'name' => $row['name']
			);
		}
		echo json_encode($data);
	}
	
	function do_upload()
	{
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			//$this->load->view('upload_success', $data);
		}
	}
	
	public function get_all_agents(){
		$query = $this->agents->get_all_agents();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'username' => $row['agent_username'],
				'agent_id' => $row['agent_id'],
				'agent_name' => $row['agent_name'],
				'agent_type' => $row['agent_type'],
				'join_date' => $row['join_date'],
				'agent_phone' => $row['agent_phone'],
				'agent_city' => $row['agent_city'],
				'agent_email' => $row['agent_email'],
				'parent_agent' => $row['parent_agent'],
				'deposit_amount' => $row['deposit_amount'],
				'voucher' => $row['voucher'],
				'approved' => $row['approved']
			);
		}
		echo json_encode($data);
	}
	
	public function get_agent_by_id(){
		$id = $this->uri->segment(3);
		$query = $this->agents->get_agent_by_id($id);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'agent_id' => $row['agent_id'],
				'username' => $row['agent_username'],
				'agent_name' => $row['agent_name'],
				'agent_type' => $row['agent_type'],
				'join_date' => $row['join_date'],
				'address' => $row['agent_address'],
				'agent_phone' => $row['agent_phone'],
				'city' => $row['agent_city_name'],
				'agent_email' => $row['agent_email'],
				'agent_fax' => $row['agent_fax'],
				'agent_yahoo' => $row['agent_yahoo'],
				'website' => $row['agent_website'],
				'license_number' => $row['license_number'],
				'license_file' => $row['license_file'],
				'manager_name' => $row['agent_manager_name'],
				'manager_phone' => $row['agent_manager_phone'],
				'manager_email' => $row['agent_manager_email'],
				'password' => $row['password'],
				'parent_agent' => $row['parent_agent'],
				'deposit_amount' => $row['deposit_amount'],
				'point_reward' => $row['point_reward'],
				'voucher' => $row['voucher'],
				'approved' => $row['approved']
			);
		}
		echo json_encode($data);
	}
	
	public function get_agents_by_status(){
		$status = $this->uri->segment(3);
		$query = $this->agents->get_agents_by_status($status);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'agent_id' => $row['agent_id'],
				'agent_name' => $row['agent_name'],
				'agent_type' => $row['agent_type'],
				'join_date' => $row['join_date'],
				'address' => $row['agent_address'],
				'agent_phone' => $row['agent_phone'],
				'agent_city' => $row['agent_city'],
				'agent_email' => $row['agent_email'],
				'agent_fax' => $row['agent_fax'],
				'agent_yahoo' => $row['agent_yahoo'],
				'website' => $row['agent_website'],
				'license_number' => $row['license_number'],
				'license_file' => $row['license_file'],
				'manager_name' => $row['agent_manager_name'],
				'manager_phone' => $row['agent_manager_phone'],
				'manager_email' => $row['agent_manager_email'],
				'password' => $row['password'],
				'parent_agent' => $row['parent_agent'],
				'deposit_amount' => $row['deposit_amount'],
				'point_reward' => $row['point_reward'],
				'voucher' => $row['voucher'],
				'approved' => $row['approved']
			);
		}
		echo json_encode($data);
	}
	
	public function get_agent_by_name(){
		$name = $this->input->get('search', TRUE);
		$query = $this->agents->get_agent_by_name($name);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'agent_id' => $row['agent_id'],
				'agent_name' => $row['agent_name'],
				'agent_type' => $row['agent_type'],
				'join_date' => $row['join_date'],
				'address' => $row['agent_address'],
				'agent_phone' => $row['agent_phone'],
				'city' => $row['agent_city'],
				'agent_email' => $row['agent_email'],
				'agent_fax' => $row['agent_fax'],
				'agent_yahoo' => $row['agent_yahoo'],
				'website' => $row['agent_website'],
				'license_number' => $row['license_number'],
				'license_file' => $row['license_file'],
				'manager_name' => $row['agent_manager_name'],
				'manager_phone' => $row['agent_manager_phone'],
				'manager_email' => $row['agent_manager_email'],
				'password' => $row['password'],
				'parent_agent' => $row['parent_agent'],
				'deposit_amount' => $row['deposit_amount'],
				'point_reward' => $row['point_reward'],
				'voucher' => $row['voucher'],
				'approved' => $row['approved']
			);
		}
		echo json_encode($data);
	}
	
	public function get_city_by_agent_id(){
		$id = $this->uri->segment(3);
		$query = $this->agents->get_afield_by_agent_id('agent_city', $id);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['agent_city']
			);
		}
		echo json_encode($data);
	}
	
	public function get_upline_by_agent_id(){
		$id = $this->uri->segment(3);
		$query = $this->agents->get_afield_by_agent_id('parent_agent_id', $id);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['parent_agent_id']
			);
		}
		echo json_encode($data);
	}
	
	public function get_agent_type_by_agent_id(){
		$id = $this->uri->segment(3);
		$query = $this->agents->get_afield_by_agent_id('agent_type_id',$id);
		
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['agent_type_id']
			);
		}
		echo json_encode($data);
	}
	
	public function get_all_banks(){
		$query = $this->bank->get_all_bank();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['bank_id'],
				'name' => $row['bank_name'],
				'account_number' => $row['bank_account_number'],
				'holder_name' => $row['bank_holder_name'],
				'branch' => $row['bank_branch'],
				'city' => $row['bank_city']
			);
		}
		echo json_encode($data);
	}
	
	public function get_all_bank_via(){
		$query = $this->bank->get_all_bank_via();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'via' => $row['via'],
				'via_code' => $row['via_code']
			);
		}
		echo json_encode($data);
	}
	
	public function bank_add(){
		$data = array(
			'bank_name' => $this->input->get('bank-name', TRUE),
			'bank_account_number' => $this->input->get('account-no',TRUE),
			'bank_holder_name' => $this->input->get('holder',TRUE),
			'bank_branch' => $this->input->get('branch',TRUE),
			'bank_city' => $this->input->get('city',TRUE)
		);
		$add = $this->bank->add_to_table('bank_accounts',$data);
		$response[] = array('response' => $add);
		echo json_encode($response);
		//redirect(base_url('index.php/admin/agent_page'));
	}
	
	public function bank_via_add(){
		$data = array(
			'via' => $this->input->get('via', TRUE),
			'via_code' => $this->input->get('via-code',TRUE)
		);
		$add = $this->bank->add_to_table('bank_via',$data);
		$response[] = array('response' => $add);
		echo json_encode($response);
		//redirect(base_url('index.php/admin/agent_page'));
	}
	
	public function bank_delete(){
		$id = $this->uri->segment(3);
		$del = $this->bank->delete_from_table_by_id('bank_accounts', 'bank_id', $id);
		redirect(base_url('index.php/admin/setting_bank_page/bank_list'));
	}
	
	public function bank_via_delete(){
		$id = $this->uri->segment(3);
		$del = $this->bank->delete_from_table_by_id('bank_via', 'id', $id);
		redirect(base_url('index.php/admin/setting_bank_page/bank_list'));
	}
	
	public function bank_details(){
		$id = $this->uri->segment(3);
		$query = $this->bank->get_detail_by_id('bank_accounts', 'bank_id', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'name' => $row['bank_name'],
				'account_number' => $row['bank_account_number'],
				'holder_name' => $row['bank_holder_name'],
				'branch' => $row['bank_branch'],
				'city' => $row['bank_city']
			);
		}
		echo json_encode($data);
	}
	
	public function bank_via_details(){
		$id = $this->uri->segment(3);
		$query = $this->bank->get_detail_by_id('bank_via', 'id', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'via' => $row['via'],
				'via_code' => $row['via_code']
			);
		}
		echo json_encode($data);
	}
	
	public function bank_edit(){
		$this->page('admin_setting_bank_modify');
	}
	
	public function bank_via_edit(){
		$this->page('admin_setting_bank_modify');
	}
	
	public function bank_edit_by_id(){
		$id = $this->uri->segment(3);
		$data = array(
			'bank_name' => $this->input->get('bank_name', TRUE),
			'bank_account_number' => $this->input->get('account_number',TRUE),
			'bank_holder_name' => $this->input->get('holder',TRUE),
			'bank_branch' => $this->input->get('branch',TRUE),
			'bank_city' => $this->input->get('city',TRUE)
		);
		$upd = $this->bank->upd_bank('bank_accounts', 'bank_id', $id, $data);
	}
	
	public function bank_via_edit_by_id(){
		$id = $this->uri->segment(3);
		$data = array(
			'via' => $this->input->get('via', TRUE),
			'via_code' => $this->input->get('via_code',TRUE)
		);
		$upd = $this->bank->upd_bank('bank_via', 'id', $id, $data);
	}
	
	public function get_registered_order(){
		$category = $this->uri->segment(3);
		$query = $this->orders->get_registered_order($category);
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
					'room_name' => $row['hotel_room_name'],
					'total_price' => $row['total_price'],
					'adult' => $row['adult'],
					'child' => $row['child'],
					'payment_status' => $row['status']
				);
		}
		echo json_encode($data);
	}
	
	public function get_issued_order(){
		$category = $this->uri->segment(3);
		$query = $this->orders->get_issued_order($category);
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status']
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status']
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status']
				);
		}
		echo json_encode($data);
	}
	
	public function get_rejected_order(){
		$category = $this->uri->segment(3);
		$query = $this->orders->get_cancelled_order($category);
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status'],
					'reason' => $row['reason']
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status'],
					'reason' => $row['reason']
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
					'payment_status' => $row['status'],
					'order_status' => $row['order_status'],
					'reason' => $row['reason']
				);
		}
		echo json_encode($data);
	}
	
	function reject_order(){
		$id = $this->uri->segment(3);
		$reject = $this->orders->update_order_status($id, 'Rejected');
		redirect(base_url('index.php/admin/booking_page'));
	}
	
	function cancel_order(){
		$id = $this->uri->segment(3);
		$reject = $this->orders->update_order_status($id, 'Cancelled');
		redirect(base_url('index.php/admin/booking_page'));
	}
	
	function add_reason(){
		$id = $this->input->get('order-id');
		$reason = $this->input->get('reason');
		$this->orders->add_edit_reason($id, $reason);
	}
	
	function get_topup_by_status(){
		$status = $this->uri->segment(3);
		$topup = $this->agents->get_topup_by_status($status);
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
				'nominal' => $row['nominal']
			);
		}
		echo json_encode($data);
	}
	
	function topup_issued(){
		$id = $this->uri->segment(3);
		//get the nominal requested
		$nominal = $this->agents->get_afield_in_topup($id, 'nominal');
		$agent_id = $this->agents->get_afield_in_topup($id, 'agent_id');
		$issued = $this->agents->set_toptup_status($id, 'Issued');
		if ($issued){
			// add deposit into account
			$upd = $this->agents->add_nominal_into_account($agent_id, $nominal);
			redirect(base_url('index.php/admin/setting_deposit_topup'));
		}
		else
			$this->show_message_page('issued top up', $this->db->_error_message());
	}
	
	function topup_reject(){
		$id = $this->uri->segment(3);
		$reject = $this->agents->set_toptup_status($id, 'Rejected');
		if ($reject)
			redirect(base_url('index.php/admin/setting_deposit_topup'));
		else
			$this->show_message_page('reject top up', $this->db->_error_message());
	}
	
	function get_withdraw_by_status(){
		$status = $this->uri->segment(3);
		$topup = $this->agents->get_withdraw_by_status($status);
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
				'nominal' => $row['nominal']
			);
		}
		echo json_encode($data);
	}
	
	function withdraw_issued(){
		$id = $this->uri->segment(3);
		//get the nominal requested
		$nominal = $this->agents->get_afield_in_withdraw($id, 'nominal');
		$agent_id = $this->agents->get_afield_in_withdraw($id, 'agent_id');
		$issued = $this->agents->set_withdraw_status($id, 'Issued');
		if ($issued){
			// add deposit into account
			$upd = $this->agents->substract_nominal_into_account($agent_id, $nominal);
			redirect(base_url('index.php/admin/setting_deposit_withdraw'));
		}
		else
			$this->show_message_page('issued withdraw', $this->db->_error_message());
	}
	
	function withdraw_reject(){
		$id = $this->uri->segment(3);
		$reject = $this->agents->set_withdraw_status($id, 'Rejected');
		if ($reject)
			redirect(base_url('index.php/admin/setting_deposit_withdraw'));
		else
			$this->show_message_page('reject withdraw', $this->db->_error_message());
	}
	
	public function get_users_by_type(){
		$type = $this->uri->segment(3);
		$account = $this->users->get_accounts_by_level($type);
		if ($account==false){
			$data['error'] = 'No rows returned';
		}
		else {
			$number_row = 0;
			foreach ($account->result_array() as $row){
				$number_row++;
				$data[] = array(
					'number_row' => $number_row,
					'id' => $row['account_id'],
					'username' => $row['user_name'],
					'email' => $row['email_login'],
					'name' => $row['name'],
					'job_position' => $row['job_position'],
					'city' => $row['city'],
					'phone' => $row['phone'],
					'address' => $row['address']
				);
			}
		}
		
		
		echo json_encode($data);
	}
	
	public function user_add(){
		$posts = $this->input->get(NULL, TRUE);
		foreach ($posts as $key => $value){
			if ($key != '_'){
				if ($key == 'password')
					$data[$key] = md5($value);
				else
					$data[$key] = $value;
			}
			
		}
		
		$insert = $this->users->add_user($data);
	}
	
	public function user_edit(){
		$id = $this->uri->segment(3);
		$posts = $this->input->post(NULL, TRUE);
		foreach ($posts as $key => $value)
			$data[$key] = $value;
		
		$edit = $this->users->edit_user($id, $data);
		if($edit)
			redirect(base_url('index.php/admin/my_account_page'));
		else
			$this->show_message_page('mengubah data user', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function user_delete(){
		$id = $this->uri->segment(3);
		
		$del = $this->users->del_user($id);
		if($del)
			$this->show_success_page('Proses hapus user berhasil.');
		else
			$this->show_message_page('menghapus data user', 'Mohon hubungi web administrator.');
	}
	
	public function get_user_by_id(){
		$id = $this->uri->segment(3);
		$get = $this->users->get_account_by_id($id);
		foreach ($get->result_array() as $row){
			$data = array(
				'user_name' => $row['user_name'],
				'email' => $row['email_login'],
				'user_level' => $row['user_level'],
				'job_position' => $row['job_position'],
				'phone' => $row['phone'],
				'address' => $row['address'],
				'city_id' => $row['city_id'],
				'city' => $row['city']
			);
		}
		echo json_encode($data);
	}
	
	public function change_password(){
		$id = $this->uri->segment(3);
		$check_pass = $this->users->get_password_by_id($id, $this->input->post('password-now', TRUE));
		if ($check_pass==false)
			$this->show_message_page('mengecek password lama', 'Mohon isi password lama dengan benar, perhatikan CAPS LOCK agar dalam keadaan OFF.');
		else{
			$data = array('password' => md5($this->input->post('password-new', TRUE)));
			$upd = $this->users->edit_user($id, $data);
			if($upd)
				$this->show_success_page('Proses ubah password user berhasil.');
			else
				$this->show_message_page('mengubah password', 'Mohon cek kembali input anda, atau hubungi web administrator.');
		}
	}
	
	public function add_content_category(){
		$inputs = $this->input->get(NULL, TRUE);
		foreach ($inputs as $key => $value)
			if ($key!='_')
				$data[$key] = $value;
			
		$add = $this->posts->add_category($data);
	}
	
	public function get_content_categories(){
		$is_paket = $this->uri->segment(3);
		$get = $this->posts->get_categories($is_paket);
		$number_row=0;
		foreach ($get->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'category' => $row['category'],
				'description' => $row['description'],
				'removable' => $row['removable'],
				'value' => $row['id'],
				'name' => $row['category'],
				'is_package' => $row['is_package']
			);
		}
		echo json_encode($data);
	}
	
	public function get_nonpaket_categories(){
		$get = $this->posts->nonpaket_categories_exclude_existing();
		$number_row=0;
		foreach ($get->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'category' => $row['category'],
				'description' => $row['description'],
				'removable' => $row['removable'],
				'value' => $row['id'],
				'name' => $row['category'],
				'is_package' => $row['is_package']
			);
		}
		echo json_encode($data);
	}
	
	public function get_content_reviews(){
		$get = $this->posts->get_reviews();
		$number_row=0;
		foreach ($get->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'content_title' => $row['title'],
				'score' => $row['evaluation_score'],
				'name' => $row['reviewer_name'],
				'title' => $row['evaluation_title'],
				'content' => $row['evaluation_content'],
				'approved' => $row['is_approved'],
				'submit_date' => $row['submit_date']
			);
		}
		echo json_encode($data);
	}
	
	public function get_category_by_id(){
		$id = $this->uri->segment(3);
		$get = $this->posts->get_category_by_id($id);
		foreach ($get->result_array() as $row){
			$data = array(
				'category' => $row['category'],
				'description' => $row['description'],
				'removable' => $row['removable'],
				'is_package' => $row['is_package']
			);
		}
		echo json_encode($data);
	}
	
	public function edit_category(){
		$id = $this->uri->segment(3);
		$inputs = $this->input->post(NULL, TRUE);
		foreach ($inputs as $key => $value)
			$data[$key] = $value;
		$upd = $this->posts->edit_category($id, $data);
		if($upd)
			redirect(base_url('index.php/admin/content_category_page'));
		else
			$this->show_message_page('mengubah data kategori konten', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function delete_content_category(){
		$id = $this->uri->segment(3);
		$del = $this->posts->del_category($id);
		if($del)
			redirect(base_url('index.php/admin/content_category_page'));
		else
			$this->show_message_page('menghapus data kategori konten', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	//cindy nordiansyah
	public function city_add() {
		$data =array(
			'city' => $this->input->get('namakota', TRUE)
		);
		
		$insert_city = $this->cities->add_city('cities', $data);
		
		$response[] = array('response' => $insert_city);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function city_edit_page() {
		$this->page('admin_setting_city_modify');
	}
	//cindy nordiansyah
	public function city_edit() {
		$city_code= $this->uri->segment(3);
		$data = array(
			'city' => $this->input->get('city_name', TRUE),
		);
		$upd = $this->cities->upd_city('cities', 'id', $city_code, $data);
	}
	
	//cindy nordiansyah
	public function city_details(){
		$id = $this->uri->segment(3);
		$query = $this->cities->get_detail_by_id('cities', 'id', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'city_name' => $row['city']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	/*public function city_delete() {
		$city_code= $this->uri->segment(3);
		
	}*/
	
	//cindy nordiansyah
	public function ym_add() {
		$data =array(
			'yahoo_account' => $this->input->get('akun_ym', TRUE),
			'functional_type' => $this->input->get('tipe', TRUE),
			'enabled' => 'YES'
		);
		
		$insert_ym = $this->yahoo_messenger->add_ym('yahoo_accounts', $data);
		
		$response[] = array('response' => $insert_ym);
		echo json_encode($response);
	}
	
	//cindy nordiansyah
	public function ym_update() {
		$this->page('admin_setting_yahoo_modify');
	}
	//cindy nordiansyah
	public function ym_edit() {
		$ymid= $this->uri->segment(3);
		$data = array(
			'yahoo_account' => $this->input->get('akun', TRUE),
			'functional_type' => $this->input->get('tipe', TRUE)
		);
		$upd = $this->yahoo_messenger->upd_ym('yahoo_accounts', 'id', $ymid, $data);
	}
	
	//cindy nordiansyah
	public function ym_details(){
		$id = $this->uri->segment(3);
		$query = $this->yahoo_messenger->get_detail_by_id('yahoo_accounts', 'id', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'akun' => $row['yahoo_account'],
				'tipe' => $row['functional_type']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function ym_delete() {
		$ymid= $this->uri->segment(3);
		//delete on table agents
		$query = $this->yahoo_messenger->del_ym($ymid);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/setting_yahoo_page'));
	}
	
	//cindy nordiansyah
	public function get_yahoo() {
		$number_row = 0;
		$query = $this->yahoo_messenger->get_yahoo();
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' =>  $row['id'],
				'name' => $row['yahoo_account'],
				'type' => $row['functional_type']
			);
		}
		echo json_encode($data);
	}
	
	public function add_post(){
		$this->load->library('upload');
		$config['upload_path'] = './assets/uploads/posts';
		$config['file_name'] = 'pic_'.$this->input->post('post_id');
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '1000';
		$config['max_width']	= '1140';
		$config['max_height']	= '600';
		
		$config_1['upload_path'] = './assets/uploads/posts';
		$config_1['file_name'] = 'pic_'.$this->input->post('post_id').'_1';
		$config_1['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_1['overwrite']	= TRUE;
		$config_1['max_size']	= '1000';
		$config_1['max_width']	= '1140';
		$config_1['max_height']	= '600';
		
		$config_2['upload_path'] = './assets/uploads/posts';
		$config_2['file_name'] = 'pic_'.$this->input->post('post_id').'_2';
		$config_2['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_2['overwrite']	= TRUE;
		$config_2['max_size']	= '1000';
		$config_2['max_width']	= '1140';
		$config_2['max_height']	= '600';
		
		$config_3['upload_path'] = './assets/uploads/posts';
		$config_3['file_name'] = 'pic_'.$this->input->post('post_id').'_3';
		$config_3['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_3['overwrite']	= TRUE;
		$config_3['max_size']	= '1000';
		$config_3['max_width']	= '1140';
		$config_3['max_height']	= '600';
		
		$config_4['upload_path'] = './assets/uploads/posts';
		$config_4['file_name'] = 'pic_'.$this->input->post('post_id').'_4';
		$config_4['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_4['overwrite']	= TRUE;
		$config_4['max_size']	= '1000';
		$config_4['max_width']	= '1140';
		$config_4['max_height']	= '600';
		
		$config_5['upload_path'] = './assets/uploads/posts';
		$config_5['file_name'] = 'pic_'.$this->input->post('post_id').'_5';
		$config_5['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_5['overwrite']	= TRUE;
		$config_5['max_size']	= '1000';
		$config_5['max_width']	= '1140';
		$config_5['max_height']	= '600';
		
		$id = $this->input->post('post_id');
		
		$error= false;
		if ($_FILES['image']['name']<>''){
			$this->upload->initialize($config); 
			if ( ! $this->upload->do_upload('image')){
				$error = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$data['image_file'] = 'pic_'.$id.'.'.$ext;
			}
				
		}
		$error_additional = false;
		$image_additional = array();
		if ($_FILES['image_1']['name']<>''){
			$this->upload->initialize($config_1); 
			if ( ! $this->upload->do_upload('image_1')){
				$error_additional = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_additional['image_1'] = 'pic_'.$id.'_1.'.$ext;
			}
				
		}
		if ($_FILES['image_2']['name']<>''){
			$this->upload->initialize($config_2); 
			if ( ! $this->upload->do_upload('image_2')){
				$error_additional = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_additional['image_2'] = 'pic_'.$id.'_2.'.$ext;
			}
				
		}
		if ($_FILES['image_3']['name']<>''){
			$this->upload->initialize($config_3); 
			if ( ! $this->upload->do_upload('image_3')){
				$error_additional = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_additional['image_3'] = 'pic_'.$id.'_3.'.$ext;
			}
				
		}
		if ($_FILES['image_4']['name']<>''){
			$this->upload->initialize($config_4); 
			if ( ! $this->upload->do_upload('image_4')){
				$error_additional = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_additional['image_4'] = 'pic_'.$id.'_4.'.$ext;
			}
				
		}
		if ($_FILES['image_5']['name']<>''){
			$this->upload->initialize($config_5); 
			if ( ! $this->upload->do_upload('image_5')){
				$error_additional = true;
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			}
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_additional['image_5'] = 'pic_'.$id.'_5.'.$ext;
			}
				
		}
		
		if ($error==false){
			$posts = $this->input->post(NULL, TRUE);
			foreach ($posts as $key => $value)
				if (strpos($key,'image') !== true)
					$data[$key] = $value;
			$data['publish_date'] = ($this->input->post('status')=='publish' ? date('Y-m-d') : '');
			
			$upd = $this->posts->update_post($id, $data);
			if($upd){
				if(sizeof($image_additional)>0){
					$image_additional['post_id'] = $id;
					$this->general->add_to_table('post_additional_images', $image_additional);
				}
				$this->show_success_page('Proses menambah konten berhasil.');
			}
			else
				$this->show_message_page('menambah konten', 'Mohon cek inputan anda atau hubungi web administrator.');
		}
	}
	
	public function add_post_nonpaket(){
		$id = $this->input->post('post_id');
		$posts = $this->input->post(NULL, TRUE);
		foreach ($posts as $key => $value)
			$data[$key] = $value;
		$data['publish_date'] = ($this->input->post('status')=='publish' ? date('Y-m-d') : '');
			
		$upd = $this->posts->update_post($id, $data);
		if($upd){
			$this->show_success_page('Proses menambah konten berhasil.');
		}
		else
			$this->show_message_page('menambah konten', 'Mohon cek inputan anda atau hubungi web administrator.');
	}
	
	public function get_posts(){
		$is_paket = $this->uri->segment(3);
		$get = $this->posts->get_posts($is_paket);
		foreach ($get->result_array() as $row){
			$data[] = array(
				'id' => $row['post_id'],
				'category' => $row['category_name'],
				'title' => $row['title'],
				'star_rating' => $row['star_rating'],
				'is_promo' => $row['is_promo'],
				'price' => $row['price'],
				'purchasing_price' => $row['purchasing_price'],
				'author' => $row['user_name'],
				'status' => $row['status'],
				'enabled' => $row['enabled'],
				'point_reward' => $row['point_reward'],
				'creation_date' => $row['creation_date'],
				'publish_date' => $row['publish_date'],
				'image_slider' => $row['shown_in_image_slider']
			);
		}
		echo json_encode($data);
	}
	
	
	public function edit_post(){
		$this->load->library('upload');
		$id = $this->uri->segment(3);
		
		$config['upload_path'] = './assets/uploads/posts';
		$config['file_name'] = 'pic_'.$id;
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '1000';
		$config['max_width']	= '1140';
		$config['max_height']	= '600';
		
		$config_1['upload_path'] = './assets/uploads/posts';
		$config_1['file_name'] = 'pic_'.$id.'_1';
		$config_1['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_1['overwrite']	= TRUE;
		$config_1['max_size']	= '1000';
		$config_1['max_width']	= '1140';
		$config_1['max_height']	= '600';
		
		$config_2['upload_path'] = './assets/uploads/posts';
		$config_2['file_name'] = 'pic_'.$id.'_2';
		$config_2['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_2['overwrite']	= TRUE;
		$config_2['max_size']	= '1000';
		$config_2['max_width']	= '1140';
		$config_2['max_height']	= '600';
		
		$config_3['upload_path'] = './assets/uploads/posts';
		$config_3['file_name'] = 'pic_'.$id.'_3';
		$config_3['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_3['overwrite']	= TRUE;
		$config_3['max_size']	= '1000';
		$config_3['max_width']	= '1140';
		$config_3['max_height']	= '600';
		
		$config_4['upload_path'] = './assets/uploads/posts';
		$config_4['file_name'] = 'pic_'.$id.'_4';
		$config_4['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_4['overwrite']	= TRUE;
		$config_4['max_size']	= '1000';
		$config_4['max_width']	= '1140';
		$config_4['max_height']	= '600';
		
		$config_5['upload_path'] = './assets/uploads/posts';
		$config_5['file_name'] = 'pic_'.$id.'_5';
		$config_5['allowed_types'] = 'gif|jpeg|jpg|png';
		$config_5['overwrite']	= TRUE;
		$config_5['max_size']	= '1000';
		$config_5['max_width']	= '1140';
		$config_5['max_height']	= '600';
		
		$image_file = '';
		if ($_FILES['image']['name']<>''){
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('image'))
				$this->show_message_page('mengunggah foto', $this->upload->display_errors());
			else {
				$ext = end(explode(".", $this->upload->file_name));
				$image_file = 'pic_'.$id.'.'.$ext;
			}
		}
		
		$error_additional = false;
		$image_additional = array();
		
		if($this->input->post('image_1_delete')=='delete')
			$image_additional['image_1'] = '';
		else{
			if ($_FILES['image_1']['name']<>''){
				$this->upload->initialize($config_1); 
				if ( ! $this->upload->do_upload('image_1')){
					$error_additional = true;
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				}
				else {
					$ext = end(explode(".", $this->upload->file_name));
					$image_additional['image_1'] = 'pic_'.$id.'_1.'.$ext;
				}
			}
		}
		
		if($this->input->post('image_2_delete')=='delete')
			$image_additional['image_2'] = '';
		else{
			if ($_FILES['image_2']['name']<>''){
				$this->upload->initialize($config_2); 
				if ( ! $this->upload->do_upload('image_2')){
					$error_additional = true;
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				}
				else {
					$ext = end(explode(".", $this->upload->file_name));
					$image_additional['image_2'] = 'pic_'.$id.'_2.'.$ext;
				}
					
			}
		}
		
		if($this->input->post('image_3_delete')=='delete')
			$image_additional['image_3'] = '';
		else{
			if ($_FILES['image_3']['name']<>''){
				$this->upload->initialize($config_3); 
				if ( ! $this->upload->do_upload('image_3')){
					$error_additional = true;
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				}
				else {
					$ext = end(explode(".", $this->upload->file_name));
					$image_additional['image_3'] = 'pic_'.$id.'_3.'.$ext;
				}
					
			}
		}
		
		if($this->input->post('image_4_delete')=='delete')
			$image_additional['image_4'] = '';
		else{
			if ($_FILES['image_4']['name']<>''){
				$this->upload->initialize($config_4); 
				if ( ! $this->upload->do_upload('image_4')){
					$error_additional = true;
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				}
				else {
					$ext = end(explode(".", $this->upload->file_name));
					$image_additional['image_4'] = 'pic_'.$id.'_4.'.$ext;
				}
					
			}
		}
		
		if($this->input->post('image_5_delete')=='delete')
			$image_additional['image_5'] = '';
		else{
			if ($_FILES['image_5']['name']<>''){
				$this->upload->initialize($config_5); 
				if ( ! $this->upload->do_upload('image_5')){
					$error_additional = true;
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				}
				else {
					$ext = end(explode(".", $this->upload->file_name));
					$image_additional['image_5'] = 'pic_'.$id.'_5.'.$ext;
				}
					
			}
		}
		
		$data = array(
			'publish_date' => ($this->input->post('status',TRUE)=='publish' ? date('Y-m-d') : ''),
			'author' => $this->input->post('author'),
			'category' => $this->input->post('category'),
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'price' => $this->input->post('price'),
			'point_reward' => $this->input->post('point_reward'),
			'status' => $this->input->post('status'),
			'enabled' => $this->input->post('enabled'),
			'star_rating' => $this->input->post('star_rating'),
			'is_promo' => $this->input->post('is_promo'),
			'shown_in_image_slider' => $this->input->post('shown_in_image_slider'),
			'mini_slogan' => $this->input->post('mini_slogan'),
			'currency' => $this->input->post('currency'),
			'purchasing_price' => $this->input->post('purchasing_price')
		);
		if($image_file <> '')
			$data['image_file'] = $image_file;
		$upd = $this->general->update_data_on_table('posts', 'post_id', $id, $data);
		if($upd){
			if(sizeof($image_additional) > 0){
				//cek dulu ada atau nggak
				$check = $this->general->get_afield_by_id('post_additional_images','post_id', $id, 'post_id');
				if($check==false){
					$image_additional['post_id'] = $id;
					$ins = $this->general->add_to_table('post_additional_images', $image_additional);
				}
					
				else
					$this->general->update_data_on_table('post_additional_images', 'post_id', $id, $image_additional);
			}
				
			redirect(base_url('index.php/admin/cms_page'));
		}
		else{
			$error = array(
				'category' => 'mysql_update',
				'message' => $this->db->_error_message()
			);
			$this->general->add_to_table('error_logs', $error);
			$this->show_message_page('mengubah konten', 'Mohon cek inputan anda atau hubungi web administrator.');
		}
			
	}
	
	public function edit_post_non_paket(){
		$id = $this->uri->segment(3);
		$posts = $this->input->post(NULL,TRUE);
		foreach($posts as $key => $value)
			$data[$key] = $value;
		$upd = $this->general->update_data_on_table('posts', 'post_id', $id, $data);
		if($upd){
			redirect(base_url('index.php/admin/cms_page'));
		}
		else{
			$error = array(
				'category' => 'mysql_update',
				'message' => $this->db->_error_message()
			);
			$this->general->add_to_table('error_logs', $error);
			$this->show_message_page('mengubah konten', 'Mohon cek inputan anda atau hubungi web administrator.');
		}
	}
	
	public function del_post(){
		$id = $this->uri->segment(3);
		$del = $this->posts->del_post($id);
		if($del)
			redirect(base_url('index.php/admin/cms_page'));
		else
			$this->show_message_page('menghapus data konten', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function get_content_by_id(){
		$id = $this->uri->segment(3);
		$get = $this->posts->get_post_by_id($id, true);
		foreach ($get->result_array() as $row){
			$data = array(
				'id' => $row['post_id'],
				'category' => $row['category'],
				'title' => $row['title'],
				'mini_slogan' => $row['mini_slogan'],
				'content' => $row['content'],
				'is_promo' => $row['is_promo'],
				'currency' => $row['currency'],
				'price' => $row['price'],
				'purchasing_price' => $row['purchasing_price'],
				'status' => $row['status'],
				'enabled' => $row['enabled']				,
				'image' => $row['image_file'],
				'point_reward' => $row['point_reward'],
				'star_rating' => $row['star_rating'],
				'image_slider' => $row['shown_in_image_slider'],
				'image_1' => $row['image_1'],
				'image_2' => $row['image_2'],
				'image_3' => $row['image_3'],
				'image_4' => $row['image_4'],
				'image_5' => $row['image_5']
			);
		}
		echo json_encode($data);
	}
	
	public function get_exchanges(){
		$get = $this->bank->get_exchanges();
		$number_row = 0;
		foreach ($get->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'currency_a' => $row['currency_a'],
				'currency_b' => $row['currency_b'],
				'country_a' => $row['country_a'],
				'country_b' => $row['country_b'],
				'rate' => $row['rate_in_b']
			);
		}
		echo json_encode($data);
	}
	
	public function get_exchange_by_id(){
		$id = $this->uri->segment(3);
		$get = $this->bank->get_exchanges($id);
		foreach ($get->result_array() as $row){
			$data = array(
				'id' => $row['id'],
				'currency_a' => $row['currency_a'],
				'currency_b' => $row['currency_b'],
				'country_a' => $row['country_a'],
				'country_b' => $row['country_b'],
				'rate' => $row['rate_in_b']
			);
		}
		echo json_encode($data);
	}
	
	public function kurs_add(){
		$inputs = $this->input->get(NULL, TRUE);
		foreach ($inputs as $key => $value)
			if ($key!='_')
				$data[$key] = $value;
			
		$add = $this->bank->add_to_table('exchange_rates', $data);
	}
	
	public function kurs_edit(){
		$id = $this->uri->segment(3);
		$inputs = $this->input->post(NULL, TRUE);
		foreach ($inputs as $key => $value)
			if ($key!='_')
				$data[$key] = $value;
		$upd = $this->bank->upd_bank('exchange_rates','id',$id, $data);
		if($upd)
			redirect(base_url('index.php/admin/setting_kurs_page'));
		else
			$this->show_message_page('mengubah data kategori konten', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function kurs_delete(){
		$id = $this->uri->segment(3);
		$del = $this->bank->delete_from_table_by_id('exchange_rates','id',$id);
		if($del)
			redirect(base_url('index.php/admin/setting_kurs_page'));
		else
			$this->show_message_page('menghapus data konten', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function get_commission_by_type(){
		$cat = $this->uri->segment(3);
		$this->load->model('commission');
		$get = $this->commission->get_commission_by_type($cat);
		$number_row = 0;
		foreach ($get->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'type' => $row['trip_category'],
				'name' => $row['name'],
				'for_agent' => $row['is_for_agent'],
				'nominal' => $row['nominal'],
				'active' => $row['is_active'],
				'note' => $row['notes']
			);
		}
		echo json_encode($data);
	}
	
	public function get_commission_by_id(){
		$id = $this->uri->segment(3);
		$get = $this->general->get_detail_by_id('commissions', 'id', $id);
		foreach ($get->result_array() as $row){
			$data = array(
				'id' => $row['id'],
				'type' => $row['trip_category'],
				'name' => $row['name'],
				'slug' => $row['match_name'],
				'for_agent' => $row['is_for_agent'],
				'nominal' => $row['nominal'],
				'active' => $row['is_active'],
				'note' => $row['notes']
			);
		}
		echo json_encode($data);
	}
	
	public function commission_edit(){
		$id = $this->uri->segment(3);
		$posts = $this->input->post(NULL,TRUE);
		foreach($posts as $key => $value)
			$data[$key] = $value;
		$upd = $this->general->update_data_on_table('commissions', 'id', $id, $data);
		if ($upd)
			redirect(base_url('index.php/admin/setting_commission_page'));
		else
			$this->show_message_page('mengubah data komisi', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function get_administration_fee(){
		$cat = $this->uri->segment(3);
		$this->load->model('commission');
		$query = $this->commission->get_admin_fee($cat);
		foreach($query->result_array() as $row){
			$data = array(
				'name' => $row['name'],
				'nominal' => $row['nominal']
			);
		}
		echo json_encode($data);
	}
	
	public function get_registered_order_paket(){
		$cat = $this->uri->segment(3);
		$cat_array = explode('-',$cat);
		
		$query = $this->orders->get_registered_order_paket_2();
		$number_row=0;
		foreach($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'order_id' => $row['order_id'],
				'category' => $row['category'],
				'description' => $row['description'],
				'title' => $row['title'],
				'agent_name' => $row['agent_name'],
				'payment_status' => $row['status'],
				'order_status' => $row['order_status'],
				'price' => $row['total_price'],
				'currency' => $row['currency'],
				'total_person' => $row['total_person_registered']
			);
		}
		echo json_encode($data);
	}
	
	public function get_issued_order_paket(){
		$cat = $this->uri->segment(3);
		$cat_array = explode('-',$cat);
		
		$query = $this->orders->get_issued_order_paket_2();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row ++;
			$data[] = array(
				'number_row' => $number_row,
				'order_id' => $row['order_id'],
				'category' => $row['category'],
				'description' => $row['description'],
				'title' => $row['title'],
				'agent_name' => $row['agent_name'],
				'payment_status' => $row['status'],
				'order_status' => $row['order_status'],
				'price' => $row['total_price']
			);
		}
		echo json_encode($data);
	}
	
	public function get_rejected_order_paket(){
		$cat = $this->uri->segment(3);
		$cat_array = explode('-',$cat);
		
		$query = $this->orders->get_cancelled_order_paket_2();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row ++;
			$data[] = array(
				'number_row' => $number_row,
				'order_id' => $row['order_id'],
				'category' => $row['category'],
				'description' => $row['description'],
				'title' => $row['title'],
				'agent_name' => $row['agent_name'],
				'payment_status' => $row['status'],
				'order_status' => $row['order_status'],
				'price' => $row['total_price'],
				'reason' => $row['reason']
			);
		}
		echo json_encode($data);
	}
	
	public function get_email_dist_list(){
		$this->load->model('notification');
		$query = $this->notification->get_email_distribution();
		$number_row = 0;
		foreach($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'category' => $row['category'],
				'to' => $row['to'],
				'cc' => $row['cc'],
				'bcc' => $row['bcc'],
				'email_sender' => $row['email_sender'],
				'sender_name' => $row['sender_name']
			);
		}
		echo json_encode($data);
	}
	
	public function get_email_dist_by_id(){
		$id = $this->uri->segment(3);
		$query = $this->general->get_detail_by_id('email_distributions', 'id', $id);
		foreach($query->result_array() as $row){
			$data = array(
				'id' => $row['id'],
				'category' => $row['category'],
				'to' => $row['to'],
				'cc' => $row['cc'],
				'bcc' => $row['bcc'],
				'email_sender' => $row['email_sender'],
				'sender_name' => $row['sender_name']
			);
		}
		echo json_encode($data);
	}
	
	public function email_dist_edit(){
		$id = $this->uri->segment(3);
		$post = $this->input->post(NULL,TRUE);
		foreach($post as $key => $value)
			$data[$key] = $value;
		$upd = $this->general->update_data_on_table('email_distributions', 'id', $id, $data);
		if($upd)
			redirect(base_url('index.php/admin/setting_email_dist'));
		else
			$this->show_message_page('mengubah konten', 'Mohon cek inputan anda atau hubungi web administrator.');
	}
	
	public function get_notifications(){
		$this->load->model('notification');
		$query = $this->notification->get_notification();
		$number_row = 0;
		foreach($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'category' => $row['category'],
				'message' => $row['message'],
				'datetime' => $row['created_datetime']
			);
		}
		echo json_encode($data);
	}
	
	public function count_notifications_today(){
		$this->load->model('notification');
		$date = date('Y-m-d');
		$query = $this->notification->count_notification_by_date($date);
		
		$data['count'] = $query;
		echo json_encode($data);
	}
	
	
	
	/*   ASSETS     */
	//======airlines======
	//cindy nordiansyah
	public function assets_airlines(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='airlines')
			$this->page('admin_assets_airlines');
		else if ($uri3=='rute')
			$this->page('admin_assets_airlines_rute');
		else if ($uri3=='password')
			$this->page('admin_assets_airlines_password');
	}
	//------airlines-----------
	//cindy nordiansyah
	public function get_assets_airlines() {
		$number_row = 0;
		$query = $this->assets->get_data('airlines');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'name' => $row['airlines_name'],
				'website' => $row['website'],
				'code' => $row['airlines_code']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function airline_add() {
		
		
		$data =array(
			'airlines_name' => $this->input->get('nama', TRUE),
			'website' => $this->input->get('website', TRUE),
			'airlines_code' => $this->input->get('kode', TRUE)
		);
		
		$insert_a = $this->assets->add_data('airlines', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function airline_update() {
		$this->page('admin_assets_airlines_modify');
	}
	//cindy nordiansyah
	public function airline_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'airlines_name' => $this->input->get('nama', TRUE),
			'website' => $this->input->get('website', TRUE),
			'airlines_code' => $this->input->get('kode', TRUE)
		);
		$upd = $this->assets->upd_data('airlines','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function airline_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('airlines','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'name' => $row['airlines_name'],
				'website' => $row['website'],
				'code' => $row['airlines_code']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function airline_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('airlines','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_airlines/airlines'));
	}
	//!------airlines-----------
	
	//------airlines rute------
	//cindy nordiansyah
	public function get_assets_airlines_rute() {
		$number_row = 0;
		$query = $this->assets->get_data('airlines_rute');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'name' => $row['airlines_name'],
				'origin' => $row['origin'],
				'destination' => $row['destination']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function airline_rute_add() {
		
		
		$data =array(
			'airlines_name' => $this->input->get('nama', TRUE),
			'origin' => $this->input->get('origin', TRUE),
			'destination' => $this->input->get('destination', TRUE)
		);
		
		$insert_a = $this->assets->add_data('airlines_rute', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function airline_rute_update() {
		$this->page('admin_assets_airlines_rute_modify');
	}
	//cindy nordiansyah
	public function airline_rute_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'airlines_name' => $this->input->get('nama', TRUE),
			'origin' => $this->input->get('origin', TRUE),
			'destination' => $this->input->get('destination', TRUE)
		);
		$upd = $this->assets->upd_data('airlines_rute','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function airline_rute_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('airlines_rute','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'name' => $row['airlines_name'],
				'origin' => $row['origin'],
				'destination' => $row['destination']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function airline_rute_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('airlines_rute','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_airlines/rute'));
	}
	//!------airlines rute------
	
	//------airlines password------
	//cindy nordiansyah
	public function get_assets_airlines_password() {
		$number_row = 0;
		$query = $this->assets->get_data('airlines_password');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'name' => $row['id_airlines'],
				'pass' => $row['password'],
				'kode' => $row['kode_agen'],
				'tipe' => $row['tipe']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function airline_password_add() {
		
		
		$data =array(
			'id_airlines' => $this->input->get('nama', TRUE),
			'password' => $this->input->get('pass', TRUE),
			'kode_agen' => $this->input->get('kode', TRUE),
			'tipe' => $this->input->get('tipe', TRUE)
		);
		
		$insert_a = $this->assets->add_data('airlines_password', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function airline_password_update() {
		$this->page('admin_assets_airlines_password_modify');
	}
	//cindy nordiansyah
	public function airline_password_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'id_airlines' => $this->input->get('nama', TRUE),
			'password' => $this->input->get('pass', TRUE),
			'kode_agen' => $this->input->get('kode', TRUE),
			'tipe' => $this->input->get('tipe', TRUE)
		);
		$upd = $this->assets->upd_data('airlines_password','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function airline_password_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('airlines_password','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'name' => $row['id_airlines'],
				'pass' => $row['password'],
				'kode' => $row['kode_agen'],
				'tipe' => $row['tipe']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function airline_password_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('airlines_password','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_airlines/password'));
	}
	//!------airlines password------
	//!======airlines======
	
	//======hotel======
	public function assets_hotel(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='hotel_list')
			$this->page('admin_assets_hotel_list');
		else if ($uri3=='hotel_supplier')
			$this->page('admin_assets_hotel_supplier');
		else if ($uri3=='hotel_price')
			$this->page('admin_assets_hotel_price');
		else if ($uri3=='hotel_coordinate')
			$this->page('admin_assets_hotel_coordinate');
		else if ($uri3=='hotel_tipe')
			$this->page('admin_assets_hotel_tipe');
		else if ($uri3=='hotel_room')
			$this->page('admin_assets_hotel_room');
		else if ($uri3=='hotel_facility')
			$this->page('admin_assets_hotel_facility');
	}
	
	//------hotel list--------
	//cindy nordiansyah
	public function get_assets_hotel_list() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_list');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'tipe' => $row['hotel_type'],
				'nama' => $row['hotel_name'],
				'address' => $row['address'],
				'telp' => $row['telp'],
				'idcity' => $row['id_city'],
				'isactive' => $row['is_active']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_list_add() {
		
		
		$data =array(
			'hotel_type' => $this->input->get('tipe', TRUE),
			'hotel_name' => $this->input->get('nama', TRUE),
			'address' => $this->input->get('address', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'id_city' => $this->input->get('idcity', TRUE),
			'is_active' => $this->input->get('isactive', TRUE)
		);
		
		$insert_a = $this->assets->add_data('hotel_list', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_list_update() {
		$this->page('admin_assets_hotel_list_modify');
	}
	//cindy nordiansyah
	public function hotel_list_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'hotel_type' => $this->input->get('tipe', TRUE),
			'hotel_name' => $this->input->get('nama', TRUE),
			'address' => $this->input->get('address', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'id_city' => $this->input->get('idcity', TRUE),
			'is_active' => $this->input->get('isactive', TRUE)
		);
		$upd = $this->assets->upd_data('hotel_list','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_list_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_list','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'tipe' => $row['hotel_type'],
				'nama' => $row['hotel_name'],
				'address' => $row['address'],
				'telp' => $row['telp'],
				'idcity' => $row['id_city'],
				'isactive' => $row['is_active']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_list_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_list','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_list'));
	}
	//!------hotel list--------
	
	//------hotel supplier--------
	//cindy nordiansyah
	public function get_assets_hotel_supplier() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_supplier');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'alamat' => $row['alamat'],
				'telp' => $row['telp'],
				'manajer' => $row['manajer'],
				'email' => $row['email']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_supplier_add() {
		
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'email' => $this->input->get('email', TRUE)
		);
		
		$insert_a = $this->assets->add_data('hotel_supplier', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_supplier_update() {
		$this->page('admin_assets_hotel_supplier_modify');
	}
	//cindy nordiansyah
	public function hotel_supplier_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'email' => $this->input->get('email', TRUE)
		);
		$upd = $this->assets->upd_data('hotel_supplier','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_supplier_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_supplier','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'alamat' => $row['alamat'],
				'telp' => $row['telp'],
				'manajer' => $row['manajer'],
				'email' => $row['email']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_supplier_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_supplier','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_supplier'));
	}
	
	//!------hotel supplier--------
	
	//------hotel price--------
	//cindy nordiansyah
	public function get_assets_hotel_price() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_price');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'room_type' => $row['room_type'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price'],
				'alot' => $row['alot'],
				'max_guest' => $row['max_guest']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_price_add() {
		
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'room_type' => $this->input->get('room_type', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE),
			'alot' => $this->input->get('alot', TRUE),
			'max_guest' => $this->input->get('max_guest', TRUE)
		);
		
		$insert_a = $this->assets->add_data('hotel_price', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_price_update() {
		$this->page('admin_assets_hotel_price_modify');
	}
	//cindy nordiansyah
	public function hotel_price_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'room_type' => $this->input->get('room_type', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE),
			'alot' => $this->input->get('alot', TRUE),
			'max_guest' => $this->input->get('max_guest', TRUE)
		);
		$upd = $this->assets->upd_data('hotel_price','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_price_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_price','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'room_type' => $row['room_type'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price'],
				'alot' => $row['alot'],
				'max_guest' => $row['max_guest']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_price_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_price','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_price'));
	}
	//!------hotel price--------
	
	//------hotel coordinate--------
	//cindy nordiansyah
	public function get_assets_hotel_coordinate() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_coordinate');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'lati' => $row['lati'],
				'longi' => $row['longi']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_coordinate_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'lati' => $this->input->get('lati', TRUE),
			'longi' => $this->input->get('longi', TRUE)
		);
		
		$insert_a = $this->assets->add_data('hotel_coordinate', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_coordinate_update() {
		$this->page('admin_assets_hotel_coordinate_modify');
	}
	//cindy nordiansyah
	public function hotel_coordinate_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'lati' => $this->input->get('lati', TRUE),
			'longi' => $this->input->get('longi', TRUE)
		);
		$upd = $this->assets->upd_data('hotel_coordinate','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_coordinate_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_coordinate','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'lati' => $row['lati'],
				'longi' => $row['longi']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_coordinate_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_coordinate','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_coordinate'));
	}
	//!------hotel coordinate--------
	
	//------hotel tipe--------
	//cindy nordiansyah
	public function get_assets_hotel_tipe() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_tipe');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'tipe' => $row['tipe']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_tipe_add() {
		
		$data =array(
			'tipe' => $this->input->get('tipe', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('hotel_tipe', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_tipe_update() {
		$this->page('admin_assets_hotel_tipe_modify');
	}
	//cindy nordiansyah
	public function hotel_tipe_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'tipe' => $this->input->get('tipe', TRUE)
			
		);
		$upd = $this->assets->upd_data('hotel_tipe','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_tipe_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_tipe','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'tipe' => $row['tipe']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_tipe_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_tipe','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_tipe'));
	}
	//!------hotel tipe--------
	
	//------hotel room--------
	//cindy nordiansyah
	public function get_assets_hotel_room() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_room');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'room_type' => $row['room_type']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_room_add() {
		
		$data =array(
			'room_type' => $this->input->get('room_type', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('hotel_room', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_room_update() {
		$this->page('admin_assets_hotel_room_modify');
	}
	//cindy nordiansyah
	public function hotel_room_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'room_type' => $this->input->get('room_type', TRUE)
			
		);
		$upd = $this->assets->upd_data('hotel_room','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_room_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_room','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'room_type' => $row['room_type']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_room_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_room','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_room'));
	}
	//!------hotel room--------
	
	//------hotel facility--------
	//cindy nordiansyah
	public function get_assets_hotel_facility() {
		$number_row = 0;
		$query = $this->assets->get_data('hotel_facility');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'facility' => $row['facility']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function hotel_facility_add() {
		
		$data =array(
			'facility' => $this->input->get('facility', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('hotel_facility', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function hotel_facility_update() {
		$this->page('admin_assets_hotel_facility_modify');
	}
	//cindy nordiansyah
	public function hotel_facility_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'facility' => $this->input->get('facility', TRUE)
			
		);
		$upd = $this->assets->upd_data('hotel_facility','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function hotel_facility_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('hotel_facility','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'facility' => $row['facility']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function hotel_facility_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('hotel_facility','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_hotel/hotel_facility'));
	}
	//!------hotel facility--------
	
	//!======hotel======
	
	//======tour======
	
	public function assets_tour(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='agent')
			$this->page('admin_assets_tour_agent');
		else if ($uri3=='list')
			$this->page('admin_assets_tour_list');
		else if ($uri3=='price_custom')
			$this->page('admin_assets_tour_price_custom');
		else if ($uri3=='price_default')
			$this->page('admin_assets_tour_price_default');
		else if ($uri3=='category')
			$this->page('admin_assets_tour_category');
		else if ($uri3=='duration')
			$this->page('admin_assets_tour_duration');
		else if ($uri3=='location')
			$this->page('admin_assets_tour_location');
	}
	//------tour agent--------
	//cindy nordiansyah
	public function get_assets_tour_agent() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_agent');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'propinsi' => $row['propinsi'],
				'kota' => $row['kota'],
				'manajer' => $row['manajer'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_agent_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'propinsi' => $this->input->get('propinsi', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		
		$insert_a = $this->assets->add_data('tour_agent', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_agent_update() {
		$this->page('admin_assets_tour_agent_modify');
	}
	//cindy nordiansyah
	public function tour_agent_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'propinsi' => $this->input->get('propinsi', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_agent','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_agent_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_agent','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'propinsi' => $row['propinsi'],
				'kota' => $row['kota'],
				'manajer' => $row['manajer'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_agent_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_agent','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/agent'));
	}
	//!------tour agent--------
	
	//------tour list--------
	//cindy nordiansyah
	public function get_assets_tour_list() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_list');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'category' => $row['category'],
				'location' => $row['location'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_list_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'category' => $this->input->get('category', TRUE),
			'location' => $this->input->get('location', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('tour_list', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_list_update() {
		$this->page('admin_assets_tour_list_modify');
	}
	//cindy nordiansyah
	public function tour_list_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'category' => $this->input->get('category', TRUE),
			'location' => $this->input->get('location', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_list','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_list_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_list','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'category' => $row['category'],
				'location' => $row['location'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_list_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_list','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/list'));
	}
	//!------tour list--------
	
	//------tour price custom--------
	//cindy nordiansyah
	public function get_assets_tour_price_custom() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_price_custom');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'tgl_dari' => $row['tgl_dari'],
				'tgl_sd' => $row['tgl_sd'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_price_custom_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'tgl_dari' => $this->input->get('tgl_dari', TRUE),
			'tgl_sd' => $this->input->get('tgl_sd', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		
		$insert_a = $this->assets->add_data('tour_price_custom', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_price_custom_update() {
		$this->page('admin_assets_tour_price_custom_modify');
	}
	//cindy nordiansyah
	public function tour_price_custom_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'tgl_dari' => $this->input->get('tgl_dari', TRUE),
			'tgl_sd' => $this->input->get('tgl_sd', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_price_custom','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_price_custom_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_price_custom','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'tgl_dari' => $row['tgl_dari'],
				'tgl_sd' => $row['tgl_sd'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_price_custom_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_price_custom','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/price_custom'));
	}
	//!------tour price custom--------
	
	//------tour price default--------
	//cindy nordiansyah
	public function get_assets_tour_price_default() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_price_default');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_price_default_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		
		$insert_a = $this->assets->add_data('tour_price_default', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_price_default_update() {
		$this->page('admin_assets_tour_price_default_modify');
	}
	//cindy nordiansyah
	public function tour_price_default_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'tour_name' => $this->input->get('tour_name', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_price_default','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_price_default_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_price_default','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'tour_name' => $row['tour_name'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_price_default_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_price_default','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/price_default'));
	}
	//!------tour price default--------
	
	//------tour category--------
	//cindy nordiansyah
	public function get_assets_tour_category() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_category');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'category' => $row['category']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_category_add() {
		
		$data =array(
			'category' => $this->input->get('category', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('tour_category', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_category_update() {
		$this->page('admin_assets_tour_category_modify');
	}
	//cindy nordiansyah
	public function tour_category_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'category' => $this->input->get('category', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_category','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_category_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_category','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'category' => $row['category']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_category_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_category','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/category'));
	}
	//!------tour category--------
	
	//------tour duration--------
	//cindy nordiansyah
	public function get_assets_tour_duration() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_duration');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'duration' => $row['duration']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_duration_add() {
		
		$data =array(
			'duration' => $this->input->get('duration', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('tour_duration', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_duration_update() {
		$this->page('admin_assets_tour_duration_modify');
	}
	//cindy nordiansyah
	public function tour_duration_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'duration' => $this->input->get('duration', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_duration','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_duration_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_duration','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'duration' => $row['duration']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_duration_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_duration','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/duration'));
	}
	//!------tour duration--------
	
	//------tour location--------
	//cindy nordiansyah
	public function get_assets_tour_location() {
		$number_row = 0;
		$query = $this->assets->get_data('tour_location');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'location' => $row['location']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function tour_location_add() {
		
		$data =array(
			'location' => $this->input->get('location', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('tour_location', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function tour_location_update() {
		$this->page('admin_assets_tour_location_modify');
	}
	//cindy nordiansyah
	public function tour_location_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'location' => $this->input->get('location', TRUE)
			
		);
		$upd = $this->assets->upd_data('tour_location','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function tour_location_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('tour_location','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'location' => $row['location']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function tour_location_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('tour_location','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_tour/location'));
	}
	//!------tour location--------
	
	//!======tour======
	
	//======travel======
	public function assets_travel(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='agent')
			$this->page('admin_assets_travel_agent');
		else if ($uri3=='trayek')
			$this->page('admin_assets_travel_trayek');
		else if ($uri3=='jemput')
			$this->page('admin_assets_travel_jemput');
		else if ($uri3=='mobil')
			$this->page('admin_assets_travel_mobil');
		else if ($uri3=='price')
			$this->page('admin_assets_travel_price');		
	}
	//------travel agent--------
	//cindy nordiansyah
	public function get_assets_travel_agent() {
		$number_row = 0;
		$query = $this->assets->get_data('travel_agent');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'manajer' => $row['manajer'],
				'manajer_telp' => $row['manajer_telp'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function travel_agent_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'manajer_telp' => $this->input->get('manajer_telp', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		
		$insert_a = $this->assets->add_data('travel_agent', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function travel_agent_update() {
		$this->page('admin_assets_travel_agent_modify');
	}
	//cindy nordiansyah
	public function travel_agent_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'manajer_telp' => $this->input->get('manajer_telp', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
			
		);
		$upd = $this->assets->upd_data('travel_agent','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function travel_agent_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('travel_agent','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'manajer' => $row['manajer'],
				'manajer_telp' => $row['manajer_telp'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function travel_agent_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('travel_agent','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_travel/agent'));
	}
	//!------travel agent--------
	
	//------travel trayek--------
	//cindy nordiansyah
	public function get_assets_travel_trayek() {
		$number_row = 0;
		$query = $this->assets->get_data('travel_trayek');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'trayek' => $row['trayek'],
				'mobil' => $row['mobil'],
				'kota_dari' => $row['kota_dari'],
				'kota_ke' => $row['kota_ke'],
				'jam' => $row['jam']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function travel_trayek_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'trayek' => $this->input->get('trayek', TRUE),
			'mobil' => $this->input->get('mobil', TRUE),
			'kota_dari' => $this->input->get('kota_dari', TRUE),
			'kota_ke' => $this->input->get('kota_ke', TRUE),
			'jam' => $this->input->get('jam', TRUE)
		);
		
		$insert_a = $this->assets->add_data('travel_trayek', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function travel_trayek_update() {
		$this->page('admin_assets_travel_trayek_modify');
	}
	//cindy nordiansyah
	public function travel_trayek_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'trayek' => $this->input->get('trayek', TRUE),
			'mobil' => $this->input->get('mobil', TRUE),
			'kota_dari' => $this->input->get('kota_dari', TRUE),
			'kota_ke' => $this->input->get('kota_ke', TRUE),
			'jam' => $this->input->get('jam', TRUE)
			
		);
		$upd = $this->assets->upd_data('travel_trayek','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function travel_trayek_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('travel_trayek','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'trayek' => $row['trayek'],
				'mobil' => $row['mobil'],
				'kota_dari' => $row['kota_dari'],
				'kota_ke' => $row['kota_ke'],
				'jam' => $row['jam']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function travel_trayek_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('travel_trayek','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_travel/trayek'));
	}
	//!------travel trayek--------
	
	//------travel titik jemput--------
	//cindy nordiansyah
	public function get_assets_travel_jemput() {
		$number_row = 0;
		$query = $this->assets->get_data('travel_jemput');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'kota' => $row['kota'],
				'titik_jemput' => $row['titik_jemput']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function travel_jemput_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'titik_jemput' => $this->input->get('titik_jemput', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('travel_jemput', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function travel_jemput_update() {
		$this->page('admin_assets_travel_jemput_modify');
	}
	//cindy nordiansyah
	public function travel_jemput_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'titik_jemput' => $this->input->get('titik_jemput', TRUE)
			
		);
		$upd = $this->assets->upd_data('travel_jemput','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function travel_jemput_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('travel_jemput','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'kota' => $row['kota'],
				'titik_jemput' => $row['titik_jemput']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function travel_jemput_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('travel_jemput','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_travel/jemput'));
	}
	//!------travel titik jemput--------
	
	//------travel mobil--------
	//cindy nordiansyah
	public function get_assets_travel_mobil() {
		$number_row = 0;
		$query = $this->assets->get_data('travel_mobil');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'mobil' => $row['mobil'],
				'kapasitas' => $row['kapasitas']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function travel_mobil_add() {
		
		$data =array(
			'mobil' => $this->input->get('mobil', TRUE),
			'kapasitas' => $this->input->get('kapasitas', TRUE)
		);
		
		$insert_a = $this->assets->add_data('travel_mobil', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function travel_mobil_update() {
		$this->page('admin_assets_travel_mobil_modify');
	}
	//cindy nordiansyah
	public function travel_mobil_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'mobil' => $this->input->get('mobil', TRUE),
			'kapasitas' => $this->input->get('kapasitas', TRUE)
		);
		$upd = $this->assets->upd_data('travel_mobil','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function travel_mobil_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('travel_mobil','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'mobil' => $row['mobil'],
				'kapasitas' => $row['kapasitas']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function travel_mobil_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('travel_mobil','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_travel/mobil'));
	}
	//!------travel mobil--------
	
	//------travel price--------
	//cindy nordiansyah
	public function get_assets_travel_price() {
		$number_row = 0;
		$query = $this->assets->get_data('travel_price');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'trayek' => $row['trayek'],
				'nama' => $row['nama'],
				'chair_type' => $row['chair_type'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price'],
				'alot' => $row['alot'],
				'isdefault' => $row['isdefault']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function travel_price_add() {
		
		$data =array(
			'trayek' => $this->input->get('trayek', TRUE),
			'nama' => $this->input->get('nama', TRUE),
			'chair_type' => $this->input->get('chair_type', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE),
			'alot' => $this->input->get('alot', TRUE),
			'isdefault' => $this->input->get('isdefault', TRUE)
		);
		
		$insert_a = $this->assets->add_data('travel_price', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function travel_price_update() {
		$this->page('admin_assets_travel_price_modify');
	}
	//cindy nordiansyah
	public function travel_price_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'trayek' => $this->input->get('trayek', TRUE),
			'nama' => $this->input->get('nama', TRUE),
			'chair_type' => $this->input->get('chair_type', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE),
			'alot' => $this->input->get('alot', TRUE),
			'isdefault' => $this->input->get('isdefault', TRUE)
		);
		$upd = $this->assets->upd_data('travel_price','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function travel_price_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('travel_price','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'trayek' => $row['trayek'],
				'nama' => $row['nama'],
				'chair_type' => $row['chair_type'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price'],
				'alot' => $row['alot'],
				'isdefault' => $row['isdefault']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function travel_price_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('travel_price','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_travel/price'));
	}
	//!------travel price--------
	
	//!======travel======
	
	//======umroh/haji======
	public function assets_umroh(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='agent')
			$this->page('admin_assets_umroh_agent');
		else if ($uri3=='list')
			$this->page('admin_assets_umroh_list');
		else if ($uri3=='price_custom')
			$this->page('admin_assets_umroh_price_custom');
		else if ($uri3=='price_default')
			$this->page('admin_assets_umroh_price_default');
		else if ($uri3=='category')
			$this->page('admin_assets_umroh_category');
		else if ($uri3=='duration')
			$this->page('admin_assets_umroh_duration');
		else if ($uri3=='location')
			$this->page('admin_assets_umroh_location');
	}
	//------agent--------
	//cindy nordiansyah
	public function get_assets_umroh_agent() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_agent');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'propinsi' => $row['propinsi'],
				'kota' => $row['kota'],
				'manajer' => $row['manajer'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_agent_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'propinsi' => $this->input->get('propinsi', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		
		$insert_a = $this->assets->add_data('umroh_agent', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_agent_update() {
		$this->page('admin_assets_umroh_agent_modify');
	}
	//cindy nordiansyah
	public function umroh_agent_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'alamat' => $this->input->get('alamat', TRUE),
			'propinsi' => $this->input->get('propinsi', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'manajer' => $this->input->get('manajer', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		$upd = $this->assets->upd_data('umroh_agent','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_agent_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_agent','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'alamat' => $row['alamat'],
				'propinsi' => $row['propinsi'],
				'kota' => $row['kota'],
				'manajer' => $row['manajer'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_agent_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_agent','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/agent'));
	}
	//!------agent--------
	
	//------list--------
	//cindy nordiansyah
	public function get_assets_umroh_list() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_list');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'category' => $row['category'],
				'location' => $row['location'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_list_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'category' => $this->input->get('category', TRUE),
			'location' => $this->input->get('location', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		
		$insert_a = $this->assets->add_data('umroh_list', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_list_update() {
		$this->page('admin_assets_umroh_list_modify');
	}
	//cindy nordiansyah
	public function umroh_list_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'category' => $this->input->get('category', TRUE),
			'location' => $this->input->get('location', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		$upd = $this->assets->upd_data('umroh_list','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_list_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_list','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'category' => $row['category'],
				'location' => $row['location'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_list_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_list','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/list'));
	}
	//!------list--------
	
	//------price custom--------
	//cindy nordiansyah
	public function get_assets_umroh_price_custom() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_price_custom');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'tgl_dari' => $row['tgl_dari'],
				'tgl_sd' => $row['tgl_sd'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_price_custom_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'tgl_dari' => $this->input->get('tgl_dari', TRUE),
			'tgl_sd' => $this->input->get('tgl_sd', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		
		$insert_a = $this->assets->add_data('umroh_price_custom', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_price_custom_update() {
		$this->page('admin_assets_umroh_price_custom_modify');
	}
	//cindy nordiansyah
	public function umroh_price_custom_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'tgl_dari' => $this->input->get('tgl_dari', TRUE),
			'tgl_sd' => $this->input->get('tgl_sd', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		$upd = $this->assets->upd_data('umroh_price_custom','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_price_custom_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_price_custom','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'tgl_dari' => $row['tgl_dari'],
				'tgl_sd' => $row['tgl_sd'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_price_custom_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_price_custom','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/price_custom'));
	}
	//!------price custom--------
	
	//------price default--------
	//cindy nordiansyah
	public function get_assets_umroh_price_default() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_price_default');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_price_default_add() {
		
		$data =array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		
		$insert_a = $this->assets->add_data('umroh_price_default', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_price_default_update() {
		$this->page('admin_assets_umroh_price_default_modify');
	}
	//cindy nordiansyah
	public function umroh_price_default_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'agent' => $this->input->get('agent', TRUE),
			'umroh_name' => $this->input->get('umroh_name', TRUE),
			'agen_price' => $this->input->get('agen_price', TRUE),
			'price' => $this->input->get('price', TRUE)
		);
		$upd = $this->assets->upd_data('umroh_price_default','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_price_default_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_price_default','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'agent' => $row['agent'],
				'umroh_name' => $row['umroh_name'],
				'agen_price' => $row['agen_price'],
				'price' => $row['price']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_price_default_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_price_default','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/price_default'));
	}
	//!------price default--------
	
	//------category--------
	//cindy nordiansyah
	public function get_assets_umroh_category() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_category');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'category' => $row['category']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_category_add() {
		
		$data =array(
			'category' => $this->input->get('category', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('umroh_category', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_category_update() {
		$this->page('admin_assets_umroh_category_modify');
	}
	//cindy nordiansyah
	public function umroh_category_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'category' => $this->input->get('category', TRUE)
			
		);
		$upd = $this->assets->upd_data('umroh_category','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_category_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_category','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'category' => $row['category']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_category_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_category','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/category'));
	}
	//!------category--------
	
	//------duration--------
	//cindy nordiansyah
	public function get_assets_umroh_duration() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_duration');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'duration' => $row['duration']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_duration_add() {
		
		$data =array(
			'duration' => $this->input->get('duration', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('umroh_duration', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_duration_update() {
		$this->page('admin_assets_umroh_duration_modify');
	}
	//cindy nordiansyah
	public function umroh_duration_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'duration' => $this->input->get('duration', TRUE)
			
		);
		$upd = $this->assets->upd_data('umroh_duration','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_duration_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_duration','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'duration' => $row['duration']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_duration_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_duration','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/duration'));
	}
	//!------duration--------
	
	//------location--------
	//cindy nordiansyah
	public function get_assets_umroh_location() {
		$number_row = 0;
		$query = $this->assets->get_data('umroh_location');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'location' => $row['location']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function umroh_location_add() {
		
		$data =array(
			'location' => $this->input->get('location', TRUE)
			
		);
		
		$insert_a = $this->assets->add_data('umroh_location', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function umroh_location_update() {
		$this->page('admin_assets_umroh_location_modify');
	}
	//cindy nordiansyah
	public function umroh_location_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'location' => $this->input->get('location', TRUE)
			
		);
		$upd = $this->assets->upd_data('umroh_location','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function umroh_location_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('umroh_location','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'location' => $row['location']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function umroh_location_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('umroh_location','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_umroh/location'));
	}
	//!------location--------
	
	//!======umroh/haji======
	
	//======rental======
	public function assets_rental(){
		$uri3= $this->uri->segment(3);
		if ($uri3=='agent')
			$this->page('admin_assets_rental_agent');
		else if ($uri3=='vehicle')
			$this->page('admin_assets_rental_vehicle');
		else if ($uri3=='list')
			$this->page('admin_assets_rental_list');
	}
	//------agent--------
	//cindy nordiansyah
	public function get_assets_rental_agent() {
		$number_row = 0;
		$query = $this->assets->get_data('rental_agent');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'kota' => $row['kota']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function rental_agent_add() {
		
		$data =array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'kota' => $this->input->get('kota', TRUE)
		);
		
		$insert_a = $this->assets->add_data('rental_agent', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function rental_agent_update() {
		$this->page('admin_assets_rental_agent_modify');
	}
	//cindy nordiansyah
	public function rental_agent_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'nama' => $this->input->get('nama', TRUE),
			'logo' => $this->input->get('logo', TRUE),
			'telp' => $this->input->get('telp', TRUE),
			'kota' => $this->input->get('kota', TRUE)
			
		);
		$upd = $this->assets->upd_data('rental_agent','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function rental_agent_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('rental_agent','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'nama' => $row['nama'],
				'logo' => $row['logo'],
				'telp' => $row['telp'],
				'kota' => $row['kota']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function rental_agent_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('rental_agent','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_rental/agent'));
	}
	//!------agent--------
	
	//------vehicle--------
	//cindy nordiansyah
	public function get_assets_rental_vehicle() {
		$number_row = 0;
		$query = $this->assets->get_data('rental_vehicle');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'vehicle' => $row['vehicle'],
				'image' => $row['image']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function rental_vehicle_add() {
		
		$data =array(
			'vehicle' => $this->input->get('vehicle', TRUE),
			'image' => $this->input->get('image', TRUE)
		);
		
		$insert_a = $this->assets->add_data('rental_vehicle', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function rental_vehicle_update() {
		$this->page('admin_assets_rental_vehicle_modify');
	}
	//cindy nordiansyah
	public function rental_vehicle_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'vehicle' => $this->input->get('vehicle', TRUE),
			'image' => $this->input->get('image', TRUE)
		);
		$upd = $this->assets->upd_data('rental_vehicle','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function rental_vehicle_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('rental_vehicle','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'vehicle' => $row['vehicle'],
				'image' => $row['image']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function rental_vehicle_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('rental_vehicle','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_rental/vehicle'));
	}
	//!------vehicle--------
	
	//------list--------
	//cindy nordiansyah
	public function get_assets_rental_list() {
		$number_row = 0;
		$query = $this->assets->get_data('rental_list');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'supplier' => $row['supplier'],
				'kota' => $row['kota'],
				'vehicle' => $row['vehicle'],
				'isactive' => $row['isactive'],
				'bensin' => $row['bensin']
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function rental_list_add() {
		
		$data =array(
			'supplier' => $this->input->get('supplier', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'vehicle' => $this->input->get('vehicle', TRUE),
			'isactive' => $this->input->get('isactive', TRUE),
			'bensin' => $this->input->get('bensin', TRUE)
		);
		
		$insert_a = $this->assets->add_data('rental_list', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function rental_list_update() {
		$this->page('admin_assets_rental_list_modify');
	}
	//cindy nordiansyah
	public function rental_list_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'supplier' => $this->input->get('supplier', TRUE),
			'kota' => $this->input->get('kota', TRUE),
			'vehicle' => $this->input->get('vehicle', TRUE),
			'isactive' => $this->input->get('isactive', TRUE),
			'bensin' => $this->input->get('bensin', TRUE)
		);
		$upd = $this->assets->upd_data('rental_list','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function rental_list_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('rental_list','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'supplier' => $row['supplier'],
				'kota' => $row['kota'],
				'vehicle' => $row['vehicle'],
				'isactive' => $row['isactive'],
				'bensin' => $row['bensin']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function rental_list_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('rental_list','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_rental/list'));
	}
	//!------list--------
	
	//!======rental======
	
	//======point reward======
	public function assets_point_reward(){
		
		$this->page('admin_assets_point_reward');
		
	}
	public function get_assets_point_reward() {
		$number_row = 0;
		$query = $this->assets->get_data('point_reward');
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['no'],
				'image' => $row['image'],
				'point' => $row['point'],
				'keterangan' => $row['keterangan'],
				'isactive' => $row['isactive']
				
			);
		}
		echo json_encode($data);
	}
	
	//cindy nordiansyah
	public function point_reward_add() {
		
		$data =array(
			'image' => $this->input->get('image', TRUE),
			'point' => $this->input->get('point', TRUE),
			'keterangan' => $this->input->get('keterangan', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)

		);
		
		$insert_a = $this->assets->add_data('point_reward', $data);
		
		$response[] = array('response' => $insert_a);
		echo json_encode($response);
	}
	//cindy nordiansyah
	public function point_reward_update() {
		$this->page('admin_assets_point_reward_modify');
	}
	//cindy nordiansyah
	public function point_reward_edit() {
		$id= $this->uri->segment(3);
		$data = array(
			'image' => $this->input->get('image', TRUE),
			'point' => $this->input->get('point', TRUE),
			'keterangan' => $this->input->get('keterangan', TRUE),
			'isactive' => $this->input->get('isactive', TRUE)
		);
		$upd = $this->assets->upd_data('point_reward','no', $id, $data);
	}
	
	//cindy nordiansyah
	public function point_reward_details(){
		$id = $this->uri->segment(3);
		$query = $this->assets->get_detail_by_id('point_reward','no', $id);
		foreach ($query->result_array() as $row){
			$data[] = array(
				'id' => $row['no'],
				'image' => $row['image'],
				'point' => $row['point'],
				'keterangan' => $row['keterangan'],
				'isactive' => $row['isactive']
			);
		}
		echo json_encode($data);
	}
	//cindy nordiansyah
	public function point_reward_delete() {
		$id= $this->uri->segment(3);
		//delete on table agents
		$query = $this->assets->del_data('point_reward','no',$id);
		//also delete the user on table users
		//$del_user = $this->users->del_user($id);
		redirect(base_url('index.php/admin/assets_point_reward'));
	}
	
	//!======point reward======
	
	public function get_options(){
		$query = $this->posts->fetch_options();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array(
				'number_row' => $number_row,
				'id' => $row['id'],
				'parameter' => $row['parameter'],
				'readable' => $row['readable'],
				'value' => $row['value']
			);
		}
		echo json_encode($data);
	}
	
	public function get_option_by_id(){
		$id = $this->uri->segment(3);
		$query = $this->general->get_detail_by_id('options', 'id', $id);
		foreach($query->result_array() as $row){
			$data = array(
				'id' => $row['id'],
				'parameter' => $row['parameter'],
				'readable' => $row['readable'],
				'value' => $row['value']
			);
		}
		echo json_encode($data);
	}
	
	public function edit_option(){
		$id = $this->uri->segment(3);
		$new_filename = 'pic_'.rand(1000, 1000000);
		$config['upload_path'] = './assets/uploads/option_images';
		$config['file_name'] = $new_filename;
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['overwrite']	= TRUE;
		$config['max_size']	= '2000';
		
		if($this->input->post('is_logo')=='yes'){
			$logo = '';
			if ($_FILES['value']['name']<>''){
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('value'))
					$this->show_message_page('mengunggah foto', $this->upload->display_errors());
				else {
					$upload_data = $this->upload->data();
					//$ext = end(explode(".", $this->upload->file_name));
					$data['value'] = $this->upload->file_name;
				}
			}
		}
		else
			$data['value'] = $this->input->post('value',TRUE);
		
		$upd = $this->general->update_data_on_table('options', 'id', $id, $data);
		if($upd)
			redirect(base_url('index.php/admin/option_setting'));
		else
			$this->show_message_page('mengubah opsi', 'Mohon cek inputan anda atau hubungi web administrator.');
		
	}
	
	public function approve_review(){
		$id = $this->uri->segment(3);
		$data['is_approved'] = 'true';
		$upd = $this->general->update_data_on_table('post_reviews', 'id', $id, $data);
		if($upd)
			redirect(base_url('index.php/admin/content_review'));
		else
			$this->show_message_page('approve komentar', 'Mohon cek inputan anda atau hubungi web administrator.');
	}
	
	public function delete_review(){
		$id = $this->uri->segment(3);
		$data['is_approved'] = 'true';
		$upd = $this->general->delete_from_table_by_id('post_reviews', 'id', $id);
		if($upd)
			redirect(base_url('index.php/admin/content_review'));
		else
			$this->show_message_page('menghapus komentar', 'Mohon cek inputan anda atau hubungi web administrator.');
	}
	
	public function get_post_paket(){
		$get = $this->posts->get_posts('true');
		foreach ($get->result_array() as $row){
			$data[] = array(
				'id' => $row['post_id'],
				'category' => $row['category_name'],
				'title' => $row['title'],
				'star_rating' => $row['star_rating'],
				'is_promo' => $row['is_promo'],
				'price' => $row['price'],
				'author' => $row['user_name'],
				'status' => $row['status'],
				'enabled' => $row['enabled'],
				'point_reward' => $row['point_reward'],
				'creation_date' => $row['creation_date'],
				'publish_date' => $row['publish_date'],
				'image_slider' => $row['shown_in_image_slider']
			);
		}
		echo json_encode($data);
	}
	
	public function test_email(){
		$this->load->library('email');

		$this->email->from('noreply@travelku.co', 'No Reply');
		$this->email->to('ocky.harli@gmail.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();
	}
	
	function export_to_excel($data, $headers, $sheet_name, $filename){
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle($sheet_name);
		// set value for headers
		
		for($i=0;$i<sizeof($headers);$i++){
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $headers[$i]); // 1 is the row index, column starting from 0, column 0 is A
			$this->excel->getActiveSheet()->getStyleByColumnAndRow($i, 1)->getFont()->setBold(true);
		}
		//fetch data and write to excel
		$row_index = 2;
		for($i=0;$i<sizeof($data);$i++){
			for($j=0;$j<sizeof($data[$i]);$j++){
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $row_index, $data[$i][$j]); // 1 is the row index, column starting from 0, column 0 is A
			}
			$row_index++;
		}
		
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function excel_all_transaction(){
		//load from database
		$list = $this->orders->get_order_list();
		$number_row = 0;
		foreach ($list->result_array() as $row){
			$number_row++;
			$data[] = array($number_row,$row['agent_username'],$row['agent_name'],$row['trip_category'],$row['order_id'],$row['total_price'],$row['order_status'],$row['registered_date'],$row['issued_date'],$row['status'],$row['transfer_date']);
		}
		
		$headers = array('Nomor', 'Username Agen','Nama Agen', 'Kategori Pembelian', 'ID Pesanan', 'Total Harga', 'Status Pesanan', 'Tanggal Pemesanan', 'Tanggal Issued', 'Status Pembayaran', 'Tanggal Transfer');

		$this->export_to_excel($data, $headers, 'Data Semua Transaksi', 'data transaksi semua agen.xls');
	}
	
	public function excel_all_agent(){
		//load from database
		$query = $this->agents->get_all_agents();
		$number_row = 0;
		foreach ($query->result_array() as $row){
			$number_row++;
			$data[] = array($number_row,$row['agent_username'],$row['agent_id'],$row['agent_name'],$row['agent_type'],$row['join_date'],$row['agent_phone'],$row['agent_city'],$row['agent_email'],$row['parent_agent'],$row['deposit_amount'],$row['voucher'],$row['approved']);
		}
		
		$headers = array('Nomor', 'Username Agen','ID Agen','Nama Agen', 'Tipe Agen', 'Tanggal Bergabung', 'No. Telepon', 'Kota', 'Email', 'Upline', 'Nilai Deposit', 'Voucher', 'Status Approval');

		$this->export_to_excel($data, $headers, 'Data Semua Agen', 'data semua agen.xls');
	}
	
	public function test(){
		$list = $this->orders->get_order_list();
		$number_row = 0;
		$col_index = 0;
		foreach ($list->result_array() as $row){
			$number_row++;
			$data[] = array($number_row,$row['trip_category'],$row['order_id'],$row['total_price'],$row['order_status'],$row['registered_date'],$row['status']);
		}
		print_r($data);
	}
	
	public function get_running_system_order(){
		$query = $this->general->get_afield_by_id('order_system_running', 'order', 'tiket', 'system');
		foreach($query->result_array() as $row)
			$data['running'] = $row['system'];
			
		echo json_encode($data); 
	}
	
	public function change_system_order(){
		$data = array('system' => $this->input->get('system', TRUE));
		$upd = $this->general->update_data_on_table('order_system_running', 'order', 'tiket', $data);
		
	}
	
	public function get_news_agents(){
		$q = $this->input->get('q',NULL);
		if(empty($q))
			$query = $this->agents->get_news_agents();
		else if($q=='pub')
			$query = $this->agents->get_news_agents(null,'pub');
		if($query<>false){
			foreach($query->result_array() as $row){
				$response[] = array(
					'id' => $row['id'],
					'title' => $row['news_title'],
					'content' => $row['news_content'],
					'status' => $row['status'],
					'creation_date' => date_format(new DateTime($row['creation_datetime']), 'd M Y H:i:s'),
					'publish_date' => ($row['publish_datetime']=="0000-00-00 00:00:00" ? "" : date_format(new DateTime($row['publish_datetime']), 'd M Y H:i:s'))
				);
			}
		}
		echo json_encode($response);
	}
	
	public function add_news_agent(){
		$data = array(
			'news_title' => $this->input->post('news_title',NULL),
			'news_content' => $this->input->post('news_content',NULL),
			'status' => $this->input->post('status',NULL),
			'creation_datetime' => date('Y-m-d H:i:s')
		);
		if($this->input->post('status',NULL)=="publish")
			$data['publish_datetime'] = date('Y-m-d H:i:s');
		
		$add = $this->general->add_to_table('agent_news', $data);
		if($add)
			redirect(base_url('index.php/admin/agent_news'));
		else
			$this->show_message_page('menambah berita agen', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function get_agent_news_by_id(){
		$id = $this->uri->segment(3);
		$query = $this->agents->get_news_agents($id);
		if($query<>false){
			foreach($query->result_array() as $row){
				$response = array(
					'title' => $row['news_title'],
					'content' => $row['news_content'],
					'status' => $row['status']
				);
			}
		}
		echo json_encode($response);
	}
	
	public function edit_news_agent(){
		$id = $this->input->post('id');
		$data = array(
			'news_title' => $this->input->post('news_title',NULL),
			'news_content' => $this->input->post('news_content',NULL),
			'status' => $this->input->post('status',NULL)
		);
		if($this->input->post('status',NULL)=="publish")
			$data['publish_datetime'] = date('Y-m-d H:i:s');
		
		$upd = $this->general->update_data_on_table('agent_news', 'id', $id, $data);
		if($upd)
			redirect(base_url('index.php/admin/agent_news'));
		else
			$this->show_message_page('mengubah data berita agen', 'Mohon cek kembali input anda, atau hubungi web administrator.');
	}
	
	public function agent_news_delete(){
		$id = $this->uri->segment(3);
		$del = $this->general->delete_from_table_by_id('agent_news', 'id', $id);
		if($del)
			redirect(base_url('index.php/admin/agent_news'));
		else
			$this->show_message_page('menghapus data berita agen', 'Mohon hubungi web administrator.');
	}
}