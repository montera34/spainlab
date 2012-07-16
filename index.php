<?php
get_header();
?>
<div class="part-mid1">
<?php if ( ! dynamic_sidebar( 'bar-1' ) ) : ?><?php endif; // end blog widget area ?>
</div>
<div id="related">
<?php if ( ! dynamic_sidebar( 'bar-2' ) ) : ?><?php endif; // end blog widget area ?>
</div>

<?php get_footer(); ?>
