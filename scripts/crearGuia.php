<?php

	/*Datos de conexion*/
    require_once('conexion.php');

	/*Recuperamos datos para crear la guia*/
	
    $idAsignatura = $_POST['idAsig'];
    $tituloGuia = $_POST['titulo'];
    $descripcionGuia = $_POST['descripcionGuia'];
    $estado = $_POST['estadoGuia'];
    $fecha = date('Y-m-d'); // Recuperamos la fecha actual (YYYY-MM-DD)

    /*Recuperar ultimo id insertado en guias*/			

    $stmt = $conn->prepare("SELECT max(Id) as Id FROM Guia");
    $stmt->execute();
    $row = $stmt->fetch();

    $idGuia = $row['Id'] + 1;  //Creamos nuevo id para la siguiente guia 

    /*Crear la nueva guia*/
	
    $stmt = $conn->prepare("INSERT INTO Guia values (:idGuia,:titulo,:descripcion,:fecha,:idAsignatura,:estado)");
    $stmt->bindParam(':idGuia',$idGuia);
    $stmt->bindParam(':titulo', $tituloGuia);
    $stmt->bindParam(':descripcion', $descripcionGuia);
    $stmt->bindParam(':fecha', $fecha);   
    $stmt->bindParam(':idAsignatura', $idAsignatura);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();   
    
    echo $idGuia; //Enviamos como respuesta el id de la guia con Ajax
?>