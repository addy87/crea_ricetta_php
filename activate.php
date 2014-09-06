<?php
	include "includes/head.php";

	header("Location: login_form.php"); //aggiunto dopo aver eliminato la conferma via mail
	exit(); //aggiunto dopo aver eliminato la conferma via mail

	if(isset($_GET["success"]) === true && empty($_GET["success"]) === true ) {
		echo "<div class='alert alert-success' role='alert'>Email confermata! Procedi pure con l'autenticazione usando la pagina di <a href='login_form.php'>Login</a> :-)</div>";
		include 'includes/footer.php';
		exit();	
	}


	if (logged_in() === true) {
		header("Location: ricetta.php");
		exit();
	}

	if (isset($_GET["email"], $_GET["email_code"]) === true) {
		$email 		= trim($_GET["email"]);
		$email_code = trim($_GET["email_code"]);

		if(email_exists($email) === false) {
			$errors[] = "Qualcosa è andato storto! Indirizzo email non registrato.";
		} else if (activate ($email, $email_code) === false) {
			$errors[] = "Abbiamo riscontrato problemi nell'attivazione del tuo account. Utilizza l'indirizzo che ti è stato inviato via mail. Se non dovessi risolvere, contattaci.";
		}


		if (empty($errors) === false) {
			echo output_errors($errors);
		} else if (empty($errors) === true) {
			header("Location: activate.php?success");
			exit();
		}

	} else {
		header("Location: index.php");
		exit();
	}

?>

<?php include 'includes/footer.php' ?>