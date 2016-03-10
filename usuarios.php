<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Guías Resueltas</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mis_css/guia.css" rel="stylesheet">

		<?php
			require('conexion.php');
			
			//$id_asignaruta = $_GET['id'];
			$id_asignatura = 1;
			
			function cargar_alumno($rut,$nombre){
	
				print "<div class=\"row\" id = \"".$rut."\">";
				print       "<div class=\"col-md-9\">";
				print           "<h4 id=\"alumno\"> ".$nombre."</h4>";
				print       "</div>";
				print       "<div class=\"col-md-3\">";
				print           "<div class=\"col-xs-5\">";
				print               "<a href=\"#\"><span class=\"glyphicon glyphicon-eye-open\"></span></a>";
				print           "</div>";
				print       "</div>";
				print  "</div>";
				print  "<hr>";
			}
		?>
		
    </head>

    <body>

       <!-- nav -->
        <nav class="navbar navbar-default">
            <div class="container">
               <!-- LEFT SECTION -->
                <div class="navbar-header">
                    <div class="col-lg-4">
                        <img src="imagenes/logo-ULS.png" id="logo-uls" class="center-block img-circle">
                    </div>
                    <div class="col-md-8">
                        <h6 class="navbar-brand">Departamento de Biología</h6>
                    </div>
                </div>
                
                <!-- RIGHT SECTION -->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="listadoGuias.html">Guías Laboratorio</a></li>
                        <li><a href="#">Galería</a></li>
                        <li class="active"><a href="#">Guías Resueltas</a></li>
                        <li class="sign-out">
                            <a href="#">Cerrar Sesión <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                 </div>
            </div>
        </nav>

       <!-- CONTENIDO DE LA GUIA -->
        <div class="container" id="contenido-guia">
            <div id="numero-laboratorio">
                <h3 class="text text-center">Guías Resueltas</h3>
            </div>
        </div>

       <!-- LISTADO DE ALUMNOS -->
        <div class="container">
           <?php
		   
				/*Seleccionar personas que pertenezcan a la asignatura*/
				
				$stmt = $conn->prepare ("SELECT RutUsuario FROM UsuarioAsignatura WHERE IdAsignatura = :id");
				$stmt->bindParam(':id',$id_asignatura);
				$stmt->execute();
				
				while ($row = $stmt->fetch()){
					
						$stmt2 = $conn->prepare ("SELECT Rut, Nombre, ApellidoP, ApellidoM FROM Usuario WHERE TipoUsuario = 'ALUMNO' AND Rut =:rut");
						$stmt2->bindParam(':rut',$row['RutUsuario']);
						$stmt2->execute();
						
						while($row = $stmt2->fetch()){
							
							$rut = $row['Rut'];
							$nombre = $row['Nombre']." ".$row['ApellidoP']." ".$row['ApellidoM'];
							
							/*print "<br><br><br>";  
							print "Alumno<br><br>";
							print $rut."<br>";
							print $alumno."<br>";*/
							
							/*Cargando alumno*/
							
							cargar_alumno($rut,$nombre);
						}
				}

		   ?>
       </div>
       
       <!-- BARRA DE PAGINACION -->
       <div class="container">
           <div class="row">
               <div class="col-md-8 text-center">
                   <nav>
                      <ul class="pagination pagination-sm">
                        <li class="disabled">
                            <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">1 
                            <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        ...
                      </ul>
                   </nav> <!-- end NAV -->
               </div>
           </div>
       </div>
        
        <!-- PIE DE PAGINA -->
        <footer>
            <div class="jumbotron">
                <center>
                    <h4 id="pie-pagina">Copyright © 2016 Departamento de Biología - Facultad de Ciencias - Universidad de La Serena</h4>
                    <h5>Desarrollado por la carrera de Ingeniería en Computación</h5>
                </center>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>