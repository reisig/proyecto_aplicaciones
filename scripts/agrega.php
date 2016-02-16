<!-- Este es un comentario en HTML                                -->
<!-- Declaración de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del código HTML                                       --> 
<html>

<!-- Inicio del encabezado HTML                                   --> 
<head>
	<title> Tipos de Páginas </title>
<link rel="stylesheet" type="text/css" href="estilos.css">
<style>
p {color:black; width:80%; margin-left:20px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<!-- Inicio del contenido HTML                                   --> 
<body>
<?php

$nombre = $_POST['nombre'];
$apellidoP = $_POST['apellidoP'];
$apellidoM = $_POST['apellidoM'];
$rut = $_POST['rut'];
$correo = $_POST['correo'];
$password = $_POST['clave'];
$tipo = $_POST['tipo']; 


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

$stmt = $conn->prepare("INSERT INTO biologia VALUES (:rut, :nombre, :apellidoP, :apellidoM, :clave, :correo, :tipo) ");
$stmt->bindParam(':nombre',$nombre);
$stmt->bindParam(':apellidoP',$apellidoP);
$stmt->bindParam(':apellidoM',$apellidoM);
$stmt->bindParam(':rut',$rut);
$stmt->bindParam(':correo',$correo);
$stmt->bindParam(':tipo',$tipo);
$stmt->bindParam(':clave',$password);
 if ($stmt->execute() ){
    
    	print "fue creado correctamente";
    

 }

?>


</body>
</html>
