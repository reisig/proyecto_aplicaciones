<?php 
/**
 * Este archivo contiene las funciones y variables que son usadas por la galeria.
 *
 * @package RepBiologia
 * @subpackage scripts
 * @since RepBiologia 1.0
 */

/**
 * Muestra una lista de checkboxs con los valores del filtro.
 *
 * @param string $id ID del filtro.
 * @param array $filtro Los valores del filtro a mostrar.
 * @param string $titulo Titulo opcional para el filtro.
 */
function filtro( $id, $filtro, $titulo = '' ) {

	// verificamos que hayan un id y filtros y que este sea un array.
	if( !empty($id) && !empty($filtro) && is_array($filtro) ): ?>

		<h3 class="titulo"><?php echo $titulo; ?></h3>

		<ul class="filtro">

			<?php foreach ($filtro as $valor): ?>

				<li class="valor">

					<input type="checkbox" class="<?php echo $id; ?>" name="<?php echo $id; ?>[]" value="<?php echo $valor; ?>"><span class="texto"><?php echo $valor; ?></span>

				</li>

			<?php endforeach; ?>

		</ul>

	<?php endif;
}

/**
 * Muestra una lista de checkboxs con los valores del filtro.
 *
 * @param string $id ID del filtro.
 * @param array $filtro Los valores del filtro a mostrar.
 * @param string $titulo Titulo opcional para el filtro.
 */
function filtros( $filtros ) {

	// verificamos que existan filtros.
	if( !empty($filtros) && is_array($filtros) ):
		$contador = 1; //usado para agregar filas.

		foreach ($filtros as $id => $filtro): ?>

			<?php if( $contador == 1 ): ?>

				<div class="row">

			<?php endif; ?>

			<div class="filtros col-sm-6"><?php filtro($id, $filtro['valores'], $filtro['titulo']); ?></div>

			<?php if( $contador == 2 ): ?>

				</div>

				<?php $contador = 1; // cerramos la fila y reiniciamos. ?>

			<?php elseif( $contador < 2 ): ?>

				<?php $contador += 1; ?>
					
			<?php endif; ?>

		<?php endforeach; ?>

	<?php endif;
}

/**
 * Muestra la paginacion de la galeria.
 * 
 * @param int $num_total Numero total de imagenes en al base de datos.
 * @param int $num_por_pagina Numero de imagenes a mostrar por pagina.
 */
function filtro_fecha( $num_total, $num_por_pagina ) {

}

/**
 * Devuelve el html de las imagenes a mostrar en la galeria.
 * 
 * @param array $imagenes Array con las imagenes a mostrar.
 * @return string
 */
function obtener_imagenes_galeria( $imagenes ) {

	$html = '<div class="imagenes grid" itemscope itemtype="http://schema.org/ImageGallery">';

		foreach ($imagenes as $imagen) {
			$info_imagen = getimagesize('repositorio/'. $imagen);

			$html .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="grid-item col-sm-3">';

				$html .= '<a href="repositorio/'. $imagen. '" itemprop="contentUrl" data-size="'. $info_imagen[0]. 'x'. $info_imagen[1]. '">';

					$html .= '<img src="repositorio/'. $imagen. '" itemprop="thumbnail" alt="Image description" />';

				$html .= '</a>';

				$html .= '<figcaption class="detalles" itemprop="caption description">';

					$html .= '<div class="detalle"><strong>Preparacion de: </strong><span>Epidermis inferior de hoja</span></div>';
					$html .= '<div class="detalle"><strong>Tinción usada: </strong><span>Hematoxilina-eosina</span></div>';
					$html .= '<div class="detalle"><strong>Diámetro del campo: </strong><span>1500 µ</span></div>';
					$html .= '<div class="detalle"><strong>Aumento total: </strong><span>100x</span></div>';
					$html .= '<div class="detalle"><strong>Autor: </strong><span>Juan Perez</span></div>';
					$html .= '<div class="detalle"><strong>Fecha: </strong><span>20/01/2016</span></div>';

				$html .= '</figcaption>';

			$html .= '</figure>';

		}

	$html .= '</div>';

	return $html;
} 

