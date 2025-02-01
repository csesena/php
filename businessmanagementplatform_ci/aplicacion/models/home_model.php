<?php

class Home_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	//Funcion para convertir stdclass a arrays
	function ejemplo($id) {
		echo getcwd();
		return $id;
	}
	
}
?>