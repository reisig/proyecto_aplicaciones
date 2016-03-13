<?php
  session_start();
  require_once( __DIR__. '/cabecera.php' );

     if(isset($_POST['agrega-profesor'])){
      header("Location: agregar-usuarios.php");
    }

?>
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
      <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
      <script type="text/javascript" src="js/main.js"></script>
    <style>
       p {color:black; width:80%; margin-left:20px;}
    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>

<!-- Inicio del encabezado HTML                                   --> 
  <body>
    

    <div class="container"> 
      <h1> Ver Profesores </h1>
      <form name="ver_profesor" > <!-- action="scripts/agrega.php" method="post" -->
    </div>
        <?php

          if(isset($_SESSION['user'])==""){
            header("Location: index.php");
          }

          require_once __DIR__."/scripts/bd/consultas.php";
          require_once __DIR__."/scripts/usuario/clase-usuario.php";

          $usuarios = consultas::getUsuarios();
          if(count($usuarios)!=0){
              $count = 0;
              foreach($usuarios as $usr){
                if($usr['TipoUsuario']=="profesor"){
                  $count = $count+1;
                  $nombre = $usr['Nombre'];
                  $apellidoP = $usr['ApellidoP'];
                  $apellidoM = $usr['ApellidoM'];
                  $correo = $usr['Correo'];
                  $rut = $usr['Rut'];
                  echo $nombre.'  '.$apellidoP.'  '.$apellidoM.'  '.$correo.'
                   <a href="asignaturas.php?id='.$rut.'">Asignaturas</a>
                   <a href="modificar-usuarios.php?id='.$rut.'">Modificar</a> 
                   <a href="eliminar.php?id='.$rut.'">Eliminar</a></br>'; 
                }else{
                  if ($count==0){
                    echo "No hay profesores agregados.\n";
                  }
                }
            }
          }else{
            echo "No hay usuarios agregados.\n";
          }
        ?>

          <a href="agregar-usuarios.php?tipo=1" style="display:inline-block" class="btn btn-lg btn-info btn-block" >Agrega Profesor</a> 
           <a href="agregar-usuarios.php?tipo=2" style="display:inline-block" class="btn btn-lg btn-info btn-block"  >Agrega Alumno</a> 

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