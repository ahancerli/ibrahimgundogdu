<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $viewFolder = "";

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library("form_validation");

	}

	public function index()
	{

		$viewData = new stdClass();
		$viewData->viewFolder = "home_v";
		$this->load->view($viewData->viewFolder,$viewData);
	}

	public function sendMessage()
	{
		$config = [
			'protocol' => "smtp",
			'smtp_host' => "smtp.gmail.com",
			'smtp_port' => "587",
			'smtp_user' => "redlin3agency@gmail.com",
			'smtp_pass' => "Redlin321*",
			'starttls' => true,
			'charset' => "UTF-8",
			'mailtype' => "html",
			'wordwrap' => true,
			'newline' => "\r\n",
		];

		$this->load->library("email",$config);

		$this->email->from("redlin3agency@gmail.com","HASANŞİMŞEK");
		$this->email->to("akmanhancerli@gmail.com");
		$this->email->subject("deneme konu");
		$this->email->message("deneme mesajı için geldim hacım");

		$send = $this->email->send();

		if ($send) {
			return redirect()->to( base_url( '/') );
			echo "mail başarılı bir şekilde gönderildi";
		}
		else {
			return redirect()->to( base_url( '/') );
			echo "<pre>";
			print_r($this->email->print_debugger());
			echo "</pre>";
		}


	}
}
