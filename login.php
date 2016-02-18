<!-- Este es un comentario en HTML                                -->
<!-- Declaración de tipod e documento                             -->
<!DOCTYPE html>
<!-- Inicio del código HTML                                       -->
<html>
    <!-- Inicio del encabezado HTML                                   --> 
<head>
<title> Login </title>
<link rel="stylesheet" type="text/css" href="css/estilos2.css">
<style>
p {color:black; width:80%; margin-left:20px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<!-- Inicio del contenido HTML                                   --> 
<body>
<div class="container"> 

<h1> Acceso a Plataforma </h1>
<form name="nombre_usuario" action="scripts/verifica.php" method="post">

  <div class="form-group">
    Usuario: <input type="email" name="correo" class="form-control" id="email">
  </div>

  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="clave" class="form-control" id="pwd">
  </div>

  <div class="checkbox">
    <label><input type="checkbox"> Recordarme</label>
  </div>

  <button type="submit" class="btn-default">Ingresa</button>

</form>

</div>
</body>
</html>