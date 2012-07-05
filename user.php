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
	//	$redirect .= "?login=true"
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

// to log out a logged in user
if ( is_user_logged_in() && isset($_POST['logout']) ) {
	// if user is logged in and a logout link has been clicked
	$redirect = $_POST['logout-ref'];
	
	wp_logout();
	header("location: " .$redirect);

}


// log in or sign up successfully
if ( is_user_logged_in() ) {
	// if login successfully
	// user data
	global $current_user;
	get_currentuserinfo();
	$username = $current_user->user_login;

	// logout form
	include "user-logout.form.php";

	$success_msg = "You have logged in as " .$username. " Welcome! You can <a href='" .$general_options['blogurl']. "/wp-admin/profile.php'>complete your profile</a> to give other users more information about you.";
	// HTML output
	echo $success_msg;
	echo $logout_form;

}

if ( isset($_GET['user']) ) {
	// if user has just signed up
	$success_msg = "You have sign up successfully. First of all, you must log in using the form underneath.";
	echo $success_msg;
}
?>
