<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Other extends CI_Controller {

	public function get_yahoo_by_type() {
		$this->load->model('yahoo_messenger');
		$type = $this->uri->segment(3);
		$query = $this->yahoo_messenger->filter_by_type($type);
		foreach ($query->result_array() as $row){
			$email = explode("@", $row['yahoo_account']);
			$response[] = array(
				'id' =>  $row['id'],
				'username' => $email[0],
				'type' => $row['functional_type']
			);
		}
		echo json_encode($response);
	}
	
	public function get_server_info(){
		phpinfo();
	}
	
	public function curl(){
		echo exec('/usr/bin/curl http://api.sandbox.tiket.com/apiv1/payexpress?method=getToken&secretkey=34f08bda20602f4694c1466eefdd4a8e&output=json');
	}
}