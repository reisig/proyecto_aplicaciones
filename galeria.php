<?php 
/**
 * Este archivo muestra la galeria de imagnes (repositorio).
 *
 * @package RepBiologia
 * @since RepBiologia 1.0
 */

/*Gran parte del codigo de este archivo no es el codigo final, solo se hizo para
  probar la pagina. */

require_once( 'scripts/imagen/funciones-galeria.php' );

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Repositorio Biologia</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/photoswipe.css">
	<link rel="stylesheet" type="text/css" href="css/default-skin/default-skin.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="js/photoswipe.min.js"></script>
	<script type="text/javascript" src="js/photoswipe-ui-default.min.js"></script>
	<script type="text/javascript" src="js/init.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>

	<div class="envoltura">

		<main id="galeria">

			<div class="contenedor-filtros">

				<div class="container">

					<div class="despegable">

						<h2 class="titulo">Realizar búsqueda por filtros</h2>

					</div>

					<div class="filtros-interior">

						<form id="busqueda" method="get">

							<span class="todos">Marcar todos filtros</span>

							<!-- indica si se busca por todos los filtros -->
							<input type="hidden" name="todos" value="0">

							<!-- indica el numero de pagina a mostrar (offset) -->
							<input type="hidden" name="offset" value="0">

							<div class="row">

								<div class="col-sm-9">

									<?php filtros(obtener_filtros()); ?>

								</div>

								<div class="filtros col-sm-3">

								</div>

								<div class="col-xs-12"><button type="submit" form="busqueda" value="Submit"><i class="fa fa-search"></i> Realizar Búsqueda</button></div>

							</div>

						</form>

					</div>

				</div>

			</div>

			<div class="contenedor-imagenes">

				<?php echo obtener_imagenes_galeria(obtener_imagenes(array(), 14, 0)); ?>

				<!-- Visor de imagenes. -->
				<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

				    <!-- Fondo del visor de imagenes. -->
				    <div class="pswp__bg"></div>

				    <div class="pswp__scroll-wrap">

				        <!-- Contenedor de slides. PhotoSwipe mantiene solo 3 slides en el  DOM para ahorrar memoria. -->
				        <div class="pswp__container">
				            <div class="pswp__item"></div>
				            <div class="pswp__item"></div>
				            <div class="pswp__item"></div>
				        </div>

				        <!-- Interfaz grafica por defecto de Photoswipe. -->
				        <div class="pswp__ui pswp__ui--hidden">

				            <div class="pswp__top-bar">

				                <!--  Controles del visor. -->

				                <div class="pswp__counter"></div>

				                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

				                <button class="pswp__button pswp__button--share" title="Share"></button>

				                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

				                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

				                <!-- Preloader -->
				                <div class="pswp__preloader">
				                    <div class="pswp__preloader__icn">
				                      <div class="pswp__preloader__cut">
				                        <div class="pswp__preloader__donut"></div>
				                      </div>
				                    </div>
				                </div>
				            </div>

				            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				                <div class="pswp__share-tooltip"></div> 
				            </div>

				            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				            </button>

				            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				            </button>

				            <div class="pswp__caption">
				                <div class="pswp__caption__center"></div>
				            </div>

				          </div>

				        </div>

				</div> <!-- fin pswp -->

			</div> <!--fin contenedor-imagenes -->

			<div class="contenedor-paginacion">

				<?php echo obtener_paginacion_galeria(obtener_total_imagenes(), 14, 1); ?>

			</div>

		</main>

	</div> <!-- fin envoltura -->

</body>
</html>
