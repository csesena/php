<?php

class Localizacion extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{	
		
		$data['title'] = ucfirst("Localización"); // Capitalize the first letter

			$this->load->view('templates/header', $data);
			$this->load->view('localizacion/view', $data);
			$this->load->view('templates/footer', $data);
	}
	
}
?>