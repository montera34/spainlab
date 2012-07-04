<?php
	$add_form = "
	<form id='addcontent' name='addcontent' method='post' action='" .$general_options['blogurl']. "/" .$action_slug. "' enctype='multipart/form-data'>
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

?>
