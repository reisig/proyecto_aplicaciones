<?php 
    /**
     * Cabecera para la pagina.
     *
     * @package RepBiologia
     * @since RepBiologia 1.0
     */

    //cargamos las dependencias.
    require_once(__DIR__. '/scripts/cargar.php');

    $tipo = "";
    if(isset($_SESSION['user'])){
        $usr = usuarioActual();
        $tipo = $usr->tipoUsuario;
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Repositorio - Departamento de Biologia</title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/photoswipe.css">
        <link rel="stylesheet" type="text/css" href="css/default-skin/default-skin.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/guia.css">

        <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
        <script type="text/javascript" src="js/photoswipe.min.js"></script>
        <script type="text/javascript" src="js/photoswipe-ui-default.min.js"></script>
        <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
        <script type="text/javascript" src="js/main.js"></script>  
    </head>

    <body>

        <div class="envolutra">

            <header id="cabecera">

                <!-- Barra de navegacion -->
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
                                    <li class ="active">
                                    <?php
                                        if($tipo=="Profesor"){
                                            echo "<a href=\"asignaturas.php\">Asignaturas</a>";
                                        }else if($tipo=="Administrador"){
                                            echo "<a href=\"asignaturas.php\">Asignaturas</a>";
                                            echo "</li><li>";
                                            echo "<a href=\"ver-usuarios.php\">Profesores</a>";
                                        }else if($tipo=="Alumno"){
                                            echo"<li class=\"dropdown\">
                                                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\">Guías Resueltas<span class=\"caret\"></span></a>
                                                    <ul class=\"dropdown-menu\">
                                                        <!-- Listar asignaturas -->
                                                        <li><a href=\"#\">Asignatura1</a></li>
                                                        <li><a href=\"#\">Asignatura2</a></li>
                                                        <li><a href=\"#\">Asignatura3</a></li>
                                                        <li><a href=\"#\">Asignatura4</a></li>
                                                        <li><a href=\"#\">Asignatura5</a></li> 
                                                    </ul>     
                                                </li>";
                                        }
                                    ?>
                                    </li>
                                    <?php if($tipo==""){
                                        echo "<li class=\"active\">
                                                <a href=\"login.php\">Home<span class=\"sr-only\">(current)</span></a>
                                            </li>";
                                        }
                                    ?>
                                    <li>
                                        <a href="galeria.php">Galería</a>
                                    </li>
                                    <?php
                                        if($tipo!=""){
                                        echo "<li class=\"sign-out\">
                                                <a href=\"logout.php\">Cerrar Sesión<span class=\"sr-only\">(current)</span></a>
                                            </li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                
            </header>
