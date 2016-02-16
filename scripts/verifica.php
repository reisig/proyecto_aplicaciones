<!-- Este es un comentario en HTML                                -->
<!-- Declaración de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del código HTML                                       --> 
<html>

<!-- Inicio del encabezado HTML                                   --> 
	<head>
		<title> Verificador </title>
		<link rel="stylesheet" type="text/css" href="estilos2.css">
	<style>
		p {color:black; width:80%; margin-left:20px;}
	</style>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>

<!-- Inicio del contenido HTML                                   --> 
	<body>
		<?php
			$nombre_usuario = $_POST['correo'];
			$clave_usuario = $_POST['clave'];

			$cargo_administrador = 'administrador';
			$cargo_profesor = 'profesor';
			$cargo_alumno = 'alumno' ;

			$usuario_bd = 'www';
			$passwd_bd = '12345';
		try {
		//	print "Conectando";
    		$conn = new PDO('mysql:host=localhost;dbname=usuarios;charset=utf8', $usuario_bd, $passwd_bd);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    	die();
		}

			$stmt = $conn->prepare("SELECT * FROM biologia WHERE usuario = :usuario and password = :pass");
			$stmt->bindParam(':usuario',$nombre_usuario);
			$stmt->bindParam(':pass',$clave_usuario);
			$stmt->execute();

		if($row = $stmt->fetch()){

			if($row['cargo'] == $cargo_profesor) {
				echo "bienvenido ".$row['cargo']."," .$row['nombre'].".";
			} elseif($row['cargo'] == $cargo_alumno){
				echo "bienvenido ".$row['cargo']."," .$row['nombre'].".";
			} else {
				echo "bienvenido ".$row['cargo']."," .$row['nombre'].".";
			}

	
		}
		?>
	
	<?php

		$conn = null;

	?>


	</body>
</html>
