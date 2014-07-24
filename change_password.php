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
			<h3>Cambia Password</h3>


			

<?php

	if (isset($_GET["success"]) && empty($_GET["success"])) {
			echo "<div class='alert alert-success' role='alert'>Password modificata con successo.</div>";
		}
	
		if (empty($_POST) === false) {
			$required_fields = array("current_password", "password", "password_again");


			foreach($_POST as $key=>$value) {
				if(empty($value) && in_array($key, $required_fields) === true) {
					$errors[] = "Inserisci tutti i campi richiesti!";
					break 1;
				}
			}


			if (md5($_POST["current_password"]) === $user_data["password"]) {
				if (trim($_POST["password"]) !== trim($_POST["password_again"])) {
					$errors[] = "I campi nuova password non coincidono. Per favore, riscrivi la tua nuova password.";
				} else if (strlen($_POST["password"]) < 6) {
					$errors[] = "La nuova password dev'essere compresa tra 7 e 32 caratteri.";
				}
			} else {
				$errors[] = "Password incorretta.";
			}
		

			

			if (empty($_POST) === false && empty($errors) === true) {
				change_password($session_user_id, $_POST["password"]);
				header("Location: change_password.php?success");

			} else if (empty($errors) === false) {
				echo output_errors($errors);
			}



		}
	

	

?>

			<form class="login-form" action="" method="post">
				<div class="form-group">
					<input type="password" class="form-control login-field" placeholder="Password attuale (*)" name="current_password" />
					<label class="login-field-icon fui-lock" for="current_password"></label>
				</div>
				<div class="form-group">
					<input type="password" class="form-control login-field" placeholder="Nuova password (*)" name="password" />
					<label class="login-field-icon fui-lock" for="password"></label>
				</div>

				<div class="form-group">
					<input type="password" class="form-control login-field" placeholder="Conferma nuova password (*)" name="password_again" />
					<label class="login-field-icon fui-lock" for="password_again"></label>
				</div>

				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Aggiorna">
			</form>

		</div>
	</div>
</div>

<?php include 'includes/footer.php' ?>