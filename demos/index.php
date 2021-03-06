<?php
require('core.php');

function validateIndex(){
	$oValidation = new Validation($oRequest);
	return array(
		'email' => array(
			$oValidation->required('<p>An email address is required to register for MacGuffin App. Please provide an email address.</p>'),
			$oValidation->email('<p>The email address provided does not appear to be valid. Please provide a valid email address.</p>'),
		),
		'username' => array(
			$oValidation->required('<p>A username is required in order to register for MacGuffin App. Please provide a username.</p>'),
			$oValidation->username('<p>Usernames have the following requirements.<br />
				<ul><li>Must be composed of alpha numeric characters.</li>
				<li>Must contain atleast one alphabetic character.</li>
				<li>Must be atleast four characters long</li>
				<li>Can not be longer than 50 characters</li></ul>
				Please provide a username that meets these requirements.</p>'),
		),
		'password' => array(
			$oValidation->required('<p>A password is required to register for MacGuffin App. Please provide a password.</p>'),
			$oValidation->minLength('<p>Passwords must be atleast five characters in length. Please provide a valid password.</p>', 5),
		),
	);
}


if ($_POST) {
	$oValidation = new Validation($oRequest);
	$aErrors = $oValidation->validate(validateIndex(), $_POST);
	if (empty($aErrors)) {
		// process account registration
			$aErrors['valid'] = true;
			$aErrors['global'] = 'You have successfully registered an account with MacGuffin App!';
			$aErrors['details'][] = 'Take this time to celebrate.';
	}
	
	if ($_POST['validate']) {
		echo json_encode($aErrors);
		exit(0);
	}
}

include('templates/demo.php');

?>
