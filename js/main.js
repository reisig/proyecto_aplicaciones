/**
 * Este archivo contiene todas las funciones que son utilizadas por la pagina.
 *
 * INDICE
 *
 */

$( document ).ready(function() {

	/*------------------------------------
			Filtros galeria.
	  ------------------------------------*/

	$('#busqueda .lista-valores .valor').on('click', function( event ){
		if( !$(event.target).hasClass('texto-otro') ) {
			var $icono = $(this).find('.icono');
			var $checkbox = $(this).find('.entrada-valor');

			if( $(this).hasClass('seleccionado') ) {
				$(this).removeClass('seleccionado');
				$checkbox.prop('checked', false);

				if( $(this).hasClass('valor-otro') ) {
					$(this).find('.texto-otro').css('display', 'none');
				}
			} else {
				$(this).addClass('seleccionado');
				$checkbox.prop('checked', true);

				if( $(this).hasClass('valor-otro') ) {
					$(this).find('.texto-otro').css('display', 'block');
				}
			}
		}
	});

	/*------------------------------------
			Paginacion galeria.
	  ------------------------------------*/

	$('.paginacion .pagina').on('click', function( event ){
		event.preventDefault();

		console.log('message');

		var $offset = $('#offset');

		$offset.val($(this).data('numero'));

		$("#busqueda .realizar-busqueda").click();
	});

});
