<?php
	include "includes/head.php";
	if (logged_in() === false) {
		header("Location: login_form.php");
		exit();
	}

	if (isset($_GET["cancella"]) && !empty($_GET["cancella"])) {
		if (logged_in() === false) {
			header("Location: login_form.php");
			exit();
		} else {
			if(cancella_ricetta($user_data["user_id"], $_GET["cancella"])){
				header("Location: profile.php");
			}	
			
		}

	}

	if (isset($_GET["modifica"]) && !empty($_GET["modifica"])) {
		if (logged_in() === false) {
			header("Location: login_form.php");
			exit();
		} else {
			modifica_ricetta($user_data["user_id"], $_GET["modifica"]);			
		}

	}

	if (isset($_GET["nome_ingrediente_inventario"]) && !empty($_GET["nome_ingrediente_inventario"]) && isset($_GET["categoria_ingrediente_inventario"]) && !empty($_GET["categoria_ingrediente_inventario"])) {
		$username = username_from_user_id($user_data["user_id"]);
		$nome_ingrediente = str_replace("\\", "/", $_GET["nome_ingrediente_inventario"]);
		$nome_ingrediente = addslashes($nome_ingrediente);

		$categoria_ingrediente = str_replace("\\", "/", $_GET["categoria_ingrediente_inventario"]);
		$categoria_ingrediente = addslashes($categoria_ingrediente);

		if(controllo_esistenza_ingrediente_in_inventario($username, $nome_ingrediente)) {
			aggiungi_ingrediente_inventario($username, $nome_ingrediente, $categoria_ingrediente);
		} else {
			$errors[] = "Ingrediente già presente nel tuo inventario.";
		}				
	} 

	if (isset($_GET["cancella_ingrediente_inventario"]) && !empty($_GET["cancella_ingrediente_inventario"])) {
		$username = username_from_user_id($user_data["user_id"]);
		$id = (int) $_GET["cancella_ingrediente_inventario"];

		cancella_ingrediente_inventario($username, $id);


	} 
	


?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Profilo di <?php echo $user_data["username"] ?></h3>
			
		</div>
	</div>


	<div class="panel panel-default row sezione" style="margin-top:40px">
		

		<div class="panel-body body-change">
			<div class="col-xs-6">
				<a type="button" class="btn btn-block btn-large btn-primary" href="change_password.php">Cambia Password</a>
			</div>
			<div class="col-xs-6">
				<a type="button" class="btn btn-block btn-large btn-primary" href="change_email.php">Cambia Email</a>
			</div>
		</div>
	</div>


	<div class="panel panel-default row sezione">
		<div class="panel-heading">
			<h3 class="panel-title">Cancella o modifica le tue ricette salvate.</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-12">			
				<p class="small">Attenzione! Una volta cancellata una ricetta non sarà più possibile poterla recuperare.</p>
				<table id="tabella_ricette" class="table" style="text-align: center">
					<th>TITOLO RICETTA</th>
					<th>DATA DI CREAZIONE</th>
					<th>ELABORA</th>
				
					<?php
						$ricette = get_ricette($user_data["user_id"]);

						if ($ricette == "zero_ricette") {
							echo "<tr><td colspan='3'>Non hai ancora salvato nessuna ricetta. <a href='ricetta.php' style='font-weight: bold;'>Crea la tua prima ricetta!</a></td></tr>";
						} else {
							foreach ($ricette as $ricetta) {
								echo "<tr><td>". $ricetta["titolo_ricetta"] ."</td><td>". $ricetta["data"] ."<td><a class='btn btn-danger btn-sm btn_elabora' href='?cancella=". $ricetta["ricetta_id"] ."'><span class='fui-cross'></span> Cancella</a><a class='btn btn-success btn-sm btn_elabora' href='?modifica=". $ricetta["ricetta_id"] ."'><span class='fui-new'></span> Modifica</a></td></tr>";
							}
						}
					?>
				</table>
			</div>
		</div>
	</div>


	<div class="panel panel-default row sezione">
		<div class="panel-heading">
			<h3 class="panel-title">Aggiungi ingredienti al tuo inventario</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-12">
				<p class="small">Da qui puoi aggiungere ingredienti al tuo inventario. Questi li ritroverai nella pagina della ricetta, comodamente disponibili ad un'aggiunta immediata.</p>
				<?php
					echo output_errors($errors);

				?>


				<form action="" method="get" id="form_inventario">
					<input type="text" name="nome_ingrediente_inventario" class="form-control login-field" placeholder="Nome ingrediente" />
					<input type="text" name="categoria_ingrediente_inventario" class="form-control login-field" placeholder="Categoria ingrediente" />
					<input type="submit" value="Aggiungi ingrediente" class="btn btn-primary" id="submit_inventario"/>
				</form>
			</div>
			<div id="elenco_ingredienti_inventario">
				<?php
					$ingredienti_inventario = get_ingredienti_inventario($user_data["user_id"]);
					$categorie = array();

					if($ingredienti_inventario != "zero_ingredienti_inventario") {
						foreach ($ingredienti_inventario as $ingrediente_inventario) {

							$categorie[] = $ingrediente_inventario["categoria"];
						}
						
						$categorie = array_unique($categorie);

						foreach ($categorie as $categoria) {
							echo '<div class="panel panel-default row categoria">
									<div class="panel-heading heading-categoria">
										<h3 class="panel-title">'. $categoria .'</h3>
									</div>
									<div class="panel-body">

									';
						
							foreach ($ingredienti_inventario as $ingrediente_inventario) {
								if($ingrediente_inventario["categoria"] == $categoria) {
									$id = (int) $ingrediente_inventario["ingrediente_id"];
									$query = "href='?cancella_ingrediente_inventario=". $id ."'";
									echo "<a type='button' class='btn btn-default ingrediente_inventario' ".  $query ."><span class='glyphicon glyphicon-remove' style='color:#d9534f'></span>".$ingrediente_inventario["nome_ingrediente"]."</a>";
								}
							}
							echo "</div></div>";

						}
						

					} else {
						echo "<p class='small' style='text-align:center'>Non hai ancora alcun ingrediente nel tuo inventario. Aggiungi il primo! :-)</p>";
					}

					
				?>
			</div>
		</div>
	</div>
	

		
