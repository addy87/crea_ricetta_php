<?php
session_start();
mysql_set_charset('utf8');

require "database/connect.php";
require "functions/general.php";
require "functions/users.php";

if(logged_in() === true) {

	if(isset($_COOKIE["user_id"])) {
		$cookie_user_id = $_COOKIE["user_id"];
		$user_data = user_data($cookie_user_id, "user_id", "username", "password", "email");
	} else if (isset($_SESSION["user_id"])) {
		$session_user_id = $_SESSION["user_id"];
		$user_data = user_data($session_user_id, "user_id", "username", "password", "email");
	}

	

	if(user_active($user_data["username"]) === false) {

		session_destroy();
		setcookie("user_id", "", time()-604800);
		header("Location: index.php");
		exit();
	}

}


$errors = array();


?>