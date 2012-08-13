<?php
// errors code construction
//echo $action_slug;
if ( $form_errors[0] != '' ) {
	$form_error_code = "";
	foreach ( $form_errors as $form_error ) {
		$form_error_code .= "<li class='error'>" .$form_error. "</li>";
	}
}
	$add_form = "<section class='page-text'><ul>" .$form_error_code. "</ul></section>
	<form id='addcontent' name='addcontent' method='post' class='part-mid1' action='" .$action_slug. "' enctype='multipart/form-data'>
		<fieldset class='required" .$form_tit_class. "'>
		<span class='req'>*</span>
			<label>Project name</label>
			<input id='addcontent-tit' name ='addcontent-tit' type='text' value='" .$form_tit. "' />
		</fieldset>
		<fieldset class='required" .$form_desc_class. "'>
		<span class='req'>*</span>
			<label>Description</label>
			<textarea id='addcontent-desc' name='addcontent-desc' cols='45' rows='10'>" .$form_desc. "</textarea>
			<div class='mini-faq'>You can describe your project as widely as you want: in the page of your project all the text will be shown. Just have in mind that only the first 100 will appear in <a target='_blank' href='/openlab/'>OpenLab projects list</a>.</div>
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
			<div class='mini-faq'><strong>To add a video to your project</strong> you have to choose beetwen Youtube and Vimeo, depending on where your video is hosted. Then you have to fill in the video ID in the left box.<br /><a href='http://productforums.google.com/forum/#!topic/youtube/r3zYlqEmTcc[1-25]' target='_blank'>How to know a Youtube video ID</a> | <a href='http://social.msdn.microsoft.com/Forums/pl-PL/csharpgeneral/thread/cf832a1b-95dc-4fa6-a0e4-658b21597648' target='_blank'>How to know a Vimeo video ID</a></div>
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
