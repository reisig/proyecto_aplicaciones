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

		var $offset = $('#offset');

		$offset.val($(this).data('numero'));

		$("#busqueda .realizar-busqueda").click();
	});

	/*------------------------------------
			Comparacion dibujo.
	  ------------------------------------*/

	$('#botonComparacion').on('click', function( event ){
		event.preventDefault();

		$('#visorComparacion').css('display', 'block');
	});

	$('#cerrarComparacion').on('click', function( event ){
		event.preventDefault();

		$('#visorComparacion').css('display', 'none');
	});

	$('#galeria .imagenes > figure').on('click', function( event ){
		event.preventDefault();
		console.log('message');

		var fotografia = $(this).find('img').attr('src');
		var dibujo = $(this).data('dibujo');

		$('#fotografia').attr('src', fotografia);
		$('#dibujo').attr('src', dibujo);
	});

});
