<?php
	include 'includes/head.php';

	if (logged_in() === true) {
		header("Location: ricetta.php");
		exit();
	}
?>

<div class="container">
	<h3>Registrati</h3>
	<p><small>Scegli una password di almeno 7 caratteri ed inserisci un indirizzo email valido.<br>Tutti i campi sono richiesti.</small></p>


<?php

	if (isset($_GET["success"]) && empty($_GET["success"])) {
		echo "<div class='alert alert-success' role='alert'>Registrazione effettuata! Puoi ora procedere con il <span style='font-weight:bold'><a href='login_form.php'>LOGIN</a></span> :-)</div>";
		include 'includes/footer.php';
		exit();
	} else {

		if (empty($_POST) === false) {
			$required_fields = array("username", "password", "password_again", "email");

			foreach($_POST as $key=>$value) {
				if(empty($value) && in_array($key, $required_fields) === true) {
					$errors[] = "Inserisci tutti i campi richiesti!";
					break 1;
				}
			}

			if (empty($errors) === true) {
				if (user_exists($_POST["username"]) === true) {
					$errors[] = "L'username ". htmlentities($_POST["username"]) ." è già in uso. Per favore, prova con un altro.";
				}

				if(preg_match("/\\s/", $_POST["username"]) == true) {
					$errors[] = "Lo username non deve contenere spazi.";
				}

				if (strlen($_POST["password"]) <= 6) {
					$errors[] = "La password dev'essere compresa tra 7 e 32 caratteri.";
				}

				if ($_POST["password"] !== $_POST["password_again"]) {
					$errors[] = "I campi password non coincidono. Per favore, riscrivi la tua password.";
				}

				if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
					$errors[] = "Inserisci un indirizzo email valido";
				}

				if (email_exists($_POST["email"]) === true) {
					$errors[] = "L'indirizzo email' ". htmlentities($_POST["email"]) ." è già in uso. Per favore, prova con un altro.";
				}

			}

			
		}

		if (empty($_POST) === false && empty($errors) === true) {

			$register_data = array (
				'username' 		=> $_POST["username"],
				'password' 		=> $_POST["password"],
				'email' 		=> $_POST["email"],
				'email_code' 	=> md5($_POST["username"] + microtime()),
				);

			register_user($register_data);
			header("Location: register.php?success");
			exit();


		} else if (empty($errors) === false) {

			echo output_errors($errors);

		}

	}

?>


	<form class="login-form animated bounceInLeft" action="" method="post">
		<div class="form-group">
			<input type="text" class="form-control login-field" placeholder="Username (*)" name="username" />
			<label class="login-field-icon fui-user" for="username"></label>
		</div>

		<div class="form-group">
			<input type="password" class="form-control login-field" placeholder="Password (*)" name="password" />
			<label class="login-field-icon fui-lock" for="password"></label>
		</div>

		<div class="form-group">
			<input type="password" class="form-control login-field" placeholder="Conferma password (*)" name="password_again" />
			<label class="login-field-icon fui-lock" for="password_again"></label>
		</div>

		<div class="form-group">
			<input type="text" class="form-control login-field" placeholder="Email (*)" name="email" />
			<label class="login-field-icon fui-mail" for="email"></label>
		</div>

		<input type="submit" class="btn btn-primary btn-lg btn-block" value="Registrati">
	</form>
	
</div>


<?php include 'includes/footer.php' ?>

<script type="text/javascript">
	$("input[name='username']").focus();
</script>