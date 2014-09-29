<script type="text/javascript" src="includes/data/jquery-1.8.3.js"></script>
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
		$nome_ingrediente = str_replace("\"", "`", $nome_ingrediente);
		$nome_ingrediente = str_replace("'", "`", $nome_ingrediente);
		$nome_ingrediente = trim($nome_ingrediente);
		$nome_ingrediente = addslashes($nome_ingrediente);

		$categoria_ingrediente = str_replace("\\", "/", $_GET["categoria_ingrediente_inventario"]);
		$categoria_ingrediente = str_replace("\"", "`", $categoria_ingrediente);
		$categoria_ingrediente = str_replace("'", "`", $categoria_ingrediente);
		$categoria_ingrediente = trim($categoria_ingrediente);
		$categoria_ingrediente = addslashes($categoria_ingrediente);

		$inventario_note = str_replace("\\", "/", $_GET["inventario_note"]);
		$inventario_note = str_replace("\"", "`", $inventario_note);
		$inventario_note = str_replace("'", "`", $inventario_note);
		$inventario_note = trim($inventario_note);
		$inventario_note = addslashes($inventario_note);

		if(controllo_esistenza_ingrediente_in_inventario($username, $nome_ingrediente)) {
			aggiungi_ingrediente_inventario($username, $nome_ingrediente, $categoria_ingrediente, $inventario_note);
		} else {
			$errors[] = "E' già presente nell'inventario un ingrediente con questo nome. Prova ad aggiungerne un altro o modifica quello già presente.";
		}


		echo "<script>function focus() { $(\"input[name='nome_ingrediente_inventario']\").focus(); $('html, body').animate({scrollTop: $('.sezione:last-child').offset().top+50}, 1000);; }</script>";
	} 

	if (isset($_GET["cancella_ingrediente_inventario"]) && !empty($_GET["cancella_ingrediente_inventario"])) {
		$username = username_from_user_id($user_data["user_id"]);
		$id = (int) $_GET["cancella_ingrediente_inventario"];

		cancella_ingrediente_inventario($username, $id);
		echo "<script>function focus() { $(\"input[name='nome_ingrediente_inventario']\").focus(); $('html, body').animate({scrollTop: $('.sezione:last-child').offset().top+50}, 1000);; }</script>";

	} 
	

	if (isset($_GET["nuovo_nome_ingrediente"]) && isset($_GET["nuova_categoria_ingrediente"]) && isset($_GET["nuova_nota_ingrediente"]) && isset($_GET["ingrediente_id"]) && empty($_GET["ingrediente_id"]) === false) {
		$username = username_from_user_id($user_data["user_id"]);

		$nuovo_nome_ingrediente = str_replace("\\", "/", $_GET["nuovo_nome_ingrediente"]);
		$nuovo_nome_ingrediente = str_replace("\"", "`", $nuovo_nome_ingrediente);
		$nuovo_nome_ingrediente = str_replace("'", "`", $nuovo_nome_ingrediente);
		$nuovo_nome_ingrediente = trim($nuovo_nome_ingrediente);
		$nuovo_nome_ingrediente = addslashes($nuovo_nome_ingrediente);

		$nuova_categoria_ingrediente = str_replace("\\", "/", $_GET["nuova_categoria_ingrediente"]);
		$nuova_categoria_ingrediente = str_replace("\"", "`", $nuova_categoria_ingrediente);
		$nuova_categoria_ingrediente = str_replace("'", "`", $nuova_categoria_ingrediente);
		$nuova_categoria_ingrediente = trim($nuova_categoria_ingrediente);
		$nuova_categoria_ingrediente = addslashes($nuova_categoria_ingrediente);

		$nuova_nota_ingrediente = str_replace("\\", "/", $_GET["nuova_nota_ingrediente"]);
		$nuova_nota_ingrediente = str_replace("\"", "`", $nuova_nota_ingrediente);
		$nuova_nota_ingrediente = str_replace("'", "`", $nuova_nota_ingrediente);
		$nuova_nota_ingrediente = trim($nuova_nota_ingrediente);
		$nuova_nota_ingrediente = addslashes($nuova_nota_ingrediente);

		$ingrediente_id = (int) $_GET["ingrediente_id"];
		aggiorna_ingrediente_inventario($username, $ingrediente_id, $nuovo_nome_ingrediente, $nuova_categoria_ingrediente, $nuova_nota_ingrediente);

		
		echo "<script>function focus() { $('html, body').animate({scrollTop: $('.sezione:last-child').offset().top-75}, 1000); }</script>";
		
	}


