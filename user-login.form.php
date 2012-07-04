<?php
$login_form = "
<form id='login' name='login' method='post' action='" .$general_options['blogurl']. "/" .$action_slug. "'>
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
		<input id='login-ref' name='login-ref' type='hidden' value='" .$ref. "' />
		<input id='login-submit' name='login-submit' type='submit' value='Login' />
	</fieldset>
</form><!-- #login -->
";
?>
