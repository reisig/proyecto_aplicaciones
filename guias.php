<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <title>Listado Guias</title>
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/guia.css" rel="stylesheet">
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!--<script src="js/jquery-1.12.0.min.js"></script>-->
        <script src="js/bootstrap.min.js"></script>
		
		<?php
		
			/*LUIS
			require_once(__DIR__. '/scripts/cargar.php');
			$tipo ="";
			
			if(isset($_SESSION['user'])){
				$usr = usuarioActual();
				$tipo = $usr->tipoUsuario;
				$rutProfesor = $usr->rut;
			}*/
	
			/*GONZALO*/
			
			/*Datos de conexion*/

			require('scripts/conexion.php');
			
			$idAsignatura  = $_GET['id'];
			$rutProfesor = $_GET['rut'];
			 
            //$idAsignatura = 1;
            //$rutProfesor = '15302958-k';
        
            //print "<h3>Rut: ".$rutProfesor."</h3>";
            //print "<h3>Asignatura: ".$idAsignatura."</h3>";
        
            /*Recuperar datos del profesor*/

            $stmt = $conn->prepare ("SELECT Nombre, ApellidoP FROM Usuario WHERE Rut=:rut");
            $stmt->bindParam(':rut',$rutProfesor);
            $stmt->execute();
            $row = $stmt->fetch();

            $profesor = $row['Nombre']." ".$row['ApellidoP'];


			function cargarGuias($rutProfesor,$idAsignatura,$idGuia,$titulo,$descripcion,$fecha,$usuario){
				
                print "<div class=\"row\" id = \"".$idGuia."\">";
				print		"<div class=\"col-md-9\">";
				print		  "<h3 id=\"titulo-guia\">".$titulo."</h3>";
				print		  "<p id=\"autor\">";
				print			"<strong>Autor:  </strong>".$usuario."</p>";
				print		  "<p id=\"fecha\">";
				print			"<strong>Fecha:  </strong>".$fecha."</p>";
				print		  "<p id=\"descripcion\">";
				print			"<strong>Descripción:  </strong>".$descripcion."</p>";
				print		"</div>";    
				print		"<div class=\"col-md-3\">";
				print			"<div class=\"row\">";
				print               "<div class=\"col-xs-5\">";
                print                   "<label>";
                print                       "<input type=\"checkbox\" id=\"habilitarGuia:".$idGuia."\"> Habilitar";
                print                   "</label>";
                print               "</div>";				
				print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"guia.php?rut=".$rutProfesor."&idA=".$idAsignatura."&idG=".$idGuia."&modo=VER\" id=\"verGuia:".$idGuia."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver guía\"><span class=\"glyphicon glyphicon-eye-open\"></span></a>";
				print    			"</div>";
                print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"guia.php?rut=".$rutProfesor."&idA=".$idAsignatura."&idG=".$idGuia."&modo=EDITAR\" id=\"editarGuia:".$idGuia."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar guía\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
                print    			"</div>";
				print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"guia.php?rut=".$rutProfesor."&idA=".$idAsignatura."&idG=".$idGuia."&modo=RESOLVER\" id=\"eliminarGuia:".$idGuia."\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Eliminar guía\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
				print    			"</div>";
				print			"</div>";
				print		"</div>";
				print "</div>";
				print "<hr>";
			}
        
            function menuAsignatura($idAsignatura, $nombreAsignatura){
                print "<li><a href=\"usuarios.php?id=".$idAsignatura."\">".$nombreAsignatura."</a></li>";
            }
        
		?>
   
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();   
            });

            $(document).ready(function(){
				
                $(":checkbox").click(function(){
					
                    var idAsignatura = <?php print $idAsignatura; ?>;
					
					var idGuiaCompleto = $(this).attr('id');
					var res = idGuiaCompleto.split(":"); 
					var idGuia = res[1];
					
                    var seleccion = document.getElementById(idGuiaCompleto).checked;
                    
                    alert("Asignatura: "+idAsignatura);
                    alert("Guia: "+idGuia);
                    alert("Seleccion: "+seleccion);
                    
					$.ajax({
						type: "POST",
						url: "scripts/cambiarEstado.php",
						data:  { idG : idGuia, idA : idAsignatura, selCheckbox : seleccion },
						cache: false,

						success: function(response){
							if(response == 1){
								alert("cambio el estado a ACTIVA");
							}else{
								alert("cambio el estado a INACTIVA");
							}
						}
					});
                });    
            });    
            
            function direccionarAGuia(rutProfesor,idAsignatura,idGuia,modo){
                
				/*console.log("Rut: "+rutProfesor);
				console.log("Asignatura: "+idAsignatura);
				console.log("Guia: "+idGuia);
				console.log("modo: "+modo);*/
				
                location.href="guia.php?rut="+rutProfesor+"&idA="+idAsignatura+"&idG="+idGuia+"&modo="+modo;
            }
            
            function crearGuia(){
                
                var modo = "CREAR";
                var estado = "INACTIVA";
                var idAsignatura = <?php print $idAsignatura; ?>;    
                var tituloGuia = document.getElementById("titulo-guia-nueva").value;
                var descripcion = document.getElementById("descripcion-guia-nueva").value; 
                var rutProfesor = <?php print '"'.$rutProfesor.'"'; ?>;           
                
                $.ajax({
                    type: "POST",
                    url: "scripts/crearGuia.php",
                    data: { idAsig : idAsignatura, titulo: tituloGuia, descripcionGuia : descripcion, estadoGuia : estado }, 
                    cache: false,

                    success: function(respuesta){
                        var idGuia = respuesta; 
                        //alert(idGuia);
                        direccionarAGuia(rutProfesor,idAsignatura,idGuia,modo);
                    }
                });
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
        ?>       
       
        <!-- nav -->
        <nav class="navbar navbar-default">
          <div class="container">
            <div class="row">
                <!-- LEFT SECTION -->
                <div class="navbar-header">
                    <div class="col-md-4">
                        <img src="imagenes/logo-ULS.png" id="logo-uls" class="center-block img-circle">
                    </div>
                    <div class="col-md-8">
                        <h6 class="navbar-brand">Departamento de Biología</h6>
                    </div>
                </div>
                <!-- RIGHT SECTION -->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="asignaturas.php">Asignaturas</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Guías Resueltas<span class="caret"></span></a>
                            <ul class="dropdown-menu" id = "listado-secundario">

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
                                <!-- Listar asignaturas -->
                                <!--<li class="divider"></li>-->
                                <li><a href="#">Cerrar Sesión</a></li>
                            </ul>     
                        </li>
                    </ul>
                </div>
            </div>
          </div>
        </nav>
        
        <!-- CONTENIDO DE LA GUIA --> 
        <div class="container" id="contenido-guia">
            <div id="numero-laboratorio">
                <h3 class="text text-center">GUÍAS DE LABORATORIO</h3>
                <h4 class="text text-center">Listado de guías creadas para utilizar en sesiones de laboratorio</h4>
            </div>
        </div>
        
        <!-- BOTON NUEVA GUIA -->
        <div class="container" id="nueva_guia"> 
            <div class="row">
                <div class="col-md-5 text-center"></div>
                <div class="col-md-7 ">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#miVentana">Nueva guía</button>
                </div>
            </div>
        </div>
        
        <!-- LISTADO DE GUIAS -->
        <div class="container" id ="listado-guias">
        
			<?php
			
				/*Recuperar datos del profesor*/
	
				$stmt = $conn->prepare ("SELECT Nombre, ApellidoP, ApellidoM FROM Usuario WHERE Rut=:rut");
				$stmt->bindParam(':rut',$rutProfesor);
				$stmt->execute();
				$row = $stmt->fetch();
				
				$nombre = $row['Nombre']." ".$row['ApellidoP']." ".$row['ApellidoM'];
				
				/*Obtener guias del profesor*/
				
				$stmt = $conn->prepare ("SELECT Id, Titulo, Descripcion, Fecha, Estado FROM Guia WHERE IdAsignatura = :id");
				$stmt->bindParam(':id',$idAsignatura);
				$stmt->execute();
				
				while($row = $stmt->fetch()){
					
					$id = $row['Id'];
					$titulo = $row['Titulo'];
					$descripcion = $row['Descripcion'];
					$estado = $row['Estado'];
					
					/*print "<br><br><br>";  
					print "GUIA <br><br>";
					print $id."<br>";
					print $titulo."<br>";
					print $descripcion."<br>";
					print $fecha."<br>";
					print $estado."<br>";*/
									
					/*Transformacion de fecha USA a fecha CL*/
					
					$fechaUsa = date_parse($row['Fecha']);
					
					if ($fechaUsa['day'] < 10){
						
						$fechaUsa['day'] = "0".$fechaUsa['day'];
					}
					
					if($fechaUsa['month'] < 10){
						
						$fechaUsa['month'] = "0".$fechaUsa['month'];
					}
					
					$fecha = $fechaUsa['day']."/".$fechaUsa['month']."/".$fechaUsa['year'];
					
					/*Cargar preguntas en la pagina*/
					
					cargarGuias($rutProfesor,$idAsignatura,$id,$titulo,$descripcion,$fecha,$nombre);
					
                    /*Activar guias habilitadas*/
					
					$salida = "habilitarGuia:".$id;
					
					if ($estado == 'ACTIVA'){
						print "<script> document.getElementById(\"".$salida."\").checked = true; </script>";
					}else{
						print "<script> document.getElementById(\"".$salida."\").checked = false; </script>";
					}
				}
			?>
		
        </div>
        
        <!-- VENTANA MODAL -->
        <div class="modal fade" id="miVentana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado de la ventana modal -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="text-center">Guardar guía como...</h4>
                    </div>

                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Titulo:</label>
                                <input type="text" class="form-control" id="titulo-guia-nueva" placeholder="Ingrese título de la guía" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion-guia-nueva" placeholder="Ingrese descripción de la guía" required></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer" style="text-align: center">
                        <!-- data-dismiss="modal": cierra la ventana modal -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="crearGuia()">Guardar guía</button>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- BARRA DE PAGINACION -->
        <div class="container">
          <div class="row text-center">
              <nav>
                <ul class="pagination pagination-sm">
                  <li class="disabled">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                  </li>
                  <li class="active">
                    <a href="#">1 
                        <span class="sr-only">(current)</span>
                    </a>
                  </li>...</ul>
              </nav>
          </div>
        </div>
        
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