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
				header("Location: ricette.php");
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

	if (isset($_GET["ricetta_id"]) && !empty($_GET["ricetta_id"]) && isset($_GET["cartella"]) && !empty($_GET["cartella"])) {
		if (logged_in() === false) {
			header("Location: login_form.php");
			exit();
		} else {
			if ($_GET["cartella"] === "nuova_cartella" && isset($_GET["nuova_cartella"]) && !empty($_GET["nuova_cartella"])) {
				$nuova_cartella = str_replace("\\", "/", $_GET["nuova_cartella"]);
				$nuova_cartella = str_replace("\"", "`", $nuova_cartella);
				$nuova_cartella = str_replace("'", "`", $nuova_cartella);
				$nuova_cartella = trim($nuova_cartella);
				$nuova_cartella = addslashes($nuova_cartella);

				sposta_ricetta($user_data["user_id"], $_GET["ricetta_id"], $nuova_cartella);
			} else {
				$cartella = str_replace("\\", "/", $_GET["cartella"]);
				$cartella = str_replace("\"", "`", $cartella);
				$cartella = str_replace("'", "`", $cartella);
				$cartella = trim($cartella);
				$cartella = addslashes($cartella);
				sposta_ricetta($user_data["user_id"], $_GET["ricetta_id"], $cartella);
			}
		}
	}

	

?>


