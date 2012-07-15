<?php
// common vars
$post_perma = get_permalink();

	// if remotes post type or is a post
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
		$post_subtit = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
	} else { $post_subtit = get_the_author_meta('display_name'); }
	//related excerpt
	$post_excerpt = the_excerpt();
	// related thumb
//	$max_w = "500";
//	include "loop.video.php";
	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(150,150); //I Change it from 120
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
	
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); // dows in need to be article? ?>>
	
	<header class="art-tit">
		<?php
		if ( isset($post_thumbimg) ) {
			// if there is image attachted
			echo "<span class='img-background-remote' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;'></span>";
		}
		echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		echo "<span class='sub-tit-1'>" .$post_subtit. "</span>"; 
		echo "<span class='excerpt'>" .$post_excerpt. "</span>"; 
		?>
	</header><!-- end .art-pre -->

</article>