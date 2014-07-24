<?php
session_start();

session_destroy();


setcookie("user_id", "", time()-604800);


header("Location: index.php");
?>