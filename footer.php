<?php include( get_stylesheet_directory(). '/general-vars.php' ); ?>
	</div><!-- end id content -->
	<hr />

	<footer id="epi">
		<div class="centrator">
		<?php // navigation menu
		$menu_slug = "footer-menu";
			$args = array(
				'theme_location' => $menu_slug,
				'container' => 'false',
				'menu_id' => 'epimenu',
				'menu_class' => 'menu',
			);
				wp_nav_menu( $args );
//		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) ) {
//			$menu_vars = wp_get_nav_menu_object( $locations[$menu_slug] );
//			//$args = array();
//			$menu_items = wp_get_nav_menu_items($menu_vars->term_id);
//			$menu_out = "<nav id='epimenu' role='navigation'>";
//			//foreach ( (array) $menu_items as $key->$item ) {
//			foreach ( $menu_items as $item ) {
//				$item_tit = $item->title;
//				$item_url = $item->url;
//				$item_class1 = $item->classes[0];
//				$item_class2 = $item->classes[1];
//				$menu_out .= "<div><a href='$item_url' class='$item_class1 $item_class2'>$item_tit</a></div>";
//			}
//			$menu_out .= "</nav><!-- #mainmenu -->";
//			echo $menu_out;
//		} // end if there is items in this menu
		?>

		<div id="social">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="http://www.facebook.com/spainlab" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div>

			<a href="https://twitter.com/spainlab" class="twitter-follow-button" data-show-count="false">Follow @spainlab</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			<a href="https://twitter.com/share" class="twitter-share-button" data-via="spainlab">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>

		</div><!-- end class centrator-->
	</footer>

<?php // stats code
echo $general_options['stats_code']; ?>

<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/add.field.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/flus.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $general_options['blogtheme']. "/js/menu.js"; ?>"></script>

<?php wp_footer(); ?>

</body><!-- end body as main container -->
</html>
