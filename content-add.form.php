<?php
// errors code construction
if ( $form_errors[0] != '' ) {
	$form_error_code = "";
	foreach ( $form_errors as $form_error ) {
		$form_error_code .= "<li>" .$form_error. "</li>";
	}
}
	$add_form = "<ul>" .$form_error_code. "</ul>
	<form id='addcontent' name='addcontent' method='post' action='" .$general_options['blogurl']. "/" .$action_slug. "' enctype='multipart/form-data'>
		<fieldset class='required" .$form_tit_class. "'>
			<input id='addcontent-tit' name ='addcontent-tit' type='text' value='" .$form_tit. "' />
			<label>Project name</label>
		</fieldset>
		<fieldset class='required" .$form_desc_class. "'>
			<textarea id='addcontent-desc' name='addcontent-desc' cols='45' rows='10'>" .$form_desc. "</textarea>
			<label>Description</label>
		</fieldset>
		<fieldset id='addcontent1' class='clonedField'>
			<label>Image</label>
	    		<input type='hidden' name='MAX_FILE_SIZE' value='2000000' />
			<input id='addcontent-file1' name='addcontent-file1' type='file' />
		</fieldset>
		<fieldset class='moreless'>
			<input class='midbut' type='button' id='addcontent-btnAdd' value='+' />
			<input class='midbut' type='button' id='addcontent-btnDel' value='-' />
			<label>Want to upload more images?</label>
		</fieldset>
		<fieldset>
			<input id='addcontent-video' name='addcontent-video' type='text' value='" .$form_video. "' />
			<select id='addcontent-videoapi' name='addcontent-videoapi' value='" .$form_videoapi. "'>
				<option value=''></option>
				<option value='youtube'>Youtube</option>
				<option value='vimeo'>Vimeo</option>
			</select>
			<label>Video ID</label>
		</fieldset>
		<fieldset>
			<input id='addcontent-url' name='addcontent-url' type='text' value='http://' />
			<label>Project website</label>
		</fieldset>
		<fieldset>
			<input id='addcontent-submit' name='addcontent-submit' type='submit' value='Submit' />
		</fieldset>
	</form><!-- #addcontent -->
	";
?>
