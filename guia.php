<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <title>Guía Alumno</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/guia.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <?php
            require('scripts/conexion.php');
            include 'scripts/tipoPreguntas.php';

            $rutProfesor = $_GET['rut'];
            $idAsignatura  = $_GET['idA'];
            $idGuia = $_GET['idG'];
            $modo = $_GET['modo'];

            
            //$rutProfesor = '15302958-k';
            //$idAsignatura  = 1;
            //$idGuia = 1;
            //$modo = 'CREAR';

            /*print "<h3>Rut_Profesor: ".$rutProfesor."</h3>";
            print "<h3>ID_Asignatura: ".$idAsignatura."</h3>";
            print "<h3>ID_Guia: ".$idGuia."</h3>";
            print "<h3>MODO: ".$modo."</h3>";*/
			
			function menuAsignatura($idAsignatura, $asignatura){
				print "<li><a href=\"usuarios.php?id=".$idAsignatura."\">".$asignatura."</a></li>";
			}
        ?>

        <script>

			function subir_preguntas(modo){
				
				//console.log("Modo: "+modo);
				
				var cantidad_preguntas = 28;
				var preguntas = [];
				
				if (modo == 'CREAR' || modo 'EDITAR'){
						
					for (i = 1; i <= cantidad_preguntas; i++) {
						
						var seleccion = document.getElementById("activar:"+i).checked;
						
						if (seleccion == true){
						
							preguntas.push(i); //Guardo los id seleccionados	
						}
					}
					
					//TODO : Enviar modo por ajax junto a los ids
					
					if(preguntas.length == 0){
						
						alert("Seleccione preguntas para crear la guia");
						
					}else{
						
							alert("Subiendo guia");
							
							var jsonString = JSON.stringify(preguntas);
							$.ajax({
								type: "POST",
								url: "scripts/subirGuia.php,
								data: {data : jsonString}, 
								cache: false,

								success: function(){
									alert("Guia subida correctamente");
								}
								
								
							});
					}
				}
            }
            
        </script>
		
    </head>
   
    <body>
        <?php

            /*Recuperar listado de asignaturas*/
            $stmt = $conn->prepare("SELECT Id, NombreAsignatura FROM Asignatura WHERE RutProfesorACargo=:rut");
            $stmt->bindParam(':rut', $rutProfesor);
            $stmt->execute();

            $idAsignaturas = array();
            $asignaturas = array();

            while($row = $stmt->fetch()){
                array_push($idAsignaturas, $row['Id']);
                array_push($asignaturas, $row['NombreAsignatura']);
            } 

            /*Recuperar datos del profesor*/
            $stmt = $conn->prepare ("SELECT Nombre, ApellidoP FROM Usuario WHERE Rut=:rut");
            $stmt->bindParam(':rut',$rutProfesor);
            $stmt->execute();
            $row = $stmt->fetch();

            $profesor = $row['Nombre']." ".$row['ApellidoP'];
        ?>
       
        <!-- nav -->
        <nav class="navbar navbar-default">
          <div class="container">
            <!-- LEFT SECTION -->
            <div class="navbar-header">
              <div class="navbar-left">
                  <div class="col-lg-4">
                      <img src="imagenes/logo-ULS.png" id="logo-uls">
                  </div>		 	            
                  <div class="col-md-8">
                      <h2 class="navbar-brand">Departamento de Biología</h2>
                  </div>		

              </div>
            </div>
            <!-- RIGHT SECTION -->
            <div class="navbar-right">
              <ul class="nav navbar-nav">
                  <li class="active">
                      <a>Asignaturas</a>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Guías Resueltas<span class="caret"></span></a>
                      <ul class="dropdown-menu" id="listado-secundario">

                          <!-- Listar asignaturas -->

                          <?php 
                                for($i=0; $i<count($asignaturas);$i++){
                                    menuAsignatura($idAsignaturas[$i], $asignaturas[$i]);
                                }
                           ?>

                      </ul>     
                  </li>
                  <li>
                      <a href="#">Galería</a>
                  </li>
                  <li class="dropdown sign-out">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><?php print $profesor;?><span class=" caret"></span></a>
                      <ul class="dropdown-menu">
                          <!--<li class="divider"></li>-->
                          <li><a href="#">Cerrar Sesión</a></li>
                      </ul>     
                  </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container" id="cabecera-guia">
            <?php

                /*Cagar titulo guia*/	

                $stmt = $conn->prepare ("SELECT Titulo, Descripcion FROM Guia WHERE Id =:id");
                $stmt->bindParam(':id',$id);
                $stmt->execute();
                $row = $stmt->fetch();

                descripcion($row['Titulo'],$row['Descripcion']);
            ?>	
        </div>
        <div class="container" id="tipo_preguntas">
          <div class="form" role="form">

            <?php

                /*Arreglos para guardar las variables*/

                $ids = array();
                $enunciados = array();
                $tipos = array();

                if ($modo == 'CREAR' || $modo == 'EDITAR'){

                    /*Seleccionar todas las preguntas de Pregunta*/

                    $stmt = $conn->prepare ("SELECT * FROM Pregunta");
                    $stmt->execute();

                    while($row = $stmt->fetch()){

                        $id_pregunta = $row['Id'];
                        $enunciado =  $row['Enunciado'];
                        $tipo_respuesta = $row['TipoRespuesta'];

                        array_push($ids,$id_pregunta);
                        array_push($enunciados,$enunciado);
                        array_push($tipos,$tipo_respuesta);
                    }

                }else{ /*modo VER o RESOLVER*/

                    /*Seleccionar las preguntas seleccionadas desde Contenido*/

                    $stmt = $conn->prepare ("SELECT IdPregunta FROM Contenido WHERE IdGuia = :id");
                    $stmt->bindParam(':id',$idGuia);
                    $stmt->execute();

                    while($row = $stmt->fetch()){

                        $id_pregunta = $row['IdPregunta'];

                        $stmt2 = $conn->prepare ("SELECT Enunciado, TipoRespuesta FROM Pregunta WHERE Id = :id");
                        $stmt2->bindParam(':id',$id_pregunta);
                        $stmt2->execute();

                        $row = $stmt2->fetch();

                        $enunciado =  $row['Enunciado'];
                        $tipo_respuesta = $row['TipoRespuesta'];

                        array_push($ids,$id_pregunta);
                        array_push($enunciados,$enunciado);
                        array_push($tipos,$tipo_respuesta);
                    }
                }

                /*Obtener y cargar preguntas*/

                for ($i = 0; $i < count ($ids); $i++){

                    $id_pregunta = $ids[$i];
                    $enunciado =  $enunciados[$i];
                    $tipo_respuesta = $tipos[$i];

                    /*print "<br><br><br>";  
                    print "PREGUNTA  INICIO<br><br>";
                    print $id_pregunta."<br>";
                    print $enunciado."<br>";
                    print $tipo_respuesta."<br>";*/

                    /*Llamando a la funcion constructora dependiendo del tipo de respuesta*/

                    switch($tipo_respuesta){

                        case 'FOTO':	foto($id_pregunta,$modo); 					break;
                        case 'DIBUJO':	dibujo($id_pregunta,$modo); 				break;
                        case 'TITULO':	titulo($id_pregunta,$enunciado,$modo);		break;
                        case 'TEXTO':	texto($id_pregunta,$enunciado,$modo);		break;
                        case 'AREA':	area($id_pregunta,$enunciado,$modo);		break;

                        case 'MULTIPLE':	

                            /*Seleccionamos las alternativas de la seleccion multiple*/

                            $statement = $conn->prepare ("SELECT IdPregunta, ValorAlternativa, Tipo FROM SeleccionMultiple WHERE IdPregunta =:id");
                            $statement->bindParam(':id',$id_pregunta);
                            $statement->execute();

                            /*Arreglo para guardar las opciones*/

                            $opciones = array();

                            while($row = $statement->fetch()){

                              /*print $row['IdPregunta']."<br>";													
                                print $row['ValorAlternativa']."<br>";		
                                print $row['Tipo']."<br>";	*/

                                $tipo_multiple = $row['Tipo'];
                                array_push($opciones,$row['ValorAlternativa']);
                            }		

                            //print "Numero de opciones: ".count($opciones);

                            /*Cargar las distintos tipos multiples*/

                            if ($tipo_multiple == 'LISTA'){

                                lista($id_pregunta,$enunciado,$opciones,$modo);
                            }

                            if ($tipo_multiple == 'RADIO'){

                                radio($id_pregunta,$enunciado,$opciones,$modo);
                            }

                            if ($tipo_multiple == 'CHECKBOX'){

                                checkbox($id_pregunta,$enunciado,$opciones,$modo);
                            }

                            unset($opciones); //Eliminos las opciones guardadas ya usadas

                            //print "Numero de opciones: ".count($opciones);
                        break;
                            
                        default: print "No existe el tipo"; break;
                    }
                }	

                if ($modo == 'CREAR' || $modo == 'EDITAR'){

                    /*Activar preguntas seleccionadas*/

                    $stmt = $conn->prepare ("SELECT IdPregunta FROM Contenido WHERE IdGuia =:id");
                    $stmt->bindParam(':id',$idGuia);
                    $stmt->execute();

                    while($row = $stmt->fetch()){

                        //print "<h3>ID PREGUNTA: ".$row['IdPregunta']."</h3>";
                        $salida = "activar:".$row['IdPregunta'];
                        print "<script> document.getElementById(\"".$salida."\").checked = true; </script>";
                    }	
                }

            ?>

            <div class="form-group">
                <div class="row text-center">
                    <button type="button" class="btn btn-info" id="subir-guia" onclick ="subir_preguntas('<?php print $modo;?>')">Subir guía</button>
                </div>
            </div>
            </div><!-- END FORM -->
        </div><!-- END CONTAINER -->
        
        <!-- PIE DE PAGINA -->
        <footer>
          <div class="jumbotron">
            <center>
              <h4 id="pie-pagina">Copyright © 2016 Departamento de Biología - Facultad de Ciencias - Universidad
                de La Serena</h4>
              <h5>Desarrollado por la carrera de Ingeniería en Computación</h5>
            </center>
          </div>
        </footer>  
    </body>
</html>