<?php 
/**
 * Archivo encargado de cargar todas las dependencias 
 * de la pagina.
 *
 * @package RepBiologia
 * @subpackage Scripts
 * @since RepBiologia 1.0
 */

//definicion de constantes.
define('DIR', explode('/scripts', __DIR__)[0] );
define('DIR_SCRIPTS', __DIR__);
define('URI', 'http://192.168.56.103/proyecto_aplicaciones'/*$_SERVER['SERVER_NAME']*/); //esto hay que arreglarlo.
define('URI_JS', URI. '/js');
define('URI_CSS', URI. '/css');

/**
 * Agrega un archivo css.
 *
 * @param $dir_archivo El nombre del archivo ubicado en la carpeta css.
 */
function agregar_css( $dir_archivo ) {
	echo '<link rel="stylesheet" type="text/css" href="'. URI_CSS. '/'. $dir_archivo. '">';
}

/**
 * Agrega un archivo js.
 *
 * @param $dir_archivo El nombre del archivo ubicado en la carpeta js.
 */
function agregar_js( $dir_archivo ) {
	echo '<script type="text/javascript" src="js/'. $dir_archivo. '"></script>';
}

//carga de scripts PHP.

 ?>

