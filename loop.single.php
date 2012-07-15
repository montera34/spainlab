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
		$integrantes = get_post_meta($post->ID, 'integrantes', true);
		$post_subtit = "Project statement by <em>" .$integrantes. "</em>";
		// author name
		$author = $integrantes;
	} else { $integ_out = ""; }

} elseif ( get_post_type() == $general_options['pt_s'] ) {
	// if scientifics post type
	// author bio
	$bio = get_the_excerpt();
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
	// author name
	$author = get_the_title();

} elseif ( get_post_type() == $general_options['pt_r'] || get_post_type() == 'post' ) {
//} elseif ( get_post_type() == $general_options['pt_r'] || get_post_type() == 'post' ) {
	// if remotes post type or post
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
	$post_category = get_the_category();
		if($category[0]){
		$post_category_first = '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
		}
	$post_tags = get_the_tags('<span class="tags">tags:&nbsp;','  ','</span>' );
	$post_metadata = "".$post_time. " Under category".$post_category_first. "".$post_tags. "";
	$post_subtit = "Posted by <em>" .$post_author. "</em> " .$post_metadata. " " ;
} else {
// 
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
			echo "<span class='sub-tit-1'>" .$post_subtit. "</span>";
			?>
		</header><!-- end .art-pre -->
		<section class="page-text" id="content-txt">
			<?php
			the_content();
			edit_post_link('Editar', '', '');
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			?>
		</section>

	</article>

	<aside id="bio">
		<div class="architects">
			<?php if ( isset($post_thumbimg) ) {
				//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;' ></span>";
				echo "<div class='img-background'>" .$post_thumbimg. "</div>";
			} ?>
			<header><h2><?php echo $author; ?></h2></header>
			<?php if ( $bio != '' ) { ?><span class='sub-tit-1'>bio</span><?php } ?>
		</div><!-- end .architects -->
		<div class='page-text'>
			<?php if ( $bio != '' ) { echo $bio; } ?>
		</div><!-- end .page-text -->
	</aside><!-- end #bio -->
