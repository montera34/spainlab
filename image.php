<?php
get_header();
?>

<?php 

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		// common vars
		$post_perma = get_permalink();
		$post_tit = get_the_title();
		// post subtitle
		$post_author = get_the_author(); 
		$post_time = get_the_time('F d, Y');
		$post_tit = get_the_title($post->post_parent); //calling the title of the post, not of the image
		$link_post_tit = get_permalink($post->post_parent);
		$back_to_post = "&laquo; Back to <a href=\"" .$link_post_tit. "\" rev=\"attachment\" title=\"Back to" .$post_tit. "\">  " .$post_tit. "</a>";
		$post_tit = $back_to_post;
		$attachment_tit = get_the_title();
	//	$caption = get_post_excerpt();
		$prev_img = get_previous_image_link();
		$next_img = get_next_image_link();
		$navigation_attachment = "<div id=\"navegation-attachment\" class=\"navigation\"> <div class=\"nav-image-left\">" .$prev_img. "</div><div class=\"nav-image-middle\">" .$attachment_tit. "</div><div class=\"nav-image-right\">" .$next_img. "</div></div>";
		
		
	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
			<header class="art-pre">
				<?php
				echo "<h1 class='art-tit'>" .$post_tit. "</h1>";
				echo "<span class='sub-tit-1'>" .$post_subtit. "</span>";
				?>
			</header><!-- end .art-pre -->
			<section class="page-text" id="content-txt">
				<?php
				echo $navigation_attachment;				
				if (wp_attachment_is_image($post->id)) {
				$att_image = wp_get_attachment_image_src( $post->id, "full");
				?>
					<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo $att_image[0];?>" width="750<?php //echo $att_image[1];?>" height="<?php //echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
					</a>
				</p>
				<?php 
					
				the_excerpt(); 
				} ?>
				<?php
				edit_post_link('Editar', '', '');
				wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
				?>
			</section>

		</article>
		<?php
	
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
