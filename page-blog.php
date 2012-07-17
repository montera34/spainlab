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
		include("loop.page.php");
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
 
$my_query = new WP_Query($args);


?>
<?php if ( $my_query->have_posts() ) : ?>
  		<?php while ( $my_query->have_posts() ) : 
 			 $my_query->the_post(); 
			 ?>
			 <?php
   						 //necessary to show the tags 
   						 global $wp_query;
						$wp_query->in_the_loop = true;

global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
$more = 0; 
  					  ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class='art-tit'>
				<a class="" href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			
			<div class="postmetadata">
				<?php the_time('F d, Y') ?> Category <?php the_category(', ') ?> <?the_tags('<span class="tags">tags:&nbsp;','  ','</span>' ); ?> by <?php the_author_posts_link(); ?> <?php comments_popup_link('0&nbsp;comments', '1&nbsp;comment', '%&nbsp;comments'); ?>
			</div>
			<div class="page-text">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>	
		</article><!-- end article post -->
		<?php endwhile; else: ?>		

<?php endif; ?>
		<div class="navigation">
  			<div class="alignleft"><?php 
				if ( !$max_page ) {
 					 $max_page = $my_query->max_num_pages;
					}
 
				if ( !$paged ) {
 					 $paged = 1;
					}
					$nextpage = intval($paged) + 1;
 
				if ( !is_single() && ( empty($paged) || $nextpage <= $max_page) ) {
  					$attr = apply_filters( 'next_posts_link_attributes', '' );
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Previous entries') .'</a>';
					}
					?>
			</div>
  			<div class="alignright"><?php 
				if ( !is_single() && $paged > 1 ) {
						$attr = apply_filters( 'previous_posts_link_attributes', '' );
						echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Newer entries &raquo;' ) .'</a>';
					}	?>	
			</div>
		</div>
			

</div>
<section id='related'>
	<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
</section><!-- end #related -->
<?php get_footer(); ?>
