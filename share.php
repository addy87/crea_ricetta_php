<script type="text/javascript" src="includes/data/jquery-1.8.3.js"></script>
<?php
	include "includes/head.php";
	

	if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["code"]) && !empty($_GET["code"])) {
		$ricetta = get_ricetta_share($_GET["id"], $_GET["code"]);

		switch ($ricetta) {
			case 'codice_non_valido':
				echo "<p>Spiacente, codice non valido.</p>";
				exit;
				break;
			case 'nessuna_ricetta_da_id':
				echo "<p>Spiacente, nessuna ricetta con questo ID trovata.</p>";
				exit;
				break;			
			default:
				$code_ricetta = $ricetta["code_ricetta"];

				$code_ricetta = preg_replace('/crea_lipide.*/', '', $code_ricetta);
				$code_ricetta = str_replace("add_fase('", "<p class='fase'>", $code_ricetta);
				$code_ricetta = str_replace("');", "</p>", $code_ricetta);
				$code_ricetta = str_replace("add_ingrediente('", "<p class='ingrediente'>", $code_ricetta);
				$code_ricetta = str_replace("add_testo('", "<p class='testo'>", $code_ricetta);
				$code_ricetta = str_replace("', '", " - ", $code_ricetta);		
				$code_ricetta = str_replace("add_riga();", "<br>", $code_ricetta);
				break;
		}
			
	} else {
		header("Location: index.php");
		exit();
	}

	

?>


<div class="container">
	<div class="row ricetta">
		<div class="col-md-12" style="text-align:center">
			<h1 class="titolo"><?php echo $ricetta["titolo_ricetta"]; ?></h1>	
			<p class="autore">Ricetta di <span style="color: #55D4BB"><?php echo $ricetta["username"]; ?></span></p>	
			<?php 
				echo $code_ricetta; 

				if (strlen($ricetta["osservazioni"])>0)
					echo '<p class="osservazioni"><b>Osservazioni:</b> '.$ricetta["osservazioni"].'</p>';

			?>

			
		</div>
	</div>

	<?php
		echo "<a class='btn btn-primary btn-lg btn-edit' href='ricetta.php?modifica_ricetta_share=".$_GET["id"]."&code=".$_GET["code"]."'>Crea una ricetta basata su questa <span class='fui-arrow-right'></span></a>";
	?>

</div>

<?php include 'includes/footer.php' ?>

<script>

</script>

<style>
	.container {
		text-align: center;
	}

	.ricetta {
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
		border-bottom-left-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		background-color: whitesmoke;
		border: 1px solid transparent;
		border-bottom: 5px solid transparent;
		border-bottom-color: #bdc3c7;
		border-left-color: #dfe2e4;
		border-right-color: #dfe2e4;
		border-top-color: #dfe2e4;

		padding-top: 20px;
		padding-bottom: 20px;
		max-width: 800px;
		margin: auto;
		margin-bottom: 40px;
	}
	.container p {
		width: 100%;
		display: block;
		text-align: center;
		word-wrap: break-word;
		margin-bottom: 0;
		font-size: 15px;
	}

	.titolo {
		font-weight: 600;
		font-size: 40px;
		margin: 0;
		color: #16a085;
		text-transform: uppercase;
		word-wrap: break-word;
	}

	p.autore {		
		font-size: 18px;
		margin-bottom: 30px;
	}

	.fase {
		font-weight: 600;
	}

	.ingrediente, .testo {
		font-weight: 200;
	}

	.osservazioni {
		font-weight: 200;
		margin-top: 20px;
	}

	.btn-edit {
		margin-bottom: 30px;
	}

	@media all and (max-width: 600px) {
		.container {
			padding-top: 50px;
		}
	}
	
</style>
