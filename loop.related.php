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
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }

} elseif ( get_post_type() == $general_options['pt_r'] ) {
	// if remotes post type or is a post
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$post_subtit = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $post_subtit = get_the_author_meta('display_name'); }
	//related excerpt
	$post_excerpt = get_the_excerpt();
	// related thumb
//	$max_w = "500";
//	include "loop.video.php";
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(150,150); //I Change it from 120
	include "loop.attachment.php";
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	}
	// comments
	if ( comments_open() && ! post_password_required() ) {
		$post_comments = human_comment_count();
	} else { unset($post_comments); }

} elseif ( get_post_type() == $general_options['pt_s'] ) {
	// if scientific post type
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( post_custom('institution') ) {
		$post_subtit = get_post_meta($post->ID, 'institution', true);
	} else { unset($post_subtit); }
	// related thumb
	// related thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }

} elseif ( get_post_type() == 'post' ) {
	// if is a post
	// related tit
	$post_tit = get_the_title();
	// related subtit
	$post_subtit = get_the_date();
	// related thumb
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(100,100);
	include "loop.attachment.php";
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }

}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); // dows in need to be article? ?>>
	
	<header class="art-tit">
		<?php
		if ( isset($post_thumbimg) ) {
			// if there is image attachted
			//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;'></span>";
			echo "<div class='img-background'>" .$post_thumbimg. "</div>";
		}
		echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		echo "<span class='sub-tit-1'>" .$post_subtit. "</span>"; 
		if ($post_excerpt) {
			echo "<br /><span class='page-text excerpt'>" .$post_excerpt. "</span>"; //only used for remotes
		}
		?>
	</header><!-- end .art-pre -->

	<?php if ( comments_open() && !post_password_required() && isset($post_comments) ) {
		echo "<section class='post_comments'>" .$post_comments. "</section>";
	} ?>

</article>

