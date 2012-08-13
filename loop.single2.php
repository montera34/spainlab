<?php
// common vars
$post_perma = get_permalink();
$post_tit = get_the_title();

// vars depending on the post type
if ( get_post_type() == $general_options['pt_a'] ) {
	// if architects post type
	// author bio
	$bio = get_the_excerpt();
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
	// post subtitle
	if ( post_custom('integrantes') ) {
		// get integrantes custom field values
		$integrantes_extra = get_post_meta($post->ID, 'integrantes_extra', true);
		$integrantes = get_post_meta($post->ID, 'integrantes', true) ;
		$post_subtit = "Project statement by <em>" .$integrantes. " " .$integrantes_extra. "</em>";
		// author name
		$author = $integrantes;
	} else { $integ_out = ""; }

} elseif ( get_post_type() == $general_options['pt_s'] ) {
	// if scientifics post type
	// author bio
	$bio = get_the_excerpt();
	$post_subtit = get_post_meta($post->ID, 'institution', true) ;
	
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
	// author name
	$author = get_the_title();

} elseif ( get_post_type() == $general_options['pt_r']  ) {
//} elseif ( get_post_type() == $general_options['pt_r'] || get_post_type() == 'post' ) {
	// if remotes/project from open lab post type 
	// author bio
	$bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	// author thumb
	$post_thumbimg = get_avatar( get_the_author_meta('ID'), 128 );
	// post subtitle
	$post_author = get_the_author(); 

} elseif ( get_post_type() == 'attachment'  ){
	//if post type: is an attachment
	// author bio
	$bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	// author thumb
	$post_thumbimg = get_avatar( get_the_author_meta('ID'), 128 );
	// post subtitle
	$post_author = get_the_author(); 
	$post_time = get_the_time('F d, Y');
	$post_tit = get_the_title($post->post_parent); //calling the title of the post, not of the image
	$link_post_tit = get_permalink($post->post_parent);
	$back_to_post = "&laquo; Back to post <a href=\"" .$link_post_tit. "\" rev=\"attachment\" title=\"Back to" .$post_tit. "\">  " .$post_tit. "</a>";
	$post_tit = $back_to_post;
	$attachment_tit = get_the_title();
	$prev_img = get_previous_image_link();
	$next_img = get_next_image_link();
	$navigation_attachment = "<div id=\"navegation-attachment\" class=\"navigation\"> <div class=\"nav-image-left\">" .$prev_img. "</div><div class=\"nav-image-middle\">" .$attachment_tit. "</div><div class=\"nav-image-right\">" .$next_img. "</div></div>";
	
}

else {
	//if post type: get_post_type() == 'post'
	// author bio
	$blogger_bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	$post_author = "<a href='" .get_author_posts_url(get_the_author_meta( 'ID' )). "'>" .get_the_author_meta('display_name'). "</a>";
	// author thumb
	$post_thumbimg = get_avatar( get_the_author_meta('ID'), 64 );
	// post subtitle
	$post_time = get_the_time('F d, Y');
	$post_categories = get_the_category();
	$cats_out = "";
	$tags_out = "";
	$separator = "  ";
	foreach ( $post_categories as $category ) {
		$cats_out .= '<strong><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></strong>' .$separator;
	}
	$post_tags = get_the_tags();
	if ($post_tags) {
		$sepcatstags = ", ";
		foreach( $post_tags as $tag ) {
			$tags_out .= '<a href="' .get_tag_link($tag->term_id). '">' .$tag->name. '</a>' .$separator;
		}
	} else { $sepcatstags = ""; }

	$post_subtit = "Date: " .$post_time. " | Context: " .$cats_out . $sepcatstags . $tags_out;
}

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('part-mid1'); ?>>

		<?php
		// echoing attachments for jQuery gallery: images and videos if any
		// this can be done anywhare after include "loop.attachment.php" code
		if ( isset($attach_out) ) {
			echo $attach_out;
		}
		?>

		<header class="art-pre">
			<?php
			echo "<h1 class='art-tit'>" .$post_tit. "</h1>";
			echo "<div class='postmetadata'>" .$post_subtit ;
			edit_post_link('Editar', ' | ', '');
			echo "</div>";
			?>
		</header><!-- end .art-pre -->
		<section class="page-text" id="content-txt">
			<?php
			echo $navigation_attachment;
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			the_content();
			?>
		</section>

<?php if ( get_post_type() == 'post' ) {
// if blog ?>
		<section class="blogger postmetadata">
			<?php if ( isset($post_thumbimg) ) {
				//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;' ></span>";
				echo "<div class='blogger-avatar'>" .$post_thumbimg. "</div>";
				$style_img = "style='margin-left: 73px;'";
			} ?>
			<div class="blogger-tit"<?php if ( isset($style_img) ) { echo " " .$style_img; } ?>>Content posted by <em><?php echo $author ?></em>.</div>
			<div class="blogger-bio"<?php if ( isset($style_img) ) { echo " " .$style_img; } ?>><?php echo $blogger_bio ?></div>
		</section><!-- end .blogger -->
			<?php // last posts by this author
			$args = array(
				'author' => get_the_author_meta('ID'),
				'posts_per_page' => '6',
				'post__not_in' => array( get_the_ID() )
			);
			$blogger_query = new WP_Query( $args );
			if ( $blogger_query->have_posts() ) : ?>
		<section class="blogger postmetadata">
				<div class="blogger-tit ">Other posts by this author:</div>
				<ul class="blogger-rel">
				<?php while ( $blogger_query->have_posts() ) : $blogger_query->the_post();
				//defining size of thumbnails in gallery
				$img_post_parent = get_the_ID();
				$img_amount = 1;
				$mini_size = array(48,48);
				include "loop.attachment.php";
?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title(); ?>"><?php echo $attach_out; ?><div class="blogger-rel-tit"><?php the_title(); ?></div></a></li>
				<?php unset($attach_out); endwhile; ?>
				</ul>
		</section><!-- end .blogger -->
			<?php else :
			endif;
			?>
<?php } ?>
	</article>

<?php if ( get_post_type() == 'post' ) {
	// if blog ?>
	<section id='related'>
		<?php if ( ! dynamic_sidebar( 'bar-3' ) ) : ?><?php endif; // end blog widget area ?>
	</section><!-- end #related -->
<?php } else { ?>
	<aside id="bio">
		<div class="architects">
			<?php if ( isset($post_thumbimg) ) {
				//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;' ></span>";
				echo "<div class='img-background'>" .$post_thumbimg. "</div>";
			} ?>
			<header><h2><?php echo $author; ?></h2></header>
			<?php if ( $bio != '' ) { ?><span class='sub-tit-1'>bio</span><?php }
			elseif ( 1 == 2 ) {} ?>
		</div><!-- end .architects -->
		<div class='page-text'>
			<?php if ( $bio != '' ) { echo $bio; } ?>
		</div><!-- end .page-text -->
	</aside><!-- end #bio -->

<?php } ?>
