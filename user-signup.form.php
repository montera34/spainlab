<?php
$signup_form = "
<form id='signup' name='signup' method='post' action='" .$action_slug. "'>
	<fieldset>
		<span class='req'>*</span>
		<input id='signup-username' name='signup-username' type='text' value='' />
		<label>Username</label>
	</fieldset>
	<fieldset>
		<input id='signup-pass' name='signup-pass' type='password' value='' />
		<label>Password</label>
	</fieldset>
	<fieldset>
		<input id='signup-pass2' name='signup-pass2' type='password' value='' />
		<label>Password confirmation</label>
	</fieldset>
	<fieldset>
		<span class='req'>*</span>
		<input id='signup-mail' name='signup-mail' type='text' value='' />
		<label>E-mail</label>
	</fieldset>
	<fieldset>
		<input id='signup-firstname' name='signup-firstname' type='text' value='' />
		<label>First name</label>
	</fieldset>
	<fieldset>
		<input id='signup-lastname' name='signup-lastname' type='text' value='' />
		<label>Last name</label>
	</fieldset>
	<fieldset>
		<textarea id='signup-bio' name='signup-bio' cols='45' rows='10'></textarea>
		<label>Briefly about you</label>
	</fieldset>
	<fieldset>
		<input id='signup-twitter' name='signup-twitter' type='text' value='' />
		<label>Twitter account (without @)</label>
	</fieldset>
	<fieldset>
		<input id='signup-website' name='signup-website' type='text' value='' />
		<label>Website</label>
	</fieldset>
	<fieldset>
		<input id='signup-feed' name='signup-feed' type='text' value='' />
		<label>Website Feed</label>
	</fieldset>

	<fieldset>
		<input id='sigup-ref' name='signup-ref' type='hidden' value='" .$ref. "' />
		<input id='signup-submit' name='signup-submit' type='submit' value='Sign up' />
	</fieldset>

</form><!-- #signup -->
";
?>
