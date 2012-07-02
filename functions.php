<?php
// Custom post types
add_action( 'init', 'create_post_type', 0 );

function create_post_type() {
	// Architects custom post type
	register_post_type( 'Architects', array(
		'labels' => array(
			'name' => __( 'Architects' ),
			'singular_name' => __( 'Architect' ),
			'add_new_item' => __( 'Add architect' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this architect' ),
			'new_item' => __( 'New architect' ),
			'view' => __( 'View architect' ),
			'view_item' => __( 'View this architect' ),
			'search_items' => __( 'Search architects' ),
			'not_found' => __( 'No architect was found' ),
			'not_found_in_trash' => __( 'No architects in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => true, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes'),
		'rewrite' => array('slug'=>'architect','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
	// Remotes custom post type
	register_post_type( 'Remotes', array(
		'labels' => array(
			'name' => __( 'Remotes' ),
			'singular_name' => __( 'Remote' ),
			'add_new_item' => __( 'Add remote' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this remote' ),
			'new_item' => __( 'New remote' ),
			'view' => __( 'View remote' ),
			'view_item' => __( 'View this remote' ),
			'search_items' => __( 'Search remotes' ),
			'not_found' => __( 'No remote was found' ),
			'not_found_in_trash' => __( 'No remotes in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => true, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes'),
		'rewrite' => array('slug'=>'remote','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));

}


// custom menus
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
		array(
			'header-left-menu' => 'Menú izquierdo de cabecera',
			'header-right-menu' => 'Menú derecho de cabecera',
			'footer-menu' => 'Menú del pie'
		)
		);
	}
}
// to add excerpt box to pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
//// CUSTOM DASHBOARD LOGO
////hook the administrative header output
//add_action('admin_head', 'my_custom_logo');
//
//function my_custom_logo() {
//	echo '
//	<style type="text/css">
//	#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/dashboard-logo.png) !important; }
//	</style>
//	';
//}
?>
