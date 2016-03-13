<?php
  session_start();

  $tipoUsuario = $_GET['tipo'];

  if($tipoUsuario==1){
    $tipoUsuario="Profesor";
  }else if($tipoUsuario==2){
    $tipoUsuario="Alumno";
  }else{
    die("Error al procesar la solicitud");
  }

  require_once __DIR__."/cabecera.php";
  require_once __DIR__."/scripts/bd/consultas.php";

  //primero verificar si esta algun campo vacio!!!!

  if(isset($_POST['btn-default'])){

    $rut = trim($_POST['rut']);
    $nombre = trim($_POST['nombre']);
    $apellidoP = trim($_POST['apellidoP']);
    $apellidoM = trim($_POST['apellidoM']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if($rut=="" || $nombre=="" || $apellidoP=="" || $apellidoM=="" || $correo=="" || $password==""){
      ?>
            <script>alert('Debe rellenar todos los campos!');</script>
      <?php
    }else{

      if(consultas::insertUsuario($rut, $nombre, $apellidoP, $apellidoM, $correo, $password, $tipoUsuario)){
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
      <h1> Agregar <?php echo $tipoUsuario?> </h1>
      <form name="agrega_profesor" method="post">
   
<div id="contenido-principal"> 
   <form class="form-horizontal" role="form">  

        <div class="form-group">
            <label class="control-label col-sm-2" >  Nombre:</label>
          <div class="col-sm-10">
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej: Juan Ignacio">
          </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" >  Apellido Paterno: </label>
          <div class="col-sm-10">
                <input type="text" name="apellidoP" class="form-control" id="apellidoP" placeholder="Ej: Jofre">
          </div>
        </div>

        
         <div class="form-group">
            <label class="control-label col-sm-2" >  Apellido Materno: </label>
          <div class="col-sm-10">
               <input type="text" name="apellidoM" class="form-control" id="apellidoM" placeholder="Ej: Santibañez">
          </div>
        </div>

          <div class="form-group">
            <label class="control-label col-sm-2" >   Rut: </label>
          <div class="col-sm-10">
                <input type="text" name="rut" class="form-control" id="rut" placeholder="Ej: 164505230">
          </div>
        </div>

       <div class="form-group">
            <label class="control-label col-sm-2" >   Correo:  </label>
          <div class="col-sm-10">
               <input type="email" name="correo" class="form-control" id="correo" placeholder="Ej: JuanIgnacio@mail.com">
          </div>
        </div>
       
         <div class="form-group">
            <label class="control-label col-sm-2" >   Contraseña:  </label>
          <div class="col-sm-10">
               <input type="password" name="password" class="form-control" id="password" placeholder="Ej: xxxxxx">
          </div>
        </div>

         <!--<div class="form-group">
          Tipo de Usuario: <input type="text" name="tipo" class="form-control" id="tipo">
        </div>-->
        <div class="form-group">
         <div class="col-sm-offset-7 col-sm-7">
           <button type="submit" class="btn-default" name="btn-default" id ="btn-default" >Agrega <?php echo $tipoUsuario;?></button>
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
