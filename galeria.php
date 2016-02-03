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

				<div class="imagenes grid">

					<?php foreach ($imagenes as $imagen): 
						$info_imagen = getimagesize('repositorio/'. $imagen);
					?>


						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="grid-item col-sm-3">

							<a href="<?php echo 'repositorio/'. $imagen; ?>" itemprop="contentUrl" data-size="<?php echo $info_imagen[0]; ?>x<?php echo $info_imagen[1]; ?>">
								<img src="<?php echo 'repositorio/'. $imagen; ?>" itemprop="thumbnail" alt="Image description" />
							</a>

							<figcaption itemprop="caption description">Image caption  1</figcaption>

			    		</figure>


	    			<?php endforeach; ?>

				</div>

			</div> <!--fin imagenes -->

		</main>

	</div> <!-- fin envoltura -->

</body>
</html>
