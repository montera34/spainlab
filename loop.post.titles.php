		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class='art-tit'>
				<a class="" href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			
			<div class="postmetadata">
				Date: <?php the_time('F d, Y') ?>
			</div>

		</article><!-- end article post -->
