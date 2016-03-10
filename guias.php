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
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
		
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
		
		<?php
		
			/*Datos de conexion*/
			require('scripts/conexion.php');

			function cargarGuias($id,$titulo,$descripcion,$fecha,$usuario){
				
				print "<div class=\"row\" id = \"".$id."\">";
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
                print                       "<input type=\"checkbox\" id=\"habilitarGuia:".$id."\"> Habilitar";
                print                   "</label>";
                print               "</div>";				
				print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"guia.php?id=".$id."&modo=VER\" id=\"verGuia:".$id."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver guía\"><span class=\"glyphicon glyphicon-eye-open\"></span></a>";
				print    			"</div>";
                print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"guia.php?id=".$id."&modo=EDITAR\" id=\"editarGuia:".$id."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar guía\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
                print    			"</div>";
				print    			"<div class=\"col-xs-1\">";
                print     				"<a href=\"#\" id=\"eliminarGuia:".$id."\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Eliminar guía\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
				print    			"</div>";
				print			"</div>";
				print		"</div>";
				print "</div>";
				print "<hr>";
			}
		?>
		
		<script>
		
		
		
		
		</script>
    </head>
    
    <body>
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
			
				//$rut = $_GET['rut'];
				//$idAsignatura  = $_GET[idAsignatura];
				$rut = '15302958-k';
				$idAsignatura = 1;
			
				/*Recuperar datos del profesor*/
	
				$stmt = $conn->prepare ("SELECT Nombre, ApellidoP, ApellidoM FROM Usuario WHERE Rut=:rut");
				$stmt->bindParam(':rut',$rut);
				$stmt->execute();
				$row = $stmt->fetch();
				
				$profesor = $row['Nombre']." ".$row['ApellidoP']." ".$row['ApellidoM'];
				
				/*Obtener guias del profesor*/
				
				$stmt = $conn->prepare ("SELECT Id, Titulo, Descripcion, Fecha, Estado FROM Guia WHERE IdAsignatura = :id");
				$stmt->bindParam(':id',$idAsignatura);
				$stmt->execute();
				
				while($row = $stmt->fetch()){
					
					$id = $row['Id'];
					$titulo = $row['Titulo'];
					$descripcion = $row['Descripcion'];
					$fecha = $row['Fecha'];
					$estado = $row['Estado'];
	
					/*print "<br><br><br>";  
					print "GUIA <br><br>";
					print $id."<br>";
					print $titulo."<br>";
					print $descripcion."<br>";
					print $fecha."<br>";
					print $estado."<br>";*/
	
					/*Cargar preguntas en la pagina*/
					
					cargarGuias($id,$titulo,$descripcion,$fecha,$profesor);
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
                                <input type="text" class="form-control" id="recipient-name" placeholder="Ingrese título de la guía">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripción:</label>
                                <textarea class="form-control" id="message-text" placeholder="Ingrese descripción de la guía"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer" style="text-align: center">
                        <!-- data-dismiss="modal": cierra la ventana modal -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar guía</button>

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