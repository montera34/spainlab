<?php if (get_post_type() == 'architects'): // ---Architects--- need to be written in lowercase to make it work?>
	<?php
	// post type: architect
	// gallery with all img attached
	// tit
	// content
	// custom field integrantes
	// excerpt
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('part-mid1'); ?>>
		<header class="art-pre">
			<?php $post_perma = get_permalink();
			$post_tit = get_the_title();
			// get integrantes custom field values
			$integrantes = get_post_meta($post->ID, 'integrantes', true); 
				echo "<h1 class='art-tit'>$post_tit</h1>";
				echo "<span class='sub-tit-1'>Installation manifest by <em>$integrantes</em></span>";
				edit_post_link('Editar', '', ''); ?>
		</header><!-- end .art-pre -->
		<section class="page-text">
			<?php
			the_content();
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
			?>
		</section>

	</article>

	<aside class="bio">
		<div class="architects">
		<?php // get thumbnail image custom field value
		$post_thumbimg = get_post_meta($post->ID, 'thumbimg', true); ?>
		<?php echo "<span class='img-background' style='background: url($post_thumbimg) center center no-repeat #eee;' ></span>";
		
		echo "<header><h2>" .$integrantes. "</h2></header>";
		// get bio
		echo "<span class='sub-tit-1'>bio</span></div><div class='page-text'>";
		the_excerpt_rss(); 
		echo "</div>"?>
	</aside>
	
	
	<?php // related posts loop?>

Related posts

<?php elseif (get_post_type() == 'remotes' ) : // ---Remotes---- ?>
	<?php the_title(); ?>
	<?php the_content(); ?>

	This is a remote
	
<?php elseif (get_post_type() == 'scientifics' ) : // ---Scientifics---- ?>
	<?php the_title(); ?>
	<?php the_content(); ?>

	This is a scientific

<?php else : ?>

	<?php the_title(); ?>
	<?php the_content(); ?>
	This is a post

<?php endif ; ?>