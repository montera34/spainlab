<article id="post-<?php the_ID(); ?>" <?php post_class('part-mid1'); // I add here the class to put the width. not sure yet where should be! ?>> 
	<?php
	// echoing attachments for jQuery gallery: images and videos if any
	// this can be done anywhare after include "loop.attachment.php" code
	if ( isset($attach_out) ) {
		echo $attach_out;
	}
	?>

	<header class="art-pre">
		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
			echo "<h1 class='art-tit'>$post_tit</h1>";
			edit_post_link('Editar', '', ''); ?>
	</header><!-- end .art-pre -->

	<section class="page-text">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
		?>
	</section>

</article>
