<?php

/*
* USUARIOS
* Modelo para toda las gestiones relacionadas con los usuarios en la base de datos
*/

class Usuarios_model extends CI_Model {

	/*
	* Se llama cada vez que se carga este fichero
	*/
	public function __construct()
	{
		$this->load->database();
	}
	
	/*
	* Primer caso. Función para insertar a un usuario nuevo
	* Parametros:
	*   - Numero de telefono del usuario
	*   - Contraseña elegida por el usuario
	* El codigo asignado para esta operacion sera el 1
	*/
	function insert_user($numero, $password) {

		$sql = "INSERT INTO Usuarios (Telefono, Contrasena, Activo, Fecha_Alta, ID_Genero, ID_Provincia) VALUES (?,?,?,?,?,?)"; 
		if ($this->db->query($sql, array($numero, $password, 1, date("Y-m-d H:i:s"),0,0)))
			return true;
		else {
			log_message("error", "Problem in table Usuarios: ".$this->db->_error_message()." (".$this->db->_error_number().")");
			return false;
		}

	}
	
	/*
	* Segundo caso. Funcion para añadir/actualizar informacion personal
	* Reciberemos por parametros
	*    - Numero de telefono del usuario en el que realizar los cambios
	*    - Nuevo Nickname a guardar
	*    - Nuevo Nombre
	*    - Nuevo Correo
	*    - Nuevo codigo identificativo de genero
	*    - Nuevo codigo identificativo de provincia
	*    - Nueva ciudad
	*
	* El procedimiento comprueba cada parametro pasado y en caso de contener valor actualiza
	* la base de datos con el valor correspondiente para el numero de telefono correspondiente
	*/
	function modify_user($nick, $nombre, $email, $ciudad, $genero, $provincia, $numero) {
		
			// Creamos un array con los parametros que le pasaremos a la query
			$params = array();
		
		    // Empezamos a construir el string de la query
			$sql = "UPDATE Usuarios SET";
			
			// Segun vayamos viendo que recibimos valores vamos añadiendolos al string de actualizacion
			// Si la longitud es mayor que cero significara que hay valores para actualizar
			if (strlen($nick)>0)
			{
				$sql.= " Nickname = ?,"; //Añadimos al set el campo a actualizar
				$params[] = $nick;
			}

			if (strlen($nombre)>0)
			{
				$sql.= " Nombre_Real = ?,";
				$params[] = $nombre;
			}

			if (strlen($email)>0)
			{
				$sql.= " Correo = ?,";
				$params[] = $email;
			}

			if (strlen($ciudad)>0)
			{
				$sql.= " Ciudad = ?,";
				$params[] = $ciudad;
			}

			// Los codigos identificativo vendran con el valor ya asignado por lo que siempre se añadiran
			$sql.=" ID_Genero = ?, ID_Provincia = ? where Telefono = ?";
			$params[] = $genero;
			$params[] = $provincia;
			$params[] = $numero;
			
			if ($this->db->query($sql, $params)) // Ejecutamos la query. Si se ejecuta con normalidad, devolvemos un true. Si no, un false
				return true;
			else {
			    log_message("error", "Problem in table Usuarios: ".$this->db->_error_message()." (".$this->db->_error_number().")"); 
				return false;
			}
		
	}
	
	/*
	* Tercer caso. Funcion para login
	* Para ellos recibiremos por parametros
	*     - Numero de telefono
	*     - Contraseña
	* El sistema consultara a la base de datos y la salida de valores sera de la siguiente manera:
	*     - 0: Error (Gestionado por la pagina de errores)
	*     - 1: Correcto
	*     - 2: Correcto pero el usuario esta inactivo
	*/
	function check_login_info($numero, $password) {
	
		$sql = "SELECT Activo FROM Usuarios WHERE Telefono = ? AND Contrasena = ? LIMIT 1";  // Construimos la sentencia SQL
		$query = $this->db->query($sql, array($numero, $password)); // Ejecutamos la query y nos preparamos para recoger los datos

		if ($query->num_rows() > 0) // Si hay usuario que mostrar
		{
			$row = $query->row_array();
			if ($row['Activo'] == 1)	return 1; // Devolvemos 1 si el usuario esta activo
			else return 2; // Devolvemos 2 si el usuario existe pero esta inactivo
			
		} else // Si no existe el usuario, devolvemos un 0
			return 0;

	}
	
	/*
	* Cuarto caso. Cambio de contraseña
	* Recibiremos por parametros
	*     - Numero de telefono
	*     - Contraseña nueva
	* Actualizamos al usuario en esa base de datos con la nueva contraseña
	*/
	function modify_password($numero, $password) {

		$sql = "UPDATE Usuarios SET Contrasena = ? WHERE Telefono = ?"; // Construimos la sentencia SQL
		if ($this->db->query($sql, array($password, $numero))) // Ejecutamos la query. Si se ejecuta con normalidad, devolvemos un true. Si no, un false
			return true;
		else {
			log_message("error", "Problem in table Usuarios: ".$this->db->_error_message()." (".$this->db->_error_number().")");
			return false;
		}
			
	}
	
	/*
	* Quinto caso. Funcion para dar de baja a un usuario
	* Recibiremos el numero de telefono
	* Ponemos el bit de activar a 0 y la fecha de baja a NOW()
	*/
	function deactivate_user($numero) {
		
		$sql = "UPDATE Usuarios SET Activo = ?, Fecha_Baja = ? WHERE Telefono = ?"; // Construimos la sentencia SQL
		if ($this->db->query($sql, array(0, date ("Y-m-d H:i:s"), $numero))) // Ejecutamos la query. Si se ejecuta con normalidad, devolvemos un true. Si no, un false
			return true;
		else {
			log_message("error", "Problem in table Usuarios: ".$this->db->_error_message()." (".$this->db->_error_number().")");
			return false;
		}
		
	}
	
	/*
	* Sexto caso. Funcion para dar de alta a un usuario dado de baja
	* Recibiremos el numero de telefono
	* Ponemos el bit de activar a 1 y la fecha de baja la reseteamos al valor por defecto
	*/
	function reactivate_user($numero) {
		
		$sql = "UPDATE Usuarios SET Activo = ?, Fecha_Baja = ? WHERE Telefono = ?"; // Construimos la sentencia SQL
		if ($this->db->query($sql, array(1, '0000-00-00 00:00:00', $numero))) // Ejecutamos la query. Si se ejecuta con normalidad, devolvemos un true. Si no, un false
			return true;
		else {
			log_message("error", "Problem in table Usuarios: ".$this->db->_error_message()." (".$this->db->_error_number().")");
			return false;
		}
		
	}
	
}
?>