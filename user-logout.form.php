<?php
$logout_form = "
<form id='logout' name='logout' method='post' action='" .$action_slug. "'>
	<fieldset>
		<input id='logout-ref' name='logout-ref' type='hidden' value='" .$ref. "' />
		<input id='logout-submit' name='logout-submit' type='submit' value='Log out' />
	</fieldset>
</form><!-- #logout -->
";
?>
