<?php
  require_once __DIR__."/scripts/usuario.php";
  require_once __DIR__."/scripts/bd/consultas.php";

  session_start();
  if(!isset($_SESSION['user'])){
    header("Location: index.php");
  }

  if(isset($_GET['id'])){
    $usuario = new Usuario($_GET['id']);
    if($usuario->nombre != ""){
      $nombre = $usuario->nombre;
      $apellidoP = $usuario->apellidoP;
      $apellidoM = $usuario->apellidoM;
      $rut = $usuario->rut;
      $correo = $usuario->correo;
      $password = $usuario->password;
      $tipo = $usuario->tipoUsuario;
    }else{
      die("El usuario no existe!");
    }
  }else if(isset($_POST['btn-modificar'])){
      $n_nombre = $_POST['nombre'];
      $n_apellidoP = $_POST['apellidoP'];
      $n_apellidoM = $_POST['apellidoM'];
      $n_rut = $_POST['rut'];
      $n_correo = $_POST['correo'];
      $n_password = $_POST['password'];
      $n_tipo = $_POST['tipo'];

      //solo modifica los datos de usuario
      if($rut == $n_rut){
        if(consultas::modificarUsuario($n_nombre, $n_apellidoP, $n_apellidoM, $rut, $n_correo, $n_password)){
          ?>
              <script> alert("Usuario modificado correctamente");</script>
          <?php
          header("Location: verUsuarios.php");
        }
      }else{
          $asignaturas = consultas::getAsignaturasUsuario($n_rut);
          if ($tipo = "alumno"){
              //reasignar rut
             /* if(consultas::eliminarAlumno($n_rut)){


              }*/
          }else if ($tipo = "profesor"){
            //reasignar rut
              echo("existe: ".consultas::rutExiste($n_rut));

          /*if(consultas::eliminarProfesor($rut)){

            }*/

          }
      }
  }

?>



<!-- Este es un comentario en HTML                                -->
<!-- DeclaraciÃ³n de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del cÃ³digo HTML                                       -->
<html>

<!-- Inicio del encabezado HTML                                   -->
  <head>
    <title> Modifica Usuarios </title>
      <link rel="stylesheet" type="text/css" href="css/estilos2.css">
    <style>
       p {color:black; width:80%; margin-left:20px;}
    </style>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>

<!-- Inicio del encabezado HTML                                   --> 
  <body>

    <div class="container"> 
      
      <h1> Modifica Profesor </h1>

      <form name="agrega_profesor" method="post">

        <div class="form-group">
          
          Nombre: <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $nombre; ?>">
                                                                                          
        </div>

        <div class="form-group">

          Apellido Paterno: <input type="text" name="apellidoP" class="form-control" id="apellidoP" value="<?php echo $apellidoP; ?>">

        </div>
        <div class="form-group">

          Apellido Materno: <input type="text" name="apellidoM" class="form-control" id="apellidoM" value="<?php echo $apellidoM; ?>">

        </div>
        <div class="form-group">

          Rut: <input type="text" name="rut" class="form-control" id="rut" value ="<?php echo $rut; ?>">

        </div>
        <div class="form-group">

          Correo: <input type="email" name="correo" class="form-control" id="email" value ="<?php echo $correo; ?>">

        </div>
        <div class="form-group">

          Contraseña: <input type="password" name="password" class="form-control" id="pwd" value="<?php echo $password; ?>">

        </div>
         <div class="form-group">

          Tipo de Usuario: <input type="text" name="tipo" class="form-control" id="tipo" value="<?php echo $tipo; ?>">

        </div>
        

           <button type="submit" class="btn-modificar" name="btn-modificar">Modificar Usuario</button>

      </form>         
    </body>
    </html>