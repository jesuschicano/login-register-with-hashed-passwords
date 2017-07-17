<?php
require 'database.php';

class User
{
	private $db;
	// Opciones de contraseña:
	const HASH = PASSWORD_DEFAULT;
	const COST = 14;

	/**
	* constructor
	*/
	public function __construct()
	{
		$this->db = Database::connect();
	}


	/**
	* Inserta un nuevo usuario en la base de datos
	* @var $nombre, $apellidos, $password, $localidad, $mail, $telefono, $tipo
	*/
	public function save($nombre, $apellidos, $password, $localidad, $mail, $telefono, $tipo)
	{
		// generar el nick
		$nick = "";
		// ****-*****

		// preparación de marcadores
		$datos = array(
			"nick" => $nick,
			"nombre" => $nombre,
			"apellidos" => $apellidos,
			"password" => password_hash( $password, self::HASH, ['cost' => self::COST] ),
			"localidad" => $localidad,
			"mail" => $mail,
			"telefono" => $telefono,
			"id_tipo" => $tipo,
			"id_regimen" => 3,
		);

		try{
			$launch = $this->db->prepare("INSERT INTO usuarios (nick,nombre,apellidos,password,localidad,mail,telefono,id_tipo,id_regimen) values (:nick,:nombre,:apellidos,:password,:localidad,:mail,:telefono,:id_tipo,:id_regimen)");
			$launch->execute($datos);

			if( $launch->rowCount() > 0 ){
				echo "<script>
						if(window.confirm('Usuario creado satisfactoriamente.'))
							document.location = 'index.php';
					</script>";
			}
			else{
				echo "<div class='box text-center'>Error en el registro.</div>";
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}

		$this->db = Database::disconnect();
	}

	/**
	* Devuelve el usuario logueado en el sistma
	* @var $nick,$pass
	*/
	public function login($nick,$pass)
	{
		// preparar marcadores
		$datos = array("nick"=>$nick);

		// consulta que corresponda con el nick
		try{
			// recoger primero por el nick
			$query = $this->db->prepare("SELECT nombre,password,id_tipo FROM usuarios WHERE nick=:nick");
			$query->execute($datos);

			// guardar el resultado y desconexión
			$usuario = $query->fetch(PDO::FETCH_ASSOC);
			$this->db = Database::disconnect();

			// verificar la contraseña del usuario:
			if( password_verify($pass, $usuario['password']) ){
				return $usuario;
			} else {
				exit;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
