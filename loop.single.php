<?php
// common vars
$post_perma = get_permalink();
$post_tit = get_the_title();

// vars depending on the post type
if ( get_post_type() == $general_options['pt_a'] || get_post_type() == $general_options['pt_s'] ) {
	// if architects post type or scientifics post type
	// author bio
	$bio = get_the_excerpt();
	// author thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
	}
	// post subtitle
	if ( post_custom('integrantes') ) {
		// get integrantes custom field values
		$integrantes = get_post_meta($post->ID, 'integrantes', true);
		$post_subtit = "Project statement by <em>" .$integrantes. "</em>";
		// author name
		$author = $integrantes;
	} else { $integ_out = ""; }

} else {
//} elseif ( get_post_type() == $general_options['pt_r'] || get_post_type() == 'post' ) {
	// if remotes post type
	// author bio
	$bio = get_the_author_meta('description');
	// author name
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$author = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $author = get_the_author_meta('display_name'); }
	// author thumb
//	$post_thumbing = get_avatar( get_the_author_meta('ID'), 128 );
	// post subtitle
	$post_author = get_the_author(); 
	$post_subtit = "Posted by <em>" .$post_author. "</em>";
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
		<section class="page-text">
			<?php
			the_content();
			edit_post_link('Editar', '', '');
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			?>
		</section>

	</article>

	<aside id="bio">
		<div class="architects">
			<?php if ( isset($post_thumbimg) ) { echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;' ></span>"; } ?>
			<header><h2><?php echo $author; ?></h2></header>
			<?php if ( $bio != '' ) { ?><span class='sub-tit-1'>bio</span><?php } ?>
		</div><!-- end .architects -->
		<div class='page-text'>
			<?php if ( $bio != '' ) { echo $bio; } ?>
		</div><!-- end .page-text -->
	</aside><!-- end #bio -->
