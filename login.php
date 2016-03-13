<?php
    session_start();  
    require_once __DIR__."/cabecera.php";
    require_once __DIR__."/scripts/cargar.php";

    if(isset($_SESSION['user'])!=""){
      header("Location: index.php");
    }

    if(isset($_POST['login'])){
      IniciaSesion();
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
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    
</head>


 


<body>

<main id="login" data-estado="0">

  <div class="container">

<form name="login" method="post"> 


  <div id="contenido-principal">


      <form class="form-horizontal" role="form">  

          <div class="form-group">
            <label   class="control-label col-sm-8">Usuario</label>
            <div class="col-sm-10">
              <input type="text" name="rut" placeholder="Usuario" >
            </div>
          </div>
          <div class="form-group">
            <label    class="control-label col-sm-8">Contraseña</label>
            <div class="col-sm-10">
               <input type="password" name="password"  placeholder="contraseña" >
            </div>
          </div>
          <div class="form-group">
             <div class="col-sm-offset-4 col-sm-3">
             <label class="checkbox-inline">
            <input type="checkbox"> Recordarme</label>
        </div>
          <div class="form-group">
               <div class="col-sm-offset-4 col-sm-3">
                   <button type="submit" name="login">Ingresar</button>
                </div>
          </div>
        </form>
</div>
</form>

</main> 
<!-- PIE DE PAGINA -->
        
<?php require_once( __DIR__. '/pie-pagina.php' ); ?>