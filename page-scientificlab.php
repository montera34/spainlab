<?php
/*
Template Name: Scientific Lab
*/
get_header();
?>

<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		include("loop.page.php");
		
	endwhile;

else :
endif;

// random video loop from scientific post type
// meter loop de cient'ificos, sacamos un elemento random:
// nombre scientific
// video (first custom field)
// read more
$pt = $general_options['pt_s'];
$rl_tit = "";
$args = array(
	'posts_per_page' => 1,
	'post_type' => $pt,
	'orderby' => 'rand',
);
$random_query = new WP_Query( $args );
if ( $random_query->have_posts() ) :
	echo "<section id='single-gallery' class='part-mid1'>";
	while ( $random_query->have_posts() ) : $random_query->the_post();
		$max_w = "500";
		include "loop.video.php";
/*------------------ I deactivate all this part
		echo "<div class='zoom-item'>" .$video_code[0]. "</div>";
----------------------*/
	endwhile;
	echo "</section><!-- end #single-gallery -->";
else :
// if no related posts, code in here
endif;

?>

<?php // related content loop
$pt = $general_options['pt_s'];
$rl_tit = "Scientifics";
$args = array(
	'posts_per_page' => -1,
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
