<?php get_header(); ?>

<div class="part-mid1 page-text">
	<?php if ( have_posts() ) : ?>

				<header class="">
					<h1 class="">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'twentyeleven' ); ?>
						<?php endif; ?>
					</h1>
				</header>

				<?php //navigation needed  ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>" class="">
						<?php the_title(); ?>
					</a>
					<?php the_excerpt(); ?>

				<?php endwhile; ?>

				<?php //navigation needed  ?>

			<?php else : ?>

				<article id="post-0" class="">
					<header class="">
						<h1 class=""><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

	<?php endif; ?>
</div>

<?php get_footer(); ?>
