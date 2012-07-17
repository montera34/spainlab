// minimum jQuery gallery
// click on thumbs nav system
var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('.zoom-item').hide();
	$j('.zoom-item:first').show().addClass('visto');
	$j('.single-thumb:first').addClass('access-off');
	// thumbs classes
	$j('div.single-thumb img').each(
		function( j ) {
			var $counter = (j+1);
			var $access = 'access-' + $counter;
			$j(this).addClass($access);
		}
	);
	// zoom items classes and click effect
	var $maxHeight = 0;
	$j('div.zoom-item').each(function( i ) {
		var $currentHeight = $j(this).height();
		if ( $currentHeight > $maxHeight ) {
			$maxHeight = $currentHeight;
		}
			var $counter = (i+1);
			var $access = 'access-' + $counter;
			$j(this).addClass($access);
			$j('img.'+ $access ).click(function() {
				if ( $j(this).hasClass('access-off') ) {
				} else {
					$j('.access-off').removeClass('access-off');
					$j('.visto').fadeOut('100').removeClass('visto');
					$j(this).addClass('access-off');
					$j('div.' + $access ).fadeIn('800').addClass('visto');
				}
			});
	});
	$maxHeight = $maxHeight+10;
	$j('#visor').css({height: $maxHeight + 'px', position: 'absolute', top: '0px'});
	$maxHeight = $maxHeight+80;
	//establecería condicional: si sólo hay una imagen entonces no aparece el hueco bajo el #visor. para el problema de spain-lab, algo tipo:
	//if(typeof(variable) != "undefined" && variable !== null) {
	//	bla();
	//	}
	$j('#single-gallery').css({height: $maxHeight + 'px',position: 'relative',}); //puse la position en relative y todo funcionó. el #selector lo necesitaba	
	$j('.zoom-item').css({position: 'absolute', top: '0px'});
	$j('.part-single-gal').css({'min-height': $maxHeight + 'px'});
	$j('#selector').css({position: 'absolute', bottom: '0px'});
});
