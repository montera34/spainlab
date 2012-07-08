<article id="post-<?php the_ID(); ?>" <?php post_class(); // dows in need to be article? ?>>

	<header class="art-tit">
		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
		if ( post_custom('thumbimg') ) {
			// get thumbnail image custom field value
			$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
			$thumb_out = "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;'></span>";
		} else { $thumb_out = ""; }
		if ( post_custom('integrantes') ) {
			// get integrantes custom field values
			$integrantes = get_post_meta($post->ID, 'integrantes', true);
			$integ_out = "<span class='sub-tit-1'>" .$integrantes. "</span>"; 
		} else { $integ_out = ""; }
		echo $thumb_out;
		echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		echo $integ_out;
		?>
	</header><!-- end .art-pre -->

</article>

