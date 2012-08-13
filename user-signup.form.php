<?php
if ( isset($_GET['username']) || isset($_GET['pass']) || isset($_GET['mail']) ) {
	if ( isset($_GET['username']) ) {
		$name_val = "";
		$name_msg = "<span class='error'><strong>The username you have chosen already exists. Try something different.</strong></span>";
	} else {
		$name_val = $_POST['signup-username'];
		$name_msg = "";
	}

	if ( isset($_GET['pass']) ) {
		$pass_val = "";
		$pass_msg = "<span class='error'><strong>There is any error in the password you have chosen. Try to type it again carefully.</strong></span><br />";
	} else {
		$pass_val = "";
		$pass_msg = "";
	}

	if ( isset($_GET['mail']) ) {
		$mail_val = "";
		$mail_msg = "<span class='error'><strong>The mail address you have chosen is already associated to another account. Try something different.</strong></span><br />";
	} else {
		$mail_val = $_POST['signup-mail'];
		$mail_msg = "";
	}

	$first_val = $_POST['signup-firstname'];
	$last_val = $_POST['signup-lastname'];
	$bio_val = $_POST['signup-bio'];
	$twitter_val = $_POST['signup-twitter'];
	$web_val = $_POST['signup-website'];
	$feed_val = $_POST['signup-feed'];
	
} else {
	$name_val = "";
	$name_msg = "";
	$mail_val = "";
	$mail_msg = "";
	$pass_val = "";
	$pass_msg = "";
	$first_val = "";
	$last_val = "";
	$bio_val = "";
	$twitter_val = "@";
	$web_val = "http://";
	$feed_val = "http://";
}

$signup_form = "
<form id='signup' name='signup' method='post' action='" .$action_slug. "'>
	<fieldset>
		<span class='req'>*</span>
		<input id='signup-username' name='signup-username' type='text' value='" .$name_val. "' />
		<label>Username</label>
		<div class='mini-faq'>" .$name_msg. "</div>
	</fieldset>
	<fieldset>
		<input id='signup-pass' name='signup-pass' type='password' value='' />
		<label>Password</label>
		<div class='mini-faq'><strong>Choose a strong password</strong>, a good recipe could be a combination of characters and numbers with any capital letters. To make other people difficult to access to your account is always a good idea.</div>
	</fieldset>
	<fieldset>
		<input id='signup-pass2' name='signup-pass2' type='password' value='' />
		<label>Password confirmation</label>
		<div class='mini-faq'>" .$pass_msg. "If you cannot repeat it, maybe is too strong.</div>
	</fieldset>
	<fieldset>
		<span class='req'>*</span>
		<input id='signup-mail' name='signup-mail' type='text' value='" .$mail_val. "' />
		<label>E-mail</label>
		<div class='mini-faq'>" .$mail_msg. "<strong>Spam is evil and you'll never see any from us</strong>. Instead you receive your username and password when you submit this form. <strong>This address will not be shown in the web, of course!</strong></div>
	</fieldset>
	<fieldset>
		<input id='signup-firstname' name='signup-firstname' type='text' value='" .$first_val. "' />
		<label>First name</label>
		<div class='mini-faq'><strong>All this information about you will appear next to your projects</strong> or other content you submit. You can complete it in any moment after sign up.</div>
	</fieldset>
	<fieldset>
		<input id='signup-lastname' name='signup-lastname' type='text' value='" .$last_val. "' />
		<label>Last name</label>
	</fieldset>
	<fieldset>
		<textarea id='signup-bio' name='signup-bio' cols='45' rows='10'>" .$bio_val. "</textarea>
		<label>Briefly about you</label>
	</fieldset>
	<fieldset>
		<input id='signup-twitter' name='signup-twitter' type='text' value='" .$twitter_val. "' />
		<label>Twitter account</label>
		<div class='mini-faq'><strong>Your twitter username.</strong>.</div>
	</fieldset>
	<fieldset>
		<input id='signup-website' name='signup-website' type='text' value='" .$web_val. "' />
		<label>Website</label>
	</fieldset>
	<fieldset>
		<input id='signup-feed' name='signup-feed' type='text' value='" .$feed_val. "' />
		<label>Website Feed</label>
		<div class='mini-faq'>Don't you know what a feed is? Have a look at <a target='_blank' href='http://en.wikipedia.org/wiki/Web_feed'>Wikipedia</a>.</div>
	</fieldset>

	<fieldset>
		<input id='sigup-ref' name='signup-ref' type='hidden' value='" .$ref. "' />
		<input id='signup-submit' name='signup-submit' type='submit' value='Sign up' />
	</fieldset>

</form><!-- #signup -->
";
?>