?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Profilo di <span style="color:#1abc9c"><?php echo $user_data["username"] ?></span></h3>
			
		</div>
	</div>


	<div class="panel panel-default row sezione" style="margin-top:0px">
		

		<div class="panel-body body-change">
			<div class="col-xs-6">
				<a type="button" class="btn btn-block btn-sm btn-primary" href="change_password.php">Cambia Password</a>
			</div>
			<div class="col-xs-6">
				<a type="button" class="btn btn-block btn-sm btn-primary" href="change_email.php">Cambia Email</a>
			</div>
		</div>
	</div>


	<div class="panel panel-default row sezione">
		<div class="panel-heading panel-heading-ricette">
			<h3 class="panel-title">Gestisci le tue ricette salvate.</h3>
		</div>

		<div class="panel-body">
			<div class="col-md-12">			
				<p class="small">Clicca su una ricetta per vederne i dettagli, modificarla o cancellarla. Puoi anche trascinare le ricette per riordinarle.</p>
				
				
				<?php
					$ricette = get_ricette($user_data["user_id"]);

					if ($ricette == "zero_ricette") {
						echo "<tr><td colspan='3'>Non hai ancora salvato nessuna ricetta. <a href='ricetta.php' style='font-weight: bold;'>Crea la tua prima ricetta!</a></td></tr>";
					} else {
						echo '<ul id="draggablePanelList">';
						foreach ($ricette as $ricetta) {
							$code_ricetta = $ricetta["code_ricetta"];

							$code_ricetta = preg_replace('/crea_lipide.*/', '', $code_ricetta);

							$code_ricetta = str_replace("add_fase('", "", $code_ricetta);
							$code_ricetta = str_replace("');", "<br>", $code_ricetta);
							$code_ricetta = str_replace("add_ingrediente('", "", $code_ricetta);
							$code_ricetta = str_replace("add_testo('", "", $code_ricetta);
							$code_ricetta = str_replace("', '", " - ", $code_ricetta);

							
							$code_ricetta = str_replace("add_riga();", "<br>", $code_ricetta);

							//echo "<tr><td>". $ricetta["titolo_ricetta"] ."</td><td>". $ricetta["data"] ."<td><a class='btn btn-danger btn-sm btn_elabora' href='?cancella=". $ricetta["ricetta_id"] ."'><span class='fui-cross'></span> Cancella</a><a class='btn btn-success btn-sm btn_elabora' href='?modifica=". $ricetta["ricetta_id"] ."'><span class='fui-new'></span> Modifica</a></td></tr>";
							
							echo '<li class="panel panel-default panel-ricetta" id="ricetta'. $ricetta["ricetta_id"] .'"><div class="panel-heading nome-ricetta-panel"><a data-toggle="collapse" data-parent="#ricetta'. $ricetta["ricetta_id"] .'" href="#ricettacollapse'. $ricetta["ricetta_id"] .'" class="panel-title nome-ricetta-a">'.$ricetta["titolo_ricetta"]."<br><span class='data'>". $ricetta["data"] ."</span></a></div>";
							echo'<div id="ricettacollapse'. $ricetta["ricetta_id"] .'" class="panel-collapse collapse"><div class="panel-body panel-body-ricetta" style="text-align:center">'. $code_ricetta;

							if (strlen($ricetta["osservazioni"]) > 0) {
								echo "<br>".$ricetta["osservazioni"];
							}
							echo "<div class='controller_ricetta'><a class='btn btn-danger btn-sm btn_elabora' href='?cancella=". $ricetta["ricetta_id"] ."'><span class='fui-cross'></span> Cancella</a><a class='btn btn-success btn-sm btn_elabora' href='?modifica=". $ricetta["ricetta_id"] ."'><span class='fui-new'></span> Modifica</a></div>";
							echo '</div>';
							echo '</div></li>';

							
						}

						echo "</ul>";
					}
				?>
				
			</div>
		</div>
	</div>


	<div class="panel panel-default row sezione">
		<div class="panel-heading panel-heading-inventario">
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
					<textarea name="inventario_note" rows="8" class="form-control login-field" placeholder="Note sull'ingrediente"></textarea>
					<input type="submit" value="Aggiungi ingrediente" class="btn btn-success" id="submit_inventario"/>
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
										<h3 class="panel-title" style="word-break: break-all;">'. $categoria .'</h3>
									</div>
									<div class="panel-body">

									';
						
							foreach ($ingredienti_inventario as $ingrediente_inventario) {
								if($ingrediente_inventario["categoria"] == $categoria) {
									
									$id = (int) $ingrediente_inventario["ingrediente_id"];
									$query = "href='?cancella_ingrediente_inventario=". $id ."'";
									echo '<div class="panel-group" id="accordion'.$id.'"><div class="panel panel-default panel-ingrediente"><div class="panel-heading nome-ingrediente-panel"><a data-toggle="collapse" data-parent="#accordion'.$id.'" href="#collapse'.$id.'" class="panel-title nome-ingrediente-a">'.$ingrediente_inventario["nome_ingrediente"]."<b class='caret'></b></a></div>";
									echo'<div id="collapse'.$id.'" class="panel-collapse collapse"><div class="panel-body panel-body-ingrediente" style="text-align:center">';

									echo "<form action='' method='get' class='form-inventario-modifica'><input type='text' class='form-control login-field' name='nuovo_nome_ingrediente' placeholder='Nuovo nome ingrediente' value='".$ingrediente_inventario["nome_ingrediente"]."'/><input type='text' class='form-control login-field' name='nuova_categoria_ingrediente' placeholder='Nuova categoria ingrediente' value='".$ingrediente_inventario["categoria"]."' />";

									if(strlen($ingrediente_inventario["inventario_note"])>0) {
										echo "<textarea rows='8' class='form-control login-field' name='nuova_nota_ingrediente'>".$ingrediente_inventario["inventario_note"]."</textarea>";
									} else {
										echo "<textarea rows='2' placeholder='Non hai inserito nessuna nota per questo ingrediente' class='form-control login-field'  name='nuova_nota_ingrediente'></textarea>";
									}


									echo "<input type='hidden' value='". $ingrediente_inventario["ingrediente_id"] ."' name='ingrediente_id' /><input type='submit' value='Aggiorna' class='btn btn-success' /></form>";
									echo "<a type='button' class='btn btn-sm btn-danger ingrediente_inventario' ".  $query ." toggle='0'><span class='fui-cross'></span> Cancella Ingrediente</a>";
									echo "</div></div></div></div>";
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
<script type="text/javascript" src="includes/data/touch.js"></script>
<script>
	
	$('#draggablePanelList').sortable();
	$('#draggablePanelList').disableSelection();




	$(".btn-danger, .ingrediente_inventario").click(function(evt) {		
		

		var conferma = confirm("Cancellare definitivamente questo elemento?");
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
		$("input[name='nome_ingrediente_inventario']").focus();
	});


	$(".form-inventario-modifica").submit(function(e) {
		if($(this).children("input[name='nuovo_nome_ingrediente']").val().length == 0 || $(this).children("input[name='nuova_categoria_ingrediente']").val().length == 0 || $(this).children("input[name='nuovo_nome_ingrediente']").val().replace(/ /g,'').length == 0 || $(this).children("input[name='nuova_categoria_ingrediente']").val().replace(/ /g,'').length == 0) {
			alert("Per favore, compila i campi Nome e Categoria");
			$(this).children("input[name='nuovo_nome_ingrediente']").focus();
			return false;
		}
		$("input[name='nome_ingrediente_inventario']").focus();
	});




	try {
		setTimeout(focus, 500);
	}catch(err) {

	}

	function apri_sezione(id) {
		console.log(id);
	}


</script>

<style>
	.categoria-big {
		width: 98%;
	}
	.panel-default > .panel-heading {
		background-color: #67A296;
		color: white;
		text-align: center;
	}

	.panel-body {
		background-color: whitesmoke;
		padding: 5px;
	}

	.panel-title {
		font-weight: 400;
	}

	.body-change {
		padding: 10px;
	}

	.sezione, .categoria, .panel-body-ingrediente, .panel-body-ricetta {
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
		margin-top: 50px;
	}

	.panel-body-ricetta {
		margin-top: 0px;
		background-color: #e7e7e7 !important;
		font-size: 14px;
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
		width: 80%;
		margin: auto;
		margin-bottom: 50px;
	}

	.form-control {
		display: block;
		width: 100%;
		margin-bottom: 10px;
	}

	#draggablePanelList {
		margin: 0;
		padding: 0;
	}

	.nome-ricetta-a, .nome-ricetta-a:hover {
		color: white;
		font-weight: 400 !important;
		text-transform: uppercase;
		cursor: move;
	}

	.data {
		font-weight: 200;
		font-size: 12px;
	}

	.panel-heading-ricette {
		background-color: #339E51 !important;
	}

	.panel-heading-inventario {
		background-color: #1671AC !important;
	}

	.panel-ricetta > .nome-ricetta-panel {
		background-color: #69AD7A;
		padding:3px 10px;		
	}

	.controller_ricetta {
		margin-top: 20px;
	}

	.categoria, .panel-ricetta {
		float:left;
		width: 48%;
		margin: 11px;
		list-style: none;
	}

	.panel-heading.heading-categoria  {
		background-color: #629ABE;				
	}

	.categoria .panel-body {
		background-color: #e7e7e7;
		padding-top: 30px;
		padding-bottom: 30px;
	}

	.panel-ingrediente {
		width: 90%;
		margin: auto;
	}

	.ingrediente_inventario {
		white-space: normal;
		word-break: break-all;
		color: white;
	}

	#elenco_ingredienti_inventario {
		width: auto;
	}

	.nome-ingrediente-panel {
		background-color: #8BB4CF !important;
		padding:3px 10px !important;		
	}

	.nome-ingrediente-a,  .nome-ricetta-a{
		width: 100%;
		display: block;
		color:white;
		font-weight: 200;
	}
	.nome-ingrediente-a:hover {
		color:white;
	}

	.panel-body-ingrediente {
		background-color: #F8F8F8 !important;
		margin-top: 0;
		padding: 20px 30px;
	}

	.categoria > .panel-body > .panel-group {
		margin-bottom:10px;
	}

	.btn-success {
		background-color: #5FCA8C;
	}

	.btn-danger {
		color: #ffffff;
		background-color: #D66A5F;
	}

	.caret {
		border-bottom-color: #467B99;
		border-top-color: #467B99;
		margin-left: 18px;
	}

	@media (max-width:1199px) {
		.categoria, .panel-ricetta {
			width: 48%;
			margin: 9px;
		}
	}

	@media (max-width: 991px) {
		.categoria, .panel-ricetta {
			width: 99%;
			margin: 5px;
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

		
	}

	
</style>
