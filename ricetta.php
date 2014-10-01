<?php
include 'includes/head.php';

echo "<script>
try { localStorage.test = 2; localStorage.removeItem('test');} catch (e) {
			  alert('Non puoi visualizzare questa pagina utilizzando un browser in modalità privata. Riprova a collegarti');
			  window.location.replace('profile.php');
			}
</script>
";

if (logged_in() === false) {
	echo "<script>".'alert("Attenzione! Non sei autenticato. Le funzionalità di salvataggio delle ricette e inventario sono riservate solamente agli utenti autenticati. Registrati anche tu per salvare e modificare le tue ricette!");'."</script>";
}


?>

<link rel="stylesheet" href="css/crea_ricetta.css"></link>
			<div class="container" id="reset_world_container">
				<div class="row">
					<div id="reset_world" style="width:100%; text-align:center; font-size: 30px"></div>
				</div>
			</div>
			
			<div class="container settore_transp">
				<div class="col-md-12" id="">
					

					<div class="container" id="container_inventario">
						<div class="row">
							<button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#inventario" id="inventario_toggle">Apri/Chiudi il tuo inventario</button>

							<div id="inventario" class="collapse out" style="text-align:center">
					<?php
					if(logged_in() === true) {
						$ingredienti_inventario = get_ingredienti_inventario($user_data["user_id"]);
						$categorie = array();

						if($ingredienti_inventario != "zero_ingredienti_inventario") {

					?>
								<p style="margin-top:10px">Clicca sul nome di un ingrediente per aggiungerlo alla ricetta.</p>
					<?php
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

											echo '<div class="panel-group" id="accordion'.$id.'"><div class="panel panel-default panel-ingrediente"><div class="panel-heading nome-ingrediente-panel"><a data-toggle="collapse" data-parent="#accordion'.$id.'" href="#collapse'.$id.'" class="panel-title nome-ingrediente-a">'.$ingrediente_inventario["nome_ingrediente"]."<b class='caret'></b></a></div>";
											echo'<div id="collapse'.$id.'" class="panel-collapse collapse"><div class="panel-body panel-body-ingrediente" style="text-align:center">';

											

											if(strlen($ingrediente_inventario["inventario_note"])>0) {
												echo "<p class='nota'>".nl2br($ingrediente_inventario["inventario_note"])."</p>";
											} else {
												echo "<p class='nota'>Nessuna nota per questo ingrediente</p>";
											}



											echo "<a type='button' class='btn btn-sm btn-success btn_inventario' nome='". htmlspecialchars($ingrediente_inventario["nome_ingrediente"], ENT_QUOTES) ."'>Aggiungi questo ingrediente</a>";
											echo "</div></div></div></div>";
										}
									}
									echo "</div></div>";

								}
						} else {
					?>
						<br>
						<p>Non hai ancora aggiunto alcun ingrediente al tuo inventario. Vai alla <a href="profile.php">pagina profilo</a> per aggiungere il primo! :-)</p>
					<?php
						}
					} else 
					{
					?>
						<br>
						<p>Solo gli utenti registrati possono salvare qui dentro i loro ingredienti e selezionarli subito per inserirli nella ricetta.<br><a href="register.php">Registrati</a> anche tu :-)</p>
					<?php 
					} ?>
							</div>
						</div>
					</div>

				
				</div>
			</div>
			<div class="container settore_transp">				
				<div class="col-md-4" id="container0">

					<div class="container controller" style="">
						<img class="ico_controller" src="includes/data/images/ingr.png"/>
						<div class="row">							
							<form id="formo" data-ajax="false">
								<table id="tab" >									
									<tr>							
										<td style="width: 65%"><input type="text" id="nome_ingrediente" class="form-control" style="background-color:#ffffff !important" placeholder="Nome Ingrediente"/></td>
										<td style="width: 35%"><input type="number" id="quantita_ingrediente" step="any" class="form-control" placeholder="Quantità"/></td>				
									</tr>
								</table>
								<button type="submit" id="add_ingrediente" value="Aggiungi ingrediente" type="button" class="btn btn-success btn-block" style="margin: 10px 0 0 0"><span class='fui-plus'></span> Aggiungi Ingrediente</button>
							</form>							
						</div>
					</div>

					<div class="container controller">
						<img class="ico_controller ico_controller_small" src="includes/data/images/control.png"/>
						<div class="row">
							<button id="add_fase" type="button" class="btn btn-primary btn-block"><span class='fui-plus'></span> Aggiungi Fase</button>					
							<button id="add_testo" type="button" class="btn btn-primary btn-block" style=""><span class='fui-plus'></span> Aggiungi riga di testo</button>
							<button id="add_riga" type="button" class="btn btn-primary btn-block" style=""><span class='fui-plus'></span> Aggiungi riga vuota</button>
						</div>
					</div>

					<div class="container " style="text-align: center;">
						

						<button type="button" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#avanzate">Opzioni avanzate</button>

						<div id="avanzate" class="collapse out" style="text-align:center">
							<p style="margin-top:10px">Da qui puoi impostare automaticamente delle ricette di partenza (fonte delle ricette: <a href="http://lola.mondoweb.net/index.php" target="_blank">Angolo di Lola</a>)</p>
							
								<button type="button" class="btn btn-default" id="ricetta_rosa">Crema viso alla rosa 2013</button>
								<button type="button" class="btn btn-default" id="ricetta_siero">Siero Phito Lift</button>
								<button type="button" class="btn btn-default" id="ricetta_iseree">Detergente Iseree</button>													

						</div>

					</div>
				</div>


				<div class="col-md-8">	

					<div class="container" id="container1">
						<div class="row">
							<div id="reset_world" style="width:100%; text-align:center; font-size: 30px"></div>
							<div id="contenuto">
								<ul id="ricetta" >
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="separatore"></div>
							<div id="totale"></div>
						</div>

						<div class="panel-group" id="panel-osservazioni-main">
							<div class="panel panel-default">
								<a data-toggle="collapse" data-parent="#accordion" id="osservazioni-toggle" href="#panel-osservazioni">
								<div class="panel-heading panel-heading-osservazioni">
									
									<h4 class="panel-title">
										Note/Osservazioni<b class='caret'></b>
									</h4>
								</div>
								</a>
								<div id="panel-osservazioni" class="panel-collapse collapse">
									<div class="panel-body">
										<textarea id="osservazioni" rows="8" placeholder="Inserisci qui note/osservazioni sulla ricetta" class="form-control login-field"></textarea>
									</div>
								</div>
							</div>
						</div>
							

								<?php if(logged_in() === true) {?>
									<div class="row text-center">
										<div class="col-md-4">								
											<button id="reset" class="btn btn-danger btn-sm btn-block"><span class='icona_span'><img class="icona" src="includes/data/images/trash.png"/></span>Pulisci schermata</button>
										</div>
										<div class="col-md-4">
											<button id="aggiorna" class="btn btn-info btn-sm btn-block" data-toggle="collapse" data-target="#aggiorna_ricetta"><span class='icona_span'><img class="icona_big" src="includes/data/images/ricetta.png" /></span>Aggiorna ricetta</button>
										</div>
										<div class="col-md-4">
											<button id="salva_file" type="button" class="btn btn-success btn-sm btn-block" ><span class='icona_span'><img class="icona" src="includes/data/images/save.png"/></span> Salva ricetta</button>
										</div>
									</div>
									<div id="aggiorna_ricetta" class="collapse out" style="text-align:center">
										<div class="separatore"></div>
										<p>Seleziona la ricetta che vuoi aggiornare e clicca AGGIORNA</p>
										<p><span style="color: red">Attenzione! Il contenuto della ricetta scelta verrà completamente sostituito dalla ricetta attualmente presente nella schermata</span></p>
									</div>
								<?php } else if(logged_in() === false) { ?>
									<div class="row text-center">
										<div class="col-md-4">								
											<button id="reset" class="btn btn-danger btn-sm btn-block"><span class='icona_span'><img class="icona" src="includes/data/images/trash.png"/></span>Pulisci schermata</button>
										</div>										
									</div>
								<?php } ?>
							

							
							
						
					</div>

					<div class="container" id="container1-info">
						<div class="row">
							<div class="col-md-12" style="text-align:center">
								<p class="lead">La tua ricetta è ancora vuota</p>
								<p style="color:#2ecc71">Aggiungi i primi ingredienti dando un nome e una quantità</p>
								<p style="color:#16A085">Aggiungi "Fasi", "Righe di testo" e "Righe vuote" per rendere più completa la tua ricetta</p>
								<?php 
									if(logged_in() === true) {
										?>
											<p style="color:#6F6F6F">Oppure carica una tua ricetta salvata, tramite la sezione "Opzioni avanzate"</p>
											<p style="color:#3498db">Puoi inoltre inserire elementi direttamente dal tuo inventario (lo trovi sotto la barra di navigazione)</p>
										<?php
									} else {
										?>
											<p>Gli utenti registrati possono inoltre caricare la loro ricette salvate ed inserire ingredienti direttamente a partire dal loro inventario personale</br><p><span style="font-weight: bold"><a href="register.php">Registrati</a></span> anche tu :-)</p>
										<?php
									}

								?>
							</div>
						</div>

					</div>


				</div>








			</div>

			<div class="container settore_transp" id="container2">
				<div class="col-md-12">
					<div class="container">
						<div class="row" style="text-align: center">
							<button id="stampa_semplice" type="button" class="btn btn-default"><span class="glyphicon"><img class="icona_bigger" src="includes/data/images/elabora.png"/></span> Elabora ricetta</button>
							<p class="small" style="text-align:center; margin-bottom:0; margin-top:5px; font-size:12px; line-height:15px; color:#8A8A8A;">Guarda la cascata dei grassi. Converti la tua ricetta. Crea un PDF.</p>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="container" id="output">
						<div class="row" >
							<div id="canvas" height="450" width="600"></div>
							<p id="elenco_oli_considerati"></p>
							<p id="info_canvas">Attenzione. Il presente grafico ha solamente uno scopo indicativo. Se è stato inserito un olio non conosciuto, esso non verrà elencato nel grafico. Inoltre, oli con lo stesso nome potrebbero avere caratteristiche diverse a seconda della loro provenienza/estrazione/qualità/ecc.</p>
							

							<p id="grassi"></p>

							
							<div class="well"><kbd></kbd><p id="totale_kbd" style="text-align:center"></p></div>
							<div class="row convertitore" style="text-align:center">
								<form id="form_convert">
									<p style="text-weight:bold">Converti in ricetta da: 
									<input type="number" id="quantita_ricetta" class="form-control" style="width:75px; margin: auto; display:inline"/> g
														
									<button id="converti" class="btn btn-success" style="margin-left:10px"><span class='glyphicon glyphicon-ok'></span> OK</button>						
									</p>
								</form>
								
							</div>
							
							<div class="info_convertitore alert alert-danger" style="text-align:center">
								<p>Attenzione. La somma degli ingredienti della ricetta non è 100. Prima di poter convertire, sistema le quantità e ristampa la ricetta.</p>
							</div>

							<button id="print_pdf" class="btn btn-warning pull-right"><span class="glyphicon"><img class="icona_big" src="includes/data/images/pdf.png"/></span>Crea PDF</button>
						</div>
					</div>
				</div>

			</div>	



