<?php
/*
Template Name: Academic Lab
*/
get_header();
?>

<div id="academic" class="part-mid1">
<?php // this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>
<?php rewind_posts(); ?>

<?php
$author_array_list = get_users(array(
	'role' => 'author',
	'fields' => 'ID'
));
$author_comma_list = implode(",", $author_array_list);
$args = array(
	'author' => $author_comma_list,
);
if ( $paged > 1 ) {
	$args['paged'] = $paged;
}
$related_query = new WP_Query($args);

if ( $related_query->have_posts() ) : ?>
	<?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
   		//necessary to show the tags 
   		global $wp_query;
		$wp_query->in_the_loop = true;

		global $more;    // Declare global $more (before the loop). "para que seguir leyendo funcione"
		$more = 0;
		include "loop.post.php";
		?>

		<?php endwhile; else: ?>		

<?php endif; ?>

<?php include "navigation.php"; ?>			

</div><!-- end #academic -->

<?php // related content loop
$authors = get_users(array(
	'role' => 'author',
));
//echo "<pre>";print_r($authors);echo "</pre>";
echo "<section id='related'>";
	foreach ( $authors as $authorr ) {
		include("loop.related.php");
	} // end loop authors
echo "</section><!-- end #related -->";
?>

<?php get_footer(); ?>
