jQuery(window).load(function(  ){

	var $grid = jQuery('.grid').imagesLoaded( function() {
		$grid.masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-item',
			percentPosition: true
		});
	});

});