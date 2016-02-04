<?php
	/**
	* Clase encargada de la instalación de la 
	*	base de datos en el servidor
	*
	* @package RepBiologia
	* @since RepBiologia 1.0
	*/

	require_once(__DIR__.'/scripts/cargar.php');

?>

<!DOCTYPE html>
<html>
	<meta charset="UTF-8"> 
	<head>
		<title>Instalación base de datos MySQL</title>
		<?php agregar_css('estilo.css'); ?>
	</head>
	<body>
		<div id = "header">	</div>
		<div> <h1>Este es el módulo de instalación de la base de datos MySQL</h1>	</div>
		<form id = 'FormInstalacion' align ="center">
		    <fieldset>
				<h2 class="fs-title">Conexión</h2>
				<h3 class="fs-subtitle">Conexión a la base de datos</h3>
				<input type="text" name="host" id="host" placeholder="Host" />
				<input type="text" name="puerto"  id="puerto" placeholder="Puerto" />
				<input type="text" name="dbuser" id= "dbuser" placeholder="Usuario" />
				<input type="password" name="dbpassword" id ="dbpassword" placeholder="Contraseña" />
				<input type="button" name="checkdb" class="check action-button" value="Verificar conexión" />
			</fieldset>	
			<fieldset>
				<h2 class="fs-title">Creación base de datos</h2>	
				<input type="text" name="dbname" id = "dbname" placeholder="Nombre" />
				<input type="text" name="dbprefix" id="dbprefix" placeholder="Prefijo para las tablas" />
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
			</fieldset>	
			<input type="submit" name="submit" class="submit action-button" value="Confirmar" />
		</form>
		<div id = "footer">	</div>
	</body>
</html>