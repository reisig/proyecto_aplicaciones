<?php 
			
	/*Datos de conexion*/
	require_once('conexion.php');
	
	/*Recuperar preguntas seleecionadas del arreglo y la decodifico*/
	$data = json_decode(stripslashes($_POST['data'])); 
	
	/*Recuperar ultimo id insertado en guias*/			
	$stmt = $conn->prepare ("SELECT Id FROM Guia ORDER BY Id DESC LIMIT 1"); 
	$stmt->execute();
	$row = $stmt->fetch();
	
	$id = $row['Id'] + 1;  //Creamos el id para la siguiente guia
	
	/*Crear la nueva guia*/
	$stmt = $conn->prepare ("INSERT INTO Guia values (:id,'Guia de prueba','Guia para probar la subida al servidor','03-03-2016',1,'ACTIVA')");
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	
	for ($i=0; $i < count($data); $i++){
		
		/*Obtener el tipo de la pregunta*/
		$stmt = $conn->prepare ("SELECT TipoRespuesta FROM Pregunta WHERE Id = :id");
		$stmt->bindParam(':id',$data[$i]);
		$stmt->execute();
		$row = $stmt->fetch();
		
		/*Insertar la pregunta en contenido*/
		$stmt = $conn->prepare("INSERT INTO Contenido VALUES (:id_guia,:id_pregunta,:tipo)");
		$stmt->bindParam(':id_guia',$id);
		$stmt->bindParam(':id_pregunta',$data[$i]);
		$stmt->bindParam(':tipo',$row['TipoRespuesta']);
		$stmt->execute();
	}
?>

