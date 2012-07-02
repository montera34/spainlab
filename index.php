<?php
get_header();
?>


<?php // featured information: display first sticky post
$args = array(
	'posts_per_page' => 1,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
$sticky_query = new WP_Query( $args );
if ( $sticky_query->have_posts() ) :
	echo "<section id='featured'><header class='section-pre'><h1>Información destacada</h1></header>";
	while ( $sticky_query->have_posts() ) : $sticky_query->the_post();
		include("loop.php");
	endwhile;
	echo "</section><!-- end #featured -->";
else :
// if no sticky posts, last post will be shown
endif; ?>

<?php // last news
$args = array(
	'posts_per_page' => 5,
	'post__not_in' => get_option( 'sticky_posts' ),
//	'ignore_sticky_posts' => 1
);
$news_query = new WP_Query( $args );
if ( $news_query->have_posts() ) :
	echo "<section id=news'><header class='section-pre'><h1>Novedades</h1></header>";
	while ( $news_query->have_posts() ) : $news_query->the_post();
		include("loop.php");
	endwhile;
	echo "</section><!-- end #news-->";
else :
// if no sticky posts, last post will be shown
endif; ?>


<?php get_footer(); ?>
