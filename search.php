<?php get_header(); ?>

<div class="part-mid1 page-text">
	<h1>"<strong>You've searched for: <?php the_search_query(); ?></strong>"</h1>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<ul class="">
		<li id="post-<?php the_ID(); ?>" <?php post_class('art-tit'); ?>>
			<h2 class='art-tit'>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>" class=""><?php the_title(); ?>
				</a>
			</h2>
			<?php the_excerpt(); ?>
	<?php if ( 'architects' == get_post_type() || 'remotes' == get_post_type() ): //Architects or Remotes ?>

	<?php else: ?>
			
			<p class="postmetadata">Posted on <?php the_time('M d.y') ?> to <?php the_category(', ') ?> &nbsp;
			 <?php comments_popup_link('Add a Comment', '1 Comment', '% Comments'); ?> &nbsp;&nbsp;<?php edit_post_link('Edit', '', ''); ?>
			</p>
	<?php endif; ?>
		</li>
	</ul>

	<?php endwhile; ?>

	<?php include "navigation.php"; ?>

	<?php else : ?>
	
	

	<?php endif; ?>
	<ul>
		<li>Nothing was found.</li>
	</ul>
</div>

<?php get_footer(); ?>
