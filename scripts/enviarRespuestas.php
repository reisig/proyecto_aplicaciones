<?php

	/*Datos de conexion*/
    require_once('conexion.php');
	
	/*datos necesarios*/
	
	$idAsignatura = $_POST['asigantura'];
	$idGuia = $_POST['guia'];
	$rut = $_POST['rut'];
	
	if($idAsignatura){
		
		echo "<br>SI ESTA EL ID ASIGNATURA: ".$idAsignatura."<br>";
	}
	
	if($idGuia){
		
		echo "<br>SI ESTA EL ID GUIA: ".$idGuia."<br>";
	}
	
	if($rut){
		
		echo "<br>SI ESTA EL RUT: ".$rut."<br>";
	}
	
	function subirSimple($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$arreglo = $_POST[$tipo];
		
		//echo "<br> Entrando a subirSimple con el tipo: ".$tipo."<br>";

		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			$respuesta = $arreglo[$idPregunta];
			//print "<br> ID PREGUNTA: ".$idPregunta." RESPUESTA: ".$respuesta."<br>";	
		}
		
		//echo "<br><hr>";
	}
	
	function subirCheckbox($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		
		//echo "<br> Entrando a subirCheckbox con el tipo: ".$tipo."<br>";
		//echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			//print "<br> ID PREGUNTA: ".$idPregunta."<br>";
			
			for($i=0;$i<count($arreglo);$i++){
					
					//print "<br>CHECKBOX VALOR: ".$arreglo[$i]."<br>";
			} 	
		}
		
		//echo "<br><hr>";
	}
	
	function subirFoto($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		$foto = $_FILES[$nombreArreglo]['name'];
		
		//echo "<br> Entrando a subirFoto con el tipo: ".$tipo."<br>";
		//echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			print "<br> ID PREGUNTA: ".$idPregunta."<br>";
			print "FOTO: ".$foto."<br>";
			print "PREPARACION: ".$arreglo['preparacion']."<br>";	
			print "TINTE: ".$arreglo['tinte']."<br>";
			print "DIAMETRO: ".$arreglo['diamentro']."<br>";
			print "AUMENTO: ".$arreglo['aumento']."<br>";
			print "AUTOR: ".$arreglo['autor']."<br>";
			print "DESCRIPCION: ".$arreglo['descripcion']."<br>";
		}
		
		echo "<br><hr>";
	}
	
	function subirDibujo($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_FILES[$nombreArreglo];
		
		//echo "<br> Entrando a subirDibujo con el tipo: ".$tipo."<br>";
		//echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			$respuesta = $arreglo['name'];
			//print "<br> ID PREGUNTA: ".$idPregunta." DIBUJO: ".$respuesta."<br>";	
		}
		
		//echo "<br><hr>";
		
	}
	
	function subirBDSimple(){
		 
		$stmt = $conn->prepare("INSERT into Respuesta VALUES (:idP,:idG,:resp,:fecha,:rut)");
		$stmt->bindParam(":idP", $idGuia);
		$stmt->bindParam(":idG", $idGuia);
		$stmt->bindParam(":resp", $idGuia);
		$stmt->bindParam(":fecha", $idGuia);
		$stmt->bindParam(":rut", $idGuia);
		$stmt->execute();
		
	}
	
	function subirBDFoto(){
		//obtener la fecha con php
	}
	
	function subirBDDibujo(){
		
		
	}

	/*Comprobamos si existe la información sobre las preguntas*/
	
	if(isset($_POST['PREGUNTAS'])){
				
		/*Obtenemos la información de cada pregunta, clave:id y valor:tipo*/	
		
		foreach ($_POST['PREGUNTAS'] as $clave => $valor){
			
			//echo "<br> clave: ".$clave." valor: ".$valor."<br>";
			
			switch($valor){

				case 'TITULO':	  /*NO HACER NADA: NO HAY VALOR*/		   	 break;
				case 'FOTO':	subirFoto($idAsignatura,$clave,$valor);  	 break;
				case 'DIBUJO':	 subirDibujo($idAsignatura,$clave,$valor);	 break;
				case 'CHECKBOX': subirCheckbox($idAsignatura,$clave,$valor); break;
				
				case 'TEXTO': case 'AREA': case 'RADIO': case 'LISTA':			
						subirSimple($idAsignatura,$clave,$valor);
				break;

				default: print "NO EXISTE EL TIPO"; break;
			}
		}
	}
?>