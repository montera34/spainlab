	</div><!-- end id content -->
	<hr />

	<footer id="epi">
		<?php // navigation menu
		$menu_slug = "footer-menu";
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) ) {
			$menu_vars = wp_get_nav_menu_object( $locations[$menu_slug] );
			//$args = array();
			$menu_items = wp_get_nav_menu_items($menu_vars->term_id);
			$menu_out = "<nav id='epimenu' role='navigation'>";
			//foreach ( (array) $menu_items as $key->$item ) {
			foreach ( $menu_items as $item ) {
				$item_tit = $item->title;
				$item_url = $item->url;
				$item_class1 = $item->classes[0];
				$item_class2 = $item->classes[1];
				$menu_out .= "<div><a href='$item_url' class='$item_class1 $item_class2'>$item_tit</a></div>";
			}
			$menu_out .= "</nav><!-- #mainmenu -->";
			echo $menu_out;
		} // end if there is items in this menu
		?>

	</footer>

<?php wp_footer(); ?>

<?php echo $general_options['stats_code']; ?>

</body><!-- end body as main container -->
</html>
