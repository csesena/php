<?php

class Galeria extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{	
		
		$data['title'] = ucfirst("galería"); // Capitalize the first letter

			$this->load->view('templates/header', $data);
			$this->load->view('galeria/view', $data);
			$this->load->view('templates/footer', $data);
	}
	
}
?>