<div class="container">
	<div class="row">
		<div class="col-md-12" style="text-align:center">
			<h1 style="margin-bottom:30px">Le tue ricette</h1>	
			<p>In questa pagina puoi gestire le tue ricette salvate.</p>	
			<p class="small">Le nuove ricette verrano automaticamente salvate all'interno della cartella <b>VARIE</b>. Per spostare una ricetta in una <b>nuova cartella</b>, espandi la ricetta di tuo interesse e scegli se creare una nuova cartella o se spostarla all'interno di una cartella già esistente.</p>	
		</div>
	</div>
	

	<div class="panel panel-default row"><div class="panel-heading" style="background: #0F695B"><h3 class="panel-title">Tutte le ricette</h3></div><div class="panel-body">
	
	<?php
		
		$cartelle = get_cartelle($user_data["user_id"]);
		$ricette_count = get_ricette($user_data["user_id"]);



		if ($ricette_count == "zero_ricette") {
			echo "<h4 style='text-align:center'>Non hai ancora salvato nessuna ricetta. <a href='ricetta.php' style='font-weight: bold;'>Crea la tua prima ricetta!</a> :-)</h4>";
		} else {
			if(isset($_GET["order"]) && !empty($_GET["order"])) {
				switch ($_GET["order"]) {
					case "name_asc":
						echo "<p class='small order'>Ordina ricette per: <a href='?order=name_desc' style='font-weight:400'>Nome <span class='glyphicon glyphicon-chevron-up'></span></a> - <a href='?order=date_asc'>Data</a></p>";
						break;
					case "date_asc":
						echo "<p class='small order'>Ordina ricette per: <a href='?order=name_asc'>Nome</a> - <a href='?order=date_desc' style='font-weight:400'>Data <span class='glyphicon glyphicon-chevron-up'></span></a></p>";
						break;
					case "name_desc":
						echo "<p class='small order'>Ordina ricette per: <a href='?order=name_asc' style='font-weight:400'>Nome <span class='glyphicon glyphicon-chevron-down'></span></a> - <a href='?order=date_asc'>Data</a></p>";
						break;
					case "date_desc":
						echo "<p class='small order'>Ordina ricette per: <a href='?order=name_asc'>Nome</a> - <a href='?order=date_asc' style='font-weight:400'>Data <span class='glyphicon glyphicon-chevron-down'></span></a></p>";
						break;
					default:
						echo "<p class='small order'>Ordina ricette per: <a href='?order=name_asc'>Nome</a> - <a href='?order=date_desc' style='font-weight:400'>Data <span class='glyphicon glyphicon-chevron-up'></span></a></p>";
				}

			} else {
				echo "<p class='small order'>Ordina ricette per: <a href='?order=name_asc'>Nome</a> - <a href='?order=date_desc' style='font-weight:400'>Data <span class='glyphicon glyphicon-chevron-up'></span></a></p>";
			}


			

			foreach ($cartelle as $cartella) {
				
				echo '<div class="panel panel-default panel-ricetta"><div class="panel-heading"><h3 class="panel-title">'.$cartella.'</h3></div><div class="panel-body">';


				if(isset($_GET["order"]) && !empty($_GET["order"])) {
					$ricette = get_ricette_da_cartella($user_data["user_id"], $cartella, $_GET["order"]);
				} else {
					$ricette = get_ricette_da_cartella($user_data["user_id"], $cartella);
				}

				echo '<ul class="draggablePanelList">';
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
						
						echo '<li class="panel panel-default panel-ricetta-singola" id="ricetta'. $ricetta["ricetta_id"] .'"><div class="panel-heading nome-ricetta-panel"><a data-toggle="collapse" data-parent="#ricetta'. $ricetta["ricetta_id"] .'" href="#ricettacollapse'. $ricetta["ricetta_id"] .'" class="panel-title nome-ricetta-a">'.$ricetta["titolo_ricetta"]."<br><span class='data'>". $ricetta["data"] ."</span></a></div>";
						echo'<div id="ricettacollapse'. $ricetta["ricetta_id"] .'" class="panel-collapse collapse"><div class="panel-body panel-body-ricetta" style="text-align:center">'. $code_ricetta;

						if (strlen($ricetta["osservazioni"]) > 0) {
							echo "<br>".$ricetta["osservazioni"];
						}
						echo "<div class='controller_ricetta'><a class='btn btn-danger btn-sm btn_elabora' href='?cancella=". $ricetta["ricetta_id"] ."'><span class='fui-cross'></span> Cancella ricetta</a><a class='btn btn-success btn-sm btn_elabora' href='?modifica=". $ricetta["ricetta_id"] ."'><span class='fui-new'></span> Modifica ricetta</a></div>";

						echo "<div class='panel-body panel-cartella'>";

						echo "<form action='' method='GET' class='form-inventario-modifica'>";
						echo "<input type='hidden' name='ricetta_id' value='".$ricetta["ricetta_id"]."' />";
						if (count($cartelle) == 1) {
							echo "Sposta la ricetta in una nuova cartella:";
							echo "<input type='text' name='cartella' placeholder='Nome della nuova cartella?' class='form-control login-field'/>";
							echo "<input type='submit' class='btn btn-sm btn-info submit_cartelle' value='Crea cartella e sposta ricetta'/></form>";
						} else {
							echo "<select name='cartella' class='selettore_cartella form-control login-field'>";
							echo "<option value='selettore_starter'>Sposta questa ricetta nella cartella...</option>";
							foreach ($cartelle as $cartella2) {
								if($cartella2 != $cartella)
								echo "<option value='".$cartella2."'>- ".$cartella2."</option>";
							}
							echo "<option value='nuova_cartella'>Crea una nuova cartella</option>";
							echo "<input type='text' name='nuova_cartella' class='form-control login-field' style='display: none'/>";
							echo "</select>";
							echo "<input type='submit' class='btn btn-sm btn-info submit_cartelle' style='display: none' value='Sposta nella cartella'/></form>";
						}
						

						echo '</div>';
						echo "<btn class='btn btn-info btn-sm btn-share' ricetta=".$ricetta["ricetta_id"]."'><img src='includes/data/images/share.png' width='18'/></btn>";
						echo '<input type="text" class="input-share form-control login-field" value="http://augusten.altervista.org/crea-ricetta/share.php?id='.$ricetta["ricetta_id"].'&code='.substr(md5($ricetta["username"].$ricetta["ricetta_id"]), 0, 5).'" readonly style="display:none" />';
						echo '</div></div></li>';
														

					
				}
				echo "</ul></div></div>";
			}
					
		}
	?>
	
</div></div>

</div>

<?php include 'includes/footer.php' ?>

