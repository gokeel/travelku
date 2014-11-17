<?php
class Notification extends CI_Model {
	public function __construct() {
        parent::__construct();
    }

	function get_email_distribution($category=null){
		if($category<>null)
			$this->db->where('category', $category);
		$this->db->order_by('category asc');
		$query = $this->db->get('email_distributions');
		if ($query->num_rows() > 0){
			if($category<>null){
				foreach ($query->result_array() as $row){
					$to = $row['to'];
					$cc = $row['cc'];
					$bcc = $row['bcc'];
					$email_sender = $row['email_sender'];
					$sender_name = $row['sender_name'];
				}
				return array ($to, $cc, $bcc, $email_sender, $sender_name);
			}
			else
				return $query;
		}
		else
			return false;
	}
	
	function get_notification($category=null){
		if($category<>null)
			$this->db->where('category', $category);
		$this->db->order_by('category asc');
		$query = $this->db->get('notifications');
		if ($query->num_rows() > 0)
			return $query;
		else
			return false;
	}
	
	function count_notification_by_date($date){
		$this->db->like('created_datetime', $date);
		$this->db->order_by('category asc');
		$query = $this->db->get('notifications');
		return $query->num_rows();
	}
}