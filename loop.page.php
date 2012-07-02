<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="art-pre">

		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
			echo "<h1 class='art-tit'>$post_tit</h1>";

			edit_post_link('Editar', ' &bull; ', ''); ?>
	</header><!-- end .art-pre -->

	<section>
	<div>
			<?php
		the_content();
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
		} ?>
	</div><!-- end class art-text -->

	</section>

</article>

