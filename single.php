<?php
get_header();
?>

<?php 
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		include "loop.video.php";


		$img_post_parent = get_the_ID();
		$img_amount = -1;
		$mini_size = array(100,100);
		$medium_size = "medium";
		$custom_width = "500";
		include "loop.attachment.php";

		// echoing attachment
		// this can be done anywhare after include "loop.attachment.php" code
		echo $attach_out;
		include("loop.single.php");
		
		
		
	endwhile;

else :
endif; ?>

<?php get_footer(); ?>
