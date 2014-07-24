<!doctype html>

<?php 
include 'includes/head.php';

if(logged_in() === true) {
	header ("Location: profile.php");
	exit();
}


if (empty($_POST) === false) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	if (empty($username) || empty($password)) {
		$errors[] = "Devi inserire username e password!";
	} else if (user_exists($username) === false) { //in users.php
		$errors[] = "Username non trovato";
	} else if (user_active($username) === false) { //in users.php
		$errors[] = "Account non attivato. Controlla l'email di conferma che ti è stata inviata in fase di registrazione (ricordati di controllare anche nelle cartelle SPAM/Posta Indesiderata). <br>Se non dovessi aver ricevuto la mail di attivazione, contattaci.";
	} else {
		$rememberme = isset($_POST['rememberme']) ? $_POST['rememberme'] : 'no';
		$login = login($username, $password); //in users.php

		if ($login === false) {
			$errors[] = "La combinazione username/password fornita non è corretta!";
		} else {
			if($rememberme == "si") {
				setcookie("user_id", $login, time()+604800);
			}

			$_SESSION["user_id"] = $login; //perchè login returna l'userid
			header("Location: profile.php");
			exit();
		}
	}

} 
?>




	<div class="container" >
		<h3>Login</h3>
		<?php
			if (empty($errors) === false) {
				echo output_errors($errors);
			}
		?>
		<form class="login-form animated bounceInLeft" action="" method="post" style="padding-bottom:15px">
			<div class="form-group">
				<input type="text" class="form-control login-field" placeholder="Username" name="username" />
				<label class="login-field-icon fui-user" for="username"></label>
			</div>

			<div class="form-group">
				<input type="password" class="form-control login-field" placeholder="Password" name="password" />
				<label class="checkbox" for="checkbox1">
					<input type="checkbox" value="si" id="rememberme" name="rememberme" data-toggle="checkbox">
					Ricordami per una settimana
				</label>
				<label class="login-field-icon fui-lock" for="password"></label>
			</div>

			<input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
			<a class="login-link" href="recover.php?mode=password">Password dimenticata?</a>
			<a class="login-link" href="recover.php?mode=username">Username dimenticato?</a>
		</form>
		

	</div>


<?php include 'includes/footer.php' ?>
<script type="text/javascript" src="includes/data/flat/flatui-checkbox.js"></script>
<script type="text/javascript">
	$("input[name='username']").focus();
</script>