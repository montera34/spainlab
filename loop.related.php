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
	// if remotes post type
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
	} else { unset($post_thumbimg); }


} elseif ( get_post_type() == $general_options['pt_s'] ) {
	// if scientific post type
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( post_custom('institution') ) {
		$post_subtit = get_post_meta($post->ID, 'institution', true);
	} else { unset($post_subtit); }
	// related thumb
	if ( post_custom('thumbimg') ) {
		// get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true);
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }

} elseif ( get_post_type() == 'post' ) {
	// if is a post
	if ( isset($authorr) ) {
	// if academic lab
//	print_r($author);
		$auth_id = $authorr->ID;
		$author_vars = get_userdata($auth_id);
		$auth_tw = $author_vars->twitter;
		// related subtit
		if ( $auth_tw != '' ) {
			$post_subtit = "@" .$auth_tw;
		} else { $post_subtit = ""; }
		// related tit
		$post_tit = $author_vars->display_name;
//		if ( get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '' ) {
//			$post_tit = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
//		} else { $post_tit = get_the_author_meta('display_name'); }
		$post_perma = $general_vars['blogurl']. "/author/" .$author_vars->user_login;
		//related excerpt
//		$post_excerpt = $author_vars->description;
		$post_excerpt = "";
		// related thumb
		$post_thumbimg = get_avatar( $auth_id, 128 );
		
	} else {
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
} elseif ( get_post_type() == 'page' ) {
		// if curatorial commite inside about page
	// related tit
	$post_tit = get_the_title();
	// related subtit
	if ( post_custom('subtitle') ) {
		// get integrantes custom field values
		$authors = get_post_meta($post->ID, 'subtitle', true);
		$post_subtit = $authors;
	}
	// related thumb
	if ( post_custom('project_url') ) {
		// get integrantes custom field values
		$url = get_post_meta($post->ID, 'project_url', true);
		$post_url = "<a href='>" .$url. "'>" .$url. "</a>";
	}

	$img_post_parent = get_the_ID();
	$img_amount = 1;
	$mini_size = array(150,150);
	include "loop.attachment.php";
	if ( isset($img_mini) ) {
		$post_thumbimg = $img_mini_vars[0];
		$post_thumbimg = "<img src='" .$post_thumbimg. "' alt='Author image' />";
	} else { unset($post_thumbimg); }
	$post_excerpt = get_the_excerpt();
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="art-tit">
		<?php
		if ( isset($post_thumbimg) ) {
			// if there is image attachted
			//echo "<span class='img-background' style='background: url(" .$post_thumbimg. ") center center no-repeat #eee;'></span>";
			echo "<div class='img-background'>" .$post_thumbimg. "</div>";
			$post_excerpt_stl = "";
		} else { $post_excerpt_stl = " style='margin-left: 0;'"; }
		if ( get_post_type() == 'page' ) {
			echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		} else {
			echo "<h2><a href='" .$post_perma. "' title='Permalink to " .$post_tit. "' rel='bookmark'>" .$post_tit. "</a></h2>";
		}
		echo "<span class='sub-tit-1'>" .$post_subtit. "</span>"; 
		if ($post_excerpt) {
			echo "<span class='page-text excerpt'$post_excerpt_stl>" .$post_excerpt. "</span>"; //only used for remotes and curatorial commite (about subpages)
		}
		?>
	</header><!-- end .art-pre -->

	<?php // comments
	if ( get_post_type() == $general_options['pt_r'] && comments_open() && ! post_password_required() ) {
		$post_perma = $post_perma. "#respond";
	?>
		<section class='post_meta'>
			<div class="post_meta_item"><a href="<?php echo $post_perma; ?>"><?php human_comment_count(); ?></a></div>
			<div class="post_meta_item"><?php GetWtiLikePost();?></div>
		</section>
	<?php } ?>

</article>

