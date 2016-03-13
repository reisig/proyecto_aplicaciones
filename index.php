<?php
	session_start();

	require_once __DIR__."/scripts/usuario/funciones-usuario.php";
	require_once __DIR__."/scripts/usuario/clase-usuario.php";

	$fileDir = __DIR__."/scripts/bd/config.php";

	if(file_exists($fileDir) && isset($_SESSION['user'])==""){

		header("Location: login.php");

	}else if (!file_exists($fileDir)){
			header("Location: instalar.php");
	}else if(isset($_SESSION['user'])){
		$usuario = usuarioActual();
		$tipoUsuario = $usuario->tipoUsuario;
		redirecciona($tipoUsuario);
	}

?>