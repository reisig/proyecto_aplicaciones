<?php 
/**
 * Este archivo muestra la galeria de imagnes (repositorio).
 *
 * @package RepBiologia
 * @since RepBiologia 1.0
 */

/*Gran parte del codigo de este archivo no es el codigo final, solo se hizo para
  probar la pagina. */

require_once( __DIR__. '/cabecera.php' );

 ?>

		<?php $offset = obtener_offset(); ?>
		
		<?php //$imagenes = obtener_imagenes($_GET, 14, $offset-1); ?>
        <?php $imagenes = obtener_imagenes( obtener_imagenes_bd(), 14, $offset-1); ?>
            
		<?php 
		//global $usuario;

		//if( $usuario->tipo == 'administrador' ): ?>

			<div id="visorComparacion" class="visor-comparacion" style="display: none;">

				<div class="pswp__top-bar"><button id="cerrarComparacion" class="pswp__button cerrar-comparacion" title="Cerrar Dibujo"></button></div>

				<div id="contenedorComparacion" class="contenedor-comparacion">

					<div class="cr-fotografia col-sm-6"><img src="<?php echo (!empty($imagen_defecto) ? $imagenes->get_ruta() : ''); ?>" alt="Fotografia" id="fotografia" class="img-responsive" /></div>
					<div class="cr-dibujo col-sm-6"><img src="<?php echo (!empty($imagen_defecto) ? $imagenes->get_ruta_dibujo() : ''); ?>" alt="Dibujo fotografia" id="dibujo" class="img-responsive" /></div>

				</div>

			</div>

		<?php //endif; ?>

		<main id="galeria" data-estado="0">

			<div class="contenedor-filtros">

				<div class="mostrar-filtros" data-toggle="collapse" data-target="#collapse-filtros" aria-expanded="false" aria-controls="collapse-filtros">

					<div class="container">

						<span class="busqueda-filtros titulo">Realizar búsqueda por filtros</span>

					</div>

				</div>

				<div id="collapse-filtros" class="filtros collapse">

					<div class="container">

						<form id="busqueda" method="get">

							<span class="todos titulo">Marcar todos los filtros</span>

							<!-- indica si se busca por todos los filtros -->
							<input type="hidden" name="todos" value="0">

							<!-- indica el numero de pagina a mostrar (offset) -->
							<input type="hidden" id="offset" name="offset" value="<?php echo $offset; ?>">

							<div class="row">

								<div class="col-sm-8">

									<?php filtros(obtener_filtros()); ?>

								</div>

								<div class="filtros col-sm-4">

									<!-- filtro alumnos -->

									<!-- filtro fecha -->

								</div>

								<div class="col-xs-12"><button class="realizar-busqueda" type="submit" form="busqueda" value="Submit"><i class="fa fa-search"></i> Realizar Búsqueda</button></div>

							</div>

						</form>

					</div>

				</div>

			</div>

			<div class="contenedor-imagenes">

				<?php echo obtener_imagenes_galeria($imagenes); ?>

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

				                <?php //if( $usuario->tipo == 'administrador' ): ?>

				                	<button id="botonComparacion" class="pswp__button" title="Dibujo"><i class="fa fa-files-o"></i></button>

				                <?php //endif; ?>

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

				<?php echo obtener_paginacion_galeria(obtener_total_imagenes(), 14, $offset); ?>

			</div>

		</main>

<?php require_once( __DIR__. '/pie-pagina.php' ); ?>