<script>
	
	$('.draggablePanelList').sortable();
	//$('.draggablePanelList').disableSelection();




	$(".btn-danger").click(function(evt) {		
		

		var conferma = confirm("Cancellare definitivamente questa ricetta?");
		if (conferma) {
			return true;
		} else {
			evt.preventDefault();
		}
		
	});


	$("select.selettore_cartella").on("change", function() {
		if ($(this).val() != "selettore_starter") {
			$(this).parent().find(".submit_cartelle").fadeIn();

			if ($(this).val() == "nuova_cartella") {
				$(this).parent().find(".submit_cartelle").val("Crea cartella e sposta ricetta");
			} else {
				$(this).parent().find(".submit_cartelle").val("Sposta nella cartella");
			}
		} else {
			$(this).parent().find(".submit_cartelle").fadeOut();
		}

		if ($(this).val() == "nuova_cartella") {
			$(this).parent().find("input[name='nuova_cartella']").fadeIn();
		} else {
			$(this).parent().find("input[name='nuova_cartella']").fadeOut();
		}


	});



	$(".btn-share").click(function() {
		$(this).parent().find(".share-caption").remove();
		$(this).parent().find(".input-share").after("<p class='share-caption' style='font-size: 16px'>Copia questo indirizzo e usalo per condividere la ricetta</p>");
		
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$(this).parent().find(".input-share").removeAttr("readonly");
			$(this).parent().find(".input-share").fadeIn().focus(focustext);
			$(this).parent().find(".input-share").attr("onkeydown", "event.preventDefault();event.stopPropagation();return false;");
			$(this).parent().find(".input-share").attr("oncut", "event.preventDefault();event.stopPropagation();return false;");
		} else {
				$(this).parent().find(".input-share").fadeIn().focus().select();
		}
	});

	function focustext() {
        var input = this;
        setTimeout(function () {
            input.selectionStart = 0;
            input.selectionEnd = 99999;
        },100);
    }

</script>

<style>
	.btn-share {
		margin: 10px auto 0px auto;
		background-color: #2CBAF1;
	}

	.input-share {
		margin-top: 10px;
	}

	.order {
		text-align: center;
		border: 1px solid #34495e;
		width: 300px;
		margin: 20px auto;
		border-radius: 20px;
		background-color: whitesmoke;
	}

	.order a {
		margin: auto 10px;
	}

	.order a .glyphicon {
		top:2.5px;
	}

	.panel {
		margin-bottom: 50px;
		margin-top: 30px;
	}

	.panel-default > .panel-heading {
		background-color: #118A77;
		color: white;
		text-align: center;
		text-transform: uppercase;
	}

	.panel-body {
		background-color: whitesmoke;
		padding: 5px;
		border-radius: 5px;
	}

	.panel-body .panel-body{
		background-color: #e7e7e7;
		padding: 10px 30px;
		border-radius: 5px;
	}

	.panel-title {
		font-weight: 400;
	}

	.body-change {
		padding: 10px;
	}

	.sezione, .categoria, .panel-body-ingrediente, .panel-body-ricetta, .panel-cartella {
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
		margin-top: 20px;
		padding: 5px;
	}

	.panel-cartella {
		width: 100%;
		margin: auto;
		margin-top: 40px;
		padding: 0 !important;
	}

	.panel-body-ricetta {
		margin-top: 0px;
		background-color: whitesmoke !important;
		font-size: 14px;
	}

	
	form {
		text-align: center;
		width: 80%;
		margin: 20px auto;
		font-weight: 200;
	}

	.form-control {
		display: block;
		width: 100%;
		margin-bottom: 10px;
		font-size: 12px;
	}

	.draggablePanelList {
		margin: 0;
		padding: 0;
		list-style: none;
		list-style-type: none;
		-webkit-margin-before: 0px;
		-webkit-margin-after: 0px;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
		-webkit-padding-start: 0px;
	}

	.nome-ricetta-a, .nome-ricetta-a:hover {
		color: white;
		font-weight: 400 !important;
		text-transform: none;
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

	.panel-ricetta-singola > .nome-ricetta-panel {
		background-color: #6FB982;
		padding:3px 10px;		
	}

	.controller_ricetta {
		margin-top: 20px;
	}

	.panel-ricetta {
		float:left;
		width: 48%;
		margin: 11px;
		list-style: none;
	}

	.panel-ricetta-singola {
		margin-bottom: 5px;
	}

	.nome-ricetta-a{
		width: 100%;
		display: block;
		color:white;
		font-weight: 200;
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

	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
		color: #666666;
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
