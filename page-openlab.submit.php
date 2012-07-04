<?php
/*
Template Name: Open Lab submit form
*/
get_header();
?>

<?php // dealing with user log in or sign up
include "user.php";
?>

<?php // doing the inserts into DB
if ( is_user_logged_in() && isset($_POST['addcontent-submit']) ) {
	// if conditions to do inserts

	// getting all $_POST data
	//$form_tit = strip_tags($_POST['addcontent-tit']);
	$form_tit =  wp_strip_all_tags($_POST['addcontent-tit']);
	//$form_desc = strip_tags($_POST['addcontent-desc']);
	$form_desc = wp_strip_all_tags($_POST['addcontent-desc']);
	$form_img = $_POST['addcontent-file'];

	// user data
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;

	// content data
	$pt = $general_options['pt_r'];

	// inserting all the data as a remote custom type
	$post_id = wp_insert_post(array(
		'post_type' => $pt, // "page" para páginas, "libro" para el custom post type libro...
		'post_status' => 'draft', // "publish" para publicados, "draft" para borrador, "future" para programarlo...
		'post_author' => $user_id, // el ID del autor, 1 para admin
		'post_title' => $form_tit,
		'post_content' => $form_desc, // el contenido
	//	'post_category' => $catfinal // matriz de los ID de las categorías a las que asociar la entrada
	)); // La funcion insert devuelve la id del post

//add_post_meta($post_id, _liked, '0'); // Introduzco un valor para el sistema de votaciones

// asociamos a la entrada un campo personalizado para las coordenadas
//add_post_meta($post_id, 'coordenadas', $coordenadas);
//add_post_meta($post_id, 'video', $video);

// asociamos la entrada a los términos que queramos de la taxonomía tags
//wp_set_post_terms( $post_id, $tagsfinal,$positivonegativo,'True');

// image insert

//39,88
//	$upload_dir_var = wp_upload_dir();
//	$upload_dir = $upload_dir_var['path']; // absolute path to uploads folder
//
//	$filename = basename($_FILES['blas']['name']); // to get file name from form
//	$filename = trim($filename); // removing spaces at the begining and end
//	$filename = ereg_replace(" ", "-", $filename); // removing spaces inside the name
//
//	$typefile = $_FILES['blas']['type']; // file type
//
//	$uploaddir = realpath($upload_dir);
//	$uploadfile = $uploaddir.'/'.$filename;
//
//	$slugname = preg_replace('/\.[^.]+$/', '', basename($uploadfile));
//
//	if ( file_exists($uploadfile) ) { // if file exists
//		$count = "a";
//		while ( file_exists($uploadfile) ) {
//		$count++;
//		if ( $typefile == 'image/jpeg' ) { $exten = 'jpg'; }
//		elseif ( $typefile == 'image/png' ) { $exten = 'png'; }
//		elseif ( $typefile == 'image/gif' ) { $exten = 'gif'; }
//		$uploadfile = $uploaddir.'/'.$slugname.'-'.$count.'.'.$exten;
//		}
//	} // end if file exist
//
//if (move_uploaded_file($_FILES['blas']['tmp_name'], $uploadfile)) { // if the file is uploaded
//
//	$slugname = preg_replace('/\.[^.]+$/', '', basename($uploadfile)); // defining image slug again to make it matching with file name
//	$attachment = array(
//		'post_mime_type' => $typefile,
//		'post_title' => $slugname,
//		'post_content' => '',
//		'post_status' => 'inherit'
//		);
//
//	$attach_id = wp_insert_attachment( $attachment, $uploadfile, $post_id );
//	// you must first include the image.php file
//	// for the function wp_generate_attachment_metadata() to work
//	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
//
//	$attach_data = wp_generate_attachment_metadata( $attach_id, $uploadfile );
//	wp_update_attachment_metadata( $attach_id,  $attach_data );
//
//	$img_url = wp_get_attachment_url($attach_id);
//
//} else {
//	//echo "Problema al subir la imagen.";
//	//echo 'Here is some more debugging info:';
//	//print_r($_FILES);
//}

	//echo $post_id;
	if ( $post_id != 0 ) {
		// if the content has been inserted
		echo "Your remote has been stored. If everything in your submit is accurate, an editor will publish your content.";
		echo "<br />";
		echo "User ID: " .$user_id;
		echo "<br />";
		echo "Content tit: " .$form_tit;
		echo "<br />";
		echo "Content desc: " .$form_desc;
		echo "<br />";
	} // end if the content has been inserted

} // end conditions to do inserts
?>

<?php // this page content
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>

<?php // add content form
if ( is_user_logged_in() ) {
	// if user is logged in

	// form vars
	$action_slug = $wp_query->query_vars['name'];

	include "content-add.form.php";

	// HTML output
	echo $add_form;

} else {
	// if user is not logged in

	// form vars
	$action_slug = $wp_query->query_vars['name'];
	$ref = $post_perma;

	include "user-login.form.php";
	include "user-signup.form.php";

	// HTML output
	echo "<strong>Login</strong>";
	echo $login_form;
	echo "<strong>Sign up</strong>";
	echo $signup_form;

} // end if user is logged in
?>

<?php get_footer(); ?>
