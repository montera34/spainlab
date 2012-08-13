<?php
/*
Template Name: Press
*/
get_header();
?>

<div id="press" class="part-mid1">
<?php // this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>
<?php rewind_posts(); ?>

<?php

$args = array(
	'category_name' => 'press',
);

$related_query = new WP_Query($args);

if ( $related_query->have_posts() ) : ?>
	<?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
   		//necessary to show the tags 
   		global $wp_query;
		$wp_query->in_the_loop = true;

		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		$more = 0;
		include "loop.post.titles.php";
		?>

		<?php endwhile; else: ?>		

<?php endif; ?>

<?php include "navigation.php"; ?>			

</div><!-- end #academic -->



<?php get_footer(); ?>
