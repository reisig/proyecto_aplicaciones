<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head
        content must come *after* these tags -->
        <title>Asignaturas</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/guia.css" rel="stylesheet">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        
        <?php 
            function listadoAsignatura($asignatura){
                print   "<div class=\"col-md-9\">";
                print        "<h3 id=\"titulo-asignatura\">Nombre: <strong>".$asignatura."</strong></h3>";
                print   "</div>";

                print    "<div class=\"col-md-3\">";
                print        "<div class=\"row\">"; 
                print            "<div class=\"col-xs-1\">";
                print                "<a href=\"#\" id=\"verAsignatura:\"><span class=\"glyphicon glyphicon-eye-open\"></span></a>"; 
                print            "</div>";

                print            "<div class=\"col-xs-1\">";
                print                "<a href=\"#\" id=\"eliminarAsignatura:\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
                print            "</div>"; 
                print        "</div>"; 
                print    "</div>";    
            }
        
            function menuAsignatura($asignatura){
                print "<li><a href=\"#\"></a>".$asignatura."</li>";
            }
        ?>
    </head>
    
    <body>
        
		<?php
		
			/*Datos de conexion*/
			require('scripts/conexion.php');
        
            //$rutProfesor = $_GET['rut'];
            $rutProfesor = '15302958-k';
		
            /*Recuperar listado de asignaturas*/
            $stmt = $conn->prepare("SELECT Id, NombreAsignatura FROM Asignatura WHERE RutProfesorACargo=:rut");
            $stmt->bindParam(':rut', $rutProfesor);
            $stmt->execute();
        
            $asignaturas = array();
            
            while($row = $stmt->fetch()){
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
                                <a href="#">Asignaturas</a>
                            </li>
                            <li>
                                <a href="#">Galería</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Guías Resueltas<span class="caret"></span></a>
                                <ul class="dropdown-menu" id = "listado-secundario">
                                   
                                    <!-- Listar asignaturas -->
                                    <?php 
										for($i=0; $i<count($asignaturas);$i++){
											menuAsignatura($asignaturas[$i]);
										}
                                    ?>
                                    
                                </ul>     
                            </li>
                            <li class="dropdown">
                                <a href="#" class="sign-out dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">NOMBRE PROFESOR<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- CONTENIDO DE LA GUIA -->
        <div class="container" id="contenido-guia">
            <div id="numero-laboratorio">
                <h3 class="text text-center">Listado de asignaturas</h3>
            </div>
        </div>

        <!-- LISTADO DE GUIAS -->
        <div class="container">

            <div class="row" id ="listado-principal">
               
                <?php 
                    for($i=0; $i<count($asignaturas);$i++) {
                        listadoAsignatura($asignaturas[$i]);
                    }
                ?>
                    
            </div>
            <hr>
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