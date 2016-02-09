<?php 
/**
 * Este archivo muestra la galeria de imagnes (repositorio).
 *
 * @package RepBiologia
 * @since RepBiologia 1.0
 */

/*Gran parte del codigo de este archivo no es el codigo final, solo se hizo para
  probar la pagina. */

$imagenes = array(
	'09.jpg', 
	'26rukcells_v1.jpg', 
	'Arbuscular_mycorrhiza_microscope.jpg', 
	'cell death 1.jpg', 
	'Cells-under-a-microscope.jpg', 
	'Fat cell.jpg', 
	'gol.ap in nerve cell silver stain.jpg', 
	'IMG_20140211_135459_435.jpg', 
	'img027.jpg', 
	'Neotyphodium_coenophialum.jpg', 
	'nueron_moto_nerve_cell1329245097781.png', 
	'onion_skin.jpg', 
	'tissue-10.jpg', 
	'yKKqrFI.jpg', 
	);

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Repositorio Biologia</title>
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


			</div>

			<div class="contenedor-imagenes">

				<div class="imagenes grid" itemscope itemtype="http://schema.org/ImageGallery">

					<?php foreach ($imagenes as $imagen): 
						$info_imagen = getimagesize('repositorio/'. $imagen);
					?>


						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="grid-item col-sm-3">

							<a href="<?php echo 'repositorio/'. $imagen; ?>" itemprop="contentUrl" data-size="<?php echo $info_imagen[0]; ?>x<?php echo $info_imagen[1]; ?>">
								<img src="<?php echo 'repositorio/'. $imagen; ?>" itemprop="thumbnail" alt="Image description" />
							</a>

							<figcaption class="detalles" itemprop="caption description">

								<div class="detalle"><strong>Preparacion de: </strong><span>Epidermis inferior de hoja</span></div>
								<div class="detalle"><strong>Tinción usada: </strong><span>Hematoxilina-eosina</span></div>
								<div class="detalle"><strong>Diámetro del campo: </strong><span>1500 µ</span></div>
								<div class="detalle"><strong>Aumento total: </strong><span>100x</span></div>
								<div class="detalle"><strong>Autor: </strong><span>Juan Perez</span></div>
								<div class="detalle"><strong>Fecha: </strong><span>20/01/2016</span></div>

							</figcaption>

			    		</figure>

	    			<?php endforeach; ?>

				</div>

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

			</div> <!--fin imagenes -->

		</main>

	</div> <!-- fin envoltura -->

</body>
</html>
