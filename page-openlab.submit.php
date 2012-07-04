<?php
/*
Template Name: Open Lab submit form
*/
get_header();
?>

<?php // doing the inserts into DB

// getting all $_POST data

$form_tit = strip_tags($_POST['addcontent-tit']);
$project_desc = strip_tags($_POST['addcontent-desc']);
$project_img = $_POST['addcontent-file'];

// inserting all the data as a remote custom type
$post_id = wp_insert_post(array(
	'post_type' => 'remotes', // "page" para páginas, "libro" para el custom post type libro...
	'post_status' => 'draft', // "publish" para publicados, "draft" para borrador, "future" para programarlo...
	'post_author' => $variableUsuario, // el ID del autor, 1 para admin
	'post_title' => $titulo,
	'post_content' => $contenido, // el contenido
	'post_category' => $catfinal // matriz de los ID de las categorías a las que asociar la entrada
)); // La funcion insert devuelve la id del post


add_post_meta($post_id, _liked, '0'); // Introduzco un valor para el sistema de votaciones


// asociamos a la entrada un campo personalizado para las coordenadas
add_post_meta($post_id, 'coordenadas', $coordenadas);
add_post_meta($post_id, 'video', $video);

?>

<?php // this page content
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		include("loop.page.php");
	endwhile;
else :
endif; ?>

<?php // form
// vars
$page_slug = $wp_query->query_vars['name'];

if ( is_user_logged_in() ) {
// if user is logged in

$form_out = "
<form id='addcontent' name='addcontent' method='post' action='" .$general_options['blogurl']. "/" .$page_slug. "' enctype='multipart/form-data'>
	<fieldset>
		<input id='addcontent-tit' name ='addcontent-tit' type='text' value='' />
		<label>Project name</label>
	</fieldset>
	<fieldset>
		<textarea id='addcontent-desc' name='addcontent-desc' cols='45' rows='10'></textarea>
		<label>Description</label>
	</fieldset>
	<fieldset>
    		<input type='hidden' name='MAX_FILE_SIZE' value='3000000' />
		<input id='addcontent-file' name='addcontent-file' type='file' />
		<label>Image</label>
	</fieldset>
	<fieldset>
		<input id='addcontent-submit' name='addcontent-submit' type='submit' value='Submit' />
	</fieldset>
</form><!-- #addcontent -->
";

} else {
// if user is not logged in or even registered

$form_out = "
<strong>Login</strong>
<form id='login' name='login' method='post' action='" .$general_options['blogurl']. "/login'>
	<fieldset>
		<input id='login-username' name='login-username' type='text' value='' />
		<label>Username</label>
	</fieldset>
	<fieldset>
		<input id='login-pass' name='login-pass' type='password' value='' />
		<label>Password</label>
	</fieldset>
	<fieldset>
		<input id='login-remember' name='login-remember' type='checkbox' value='false' />
		<label>Remember me?</label>
	</fieldset>
	<fieldset>
		<input id='login-submit' name='login-submit' type='submit' value='Login' />
	</fieldset>

</form><!-- #login -->

<strong>Sign up</strong>
<form id='signup' name='signup' method='post' action='" .$general_options['blogurl']. "/login'>
	<fieldset>
		<input id='signup-username' name='signup-username' type='text' value='' />
		<label>Username</label>
	</fieldset>
	<fieldset>
		<input id='signup-pass' name='signup-pass' type='password' value='' />
		<label>Password</label>
	</fieldset>
	<fieldset>
		<input id='signup-mail' name='signup-mail' type='text' value='' />
		<label>E-mail</label>
	</fieldset>
	<fieldset>
		<input id='signup-submit' name='signup-submit' type='submit' value='Sign up' />
	</fieldset>

</form><!-- #signup -->

";

} // end if user is logged in

echo $form_out;
?>


<?php get_footer(); ?>
