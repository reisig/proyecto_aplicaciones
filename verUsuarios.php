
<!-- Este es un comentario en HTML                                -->
<!-- DeclaraciÃ³n de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del cÃ³digo HTML                                       -->
<html>
<!-- Inicio del encabezado HTML                                   -->
  <head>
    <title> Ver Usuarios </title>
      <link rel="stylesheet" type="text/css" href="css/estilos2.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
       p {color:black; width:80%; margin-left:20px;}
    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>

<!-- Inicio del encabezado HTML                                   --> 
  <body>
    <!-- nav -->
    <nav class="navbar navbar-default">

      <div class="container">
        <!-- LEFT SECTION -->
        <div class="navbar-header">
          <div class="navbar-left">
            <div class="col-lg-4">
              <img src="repositorio/ULS-logo.jpg" id="logo-uls">
            </div>
            <div class="col-md-8">
              <h6 class="navbar-brand">Departamento de Biología</h2>
            </div>
          </div>
        </div>
        <!-- RIGHT SECTION -->
        <div class="navbar-right">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="#">Profesores</a>
            </li>
            <li>
              <a href="galeria.php">Galería</a>
            </li>
            <li>
              <a href="guias_resueltas.html">Configuracion</a>
            </li>
            <li class="sign-out">
              <a href="logout.php">Cerrar Sesión <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container"> 
      <h1> Ver Profesores </h1>
      <form name="ver_profesor" > <!-- action="scripts/agrega.php" method="post" -->
    </div>
        <?php
          session_start();

          if(isset($_SESSION['user'])==""){
            header("Location: index.php");
          }

          require_once __DIR__."/scripts/bd/dbc.php";
          require_once __DIR__."/scripts/bd/consultas.php";
          require_once __DIR__."/scripts/usuario.php";

          $usuarios = consultas::getUsuarios();
          if($usuarios[0] != ""){
              foreach($usuarios as $usr){
                $nombre = $usr['Nombre'];
                $apellidoP = $usr['ApellidoP'];
                $apellidoM = $usr['ApellidoM'];
                $correo = $usr['Correo'];
                $rut = $usr['Rut'];
                echo $nombre.'  '.$apellidoP.'  '.$apellidoM.'  '.$correo.'
                 <a href="asignaturas.php?id='.$rut.'">Asignaturas</a>
                 <a href="modificarUsuarios.php?id='.$rut.'">Modificar</a> 
                 <a href="eliminar.php?id='.$rut.'">Eliminar</a></br>'; 
            }
          }else{
            echo "No hay usuarios agregados.\n";
          }
        ?>
        <a style="display: inline-block" id = "btn_profesor" class="btn btn-lg btn-info btn-block" href="/proyecto_aplicaciones/scripts/usuarios.php">Agrega Profesor</a> 
         <a style="display: inline-block" id = "btn_alumno" class="btn btn-lg btn-info btn-block" href="/proyecto_aplicaciones/scripts/usuarios.php">Agrega Alumno</a> 
      </form>

       <footer>
            <div class="jumbotron">
                <center>
                    <h4 id="pie-pagina">Copyright © 2016 Departamento de Biología - Facultad de Ciencias - Universidad de La Serena</h4>
                    <h5>Desarrollado por la carrera de Ingeniería en Computación</h5>
                </center>
            </div>
        </footer>
    </body>
    </html>