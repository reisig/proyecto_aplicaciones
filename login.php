<?php
    session_start();
    require_once __DIR__."/scripts/bd/consultas.php";
    require_once __DIR__."/scripts/usuario/clase-usuario.php";

    if(isset($_SESSION['user'])!=""){
      header("Location: index.php");
    }

    if(isset($_POST['btn-login'])){
      $rut = trim($_POST['rut']);
      $password = trim($_POST['password']);

      if(consultas::verificarLogin($rut, $password)){
          $usuario = new Usuario($rut);
          echo $usuario->tipoUsuario;
          if($usuario){
              ?>
                  <script>alert($usuario->tipoUsuario);</script>
              <?php
              $_SESSION['user'] = $usuario->rut;
              if($usuario->tipoUsuario = "administrador"){
                  header('Location: /proyecto_aplicaciones/ver-usuarios.php');
              }else if ($usuario->tipoUsuario = "profesor"){
                  header('Location: /proyecto_aplicaciones/guias.php');
              }else if ($usuario->tipoUsuario = "alumno"){
                  header('Location: /proyecto_aplicaciones/guia.php');
              }
          }else{
              ?>
                  <script>alert('Hubo un error al iniciar sesion!');</script>
              <?php
          }
      }else{
          ?>
              <script>alert('RUT o contraseña incorrecto(s)!');</script>
          <?php
      }
    }
?>




<!-- Este es un comentario en HTML                                -->
<!-- Declaración de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del código HTML                                       -->
<html>
    <!-- Inicio del encabezado HTML                                   --> 
<head>
    <title> Login </title> 
    <link rel="stylesheet" type="text/css" href="css/estilos2.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/mis_css/stylesheet.css" rel="stylesheet">
</head>



<body>

<div class="container-fluid">
<!--TITULO DE FORMULARIO-->
    <div class="row">
      <div class="col-sm-6 col-sm-offset-2">
      
           <!--<img src="imagenes/logo-ULS.png">--> 

           <center><h2>Departamento de Biología</h2> </center>
                
        
      </div>
    </div>
    <br> <br />


<form name="login" method="post"> 

  <form class="form-horizontal">
  <!--<form method="post">-->
    <div class="form-group ">
      <label class="control-label col-sm-4" >  Usuario::</label>
      <div class="col-sm-3">
        <input type="text" name="rut" placeholder="Usuario">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" >Contraseña:</label>
      <div class="col-sm-3">
        <input type="password" name="password"  placeholder="contraseña">
      </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-3">
            <label class="checkbox-inline">
        <input type="checkbox"> Recordarme</label>
    </div>
    <div class="form-group">
         <div class="col-sm-offset-4 col-sm-3">
             <button type="submit" class="btn-login" name="btn-login">Ingresar</button>
          </div>
    </div>
  </form>
</form>

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