<?php

class Multiasistencia extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{	
		
		$data['title'] = ucfirst("multiasistencia"); // Capitalize the first letter

			$this->load->view('templates/header', $data);
			$this->load->view('multiasistencia/view', $data);
			$this->load->view('templates/footer', $data);
	}
	
}
?>