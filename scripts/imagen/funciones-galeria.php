<?php 
/**
 * Este archivo contiene las funciones y variables que son usadas por la galeria.
 *
 * @package RepBiologia
 * @subpackage scripts
 * @since RepBiologia 1.0
 */

/**
 * Comprueba si el valor del filtro fue seleccionado.
 *
 * @return int
 */
function obtener_offset() {
	$offset = 1;

	//comrpobamos si existe la variable offset.
	if( isset($_GET['offset']) ) {
		return $_GET['offset'];
	}

	return $offset;
}

/**
 * Comprueba si el valor del filtro fue seleccionado.
 *
 * @param string $id ID del filtro.
 * @param string $valor Valor seleccionado del filtro.
 * @return bool
 */
function comprobar_valor_filtro( $id, $valor ) {

	//comprobamos si se ha seleccionado algun valor del filtro.
	if( isset($_GET[$id]) ) {
		//comprobamos si el valor fue seleccionado.
		if( in_array($valor, $_GET[$id]) ) {
			return true;
		}
	}
	
	return false;
}

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

		<?php if( ! empty($titulo) ): ?>

			<div class="titulo-filtro"><span><?php echo $titulo; ?></span></div>

		<?php endif; ?>

		<ul class="lista-valores">

			<?php foreach ($filtro as $valor): ?>

				<?php 

					$otro = false;
					if( strtolower($valor) == 'otro' ) {
						$otro = true;
					}

					// comprobamos si es valor fue seleccionado.
					$seleccionado = comprobar_valor_filtro($id, $valor); 

				?>

				<li class="valor <?php echo ($otro ? 'valor-otro' : ''); ?> <?php echo ($seleccionado ? 'seleccionado' : ''); ?>">

					<input type="checkbox" class="entrada-valor <?php echo $id; ?>" name="<?php echo $id; ?>[]" value="<?php echo $valor; ?>" style="display: none;" <?php echo ($seleccionado ? 'checked' : ''); ?>>

					<i class="icono fa fa-check"></i><span class="texto"><?php echo $valor; ?></span>

					<?php if( $otro ): ?>

						<?php 

							// obtenemos el valor ingresado (si es que fue lom hubiera).
							if( $seleccionado ) {
								if( isset($_GET[$id]['valor_otro']) ) {
									$valor = $_GET[$id]['valor_otro'];
								} else {
									$valor = '';
								}
							} else {
								$valor = '';
							}

						 ?>

						<input type="text" class="texto-otro <?php echo $id; ?>" name="<?php echo $id; ?>[valor_otro]" value="<?php echo $valor; ?>" placeholder="Escriba aquí" <?php echo ($seleccionado ? 'style="display: block;"' : 'style="display: none;"'); ?>>

					<?php endif; ?>

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

			<div id="<?php echo $id; ?>" class="filtro col-sm-6"><?php filtro($id, $filtro['valores'], $filtro['titulo']); ?></div>

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
			//$info_imagen = getimagesize('repositorio/'. $imagen);

//            $html .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="grid-item col-md-3" data-dibujo="repositorio/'. $imagen->getRuta. '">';
            $html .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="grid-item col-md-3" data-dibujo='. $imagen->get_ruta_dibujo(). '>';

				$html .= '<a href="'. $imagen->get_ruta(). '" itemprop="contentUrl" data-size="'. $imagen->get_ancho(). 'x'. $imagen->get_alto(). '">';

					$html .= '<img src="'. $imagen->get_ruta(). '" itemprop="thumbnail" alt="Image description" />';

				$html .= '</a>';

				$html .= '<figcaption class="detalles" itemprop="caption description">';

					$html .= '<div class="detalle"><strong>Preparacion de: </strong><span>'.$imagen->get_preparacion().'</span></div>';
					$html .= '<div class="detalle"><strong>Tinción usada: </strong><span>'.$imagen->get_tenido().'</span></div>';
					$html .= '<div class="detalle"><strong>Diámetro del campo: </strong><span>'.$imagen->get_diametro().'µ</span></div>';
					$html .= '<div class="detalle"><strong>Aumento total: </strong><span>'.$imagen->get_aumento().'x</span></div>';
					$html .= '<div class="detalle"><strong>Autor: </strong><span>'.$imagen->get_rut().'</span></div>';
					$html .= '<div class="detalle"><strong>Fecha: </strong><span>'.$imagen->get_fecha().'</span></div>';

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
                'Sin diametro',
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
                'Sin aumento',
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
/*
function obtener_imagenes( $filtros, $numero, $offset = 0 ) {
    //echo "<pre>";
        //printr_r($filtros);    
    //echo "</pre>";
        
	global $imagenes_prueba;

	$resultado = array();

	if( $offset > 0 ) {
		$offset *= $numero;
		$numero += $offset;
	} else if( $offset < 0 ) {
		$offset = 0;
	}

	for ($i=$offset; $i < $numero; $i++) { 
		$resultado[] = $imagenes_prueba[$i];
	}

	return $resultado;
}*/

/**
 * Devuelve el array con los objetos Imagen a mostrar en la galeria 
 
 * @return array
*/

function obtener_imagenes_bd()
{
    //crear la conexion
    $usuario_bd = 'root';
    $passwd_bd = '1234';
    try {
    //	print "Conectando";
        $conn = new PDO('mysql:host=localhost;dbname=biologia;charset=utf8', $usuario_bd, $passwd_bd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    
    //consulta que obtiene los datos de las imagenes ordenadas desde la fecha mas actual hasta la mas antigua
    $stmt = $conn->prepare("SELECT Id,RutAlumno,Ruta,DescripcionBreve,TipoTenido,Preparacion,Diametro,Aumento,DATE_FORMAT(Fecha, '%d/%m/%y') AS FechaFormato, RutaDibujo FROM Repositorio ORDER BY Fecha DESC");
    $stmt->execute();
    
    //pasar los datos a un array
    while( $fila = $stmt->fetch()){
        echo $fila['Id'];
        echo $fila['RutAlumno'];
        echo $fila['Ruta'];
        echo $fila['DescripcionBreve'];
        echo $fila['Preparacion'];
        echo $fila['Diametro'];
        echo $fila['Aumento'];
        echo $fila['FechaFormato'];
        echo $fila['RutaDibujo'];
        
        $foto = getimagesize( $fila['Ruta'] );
        $ancho = $foto[0]; // se guarda el ancho de la imagen
        $alto = $foto[1]; // se guarda el alto de la imagen 
        
        echo $ancho;
        echo $alto;
        
        $fotosGaleria[] = new Imagen($fila['Id'],$fila['RutAlumno'],$fila['Ruta'],$fila['DescripcionBreve'],$fila['TipoTenido'],$fila['Preparacion'],$fila['Diametro'],$fila['Aumento'],$fila['RutaDibujo'],$fila['FechaFormato']);
    }
    
    // retornar el array con las imagenes
    return $fotosGaleria;
}

function obtener_imagenes( $imagenes, $numero, $offset = 0 ) {
    //echo "<pre>";
        //printr_r($filtros);    
    //echo "</pre>";
        
    $imagenes_prueba = $imagenes;

	$resultado = array();

	if( $offset > 0 ) {
		$offset *= $numero;
		$numero += $offset;
	} else if( $offset < 0 ) {
		$offset = 0;
	}

	for ($i=$offset; $i < $numero; $i++) { 
		$resultado[] = $imagenes_prueba[$i];
	}

	return $resultado;
}

