// minimum jQuery gallery
// click on thumbs nav system
var $j = jQuery.noConflict(); // avoid conflict with WordPress
$j(document).ready(function(){
	$j('.zoom-item').hide();
	$j('.zoom-item:first').show().addClass('visto');
	$j('.single-thumb:first').addClass('access-off');
	// thumbs classes
	var $selectorHeight;
	var $thumbCounter = 0;
//	var $groupCounter = 1;
	$j('div.single-thumb').each(
		function( j ) {
			$thumbCounter = (j+1);
			if ( $thumbCounter == 1 ) {
				$selectorHeight = $j(this).height()+10;
//				$j(this).before('<div class="desliza"></div>');
//				$j(this).addClass('har');
			}
//			if ( $thumbCounter == 8 * $groupCounter ) {
//				$groupCounter++;
//				$j(this).addClass('har');
//				$j(this).after('</div>');
//			}
//			if ( $thumbCounter == 8 * $groupCounter + 1 ) { 
//				$j(this).before('<div class="desliza">');
//				$j(this).addClass('har');
//			}
			var $access = 'access-' + $thumbCounter;
			$j(this).children().addClass($access);
		}
	);
//	if ( $thumbCounter % 8 == 0 ) {} else {
//		$j('div.single-thumb:last').after('</div>');
//	}
	// zoom items classes and click effect
	var $maxHeight = 0;
	var $counter = 0;
	$j('div.zoom-item').each(function( i ) {
		var $currentHeight = $j(this).height();
		if ( $currentHeight > $maxHeight ) {
			$maxHeight = $currentHeight;
		}
			$counter = (i+1);
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
	$maxHeight = $maxHeight+$selectorHeight+10;
//	$galleryHeight = $selectorHeight; //hacer esta altura variable en función del número de thumbnails [if $counter >  y que solo afecte a los que tengan  $counter>1
	$j('#single-gallery').css({height: $maxHeight + 'px',position: 'relative'}); //puse la position en relative y todo funcionó. el #selector lo necesitaba
	$j('.zoom-item').css({position: 'absolute', top: '0px'});
	$j('.part-single-gal').css({'min-height': $maxHeight + 'px'});
	if ( $counter==1 ) {
		$j('#selector').hide();
		$j('#visor').css({height: $maxHeight + 'px', position: 'absolute', top: '0'});
	}
//	else { $j('#selector').css({position: 'absolute', top: '5px', left: '5px', opacity: '0.9', width: '490px', height: $selectorHeight + 'px'}); }
	else {
		$j('#selector').css({position: 'relative', opacity: '0.9', width: '500px', height: $selectorHeight + 'px'});
		$j('#visor').css({height: $maxHeight + 'px', position: 'absolute', top:  $selectorHeight + 'px'});
	}
//});


// thumb slide pagination when more than system
//$j(document).ready(function(){
	var currentPosition = 0;
	var slideWidth = 464;
	var slides = $j('.desliza');
	var numberOfSlides = slides.length;

	// Remove scrollbar in JS
	$j('#deslizante').css({overflow: 'hidden', width: slideWidth + 'px', margin: '0 auto'});

	// Wrap all .slides with #slideInner div
	slides
	.wrapAll('<div id="slideInner"></div>')
	// Float left to display horizontally, readjust .slides width
	.css({float: 'left',width: slideWidth + 'px'});


	// Set #slideInner width equal to total width of all slides
	$j('#slideInner').css({width: slideWidth * numberOfSlides + 'px','margin-left': '0'});

	// Insert left and right arrow controls in the DOM
	$j('#selector')
	//.append('<div class="dosifica-nav"><span style="position: absolute; right: 20px; top: 0;" class="control" id="leftControl" href="javascript:previous();" title="Previous">&laquo;</span><span style="position: absolute; right: 0; top: 0;" class="control" id="rightControl" href="javascript:next();" title="Next">&raquo;</span></div>')
	.prepend('<div style="position: absolute; left: 0; top: 0;" class="control" id="leftControl" href="javascript:previous();" title="Previous">&laquo;</div>')
	.append('<div style="position: absolute; right: 0; top: 0;" class="control" id="rightControl" href="javascript:next();" title="Next">&raquo;</div>')

  // Hide left arrow control on first load
  manageControls(currentPosition);

  // Create event listeners for .controls clicks
  $j('.control')
    .bind('click', function(){
    // Determine new position
      currentPosition = ($j(this).attr('id')=='rightControl')
    ? currentPosition+1 : currentPosition-1;

      // Hide / show controls
      manageControls(currentPosition);
      // Move slideInner using margin-left
      $j('#slideInner').animate({
        'marginLeft' : slideWidth*(-currentPosition)
      }, 750 );
    });

  // manageControls: Hides and shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
    if(position==0){ $j('#leftControl').hide() }
    else{ $j('#leftControl').show() }
    // Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $j('#rightControl').hide() }
    else{ $j('#rightControl').show() }
    }
  });
