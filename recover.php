<?php
include 'includes/head.php';
if (logged_in() === true) {
	header("Location: index.php");
	exit();
}
?>


	<div class="container">
		<h3>Recupera Username/Password</h3>
		
<?php

if(isset($_GET["success"]) === true && empty($_GET["success"]) === true) {
	echo "<div class='alert alert-success' role='alert'>Dati inviati al tuo indirizzo email :-)<br>Se non dovessi ricevere la mail, controlla nella cartella SPAM/INDESIDERATA!</div>";
}
else {
	$mode_allowed = array("username", "password");

	if (isset($_GET["mode"]) === true && in_array($_GET["mode"], $mode_allowed) === true) {
		if (isset($_POST["email"]) === true && !empty($_POST["email"])) {
			if(email_exists($_POST["email"]) === true) {
				recover($_GET["mode"], $_POST["email"]);
				header("Location: recover.php?success");
				exit();
			} else {
				$errors[] = "L'email inserita non è associata ad alcun account. Riprova.";
			}
		}
	} else {
		header("Location: index.php");
		exit();
	}

	echo output_errors($errors);





	?>
			<form class="login-form animated bounceInLeft" action="" method="post">
				<div class="form-group">
					<input type="text" class="form-control login-field" placeholder="Inserisci il tuo indirizzo email" name="email" />
					<label class="login-field-icon fui-mail" for="username"></label>
				</div>			
				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Recupera dati">
			</form>

		</div>
<?php
}
?>




<?php include 'includes/footer.php' ?>

<script type="text/javascript">
	$("input[name='email']").focus();
</script>