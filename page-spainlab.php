<?php
/*
Template Name: Spain Lab
*/
get_header();
?>

<?php // this page loop
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$max_w = "500";
		include "loop.video.php";
		//defining size of thumbnails in gallery
			$img_post_parent = get_the_ID();
			$img_amount = -1;
			$mini_size = array(48,48);
			$medium_size = "medium";
			$custom_width = "500";
		include "loop.attachment.php";
		include "loop.page.php";
	endwhile;
else :
endif; ?>


<?php // related content loop
//wp_reset_postdata();
$pt = $general_options['pt_a'];
$rl_tit = "Architects";
$args = array(
	'posts_per_page' => -1,
	'nopaging' => 'true',
	'post_type' => $pt,
	'orderby' => 'rand',
);
$related_query = new WP_Query( $args );
if ( $related_query->have_posts() ) :
	echo "<section id='related'>
	<header class='section-tit'><h2><!--" .$rl_tit. "--></h2></header>";
	while ( $related_query->have_posts() ) : $related_query->the_post();
		include("loop.related.php");
	endwhile;
	echo "</section><!-- end #related -->";
else :
// if no related posts, code in here
endif;
?>

<?php get_footer(); ?>
