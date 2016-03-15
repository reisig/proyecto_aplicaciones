<?php

	/*Datos de conexion*/

	require('conexion.php');
	
	/*datos necesarios*/
	
	$idAsignatura = $_POST['asignatura'];
	$idGuia = $_POST['guia'];
	$rut = $_POST['rut'];
	$fecha = date('Y-m-d');
	
	/*print "<br>ID ASIGNATURA: ".$idAsignatura."<br>";
	print "<br>ID GUIA: ".$idGuia."<br>";
	print "<br>RUT: ".$rut."<br>";
	print "<br>FECHA: ".$fecha."<br>";*/

	function subirSimple($conexion,$idAsignatura,$idGuia,$idPregunta,$fecha,$rut,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$arreglo = $_POST[$tipo];
		
		//print "<br> Entrando a subirSimple con el tipo: ".$tipo."<br>";

		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			$respuesta = $arreglo[$idPregunta];
			
			print "<br> ID PREGUNTA: ".$idPregunta." RESPUESTA: ".$respuesta."<br>";	
			subirBDSimple($idPregunta,$idGuia,$respuesta,$fecha,$rut);
		}
		
		//print "<br><hr>";
	}
	
	function subirCheckbox($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		
		//print "<br> Entrando a subirCheckbox con el tipo: ".$tipo."<br>";
		//print "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			//print "<br> ID PREGUNTA: ".$idPregunta."<br>";
			
			for($i=0;$i<count($arreglo);$i++){
					
					//print "<br>CHECKBOX VALOR: ".$arreglo[$i]."<br>";
			} 	
		}
		
		//print "<br><hr>";
	}
	
	function subirFoto($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		$foto = $_FILES[$nombreArreglo]['name'];
		
		//print "<br> Entrando a subirFoto con el tipo: ".$tipo."<br>";
		//print "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			/*print "<br> ID PREGUNTA: ".$idPregunta."<br>";
			print "FOTO: ".$foto."<br>";
			print "PREPARACION: ".$arreglo['preparacion']."<br>";	
			print "TINTE: ".$arreglo['tinte']."<br>";
			print "DIAMETRO: ".$arreglo['diamentro']."<br>";
			print "AUMENTO: ".$arreglo['aumento']."<br>";
			print "AUTOR: ".$arreglo['autor']."<br>";
			print "DESCRIPCION: ".$arreglo['descripcion']."<br>";*/
		}
		
		//print "<br><hr>";
	}
	
	function subirDibujo($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$dibujo = $_FILES[$nombreArreglo]['name'];
		
		//print "<br> Entrando a subirDibujo con el tipo: ".$tipo."<br>";
		//print "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($dibujo)){
			
			//print "<br> ID PREGUNTA: ".$idPregunta."<br>";
			//print "DIBUJO: ".$dibujo."<br>";
		}
		
		//print "<br><hr>";
	}
	
	function subirBDSimple($conexion,$idPregunta,$idGuia,$respuesta,$fecha,$rut){
		 
		$stmt = $conn->prepare("INSERT INTO Respuesta VALUES (:idP,:idG,:resp,:fecha,:rut)");
		$stmt->bindParam(":idP", $idPregunta);
		$stmt->bindParam(":idG", $idGuia);
		$stmt->bindParam(":resp", $respuesta);
		$stmt->bindParam(":fecha", $fecha);
		$stmt->bindParam(":rut", $rut);
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
			
			//print "<br> clave: ".$clave." valor: ".$valor."<br>";
			
			switch($valor){

				case 'TITULO':	  /*NO HACER NADA: NO HAY VALOR*/		   	 break;
				case 'FOTO':	subirFoto($idAsignatura,$clave,$valor);  	 break;
				case 'DIBUJO':	 subirDibujo($idAsignatura,$clave,$valor);	 break;
				case 'CHECKBOX': subirCheckbox($idAsignatura,$clave,$valor); break; //TODO MAS PARAMETROS
				
				case 'TEXTO': case 'AREA': case 'RADIO': case 'LISTA':			
						subirSimple($conn,$idAsignatura,$idGuia,$clave,$fecha,$rut,$valor);
				break;

				default: print "NO EXISTE EL TIPO"; break;
			}
		}
		
		/*Direccionar al listado de guia*/
	}
?>