<!-- Este es un comentario en HTML                                -->
<!-- DeclaraciÃ³n de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del cÃ³digo HTML                                       -->
<html>

<!-- Inicio del encabezado HTML                                   -->
  <head>
    <title> Creacion de Usuarios </title>
      <link rel="stylesheet" type="text/css" href="css/estilos2.css">
    <style>
       p {color:black; width:80%; margin-left:20px;}
    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>

<!-- Inicio del encabezado HTML                                   --> 
  <body>

    <div class="container"> 
      
      <h1> Agregar Profesor </h1>

      <form name="agrega_profesor" action="scripts/agrega.php" method="post">

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

          Correo: <input type="email" name="correo" class="form-control" id="email">

        </div>
        <div class="form-group">

          Contraseña: <input type="password" name="clave" class="form-control" id="pwd">

        </div>
         <div class="form-group">

          Tipo de Usuario: <input type="text" name="tipo" class="form-control" id="tipo">

        </div>
        

           <button type="submit" class="btn-default">Agrega Profesor</button>

      </form>