<?php include 'includes/footer.php' ?>
<script type="text/javascript" src="includes/data/touch.js"></script>
<script type="text/javascript" src="includes/data/typeahead.bundle.js"></script>
<script type="text/javascript" src="includes/data/autocomplete.js"></script>
<script type="text/javascript" src="includes/data/jspdf.min.js"></script>
<script type="text/javascript" src="includes/data/ricette_lola.js"></script>
<script type="text/javascript" src="includes/data/cascata.js"></script>
<script type="text/javascript" src="includes/data/jquery.tinysort.min.js"></script>
<script type="text/javascript" src="includes/data/highcharts.js"></script>
<script src="includes/data/flat/bootstrap-select.js"></script>
<script src="includes/data/flat/bootstrap-switch.js"></script>
<script src="includes/data/flat/flatui-checkbox.js"></script>
<script src="includes/data/flat/flatui-radio.js"></script>
<script src="includes/data/flat/jquery.tagsinput.js"></script>
<script src="includes/data/flat/jquery.placeholder.js"></script>
<script type="text/javascript" src="includes/data/crea_ricetta.js"></script>

<style></style>

<?php

if (logged_in() === true) { 
	if (isset($_GET["modifica_ricetta"]) && !empty($_GET["modifica_ricetta"])) {
		$user_id = $user_data["user_id"];
		$string = get_ricetta_code($user_id, $_GET["modifica_ricetta"]);
		$string = str_replace("\n", "", $string);
		$string = str_replace("\r", "", $string);
		$string = str_replace("\'", "\\\'", $string);
		$string = str_replace('"', '\\"', $string);
		echo "<script>eval_funzioni(\"".$string."\")</script>";

		$osservazioni = get_ricetta_note($user_id, $_GET["modifica_ricetta"]);
		$osservazioni = str_replace("'", "`", $osservazioni);
		$osservazioni = str_replace("\"", "`", $osservazioni);
		echo "<script>setTimeout(function() { scrivi_osservazioni('".$osservazioni."'); }, 500)</script>";
	}
}
?>