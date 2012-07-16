<?php
// hide admin toolbar by default
// show admin bar only for admins and editors
//if (!current_user_can('edit_posts')) {
//	add_filter('show_admin_bar', '__return_false');
//}
show_admin_bar(false);

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
	// Scienticic custom post type
	register_post_type( 'scientifics', array(
		'labels' => array(
			'name' => __( 'Scientifics' ),
			'singular_name' => __( 'Scientific' ),
			'add_new_item' => __( 'Add scientific' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this scientific' ),
			'new_item' => __( 'New scientific' ),
			'view' => __( 'View scientific' ),
			'view_item' => __( 'View this scientific' ),
			'search_items' => __( 'Search scientific' ),
			'not_found' => __( 'No scientific was found' ),
			'not_found_in_trash' => __( 'No scientifics in the trash' ),
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
		'rewrite' => array('slug'=>'scientific','with_front'=>false),
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

// extra fields in user profile
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
 
function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>
 
<table class="form-table">
<tr>
<th><label for="twitter"><?php _e("Twitter"); ?></label></th>
<td>
<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your twitter username without @."); ?></span>
</td>
</tr>
<tr>
<th><label for="feed"><?php _e("Feed RSS"); ?></label></th>
<td>
<input type="text" name="feed" id="feed" value="<?php echo esc_attr( get_the_author_meta( 'feed', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter a valid URL feed."); ?></span>
</td>
</tr>
</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 
update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
update_user_meta( $user_id, 'feed', $_POST['feed'] );
}


//adding widgets bars
function spainlab_widgets_init() {
	// Area 1, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Bar 1. Front page', 'spainlab' ),
		'id' => 'bar-1',
		'description' => 'Barra lateral uno. Descripcion.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	) );
	// Area 2, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Bar 2', 'spainlab' ),
		'id' => 'bar-2',
		'description' => 'Barra lateral dos. Descripcion.',
		'before_widget' => '<span class="widget %2$s">',
		'after_widget' => '</span>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 3, located at the front-page.
	register_sidebar( array(
		'name' => __( 'Barra 3. Blog bar', 'spainlab' ),
		'id' => 'bar-3',
		'description' => 'Barra lateral tres.',
		'before_widget' => '<span class="widget %2$s">',
		'after_widget' => '</span>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	

}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'spainlab_widgets_init' );



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
