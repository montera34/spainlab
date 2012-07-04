<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="art-tit">
		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
		echo "<h2><a href='$post_perma' title='Permalink to $post_tit' rel='bookmark'>$post_tit</a></h2>";
		?>
	</header><!-- end .art-pre -->

	<section>
		<?php the_excerpt_rss(); ?>
	</section>

</article>

