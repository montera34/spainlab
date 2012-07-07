<?php
/*
Template Name: Blog
*/
get_header();
?>

<div class="part-mid1 page-text">
<?php // this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>

<?php global $more;    	// Declare global $more (before the loop). "para que seguir leyendo funcione"
			//mirar codigo madre en http://www.hashbangcode.com/blog/create-page-posts-wordpress-417.html
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
			 //necessary to show the tags 
   			global $wp_query;
			$wp_query->in_the_loop = true;?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a class="" href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
			<div class="postmetadata"><?php the_time('d \d\e F \d\e Y') ?> <?php the_category(', ') ?> <?the_tags(' &bull;<span class="tags">tags:&nbsp;','  ','</span>' ); ?> <?php the_author_posts_link(); ?><?php comments_popup_link('0&nbsp;comentarios', '1&nbsp;comentario', '%&nbsp;comentarios'); ?>
			</div>
			<?php the_content('Seguir leyendo &raquo;'); ?>

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
 					 echo '<a href="' . next_posts( $max_page, false ) . "\" $attr>". preg_replace('/&([^#])(?![a-z]{1,8};)/', '&$1', ' &laquo; Entradas anteriores') .'</a>';
					}
					?></div>
  					<div class="alignright"><?php 
					if ( !is_single() && $paged > 1 ) {
  				$attr = apply_filters( 'previous_posts_link_attributes', '' );
  				echo '<a href="' . previous_posts( false ) . "\" $attr>". preg_replace( '/&([^#])(?![a-z]{1,8};)/', '&$1', 'Nuevas entradas &raquo;' ) .'</a>';
					}
				?></div>
				</div>
			</div>
</div><!-- end post -->
</div>

<?php get_footer(); ?>
