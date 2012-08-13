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
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes','trackbacks'),
		'rewrite' => array('slug'=>'architect','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
	// Remotes custom post type
	register_post_type( 'Remotes', array(
		'labels' => array(
			'name' => __( 'Projects' ),
			'singular_name' => __( 'Project' ),
			'add_new_item' => __( 'Add projects' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit this project' ),
			'new_item' => __( 'New project' ),
			'view' => __( 'View project' ),
			'view_item' => __( 'View this project' ),
			'search_items' => __( 'Search project' ),
			'not_found' => __( 'No project was found' ),
			'not_found_in_trash' => __( 'No project in the trash' ),
			'parent' => __( 'Parent' )
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => false, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title', 'editor','excerpt','custom-fields','author','comments','trackbacks'),
		'rewrite' => array('slug'=>'project','with_front'=>false),
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
		'supports' => array('title', 'editor','excerpt','custom-fields','author','page-attributes','trackbacks'),
		'rewrite' => array('slug'=>'scientific','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));

}

// Custom Taxonomies
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
register_taxonomy( 'tag', 'remotes', array(
	'hierarchical' => false,
	'label' => 'Project Tag',
	'query_var' => true,
	'rewrite' => true ) );
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
	<th><label for="institution"><?php _e("Institution"); ?></label></th>
	<td>
	<input type="text" name="institution" id="institution" value="<?php echo esc_attr( get_the_author_meta( 'institution', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description"><?php _e("Please enter the academic institution, organization or group you belong."); ?></span>
	</td>
	</tr>

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
		'name' => __( 'Bar 1. Front page / home', 'spainlab' ),
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
		'before_widget' => '<span id="%1$s" class="widget boxes %2$s">',
		'after_widget' => '</span>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	// Area 3, located at the blog.
	register_sidebar( array(
		'name' => __( 'Bar 3. Blog bar', 'spainlab' ),
		'id' => 'bar-3',
		'description' => 'Barra lateral tres.',
		'before_widget' => '<div id="%1$s" class="widget-blog %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
	

}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'spainlab_widgets_init' );

/*** Comment list ***/

function commentlist($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="li-comment-<?php comment_ID() ?>">
	<?php if ( '0' != $comment->comment_parent ) { $avatar_size = 39; } ?>
	<div class="comment-avatar"><?php echo get_avatar( $comment, $avatar_size ); ?></div>
        <ul class="comment_meta">
		<li><?php printf( __('%1$s'), get_comment_author_link()); ?></li>
		<li><?php printf( __('%1$s'), get_comment_date()); ?>, <?php printf( __('%1$s'), get_comment_time()); ?></li>
		<li><?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ;?></li>
	</ul>
        <div class="comment_text"><?php comment_text() ?></div>
        <div class="clear"></div>
<?php
}

/*** human comments counter ***/
function human_comment_count() {
	global $wpdb;
	global $post;
	$postid = $post->ID;
	$count = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = '' AND comment_approved = '1' AND comment_post_ID = '$postid'";
	$counter = $wpdb->get_var($count);
	if ( $counter == 0 ) { echo "No comments"; }
	elseif ( $counter == 1 ) { echo "1 comment"; }
	else { echo "$counter comments"; }
}


//Add echo functionality to attachment links. Taken from http://www.seodenver.com/get-images-wordpress-functions/
// These functions are copied directly from wp-includes/media.php
// and modified to return the result instead of echo it.
	function get_adjacent_image_link($prev = true, $text = "test") {
		global $post;
		$post = get_post($post);
		$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));
		foreach ( $attachments as $k => $attachment )
			if ( $attachment->ID == $post->ID )
				break;
		$k = $prev ? $k - 1 : $k + 1;
		if ( isset($attachments[$k]) )
			return wp_get_attachment_link($attachments[$k]->ID, '' , true, false, $text);
	}

	function get_previous_image_link() {
		return get_adjacent_image_link(true,'&laquo; Prev' );
	}

	function get_next_image_link() {
		return get_adjacent_image_link(false,'Next &raquo;' );
	}

function fb_like( $atts, $content=null ){
/* Author: Nicholas P. Iler
 * URL: http://www.ilertech.com/2011/06/add-facebook-like-button-to-wordpress-3-0-with-a-simple-shortcode/
 */
    extract(shortcode_atts(array( 
            'send' => 'false',
            'layout' => 'standard',
            'show_faces' => 'true',
            'width' => '400px',
            'action' => 'like',
            'font' => '',
            'colorscheme' => 'light',
            'ref' => '',
            'locale' => 'en_US',
            'appId' => '' // Put your AppId here is you have one
    ), $atts));
 
    $fb_like_code = <<<HTML
        <div id="fb-root"></div><script src="http://connect.facebook.net/$locale/all.js#appId=$appId&amp;xfbml=1"></script>
        <fb:like ref="$ref" href="$content" layout="$layout" colorscheme="$colorscheme" action="$action" send="$send" width="$width" show_faces="$show_faces" font="$font"></fb:like>
HTML;
 
    return $fb_like_code;
}
add_shortcode('fb', 'fb_like');


/**
 * Register the Gallery custom post type.
 */
function gallery_init() {
    $labels = array(
        'name' => 'Imágenes de la galería',
        'singular_name' => 'Imagen de la galería',
        'add_new_item' => 'New Image de la galería',
        'edit_item' => 'Editar Imagen de la galería',
        'new_item' => 'Nueva Imagen de la galería',
        'view_item' => 'Ver Imagen de la galería',
        'search_items' => 'Buscar Imágenes de la galería',
        'not_found' => 'Imágenes de la galería noencontradas',
        'not_found_in_trash' => 'Ninguna Imagen de la galería en la papelera'
    );
    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'supports' => array('thumbnail')
    );

    register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_init' );

/**
 * Modify which columns display when the admin views a list of images posts.
 */
function gallery_posts_columns( $posts_columns ) {
    $tmp = array();

    foreach( $posts_columns as $key => $value ) {
        if( $key == 'title' ) {
            $tmp['gallery'] = 'Imagen de la galería';
        } else {
            $tmp[$key] = $value;
        }
    }

    return $tmp;
}
add_filter( 'manage_gallery_posts_columns', 'gallery_posts_columns' );

/**
 * Custom column output when admin is view the header-image post list.
 */
function gallery_custom_column( $column_name ) {
    global $post;

    if( $column_name == 'gallery' ) {
        echo "<a href='", get_edit_post_link( $post->ID ), "'>", get_the_post_thumbnail( $post->ID ), "</a>";
    }
}
add_action( 'manage_posts_custom_column', 'gallery_custom_column' );

/**
 * Make the "Featured Image" metabox front and center when editing a header-image post.
 */
function gallery_metaboxes( $post ) {
    global $wp_meta_boxes;

    remove_meta_box('postimagediv', 'gallery', 'side');
    add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'gallery', 'normal', 'high');
}
add_action( 'add_meta_boxes_gallery', 'gallery_metaboxes' );

/**
 * Enable thumbnail support in the theme, and set the thumbnail size.
 */
function gallery_after_setup() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(250, 250, true);
}
add_action( 'after_setup_theme', 'gallery_after_setup' );



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
