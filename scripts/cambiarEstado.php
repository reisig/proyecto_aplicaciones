<?php 

    /*Datos de conexion*/
    require_once('conexion.php');

    $idAsignatura = $_POST['idA'];
    $idGuia = $_POST['idG'];
    $seleccion = $_POST['selCheckbox'];
    
    /* Actualizamos el estado de la guia */

    if($seleccion == true){
        $stmt = $conn->prepare("UPDATE Guia SET Estado='ACTIVA' WHERE Id= :idG AND IdAsignatura= :idA");
        echo 1;
    }else{
        $stmt = $conn->prepare("UPDATE Guia SET Estado='INACTIVA' WHERE Id= :idG AND IdAsignatura= :idA"); 
        echo 0;
    }
        
    $stmt->bindParam(":idG", $idGuia);
    $stmt->bindParam(":idA", $idAsignatura);
    $stmt->execute();
?>