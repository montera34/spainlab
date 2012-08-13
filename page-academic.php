<?php
/*
Template Name: Academic Lab
*/
get_header();
?>

<div id="blog" class="part-mid1">


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

echo "<section id='academic'>";
// this page loop
if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		$col400 = " style='width: 400px;padding-bottom:0px;'";
		include("loop.page.php");
	endwhile;
else :
endif; 
echo "</section>";

if ( $related_query->have_posts() ) : ?>
	<?php while ( $related_query->have_posts() ) : $related_query->the_post();?>
		<?php endwhile; else: ?>		
<?php endif; ?>

<?php
echo "<section id='related' class='academic'>";

$authors = get_users(array(
	'role' => 'author',
));
echo '<h3 class="widgettitle">List of Authors in the Academic Lab</h3>';
	foreach ( $authors as $authorr ) {
		include("loop.related.php");
	} // end loop authors
echo "</section><!-- end #related -->";
?>

<?php get_footer(); ?>
