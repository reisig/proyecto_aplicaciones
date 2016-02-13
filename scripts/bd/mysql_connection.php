<?php

	/*
	
		Script para probar la conexion con la base de datos...

	*/
	
	$host = $_POST['host'];
	$port = $_POST['port'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];

	try{
		$connect = new PDO("mysql:host=".$host.";port=".$port, $dbuser, $dbpass);
		echo "1";
	}catch (PDOException $e){ 
		echo "0" ;
	}  
?>