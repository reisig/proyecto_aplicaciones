<?php

	require_once 'dbc.php';

	class consultas {
		private static $_db; 

		public static function verificarLogin($rut, $password){
			$_db = dbc::instance();
			$stmt = $_db->prepare("SELECT * FROM usuario WHERE rut = :rut AND password = :password");
			$stmt->bindParam(':rut', $rut);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
			if($row = $stmt->fetch()){
				//existe el usuario y la contraseña es correcta
				//echo "exito";
			}
		}
	}

	

?>