</div>

<?php include 'includes/footer.php' ?>
<!--<script type="text/javascript" src="includes/data/masonry.pkgd.js"></script>-->
<script>
	
	$("input[name='nome_ingrediente_inventario']").focus();


	$(".btn-danger, .ingrediente_inventario").click(function(evt) {		
		var conferma = confirm("Sei sicuro di voler cancellare questo elemento?");
		if (conferma) {
			return true;
		} else {
			evt.preventDefault();
		}
		
	});

	$("#form_inventario").submit(function() {
		if($("input[name='nome_ingrediente_inventario']").val().length == 0 || $("input[name='categoria_ingrediente_inventario']").val().length == 0 || $("input[name='nome_ingrediente_inventario']").val().replace(/ /g,'').length == 0 || $("input[name='categoria_ingrediente_inventario']").val().replace(/ /g,'').length == 0) {
			alert("Per favore, compila tutti i campi");
			$("input[name='nome_ingrediente_inventario']").focus();
			return false;
		}
	});


</script>

<style>
	.panel-default > .panel-heading {
		background-color: #1abc9c;
		color: white;
		text-align: center;
	}

	.panel-body {
		background-color: whitesmoke;
		padding: 5px;
	}

	.panel-title {
		font-weight: 200;
	}

	.body-change {
		padding:20px;
	}

	.sezione, .categoria {
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
		margin-top: 75px;

	}



	th {
		text-align: center;
		vertical-align: middle;
	}	

	tr:nth-child(odd) {
		background-color: rgba(200,200,200,0.1);
	}



	.table > tbody > tr > td {
		vertical-align: middle;
	}

	form {
		text-align: center;
	}

	.form-control {
		width: 25%;
		display: inline-block;
	}

	.categoria {
		float:left;
		width: 48%;
		margin: 11px;
	}

	.categoria .panel-body {
		background-color: #e7e7e7;
	}

	.panel-heading.heading-categoria {
		background-color: #3498db;
	}

	.ingrediente_inventario {
		white-space: normal;
		word-break: break-all;
		color: #34495e;
		margin: 5px;
	}

	#elenco_ingredienti_inventario {
		width: auto;
	}


	@media (max-width:1199px) {
		.categoria {
			width: 47%;
		}
	}

	@media (min-width: 581px) and (max-width: 770px) {
		.categoria {
			width: auto;
		}

	}
	@media (min-width: 580px) {
		.btn_elabora:first-child {
			margin-right: 5px;
		}
		
		td:last-child {
			width: 210px;
		}
	}

	@media (max-width: 579px) {
		.btn_elabora {
			display: block;
		}
		.btn_elabora:first-child {
			margin-right: 0px;
			margin-bottom: 10px;
		}

		.form-control {
			display: block;
			width: 100%;
			margin-bottom: 10px;
		}

		.categoria {
			float:left;
			width: auto;
		}

		.ingrediente_inventario {
			margin: 5px;
		}
	}

	
</style>
