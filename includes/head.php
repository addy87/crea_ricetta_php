<?php include "core/init.php"; ?>
<html>
<head>
	<title>ARC | Crea Ricetta</title>
	<meta charset='utf-8'/>
	<meta name="viewport" content="width=device-width, user-scalable=no initial-scale=0.8">

	<meta name="description" content="Applicazione per l'elaborazione di ricette cosmetiche con  strumenti di controllo e gestione. Salva la tua ricetta all'interno del tuo account e modificala quando e come vuoi!">
	<meta name="keywords" content="spignatto, spignatti, cosmetica, cosmetici, ricetta, ricette, produzione, elaborazione, autoproduzione, strumento, account">
	<meta name="author" content="Augusten">
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />

	<meta property="og:description" content="Applicazione per l'elaborazione di ricette cosmetiche con  strumenti di controllo e gestione. Salva la tua ricetta all'interno del tuo account e modificala quando e come vuoi!"/>
	<meta property="og:description" content="http://augusten.altervista.org/crea-ricetta/includes/data/images/arc2.png"/>


	<link rel="stylesheet" href="includes/data/bootstrap/css/bootstrap.css"></link>
	<link rel="stylesheet" href="includes/data/flat/flat-ui.css">
	<link rel="stylesheet" href="css/main.css"></link>
	<link rel="stylesheet" href="includes/data/animate/animate.css"></link>
	
	<link rel="shortcut icon" type="image/x-icon" href="data/images/favicon.ico"/>
</head>

<body>
	<div class="wrapper"><!--Primo wrapper chiuso in footer.php-->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
					if (logged_in() === true) 
					{
				?>
						<a class="navbar-brand brand_autenticato" href="index.php"><img src="includes/data/images/arc_little.png" /></a>
						<p class="navbar-text">Ciao 
						<a href="profile.php" class="navbar-link nome_utente"><?php echo strtoupper($user_data["username"])?></a>
						<span style="margin-left:10px; margin-right: 10px">|</span> 
						<a href="ricetta.php" class="navnbar-link ricetta-link">Crea la tua ricetta</a>
						</p>

				<?php
					} else if (logged_in() === false) {
				?>
						<a class="navbar-brand" href="index.php">Crea Ricetta</a>
						<p class="navbar-text" style="margin-right:0"><a href="login_form.php" class="navbar-link nome_utente">LOGIN</a></p>
				<?php		
					}
				?>
				
			</div>
			<div class="navbar-collapse collapse">
				
				<ul class="nav navbar-nav">
					<li><a href="ricetta.php">Crea la tua ricetta</a></li>
					
					<?php
						if (logged_in() === false) 
						{
					?>
						<li><a href="login_form.php">Login</a></li>
						<li><a href="register.php">Registrati</a></li>
					



					<?php
						} else if (logged_in() === true) {
					?>
						<li><a href="profile.php">Profilo</a></li>
					<?php 
						}
					?>


					<li><a href="info.php">Info</a></li>
					<li><a href="contact.php">Contact</a></li>

					<?php
						if (logged_in() === true) {
					?>
						<li><a href="logout.php">Logout</a></li>
					<?php 
						}
					?>

				</ul>

				
			</div>
		</nav>