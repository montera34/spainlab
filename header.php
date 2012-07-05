<!DOCTYPE html>

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php global $general_options; require_once( get_stylesheet_directory(). '/general-vars.php' ); ?>

<title>
<?php
	/* From twentyeleven theme
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	echo $general_options['blogname'];

	// Add the blog description for the home/front page.
	$site_description = $general_option['blogdesc'];
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'spainlab' ), max( $paged, $page ) );

	?>
</title>

<meta content="<?php echo $general_options['metaauthor']; ?>" name="author" />
<meta content="<?php echo $general_options['blogdesc']; ?>" name="description" />
<meta content="<?php echo $general_options['metatags']; ?>" name="keywords" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="<?php echo $general_options['blogname']; ?> RSS Feed suscription" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php echo $general_options['blogname']; ?> Atom Feed suscription" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if IE 6 | IE 7 | IE 8]>
	<script src="<?php echo "{$general_options['blogtheme']}/js/html5.js" ?>" type="text/javascript">
	</script>
<![endif]-->

<?php // including copy of jQuery hosted in WordPress package
wp_enqueue_script("jquery");

if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>

</head>

<?php // better to use body tag as the main container ?>
<body <?php body_class(); ?>>

	<header id="pre" role="banner">

		<hgroup id="pre-tit">
			<h1 id="blogname"><?php echo "<a href='" .$general_options['blogurl']. "' title='Ir al inicio'>" .$general_options['blogname']. "</a>"; ?></h1>
			<h2 id="blogdesc"><?php echo $general_options['blogdesc']; ?></h2>
		</hgroup>
		<?php // main navigation menu 1
		$menu_slug = "header-left-menu";
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) ) {
			$menu_vars = wp_get_nav_menu_object( $locations[$menu_slug] );
			//$args = array();
			$menu_items = wp_get_nav_menu_items($menu_vars->term_id);
			$menu_out = "<nav id='mainmenu1' role='navigation'>";
			//foreach ( (array) $menu_items as $key->$item ) {
			foreach ( $menu_items as $item ) {
				$item_tit = $item->title;
				$item_url = $item->url;
				$item_class1 = $item->classes[0];
				$item_class2 = $item->classes[1];
				$menu_out .= "<div><a href='$item_url' class='$item_class1 $item_class2' title='$item_tit'>$item_tit</a></div>";
			}
			$menu_out .= "</nav><!-- #mainmenu1 -->";
			echo $menu_out;
		} // end if there is items in this menu
		?>
		<?php // main navigation menu 2
		$menu_slug = "header-right-menu";
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) ) {
			$menu_vars = wp_get_nav_menu_object( $locations[$menu_slug] );
			//$args = array();
			$menu_items = wp_get_nav_menu_items($menu_vars->term_id);
			$menu_out = "<nav id='mainmenu2' role='navigation'>";
			//foreach ( (array) $menu_items as $key->$item ) {
			foreach ( $menu_items as $item ) {
				$item_tit = $item->title;
				$item_url = $item->url;
				$item_class1 = $item->classes[0];
				$item_class2 = $item->classes[1];
				$menu_out .= "<div><a href='$item_url' class='$item_class1 $item_class2' title='$item_tit'>$item_tit</a></div>";
			}
			$menu_out .= "</nav><!-- #mainmenu2 -->";
			echo $menu_out;
		} // end if there is items in this menu

		include "searchform.php";
		?>

	</header><!-- end #pre -->

	<hr />
	<div id="content" role="main">
