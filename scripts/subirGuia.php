<?php 
			
	/*Datos de conexion*/
	require('conexion.php');
	
	/*Recuperar preguntas seleecionadas del arreglo y la decodifico*/

	$guia = $_POST['idGuia'];
	$modo = $_POST['modoGuia'];
	$data = json_decode(stripslashes($_POST['datos'])); 

	if ($modo == 'EDITAR'){
		
		/*Eliminar contenido de la guia en tabla contenido*/
		
		$stmt = $conn->prepare ("DELETE FROM Contenido WHERE IdGuia = :id"); 
		$stmt->bindParam(':id',$guia);
		$stmt->execute();
	}
	
	/*Recorrer el id's de las preguntas activadas*/
	
	for ($i=0; $i < count($data); $i++){
		
		/*Obtener el tipo de la pregunta*/
		$stmt = $conn->prepare ("SELECT TipoRespuesta FROM Pregunta WHERE Id = :id");
		$stmt->bindParam(':id',$data[$i]);
		$stmt->execute();
		$row = $stmt->fetch();
		
		/*Insertar la pregunta en contenido*/
		$stmt = $conn->prepare("INSERT INTO Contenido VALUES (:id_guia,:id_pregunta,:tipo)");
		$stmt->bindParam(':id_guia',$guia);
		$stmt->bindParam(':id_pregunta',$data[$i]);
		$stmt->bindParam(':tipo',$row['TipoRespuesta']);
		$stmt->execute();
	}
	
?>

