		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class='art-tit'>
				<a class="" href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			
			<div class="postmetadata">
				Author: <em><?php the_author_posts_link(); ?></em> | Date: <?php the_time('F d, Y') ?>
			</div>
			<div class="page-text">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>	
			<div class="postmetadata">
				Context: <?php the_category(', ') ?> | <?php the_tags('<span class="tags">','  ','</span> | ' ); ?>Conversation: <?php comments_popup_link('0&nbsp;comments', '1&nbsp;comment', '%&nbsp;comments'); ?> 
			</div>

		</article><!-- end article post -->
