<?php

	/*Datos de conexion*/
    require_once('conexion.php');
	
	/*datos necesarios*/
	
	$idAsignatura = $_POST['idAsignatura'];
	
	function subirSimple($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		
		//echo "<br> Entrando a subirSimple con el tipo: ".$tipo."<br>";
		//echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			$respuesta = $arreglo['respuesta'];
			//print "<br> ID PREGUNTA: ".$idPregunta." RESPUESTA: ".$respuesta."<br>";	
		}
		
		//echo "<br><hr>";
	}
	
	function subirCheckbox($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		
		//echo "<br> Entrando a subirSimple con el tipo: ".$tipo."<br>";
		//echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			for($i=0;$i<count($arreglo);$i++){
					
					//print "<br>CHECKBOX VALOR: ".$arreglo[$i]."<br>";
			} 	
		}
		
		echo "<br><hr>";
	}
	
	function subirFoto($idAsignatura,$idPregunta,$tipo){
		
		/*crear el nombre del arreglo*/
		
		$nombreArreglo = $tipo."-".$idPregunta;
		$arreglo = $_POST[$nombreArreglo];
		
		echo "<br> Entrando a subirSimple con el tipo: ".$tipo."<br>";
		echo "<br> El nombre del arreglo es: ".$nombreArreglo."<br>";
		
		/*comprobamos si existe*/
		
		if(isset($arreglo)){
			
			$respuesta = $arreglo['respuesta'];
			print "<br> ID PREGUNTA: ".$idPregunta." RESPUESTA: ".$respuesta."<br>";	
		}
		
		echo "<br><hr>";
	}
	
	function subirDibujo($idAsignatura,$idPregunta,$tipo){
		
		
	}
	
	function subirBDSimple(){
		
		
	}

	/*Comprobamos si existe la información sobre las preguntas*/
	
	if(isset($_POST['PREGUNTAS'])){
				
		/*Obtenemos la información de cada pregunta, clave:id y valor:tipo*/	
		
		foreach ($_POST['PREGUNTAS'] as $clave => $valor){
			
			//echo "<br> clave: ".$clave." valor: ".$valor."<br>";
			
			switch($valor){

				case 'TITULO':	  /*NO HACER NADA: NO HAY VALOR*/		   break;
				case 'FOTO':											   break;
				case 'DIBUJO':											   break;
				case 'CHECKBOX': subirCheckbox($idAsignatura,$clave,$valor); break;
				
				case 'TEXTO': case 'AREA': case 'RADIO': case 'LISTA':			
						subirSimple($idAsignatura,$clave,$valor);
				break;

				default: print "NO EXISTE EL TIPO"; break;
			}
		}
	}
?>