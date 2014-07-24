<?php
	include "includes/head.php";
	if (logged_in() === false) {
		header("Location: login_form.php");
		exit();
	}


?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Cambia Email</h3>


			

<?php

	if (isset($_GET["success"]) && empty($_GET["success"])) {
			echo "<div class='alert alert-success' role='alert'>Email modificata con successo.</div>";
		}
	
		if (empty($_POST) === false) {
			$required_fields = array("current_email", "email", "email_again");


			foreach($_POST as $key=>$value) {
				if(empty($value) && in_array($key, $required_fields) === true) {
					$errors[] = "Inserisci tutti i campi richiesti!";
					break 1;
				}
			}


			if ($_POST["current_email"] === $user_data["email"]) {
				if (trim($_POST["email"]) !== trim($_POST["email_again"])) {
					$errors[] = "I campi nuova email non coincidono. Per favore, riscrivi la tua nuova email.";				
				} else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
					$errors[] = "Inserisci un nuovo indirizzo email valido";
				} else if (email_exists($_POST["email"]) === true && $user_data["email"] !== $_POST["email"]) {
					$errors[] = "L'indirizzo email fornito è già associato ad un altro utente. Riprova.";
				}				
			} else {
				$errors[] = "Email attuale incorretta.";
			}
		

			

			if (empty($_POST) === false && empty($errors) === true) {
				change_email($session_user_id, $_POST["email"]);
				header("Location: change_email.php?success");

			} else if (empty($errors) === false) {
				echo output_errors($errors);
			}



		}
	

	

?>

			<form class="login-form" action="" method="post">
				<div class="form-group">
					<input type="text" class="form-control login-field" placeholder="Email attuale (*)" name="current_email" />
					<label class="login-field-icon fui-mail" for="current_email"></label>
				</div>
				<div class="form-group">
					<input type="text" class="form-control login-field" placeholder="Nuova email (*)" name="email" />
					<label class="login-field-icon fui-mail" for="email"></label>
				</div>

				<div class="form-group">
					<input type="text" class="form-control login-field" placeholder="Conferma nuova email (*)" name="email_again" />
					<label class="login-field-icon fui-mail" for="email_again"></label>
				</div>

				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Aggiorna">
			</form>

		</div>
	</div>
</div>

<?php include 'includes/footer.php' ?>