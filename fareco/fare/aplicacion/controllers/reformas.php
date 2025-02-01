<?php

class Reformas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{	
		
		$data['title'] = ucfirst("reformas"); // Capitalize the first letter

			$this->load->view('templates/header', $data);
			$this->load->view('reformas/view', $data);
			$this->load->view('templates/footer', $data);
	}
	
}
?>