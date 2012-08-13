<?php
// to log out a logged in user
if ( is_user_logged_in() && isset($_POST['logout-submit']) ) {
	$redirect = $_POST['logout-ref'];
	wp_logout();
	header("location: " .$redirect);
}

if ( is_user_logged_in() ) {
	// if user is logged in and a logout link has been clicked

	// user data
	global $current_user;
	get_currentuserinfo();
	$username = $current_user->user_login;

	// logout form
	$action_slug = get_permalink();
	$ref = $action_slug;
	include "user-logout.form.php";

	$success_msg = "You have logged in as <strong>" .$username. "</strong> Welcome!";
}

if ( !is_user_logged_in() ) {
	$success_msg = "To submit any content you have to log in first. You can <a href='" .$general_options['blogurl']. "/open-lab/submit-your-project'>log in here</a>.";
}
if ( isset($_GET['user']) ) {
	// if user has just signed up
	$success_msg = "<span class='error'>You have sign up successfully. In order to submit any content, first of all <strong>you must log in using the form underneath.</strong></span>";
}

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

?>

<?php
// to sign up a new user
if ( isset($_POST['signup-submit']) ) {

	// catching all $_POST data
	$redirect = $_POST['signup-ref']. "?";
	$username = $_POST['signup-username'];
	$pass = $_POST['signup-pass'];
	$pass2 = $_POST['signup-pass2'];
	$mail = $_POST['signup-mail'];
	$firstname = $_POST['signup-firstname'];
	$lastname = $_POST['signup-lastname'];
	$bio = $_POST['signup-bio'];
	$twitter = $_POST['signup-twitter'];
	$website = $_POST['signup-website'];
	$feed = $_POST['signup-feed'];

	require_once(ABSPATH . WPINC . '/registration.php');

	// testing errors and redirecting if necesary
	$user_id = username_exists( $username );

	if ( $user_id ) {
		// if username already exists
		$redirect .= "username=fail&";
//		header("location: " .$redirect);
		$errore = "user";
	}
	if ( email_exists($mail) ) {
		// if email is already associated to other user
		$redirect .= "mail=fail&";
//		header("location: " .$redirect);
		$errore = "mail";
	}
	if ( $pass != $pass2 ) {
		// if passwords don't match
		$redirect .= "pass=fail&";
//		header("location: " .$redirect);
		$errore = "pass";
	}
	if ( isset($errore) ) {} else {
		// if no errors
		// if pass is empty, we generate a random one
		$random_pass = wp_generate_password( 12, false );
		if ( $pass == '' ) { $pass = $random_pass; }

		$userdata = array(
			'user_pass' => $pass,
			'user_login' => $username,
			'user_url' => $website,
			'user_email' => $mail,
			'first_name' => $firstname,
			'last_name' => $lastname,
			'description' => $bio,
			'role' => 'contributor',
			'twitter' => $twitter,
			'feed' => $feed,
		);
		$user_id = wp_insert_user( $userdata );

		$redirect .= "user=" .$user_id;
//		header("location: " .$redirect);

	} // end testing errors

	header("location: " .$redirect);
} // end sign up proccess

?>
