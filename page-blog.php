<?php
/*
Template Name: Blog
*/
get_header();
?>

<div id="blog" class="part-mid1">
<?php // this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
//		include("loop.page.php");
	endwhile;
else :
endif; ?>
 <?php rewind_posts(); ?>

<?php
//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
// also found help in http://wordpress.org/support/topic/more-tag-ignored-on-home-page
$args = array(
  'caller_get_posts' => 1
);
if ( $paged > 1 ) {
  $args['paged'] = $paged;
}
 
$related_query = new WP_Query($args);


?>
<?php if ( $related_query->have_posts() ) : ?>
  		<?php while ( $related_query->have_posts() ) : 
 			 $related_query->the_post(); 
			 ?>
			 <?php
   						 //necessary to show the tags 
   						 global $wp_query;
						$wp_query->in_the_loop = true;

global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
$more = 0; 
		include "loop.post.php";
?>
	
		<?php endwhile; else: ?>		

<?php endif; ?>

<?php include "navigation.php"; ?>			

</div>
<section id='related'>
	<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
</section><!-- end #related -->
<?php get_footer(); ?>
