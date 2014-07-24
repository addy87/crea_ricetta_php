<?php
function email($to, $subject, $body) {
	mail($to, $subject, $body, "From: augusten@outlook.com");
}


function array_sanitize(&$item) {
	$item = mysql_real_escape_string($item);
}

function sanitize($data) {
	return mysql_real_escape_string($data);
}


function output_errors($errors) {
	$output = array();

	foreach ($errors as $error) {
		$output[] = "<div class='alert alert-danger'>". $error . "</div>";
	}
	return "<div class='container'><div class='row'>". implode("", $output) ."</div></div>";
}

?>