<?php
  
  session_start();


  if(!isset($_SESSION['user'])){
    header("Location: index.php");
  }



  require_once __DIR__."/cabecera.php";
  require_once __DIR__."/scripts/usuario/clase-usuario.php";
  require_once __DIR__."/scripts/bd/consultas.php";

  if(isset($_GET['id'])){
    $usuario = new Usuario($_GET['id']);
    if($usuario->nombre != ""){
      if($usuario->tipoUsuario != "administrador"){
        $nombre = $usuario->nombre;
        $apellidoP = $usuario->apellidoP;
        $apellidoM = $usuario->apellidoM;
        $rut = $usuario->rut;
        $correo = $usuario->correo;
        $password = $usuario->password;
        $tipoUsuario = $usuario->tipoUsuario;
      }else{
        die("El usuario no existe!");
      }
    }else{
        die("El usuario no existe!");
    }
  }


  if(isset($_POST['btn-modificar'])){
      $nnombre = $_POST['nombre'];
      $napellidoP = $_POST['apellidoP'];
      $napellidoM = $_POST['apellidoM'];
      $nrut = $_POST['rut'];
      $ncorreo = $_POST['correo'];
      $npassword = $_POST['password'];

      if(!consultas::rutExiste($nrut)){
          if (consultas::modificarUsuario($nnombre, $napellidoP, $napellidoM, $rut, $nrut, $ncorreo, $npassword)){
            ?>
                <script> alert("Usuario modificado correctamente");
                        window.location = "ver-usuarios.php";
                </script>
            <?php

          }
      }else if(consultas::rutExiste($nrut) && ($rut != $nrut)){
        ?>  
             <script> alert("Ya existe un usuario con el Rut ingresado, pruebe con otro");</script>
        <?php

      }else if(consultas::rutExiste($nrut) && ($rut == $nrut)){

        if (consultas::modificarUsuario($nnombre, $napellidoP, $napellidoM, $rut, $nrut, $ncorreo, $npassword)){
            ?>
                <script> alert("Usuario modificado correctamente");
                        window.location = "ver-usuarios.php";
                </script>
            <?php
        }
      } 
  }

?>



<!DOCTYPE html>
<html>
  <head>
    <title> Modificar Usuario </title>
      <link rel="stylesheet" type="text/css" href="css/estilos2.css">
      
   
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- Bootstrap -->
     <link href="css/mis_css/stylesheet.css" rel="stylesheet">
     <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    
  </head>
  <body>
  <main id="agregar-usuarios" data-estado="0">
      
      

 <div class="container"> 
      <h1> Modificar Usuario </h1>
      <form name="agrega_profesor" method="post">
   
<div id="contenido-principal"> 
   <form class="form-horizontal" role="form">  

        <div class="form-group">
            <label class="control-label col-sm-2" >  Nombre:</label>
          <div class="col-sm-10">
                <input type="text" name="nombre" class="form-control" id="nombre" value=<?php echo $nombre?>>
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" >  Apellido Paterno: </label>
          <div class="col-sm-10">
                <input type="text" name="apellidoP" class="form-control" id="apellidoP" value=<?php echo $apellidoP?>>
          </div>
        </div>

        
         <div class="form-group">
            <label class="control-label col-sm-2" >  Apellido Materno: </label>
          <div class="col-sm-10">
               <input type="text" name="apellidoM" class="form-control" id="apellidoM" value=<?php echo $apellidoM?>>
          </div>
        </div>

          <div class="form-group">
            <label class="control-label col-sm-2" >   Rut: </label>
          <div class="col-sm-10">
                <input type="text" name="rut" class="form-control" id="rut" value=<?php echo $rut?>>
          </div>
        </div>

       <div class="form-group">
            <label class="control-label col-sm-2" >   Correo:  </label>
          <div class="col-sm-10">
               <input type="email" name="correo" class="form-control" id="correo" value=<?php echo $correo?>>
          </div>
        </div>
       
         <div class="form-group">
            <label class="control-label col-sm-2" >   Contraseña:  </label>
          <div class="col-sm-10">
               <input type="password" name="password" class="form-control" id="password" value=<?php echo $password?>>
          </div>
        </div>

         <!--<div class="form-group">
          Tipo de Usuario: <input type="text" name="tipo" class="form-control" id="tipo">
        </div>-->
        <div class="form-group">
         <div class="col-sm-offset-7 col-sm-7">
           <button type="submit" class="btn-default" name="btn-modificar" id ="btn-default" >Modificar <?php echo $tipoUsuario;?></button>
        </div>

      </form>
  
  </div>
   </form> 

</main> 
<!-- PIE DE PAGINA -->
    <div class="pie-pagina">
      <?php require_once( __DIR__. '/pie-pagina.php' ); ?>
     </div>

  </body>
  </html>