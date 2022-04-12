<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $viewFolder = "";

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index()
	{

		$viewData = new stdClass();
		$viewData->viewFolder = "home_v";
		$this->load->view($viewData->viewFolder,$viewData);
	}

	public function sendMessage()
	{
		$name = $this->input->get("name");
		$email = $this->input->get("email");
		$message = $this->input->get("message");

		$this->load->library("email");
		$this->email->from("info@ibrahimgundogdu.space","İbrahim Gündoğdu Seo Marketing");
		$this->email->to("info@ibrahimgundogdu.space");
		$this->email->subject("Seo Marketing");
		$this->email->message("
			<strong>$name</strong> Kullanıcısından Aşağıdaki Mesaj Gelmiştir <br>
			<strong>Email Adresi: </strong> $email <br>
			<strong>Mesajı: </strong> $message <br>
 							");
		$returnArray['title'] = "İşlem Başarılı";
		$returnArray['text'] = "Mail Başarı İle Atıldı";
		$returnArray['type'] = "success";

		$send = $this->email->send();

		if ($send) {
			$this->session->set_flashdata("return", $returnArray);
			redirect(base_url('/#contact'));
		}
		else {
			$returnArray['title'] = "İşlem Başarısız";
			$returnArray['text'] = "Mail Atarken Hata Oluştu. Lütfen Mail Şifrenizi Kontrol ediniz";
			$returnArray['type'] = "danger";

			$this->session->set_flashdata("return", $returnArray);
			redirect(base_url('/#contact'));
		}


	}
}
