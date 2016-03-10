<?php

	/*Datos de conexion*/
	$nombreBD = 'biologia';
	$usuario = 'administrador';
	$password = 'biologia';
	
	/*Conexion a la BD Biologia*/
	
	try{
		$conn = new PDO ('mysql:host=localhost;dbname='.$nombreBD.';charset=utf8',$usuario,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		print "¡Error:!".$e.getMessage()."<br>";
		die();
	}
?>