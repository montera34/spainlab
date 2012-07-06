<?php if (get_post_type() == 'architects'): // ---Architects--- Tiene que estar escrito con mayúscula para funcionar.?>
<?php
// post type: architect
// gallery with all img attached
// tit
// content
// custom field integrantes
// excerpt


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="art-pre">
		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
			echo "<h1 class='art-tit'>$post_tit</h1>";
			edit_post_link('Editar', '', ''); ?>
	</header><!-- end .art-pre -->
	<section class="page-text">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
		?>
	</section>

</article>

<aside>
	<?php
	// get integrantes custom field values
	$integrantes = get_post_meta($post->ID, 'integrantes', true); 
	echo "<header><h2>" .$integrantes. "</h2></header>";
	// get bio
	the_excerpt_rss(); ?>
</aside>
TEST This is an architect

<?php elseif (get_post_type() == 'remotes' ) : // ---Remotes---- ?>
<?php the_title(); ?>
<?php the_content(); ?>

TEST This is a remote

<?php else : ?>

<?php the_title(); ?>
<?php the_content(); ?>
TEST ALL

<?php endif ; ?>
