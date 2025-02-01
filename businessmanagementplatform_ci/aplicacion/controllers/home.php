<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Funcion que se llama al cargar cada una de las paginas relacionas con este controlador
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->helper('url');
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		/*if ($lang=="en") {
			$this->lang->load('header', 'english');
			$this->lang->load('inbound', 'english');
		} else {
			$this->lang->load('header', 'spanish');
			$this->lang->load('inbound', 'spanish');
		}*/
	}

	/**
	 * Index Page para el Home Controller
	 */
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('home/view');
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */