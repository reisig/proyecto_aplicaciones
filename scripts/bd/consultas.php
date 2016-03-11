<?php

	require_once 'dbc.php';
	require_once 'config.php';

	class consultas {
		private static $_db; 


		public static function insertUsuario($rut, $nombre, $apellidoP, $apellidoM, $correo, $password, $tipoUsuario){
			$_db = dbc::instance();
			$stmt = $_db->prepare("INSERT INTO ".USUARIO." (Rut, Nombre, ApellidoP, ApellidoM, Correo, TipoUsuario, Password ) VALUES (:rut, :nombre, :apellidoP, :apellidoM, :correo, :tipo, :password) ");
			$stmt->bindParam(':rut',$rut);
			$stmt->bindParam(':nombre',$nombre);
			$stmt->bindParam(':apellidoP',$apellidoP);
			$stmt->bindParam(':apellidoM',$apellidoM);
			$stmt->bindParam(':correo',$correo);
			$stmt->bindParam(':tipo',$tipoUsuario);
			$stmt->bindParam(':password',$password);
			try{
				$stmt->execute();
				return true;
			}catch(PDOException $e){
				return false;
			}
		}

		public static function verificarLogin($rut, $password){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT * 
									FROM ".USUARIO." WHERE rut = :rut AND password = :password");
			$stmt->bindParam(':rut', $rut);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
			if($stmt->fetch())
				return true;			
			return false;
		}

		public static function getTipoUsuario($tipo_usuario){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT nombre, apellidoP, apellidoM 
										FROM ".USUARIO." WHERE tipo = :tipo");
	      	$stmt->bindParam(':tipo',$tipo_usuario);
	      	$stmt->execute();
	      	return $stmt->fetch();
		}

		public static function getUsuario($rut){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT Nombre, ApellidoP, ApellidoM, Rut, Correo, Password, TipoUsuario 
										FROM ".USUARIO." WHERE rut = :rut");
	      	$stmt->bindParam(':rut',$rut);
	      	$stmt->execute();
	      	return $stmt->fetch();
		}

		public static function getUsuarios(){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT Nombre, ApellidoP, ApellidoM, Correo, Rut FROM ".USUARIO." WHERE TipoUsuario <> 'administrador'");
	      	$stmt->execute();
	      	$salida = array();
	      	while($row = $stmt->fetch()){
	      		$salida[] = $row;
	      	}
	      	return $salida;

		}

		//elimina el alumno de la tabla USUARIO y de la tabla USUARIOASIGNATURA
		public static function eliminarAlumno($rut){
			$_db = dbc::instance();
			$delUser = $_db->prepare("DELETE FROM ".USUARIO." WHERE Rut = :rut");
			$delUser->bindParam(':rut', $rut);			
			$delUserAsign = $_db->prepare("DELETE FROM ".USUARIOASIGNATURA." WHERE RutUsuario = :rut");
			$delUserAsign->bindParam(':rut', $rut);

			return ($delUser->execute() && $delUserAsign->execute());
		}

		//obtiene las asignaturas asignadas al usuario
		public static function getAsignaturasUsuario($rut){
			$_db = dbc::instance();

			$stmt = $_db->prepare("SELECT IdAsignatura FROM ".USUARIOASIGNATURA." WHERE RutUsuario = :rut");
			$stmt->bindParam(":rut", $rut);
			$stmt->execute();
			$salida = array();
	      	while($row = $stmt->fetch()){
	      		$salida[] = $row;
	      	}
	      	return $salida;
		}

		//modificar el usuario cuando tiene el mismo rut
		public static function modificarUsuario($nombre, $apellidoP, $apellidoM, $rut, $correo, $password){
			$_db = dbc::instance();
			$stmt = $_db->prepare("UPDATE ".USUARIO." SET Nombre = :nombre, 
														ApellidoP = :apellidoP,
														Rut = :rut,
														Correo = :correo,
														Password = :password WHERE Rut = :rut");
			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':apellidoP', $apellidoP);
			$stmt->bindParam(':rut', $rut);
			$stmt->bindParam(':correo', $correo);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':rut', $rut);

			return $stmt->execute();
		}

		public static function rutExiste($rut){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT nombre FROM ".USUARIO." WHERE Rut = :rut");
			$stmt->bindParam(':rut', $rut);
			$stmt->execute();
			if(count($stmt->fetch()) == 0){
				return false;
			}
			return true;
		}

		public static function eliminarProfesor($rut){

		}
	}

	

?>