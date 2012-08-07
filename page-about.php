<?php
/*
Template Name: About
*/
get_header();
?>

<?php // this page loop
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$max_w = "500";
		include "loop.video.php";
		include "loop.attachment.php";
		include "loop.page.php";
	endwhile;
else :
endif; ?>


<?php // related content loop
//wp_reset_postdata();
$post_parent = get_the_ID();
$rl_tit = "Curatorial commite";
$args = array(
	'posts_per_page' => -1,
	'nopaging' => 'true',
	'post_type' => 'page',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_parent' => $post_parent
);
$related_query = new WP_Query( $args );
if ( $related_query->have_posts() ) :
	echo "<section id='related' class='about'>";
	while ( $related_query->have_posts() ) : $related_query->the_post();
		include("loop.related.php");
	endwhile;
	echo "</section><!-- end #related -->";
else :
// if no related posts, code in here
endif;
?>

<?php get_footer(); ?>
