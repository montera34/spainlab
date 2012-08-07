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

//		$user_id = wp_create_user( $username, $pass, $mail );

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

		$redirect .= "?user=" .$user_id;
		header("location: " .$redirect);

	} // end testing errors
} // end sign up proccess

// to log out a logged in user
// see header.php

// vars for forms
//$action_slug = $wp_query->query_vars['name'];
//$ref = $general_options['blogurl']. "/" .$action_slug;


//if ( is_user_logged_in() ) {
//	// if login successfully
//
//}


?>
