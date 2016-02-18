<?php
	
	include 'clase_guia.php';
	
	function cargarGuia($guia,$usuario){
		
		print    "<div id=\"contenedor-guia\">";
		print		"<table id=\"orden\">";
		print			"<tr>";
		print				"<td>";
		print					"<h3 id=\"titulo-guia\">".$guia->getTitulo()."</h3>";
		print					"<p id=\"autor\">Autor: ".$usuario."</p>";
		print					"<p id=\"fecha\">Fecha: ".$guia->getFecha()."</p>";
		print					"<p id=\"descripcion\"> ".$guia->getDescripcion()."</p>";
		print				"</td>";
		print				"<td>";
		print					"<br><input type=\"checkbox\" id=\"activar\"> Habilitar<br>";
		print				"</td>";
		print				"<td>";
		print					"<br><input type=\"button\" id=\"eliminar\" value=\"Eliminar\"><br>";
		print				"</td>";
		print			"</tr>";
		print		"</table>";              
        print   "</div>";
	}
	
	$rut= $_GET['rut'];
	//$rut = '15302958-k';
	
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
	
	/*Recuperar datos del profesor*/
	
	$stmt = $conn->prepare ("SELECT nombre, apellidop, apellidom FROM usuarios WHERE rut=:rut");
	$stmt->bindParam(':rut',$rut);
	$stmt->execute();
	$row = $stmt->fetch();
	
	$profesor = $row['nombre']." ".$row['apellidop']." ".$row['apellidom'];
	
	/*Seleccionar asignaturas profesor*/
	
	$stmt = $conn->prepare ("SELECT id_asignatura FROM usuario_asignatura WHERE rut_usuario =:rut");
	$stmt->bindParam(':rut',$rut);
	$stmt->execute();

	/*Guardar asignaturaas*/
	$id_asignaturas = array();
	
	while($row = $stmt->fetch()){
		
		array_push($id_asignaturas,$row['id_asignatura']);
	}	
	
	/*print "ID_GUIAS <br>";
	print_r($id_asignaturas);*/
	
	/*Obtener guias de la asignatura */
	
	$guias = array();
			
	for($i = 0; $i < count($id_asignaturas);$i++){
		
		$stmt = $conn->prepare("SELECT id, titulo, descripcion, fecha, id_asignatura, estado FROM guias WHERE id_asignatura =:id_asignatura");
		$stmt->bindParam(':id_asignatura',$id_asignaturas[$i]);
		$stmt->execute();
		
		while($row = $stmt->fetch()){
			$guia = new Guia($row['id'],$row['titulo'],$row['descripcion'],$row['fecha'],$row['id_asignatura'],$row['estado']);
			array_push($guias,$guia);
			
			/*print "<br><br><br>";  
			print "GUIA <br><br>";
			print $guia->getId()."<br>";
			print $guia->getTitulo()."<br>";
			print $guia->getDescripcion()."<br>";
			print $guia->getFecha()."<br>";
			print $guia->getId_asignatura()."<br>";
			print $guia->getEstado()."<br>";*/
		}
	}
		
	/*print "GUIAS <br>";
	print_r(count($guias));*/
		
	/*Cargar preguntas en la pagina*/
	
	for($i = 0; $i < count($guias); $i++){
		cargarGuia($guias[$i],$profesor);
	}
?>

 