<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <title>Guías Alumnos</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mis_css/guia.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    <?php
        require('conexion.php');
        include 'tipoPreguntas.php';
    ?>

    <script>

            function subir_preguntas(){

                var cantidad_preguntas = 28;
                var preguntas = [];

                for (i = 1; i <= cantidad_preguntas; i++) {

                    var seleccion = document.getElementById("activar:"+i).checked;

                    if (seleccion == true){

                        preguntas.push(i); //Guardo los id seleccionados	
                    }
                }

                if(preguntas.length == 0){

                    alert("Seleccione preguntas para crear la guia");

                }else{

                        alert("Subiendo guia");

                        var jsonString = JSON.stringify(preguntas);
                        $.ajax({
                            type: "POST",
                            url: "subirGuia.php",
                            data: {data : jsonString}, 
                            cache: false,

                            success: function(){
                                alert("Guia subida correctamente");
                            }


                        });
                }
            }

    </script>
    </head>
   
    <body>
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
                  <a href="#">Guías Laboratorio</a>
                </li>
                <li>
                  <a href="#">Galería</a>
                </li>
                <li>
                  <a href="guias_resueltas.html">Guías Resueltas</a>
                </li>
                <li class="sign-out">
                  <a href="#">Cerrar Sesión <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container" id="cabecera-guia">
            <?php

                //$id = $_GET['id'];
                $id = 1;

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

               /*$stmt = $conn->prepare ("SELECT count(*) as total FROM preguntas");
                $stmt->execute();
                $row = $stmt->fetch();
                print "<h3>Cantidad de preguntas: ".$row['total']."</h3>";*/

                /*Seleccionar todas las preguntas de Preguntas (guia maestra)*/

                $stmt = $conn->prepare ("SELECT * FROM Pregunta");
                $stmt->execute();

                /*Obtener y cargar preguntas*/

                while($row = $stmt->fetch()){

                    $id_pregunta = $row['Id'];
                    $enunciado =  $row['Enunciado'];
                    $tipo_respuesta = $row['TipoRespuesta'];

                    /*print "<br><br><br>";  
                    print "PREGUNTA  INICIO<br><br>";
                    print $id_pregunta."<br>";
                    print $enunciado."<br>";
                    print $tipo_respuesta."<br>";*/

                    /*Llamando a la funcion constructora dependiendo del tipo de respuesta*/

                    switch($tipo_respuesta){

                        case 'FOTO':	foto($id_pregunta); 				break;
                        case 'DIBUJO':	dibujo($id_pregunta); 				break;
                        case 'TITULO':	titulo($id_pregunta,$enunciado);	break;
                        case 'TEXTO':	texto($id_pregunta,$enunciado);		break;
                        case 'AREA':	area($id_pregunta,$enunciado);		break;

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

                                            lista($id_pregunta,$enunciado,$opciones);
                                        }

                                        if ($tipo_multiple == 'RADIO'){

                                            radio($id_pregunta,$enunciado,$opciones);
                                        }

                                        if ($tipo_multiple == 'CHECKBOX'){

                                            checkbox($id_pregunta,$enunciado,$opciones);
                                        }

                                        unset($opciones); //Eliminos las opciones guardadas ya usadas

                                        //print "Numero de opciones: ".count($opciones);
                        break;

                        default: print "No existe el tipo"; break;
                    }
                }	

                /*Activar preguntas seleccionadas*/

                $stmt = $conn->prepare ("SELECT IdPregunta FROM Contenido WHERE IdGuia =:id");
                $stmt->bindParam(':id',$id);
                $stmt->execute();

                while($row = $stmt->fetch()){

                    $salida = "activar:".$row['IdPregunta'];
                    print "<script> document.getElementById(\"".$salida."\").checked = true; </script>";
                }	
            ?>

            <div class="form-group">
                <div class="row text-center">
                    <button type="button" class="btn btn-info" id="subir-guia">Subir guía</button>
                </div>
            </div>
          </div>
          <!-- END FORM -->

        </div>
        <!-- END CONTAINER -->

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