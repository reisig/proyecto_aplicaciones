<?php

  require_once __DIR__."/scripts/bd/consultas.php";

  //primero verificar si esta algun campo vacio!!!!

  if(isset($_POST['btn-default'])){

    $rut = trim($_POST['rut']);
    $nombre = trim($_POST['nombre']);
    $apellidoP = trim($_POST['apellidoP']);
    $apellidoM = trim($_POST['apellidoM']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);
    $tipo = trim($_POST['tipo']); 

    if($rut=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $correo=="" || $password=="" || $tipo==""){
      ?>
            <script>alert('Debe rellenar todos los campos!');</script>
      <?php
    }else{

      if(consultas::insertUsuario($rut, $nombre, $apellidoP, $apellidoM, $correo, $password, $tipo)){
          ?>
            <script>alert('El usuario fue ingresado correctamente');</script>
          <?php
      }else{
        ?>
          <script>alert('Hubo un error al ingresar el usuario (tal vez ya exista)');</script>
        <?php
      }
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Creacion de Usuarios </title>
      <link rel="stylesheet" type="text/css" href="css/estilos2.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
       p {color:black; width:80%; margin-left:20px;}
    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
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
              <a href="verUsuarios.php">Profesores</a>
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
      <h1> Agregar Profesor </h1>
      <form name="agrega_profesor" method="post">
        <div class="form-group">
          Nombre: <input type="text" name="nombre" class="form-control" id="nombre">
        </div>
        <div class="form-group">
          Apellido Paterno: <input type="text" name="apellidoP" class="form-control" id="apellidoP">
        </div>
        <div class="form-group">
          Apellido Materno: <input type="text" name="apellidoM" class="form-control" id="apellidoM">
        </div>
        <div class="form-group">
          Rut: <input type="text" name="rut" class="form-control" id="rut">
        </div>
        <div class="form-group">
          Correo: <input type="email" name="correo" class="form-control" id="correo">
        </div>
        <div class="form-group">
          Contraseña: <input type="password" name="password" class="form-control" id="password">
        </div>
         <div class="form-group">
          Tipo de Usuario: <input type="text" name="tipo" class="form-control" id="tipo">
        </div>
           <button type="submit" class="btn-default" name="btn-default" id ="btn-default" >Agrega Profesor</button>

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
