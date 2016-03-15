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
        <link href="css/guia.css" rel="stylesheet">

		<?php
			/*LUIS
			require_once(__DIR__. '/scripts/cargar.php');	
			
			$tipo = "";
			
			if(isset($_SESSION['user'])){
				$usr = usuarioActual();
				$tipo = $usr->tipoUsuario;
				$rutProfesor = $usr->rut;
			}
			*/
			
			/*GONZALO*/
			
		    /*Datos de conexion*/

			require('scripts/conexion.php');
			$rutProfesor = $_GET['rut'];
			$idAsignatura = $_GET['id'];
			
			
            //$rutProfesor = '15302958-k';
			//$idAsignatura = 1;
        
            //print "<h3>Rut_Profesor: ".$rutProfesor."</h3>";
            //print "<h3>ID_Asignatura: ".$idAsignatura."</h3>";
        
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
        
            function menuAsignatura($idAsignatura, $asignatura){
                print "<li><a href=\"usuarios.php?id=".$idAsignatura."\">".$asignatura."</a></li>";

            }
		?>
		
    </head>

    <body>

        <?php
            
            /*Recuperar listado de asignaturas*/
            $stmt = $conn->prepare("SELECT Id, NombreAsignatura FROM Asignatura WHERE RutProfesorACargo=:rut");
            $stmt->bindParam(':rut', $rutProfesor);
            $stmt->execute();
            
            $idAsignatura = array();
            $asignaturas = array();

            while($row = $stmt->fetch()){
                array_push($idAsignatura, $row['Id']);
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
                        <li>
                            <a href="asignaturas.php">Asignaturas</a>
                        </li>
                        <li class="active dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Guías Resueltas<span class="caret"></span></a>
                            <ul class="dropdown-menu" id = "listado-secundario">

                                <!-- Listar asignaturas -->
                                <?php 
                                for($i=0; $i<count($asignaturas);$i++){
                                    menuAsignatura($idAsignatura[$i], $asignaturas[$i]);
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
				$stmt->bindParam(':id',$idAsignatura);
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