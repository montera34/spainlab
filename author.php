<?php get_header(); ?>

<!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
	
<div id="blog" class="part-mid1">

<h1>Posts by <?php echo $curauth->nickname; ?>:</h1>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php
   						 //necessary to show the tags 
   						 global $wp_query;
						$wp_query->in_the_loop = true;

			global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
			$more = 0; 
		include "loop.post.php";
?>

    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.'); ?></p>

    <?php endif; ?>
	
	<?php include "navigation.php"; ?>	
</div>

<?php 
//if post type: get_post_type() == 'post'
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
	//$post_category = get_categories();
	//$post_category = the_category(', ');
	
	// test... fix this. just trying to output the post categories
	//$categories=  get_categories();
	//foreach ($categories as $category) {
	//	$post_category_1 = $category->name;
	//	echo $option;
	//  }
	
	//$post_category_1= $post_category[0];
	//	if($category[0]){
	//	$post_category_first = '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
	//	}
	$post_tags = get_the_tags('<span class="tags">tags:&nbsp;','  ','</span>' );
	$post_metadata = "".$post_time. " ".$post_category. "".$post_tags. "";
	$post_subtit = "Posted by <em>" .$post_author. "</em> " .$post_metadata. " " ;
	
	$args = array(
	'posts_per_page' => '1',
);
$related_query = new WP_Query($args);
if ( $related_query->have_posts() ) :
	while ( $related_query->have_posts() ) : $related_query->the_post();?>
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
	<?php
	endwhile;
else :
endif; ?>

<?php get_footer(); ?>
