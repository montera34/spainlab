// original code by http://charlie.griefer.com
// http://charlie.griefer.com/blog/2009/09/17/jquery-dynamically-adding-form-elements/
// adaptation to WordPress CMS by skotperez http://skotperez.net
// add fields to a form
var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('#addcontent-btnDel').attr('disabled','disabled');
	$j('#addcontent-btnAdd').click(function() {
		var num = $j('#addcontent .clonedField').length; // how many "duplicatable" input fields we currently have
		var newNum = new Number(num + 1); // the numeric ID of the new input field being added

		// create the new element via clone(), and manipulate it's ID using newNum value
		var newElem = $j('#addcontent' + num).clone().attr('id', 'addcontent' + newNum);

		// manipulate the name/id values of the input inside the new element
		newElem.children(':last').attr('id', 'addcontent' + newNum).attr('name', 'addcontent' + newNum);

		// insert the new element after the last "duplicatable" input field
		$j('#addcontent' + num).after(newElem);

		// enable the "remove" button
		$j('#addcontent-btnDel').attr('disabled',false);

		// business rule: you can only add 5 names
		if (newNum == 5)
			$j('#addcontent-btnAdd').attr('disabled','disabled');
	});

	$j('#addcontent-btnDel').click(function() {
		var num = $j('#addcontent .clonedField').length; // how many "duplicatable" input fields we currently have
		$j('#addcontent' + num).remove(); // remove the last element

		// enable the "add" button
		$j('#addcontent-btnAdd').attr('disabled',false);

		// if only one element remains, disable the "remove" button
		if (num-1 == 1)
			$j('#addcotent-btnDel').attr('disabled','disabled');
	});

});
