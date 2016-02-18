<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Listado Guias</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mis_css/stylesheet.css" rel="stylesheet">

		<script>
		
				function cargar_guias(rut) {

					var xmlhttp;

					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("listado-guias").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET","cargarGuias.php?rut=" + rut, true); //true: asincróno
					xmlhttp.send();
				}
				
		</script>
		
    </head>

    <body onload="cargar_guias('15302958-k')">

		<!-- nav -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- LEFT SECTION -->
				<div class="navbar-header">
					<div class="navbar-left">
						<div class="col-lg-4">
							<img src="imagenes/logo-ULS.png" id="logo-uls">
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
						  <a href="#">Guías Laboratorio</a>
						</li>
						<li>
						  <a href="#">Galería</a>
						</li>
						<li>
						  <a href="guias_resueltas.html">Guías Resueltas</a>
						</li>
						<li class="sign-out">
						  <a href="#">Cerrar Sesión <span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
        <div class="container" id="contenido-guia">
            <div id="numero-laboratorio">
                <h3 class="text text-center">GUIAS DE LABORATORIO</h3>
            </div>
            <div id="descripcion-guia">
                <br/>
                <h4 class="text text-center">Listado de guias creadas para utilizar en sesiones de laboratorio</h4>
				 <br/>
			</div>        
        </div>

        <div class="container" id ="listado-guias">
			<!-- Aqui se carga las guias -->
        </div>

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