<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Cindy Nordiansyah
class Wisata_controller extends CI_Controller {

	public function __construct() {

        parent::__construct();

        $this->load->helper('form');
        $this->load->model('users');
		$this->load->model('agents');
		$this->load->model('bank');
		$this->load->model('orders');
	}
	
	public function page()
	{
		$data = array(
			'title' => 'Pemesanan Paket Wisata',
			'sub_title' => 'Isikan data untuk memesan paket wisata pilihan Anda.'
			);
		$this->load->view('header');
		$this->load->view('page_nav_header', $data);
		$this->load->view('order_paket_wisata');
		$this->load->view('footer');
		
	}
	
	//order_id, account_id, trip_category, paket_id
	
	public function order_wisata(){
		$data_order = array(
			'account_id' => $this->config->item('account_id'),
			'paket_id' => $this->input->post('paket_id',TRUE),
			'trip_category' => 'paket',
			'order_status' => 'Registered',
			'registered_date' => date('Y-m-d  H:i:s')
		);
		$data_passenger = array(
			'first_name' => $this->input->post('first_name', TRUE),
			'last_name' => $this->input->post('last_name', TRUE),
			'phone_1' => $this->input->post('telp_no',TRUE),
			'email' => $this->input->post('email',TRUE)
		);
		$this->load->model('wisata_model');
		$insert_order = $this->wisata_model->add_order($data_order);
		$insert_id = $this->wisata_model->add_passenger($data_passenger);
						
		//sending email
		//$email_config['mailtype'] = 'html';
		//$data_email = array(
			//'name' => $this->input->post('company_name', TRUE),
			//'username' => $this->input->post('username', TRUE),
			//'password' => $this->input->post('password', TRUE)
		//);
		//$this->load->library('email', $email_config);

		//$this->email->from('intest@hellotraveler.co.id', 'Info Agen Hellotraveler.co.id');
		//$this->email->to($this->input->post('email',TRUE));
		
		//$this->email->subject('Registrasi Agen Berhasil');
		//$messages = $this->load->view('email_tpl/registrasi_agen_berhasil', $data_email, TRUE);
		//$this->email->message($messages);

		//$this->email->send();

		
		redirect(base_url('index.php/wisata_controller/page/success'));
	}
}