/**
 * Devuelve el html  la paginacion de la galeria.
 * 
 * @param int $num_total Numero total de imagenes en al base de datos.
 * @param int $num_por_pagina Numero de imagenes a mostrar por pagina.
 * @param int $num_actual Numero actual de la paginacion.
 * @return string
 */
function obtener_paginacion_galeria( $num_total, $num_por_pagina, $num_actual ) { 
	$rango = 5; // numero de paginas a mostrar.
	$num_paginas = 1; // numero de paginas totales.
	$comienzo = 1;
	$final = 1;
	$paginacion_izq = false;
	$paginacion_derch = false;

	// si el nunmero total es mayor, obtenemos el numero de paginas.
	if( $num_total > $num_por_pagina ) {
		$num_paginas = ceil($num_total/$num_por_pagina); //redondea hacia arriba.
	}

	// obtenemos el comienzo de la pagiancion.
	if( $num_actual == 1 || $num_actual < $rango ) {
		$comienzo = 1;
	} else if( $num_actual == $num_paginas &&  $num_paginas > $rango ) {
		$comienzo = $num_paginas - ($rango-1);
	} else if( $num_actual >= $rango && $num_actual < $num_paginas ) {
		$comienzo = $num_actual - 3;
	}

	// obtenemos el final de la paginacion.
	if( $num_paginas < $rango ) {
		$final = $num_paginas;
	} else if( $num_paginas >= $rango ) {
		$final = $comienzo + ($rango-1);
	}

	// obtenemos los puntos de la paginacion.
	if( $num_actual >= $rango ) {
		$paginacion_izq = true;
	}

	if( $num_paginas-$final >= 1 ) {
		$paginacion_derch = true;
	}

	$html = '<div class="paginacion">';

		if( $paginacion_izq ) {

			$html .= '<a href="" class="pagina primero" data-numero="1"><i class="fa fa-angle-double-left"></i></a>';
			$html .= '<span class="puntos">...</span>';

		}

		for ($i=$comienzo; $i <= $final; $i++) {

			$html .= '<a href="" class="pagina'. ($num_actual == $i ? ' actual' : ''). '" data-numero="'. $i. '">'. $i. '</a>';

		}

		if( $paginacion_derch ) {

			$html .= '<span class="puntos">...</span>';
			$html .= '<a href="" class="pagina ultimo" data-numero="'. $num_paginas. '"><i class="fa fa-angle-double-right"></i></a>';

		}

	$html .= '</div>';

	return $html;
}

/**
 * Devuelve los filtros para la busqueda de imagenes en la galeria.
   NOTA: En la primera version de la pagina, los filtros fueron definidos (constantes), 
   si se desea agregar mas filtros, la forma mas facil es agregar un nuevo array 
   al array de filtros.
 *
 * @return array
 */
function obtener_filtros() {
	$filtros = array(
		'preparacion_de' => array( 
			'titulo' => 'Preparación de',
			'valores' => array(
				'Epidermis inferior de hoja',
				'Epidermis inferior de catafilo de cebolla',
				'Aparato de Golgi en epidídimo de rata',
				'Ovocito en ovario de macha (M. donacium)',
				'Frotis de sangre humana',
				'Frotis de sangre de ave',
				'Frotis de sangre de tiburón',
				'Hepatocitos en hígado de rata',
				'Mitosis en cebolla (A. cepa)',
				'Médula espinal en rata',
				'Corte de riñón ',
				'Músculo estriado esquelético',
				'Intestino delgado',
				'Ovario de rata',
				'Testículo de rata',
				'Otro',
			),
		),
		'tincion_usada' => array(
			'titulo' => 'Tinción usada',
			'valores' => array('Hematoxilina-eosina',
				'Feulgen + Geimsa',
				'Feulgen + Fast Green',
				'May Grunwald-Geimsa',
				'Geimsa',
				'Violeta cristal',
				'Carmín acético',
				'PAS',
				'Tinción argéntica',
				'Azul de metileno',
				'Lugol',
				'Tinción argéntica',
				'Orceína',
				'Sin tinción',
			),
		),
		'diametro_campo' => array(
			'titulo' => 'Diámetro del campo',
			'valores' => array(
				'40x',
				'100x',
				'400x',
				'1000x',
			),
		),
		'aumento_total' => array(
			'titulo' => 'Aumento total',
			'valores' => array(
				'3750 µ',
				'1500 µ',
				'375 µ',
				'150 µ',
				'Otro',
			),
		),
	);

	return $filtros;
}

