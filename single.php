<?php
get_header();
?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		if ( get_post_type() == 'post' ) {
		} else {
			$max_w = "500";
			include "loop.video.php";
			//defining size of thumbnails in gallery
			$img_post_parent = get_the_ID();
			$img_amount = -1;
			$mini_size = array(48,48);
			$medium_size = "medium";
			$custom_width = "500";
			include "loop.attachment.php";
		}

		include "loop.single.php";

		if ( get_post_type() == $general_options['pt_r'] || get_post_type() == 'post' ) {
			echo "<div class='part-mid1'>";
			comments_template();
			echo "</div>";
		}

	endwhile;

else :
endif; ?>

<?php // related content to this post
// Reset Post Data
wp_reset_postdata();
if ( get_post_type() == $general_options['pt_a'] ) {
	// if post type architect
	// display related posts
	$pt = 'post';
	$rl_tit = "Related content";
	$args = array(
		'posts_per_page' => -1,
		'post_type' => $pt,
//		'orderby' => '',
		'tag' => $wp_query->query_vars['name'],
	);
	$related_query = new WP_Query( $args );
	if ( $related_query->have_posts() ) :
		echo "
		<section id='related'>
			<header class='section-tit'><h2>" .$rl_tit. "</h2></header>";
		while ( $related_query->have_posts() ) : $related_query->the_post();
			include "loop.related.php";
		endwhile;
		echo "</section><!-- end #related -->";
	else :
	// if no related posts, code in here
	endif;
} // end if custom type architect ?>


<?php get_footer(); ?>
