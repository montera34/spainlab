<?php
// common vars
$post_perma = get_permalink();

// vars depending on the post type
if ( get_post_type() == $general_options['pt_a'] ) {
	// if architects post type
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( post_custom('integrantes') ) {
		// get integrantes custom field values
		$integrantes = get_post_meta($post->ID, 'integrantes', true);
		$post_subtit = $integrantes;
	}
	// related thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
	} else { unset($post_thumbimg); }

} elseif ( get_post_type() == $general_options['pt_r'] ) {
	// if remotes post type or is a post
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$post_subtit = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $post_subtit = get_the_author_meta('display_name'); }
	// related thumb
//	$max_w = "500";
//	include "loop.video.php";
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(100,100);
	include "loop.attachment.php";
	if ( isset($attach_out) ) {
		$post_thumbimg = $img_mini_vars[0];
	}

} elseif ( get_post_type() == 'post' ) {
	// if is a post
	// related tit
	$post_tit = "related post " .$related_count;
	// related subtit
	$post_subtit = get_the_title();
	// related thumb
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(100,100);
	include "loop.attachment.php";
	if ( isset($attach_out) ) {
		$post_thumbimg = $img_mini_vars[0];
	}

}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); // dows in need to be article? ?>>
	
	<header class="art-tit">
		<?php
		if ( isset($post_thumbimg) ) {
			// if there is image attachted
			echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;'></span>";
		}
		echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		echo "<span class='sub-tit-1'>" .$post_subtit. "</span>"; 
		?>
	</header><!-- end .art-pre -->

</article>

