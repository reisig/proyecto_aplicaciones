<?php
	$fileDir = __DIR__."/scripts/bd/config.php";
	if (file_exists($fileDir)){
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Instalación base de datos MySQL</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/installstyle.css">
		<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ScriptInstalacion.js"></script>
	</head>
	<body>
		<div id="mhead"><h2>Instalación Base de datos MySQL</h2></div>
		<form id="FormInstalacion">
			<ul id="progressbar">
				<li class="active">Conexión</li>
				<li>Base de datos</li>
				<li>Administrador</li>
			</ul>
		    <fieldset id = "conexion">
				<h2 class="fs-title">Conexión</h2>
				<h3 class="fs-subtitle">Conexión al Servidor</h3>
				<input type="text" name="host" id="host" placeholder="Host" />
				<input type="text" name="port"  id="port" placeholder="Puerto" />
				<input type="text" name="dbuser" id="dbuser" placeholder="Usuario" />
				<input type="password" name="dbpass" id ="dbpass" placeholder="Contraseña" />
				<input type="button" name="checkdb" id= "checkdb" class="check action-button" value="Verificar conexión" />
				<input type="button" name="next" id="b1" class="next action-button" value="Siguiente" />
			</fieldset>
			<fieldset>
				<h2 class="fs-title">Creación base de datos</h2>	
				<input type="text" name="dbname" id="dbname" placeholder="Nombre" />
				<input type="text" name="dbprefix" id="dbprefix" placeholder="Prefijo para las tablas" />
				<input type="button" name="previous" class="previous action-button" value="Anterior" />
				<input type="button" name="next" id="b2" class="next action-button" value="Siguiente" />
			</fieldset>
			<fieldset>
				<h3 class="fs-title">Administrador</h3>
				<h3 class="fs-subtitle">Administrador de la aplicación web</h3>
				<div class="fs-error"></div>
				<input type="text" name="adminid" id="adminid" placeholder="RUT" />
				<input type="text" name="nombreadmin" id="nombreadmin" placeholder="Nombre" />
				<input type="text" name="apaterno" id="apaterno" placeholder="Apellido paterno" />
				<input type="text" name="amaterno" id="amaterno" placeholder="Apellido materno" />
				<input type="text" name="correo" id="correo" placeholder="Correo" />
				<input type="password" name="password" id="password" placeholder="Contraseña" />
				<input type="password" name="cpassword" id="cpassword" placeholder="Repita contraseña" />
				<input type="button" name="previous" class="previous action-button" value="Anterior" />
				<input type="button" name="submit" id="submit" class="submit action-button" value="Confirmar" />
			</fieldset>
		</form>
	</body>
</html>
