<article id="post-<?php the_ID(); ?>" <?php post_class(); // dows in need to be article??>>

	<header class="art-tit">
		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		// get integrantes custom field values
		$integrantes = get_post_meta($post->ID, 'integrantes', true);
		echo "<span class='img-background' style='background: url($post_thumbimg) center center no-repeat #eee;' ></span>";
		echo "<h2><a href='$post_perma' title='Permalink to $post_tit' rel='bookmark'>$post_tit</a></h2>";
		echo "<span class='sub-tit-1'>" .$integrantes. "</span>"; 
		?>
	</header><!-- end .art-pre -->

	<section>
		<?php //the_excerpt_rss(); ?>
	</section>

</article>

