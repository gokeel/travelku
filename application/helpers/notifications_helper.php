<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_email_distribution($data_email, $content)
{
	$email_config = array(
		'protocol' => 'sendmail',
		'mailpath' => '/usr/sbin/sendmail',
		'charset' => 'iso-8859-1',
		'wordwrap' => TRUE,
		'mailtype' => 'html'
	);
	$this->load->library('email', $email_config);
	
	$this->email->from($data_email['email_sender'], $data_email['sender_name']);
	$this->email->to($data_email['email_to']);
	$this->email->cc($data_email['email_cc']);
	$this->email->bcc($data_email['email_bcc']);
	
	$this->email->subject($data_email['subject']);
	$messages = $this->load->view($data_email['template'], $content, TRUE);
	$this->email->message($messages);

	$this->email->send();
}
