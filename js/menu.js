var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('.sub-menu').hide();
	$j('li.menu-item').hover(function(){
		$j(this).find('ul.sub-menu').fadeIn('slow');
		if ( $j(this).hasClass('.current-menu-item') ) {
			var current = 'true';
		} else {
			var current = 'false';
			$j(this).addClass('.current-menu-item');
		}
	},
	function(){
		$j(this).find('ul.sub-menu').fadeOut('fast');
		if ( current=='true' ) {
		} else {
			$j(this).removeClass('.current-menu-item');
		}
	});
});
