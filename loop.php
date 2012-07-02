<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="art-pre">

		<?php $post_perma = get_permalink();
		$post_tit = get_the_title();
		if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
			echo "<h2 class='art-tit'><a href='$post_perma' title='Permalink to $post_tit' rel='bookmark'>$post_tit</a></h2>";
		} else {
			echo "<h1 class='art-tit'>$post_tit</h1>";
		} ?>

		<div class="art-date">
			<?php $post_date_human = get_the_time('d \d\e F \d\e Y');
			$post_date = get_the_time('Y-m-d');
			$u_time = get_the_time('U');
			$u_modified_time = get_the_modified_time('U');
			if ($u_modified_time >= $u_time + 86400) {
				$post_modified_date_human = get_the_modified_time('d \d\e F \d\e Y');
				$post_modified_date = get_the_modified_time('Y-m-d');
				echo "<time datetime='$post_date'>$post_date_human</time> [actualizado el <time datetime='$post_modified_date'>$post_modified_date_human</time>]";
			} else {
				echo "<time datetime='$post_date'>$post_date_human</time>";
			}
			edit_post_link('Editar', ' &bull; ', ''); ?>
		</div><!-- end .art-date -->
	</header><!-- end .art-pre -->

<?php $art_text_class = "art-text";
$thumbs_class = "thumbs";
if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
// display all post thumbs with link to original size

	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $post->ID
	);
	$img_out = "";
	$attachments = get_posts($args);
	if ( $attachments ) { // if there is anyone
		$count = 0;
		foreach ( $attachments as $attachment ) { // loop
			$img_type = $attachment->post_mime_type;
			if ( $img_type == 'image/png' || $img_type == 'image/jpeg' || $img_type == 'image/gif' ) {
				$count++;
				//$img_mini = wp_get_attachment_image_src($attachment->ID, array(90,90));
				//$img_mini = wp_get_attachment_image($attachment->ID, 'thumbnail');
				$img_mini = wp_get_attachment_link($attachment->ID, 'thumbnail',false);
				//$img_medium = wp_get_attachment_image_src($attachment->ID, 'medium');
				$img_out .= $img_mini;
			}
		}
		if ( $count == '1' ) { $art_text_class = "art-text one-thumb"; $thumbs_class = "thumbs alignleft"; }
		echo "
			<div class='$thumbs_class'>
				$img_out
			</div><!-- end .thumbs -->
		";
	}

} // end display all post thumbs ?>

	<section>
	<div class="<?php echo $art_text_class ?>">
		<?php if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
			the_excerpt_rss();
		} else {
			the_content();
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
		} ?>
	</div><!-- end class art-text -->

	<?php if ( is_page() ) { // if page
	} else { ?>
		<section>
		<div class="art-context">Contexto: <?php $postcats = get_the_category(); $count = 0;
		foreach ( $postcats as $cat ) {
			if ( $cat->term_id != $brevesid ) {
				$count++;
				$cat_link = get_category_link( $cat->term_id );
				if ( $count == 1 ) { echo "<strong><a href='$cat_link'>$cat->name</a></strong>"; }
				else { echo ", <strong><a href='$cat_link'>$cat->name</a></strong>"; }
			}
		}
		the_tags(', <span class="tags">',', ','</span>'); ?>
		</div><!-- end class art-context -->
		</section>
	<?php } ?>

	<?php if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
		echo "<section><div class='art-more'><a href='$post_perma'>Leer el art&iacute;culo</a></div></section>";
	} ?>
	</section>

</article>

