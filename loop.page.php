<?php
// common vars
$post_perma = get_permalink(); 	
$post_tit = get_the_title();
$subtitle = get_post_meta($post->ID, 'subtitle', true);
	// author thumb
	//if ( post_custom('subtitle') ) {
	//	$post_subtit = $integrantes;
	//}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('part-mid1'); echo $col400;// I add here the class to put the width. not sure yet where should be! ?>> 
	<?php
	// echoing attachments for jQuery gallery: images and videos if any
	// this can be done anywhare after include "loop.attachment.php" code
	if ( isset($attach_out) ) {
		echo $attach_out;
	}
	?>

	<header class="art-pre">
		<?php 
		echo "<h1 class='art-tit'>$post_tit</h1>";
		if ( isset($subtitle) ) { echo "<span class='sub-tit-1'>" .$subtitle. "</span>"; }
		edit_post_link('Editar', '', ''); ?>
	</header><!-- end .art-pre -->

	<?php
	$pages_var = wp_link_pages( array(
		'before' => '',
		'after' => '',
		'echo' => '0'
	) );
	if ( $pages_var != '' ) {
		echo "<div id='post-menu'><ul class='post-numbers'>";
		$pages_array = preg_split('/ *(<[^>]*>[0-9]+<\/a>) */i', $pages_var, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );

		if ( post_custom('part_title') ) {
			// get pagination titles custom field values
			$item_title = get_post_meta($post->ID, 'part_title', false);
		}
		$count = 0;
		foreach ( $pages_array as $item ) {
			$patron = '/>[0-9]+</i';
			$susti = ">" . $item_title[$count]. "<";
			$replace_count = 0;
			$item = preg_replace($patron, $susti, $item, 1, $replace_count);
			if ( $replace_count == 0 ) {
				$item = "<span>" .$item_title[$count]. "</span>";
			}
			echo "<li>" . $item . "</li>";
			$count++;
		}
		echo "</ul></div>";
	} ?>

	<section class="page-text">

	<?php	the_content();
		?>
	</section>

</article>