/** 
  VARIABLE GLOBAL CON LAS IMAGENES DE PRUEBA. ESTE ARRAY ES TEMPORAL, SOLO ES PARA 
  PROBAR LA FUNCIONALIDAD.
*/

  $imagenes_prueba = array(
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
		//divisor segmentos de 14 imagenes
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
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
		//divisor segmentos de 14 imagenes
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
		'09.jpg', 
		'26rukcells_v1.jpg', 
		'Arbuscular_mycorrhiza_microscope.jpg',
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'cell death 1.jpg', 
		'Cells-under-a-microscope.jpg', 
		'Fat cell.jpg', 
		'gol.ap in nerve cell silver stain.jpg', 
		'IMG_20140211_135459_435.jpg', 
		'img027.jpg', 
		'Neotyphodium_coenophialum.jpg', 
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
		//divisor segmentos de 14 imagenes
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
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
		//divisor segmentos de 14 imagenes
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
		'09.jpg', 
		'26rukcells_v1.jpg', 
		'Arbuscular_mycorrhiza_microscope.jpg',
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'cell death 1.jpg', 
		'Cells-under-a-microscope.jpg', 
		'Fat cell.jpg', 
		'gol.ap in nerve cell silver stain.jpg', 
		'IMG_20140211_135459_435.jpg', 
		'img027.jpg', 
		'Neotyphodium_coenophialum.jpg', 
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
		//divisor segmentos de 14 imagenes
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
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
		//divisor segmentos de 14 imagenes
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
		'09.jpg', 
		'26rukcells_v1.jpg', 
		'Arbuscular_mycorrhiza_microscope.jpg',
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'cell death 1.jpg', 
		'Cells-under-a-microscope.jpg', 
		'Fat cell.jpg', 
		'gol.ap in nerve cell silver stain.jpg', 
		'IMG_20140211_135459_435.jpg', 
		'img027.jpg', 
		'Neotyphodium_coenophialum.jpg', 
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
		//divisor segmentos de 14 imagenes
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
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
		//divisor segmentos de 14 imagenes
		'tissue-10.jpg', 
		'yKKqrFI.jpg', 
		'09.jpg', 
		'26rukcells_v1.jpg', 
		'Arbuscular_mycorrhiza_microscope.jpg',
		'nueron_moto_nerve_cell1329245097781.png', 
		'onion_skin.jpg', 
		'cell death 1.jpg', 
		'Cells-under-a-microscope.jpg', 
		'Fat cell.jpg', 
		'gol.ap in nerve cell silver stain.jpg', 
		'IMG_20140211_135459_435.jpg', 
		'img027.jpg', 
		'Neotyphodium_coenophialum.jpg', 
	);

/** 
  FIN IMAGENES.
*/

/**
 * Devuelve el numero total de imagenes en la base de datos;
 *
 * @return int
 */
function obtener_total_imagenes() {
	global $imagenes_prueba;

	return count($imagenes_prueba);
}

/**
 * Devuelve las imagenes a mostrar en la galeria.
   NOTA: En esta funcion se debe colocar el codigo que retorna las imagenes 
   en un array de objetos Imagen.
 *
 * @param array #filtros Los filtros para realizar la busqueda.
 * @param int #numero Numero de imagenes a obtener.
 * @param int #offset Numero de partida.
 * @return array
 */
function obtener_imagenes( $filtros, $numero, $offset = 0 ) {
	global $imagenes_prueba;

	$resultado = array();

	for ($i=$offset; $i < $numero; $i++) { 
		$resultado[] = $imagenes_prueba[$i];
	}

	return $resultado;
}