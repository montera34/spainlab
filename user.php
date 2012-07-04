<?php
// to log in a signed up user
if ( isset($_POST['login-submit']) ) {
	$redirect = $_POST['login-ref'];
	$creds = array();
	$creds['user_login'] = $_POST['login-username'];
	$creds['user_password'] = $_POST['login-pass'];
	$creds['remember'] = $_POST['login-remember'];
	$user = wp_signon( $creds, false );

	if ( is_wp_error($user) ) {
		// if error
		// echo error message
		echo $user->get_error_message();
	} else {
		// if everything correct
		// redirect to content
		$redirect .= "?login=true"
		header("location: " .$redirect);
	}
}
// end log in proccess

// to sign up a new user
if ( isset($_POST['signup-submit']) ) {

	// catching all $_POST data
	$redirect = $_POST['signup-ref'];
	$username = $_POST['signup-username'];
	$mail = $_POST['signup-mail'];
	$pass = $_POST['signup-pass'];
	$pass2 = $_POST['signup-pass2'];

	require_once(ABSPATH . WPINC . '/registration.php');

//	$user_id = wp_create_user( $username, $pass, $mail );

	// testing errors and redirecting if necesary
	$user_id = username_exists( $username );

	if ( $user_id ) {
		// if username already exists
		$redirect .= "?fail=username";
		header("location: " .$redirect);

	} elseif ( email_exists($mail) ) {
		// if email is already associated to other user
		$redirect .= "?fail=mail";
		header("location: " .$redirect);

	} elseif ( $pass != $pass2 ) {
		// if passwords don't match
		$redirect .= "?fail=pass";
		header("location: " .$redirect);

	} else {
		// if no errors
		// if pass is empty, we generate a random one
		$random_pass = wp_generate_password( 12, false );
		if ( $pass == '' ) { $pass = $random_pass; }

		$user_id = wp_create_user( $username, $pass, $mail );

		$redirect .= "?user=" .$user_id;
		header("location: " .$redirect);

	} // end testing errors
} // end sign up proccess

if ( isset($_GET['user']) ) {
	// if user has just signed up
	$welcome = $_GET['user'];
}
?>
