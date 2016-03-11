<?php
	session_start();
	require_once __DIR__."/scripts/usuario/clase-usuario.php";

	$fileDir = __DIR__."/scripts/bd/config.php";


	if(file_exists($fileDir) && isset($_SESSION['user'])==""){

		header("Location: login.php");

	}else if (!file_exists($fileDir)){
			header("Location: instalar.php");
	}else{
		$usuario = new Usuario($_SESSION['user']);
		if($usuario->tipoUsuario = "administrador"){
          header('Location: ver-usuarios.php');
      	}else if ($usuario->tipoUsuario = "profesor"){
          header('Location: guias.php');
      	}else if ($usuario->tipoUsuario = "alumno"){
          header('Location: guia.php');
      	}
	}

?>