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
	      	while($row = $stmt->fetch()){
	      		$salida[] = $row;
	      	}
	      	return $salida;

		}
	}

	

?>