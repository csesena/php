<?php
/*
* WEBSERVICES
* Controlador para gestionar los webservices
*/
class Webservices extends CI_Controller {
	
	// Funcion llamada siempre que se invoca un webservice
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
	}

	// Funcion index para invocar todas las vistas disponibles
	public function index($funcion)
	{	
	
		$gd = $this->input->get(NULL, TRUE); // Recogemos los valores que van en el GET filtrando posibles ataques XSS
		
		$data['pintar'] = array(); // Creamos el array que se pintara en la vista
	
		// Ejecutamos la funcion que nos indican en el primer parametro y asignamos los return a la variable data
		if ($funcion == "insert_user") {
			$data['pintar'] = $this->usuarios_model->insert_user($gd['numero'], $gd['password']);
		} else if ($funcion == "modify_user") {
			$nick = isset($gd['nick']) ? $gd['nick'] : "";
			$nombre = isset($gd['nombre']) ? $gd['nombre'] : "";
			$email = isset($gd['email']) ? $gd['email'] : "";
			$ciudad = isset($gd['ciudad']) ? $gd['ciudad'] : "";
			$data['pintar'] = $this->usuarios_model->modify_user($nick, $nombre, $email, $ciudad, $gd['genero'], $gd['provincia'], $gd['numero']);
		} else if ($funcion == "check_login_info") {
			$data['pintar'] = $this->usuarios_model->check_login_info($gd['numero'], $gd['password']);
		} else if ($funcion == "modify_password") {
			$data['pintar'] = $this->usuarios_model->modify_password($gd['numero'], $gd['password']);
		} else if ($funcion == "deactivate_user") {
			$data['pintar'] = $this->usuarios_model->deactivate_user($gd['numero']);
		} else if ($funcion == "reactivate_user") {
			$data['pintar'] = $this->usuarios_model->reactivate_user($gd['numero']);
		}
		
		// Pintamos la vista pasandole la variable data
		$this->load->view('webservices/view', $data);

	}
	
}
?>