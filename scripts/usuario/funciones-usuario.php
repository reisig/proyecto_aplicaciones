<?php

	/*require_once dirname(__DIR__). '/bd/consultas.php';
	require_once __DIR__."/clase-usuario.php";*/

	function IniciaSesion(){
	      $rut = trim($_POST['rut']);
	      $password = trim($_POST['password']);
	      if(consultas::verificarLogin($rut, $password)){
	          $usuario = new Usuario($rut);
	          if($usuario->nombre!=""){
	              $_SESSION['user'] = $usuario->rut;
	              session_write_close();
	              $tipoUsuario = $usuario->tipoUsuario;
	              redirecciona($tipoUsuario);
	          }else{
	              ?>
	                  <script>alert('Hubo un error al iniciar sesion!');</script>
	              <?php
	          }
	      }else{
	          ?>
	              <script>alert('RUT o contraseña incorrecto(s)!');</script>
	          <?php
	     }
	}

	function usuarioActual(){
		if(isset($_SESSION['user'])){
			return new Usuario($_SESSION['user']);
		}
	}

	function redirecciona($tipoUsuario){
	   switch($tipoUsuario){
	  	case "Administrador":
	  		header('Location: ver-usuarios.php');
	  		break;
	  	case "Profesor":
	  		header('Location: guias.php');
	  		break;
	  	case "Alumno":
	  		header('Location: guia.php');
	  		break;
	  }
	}


?>