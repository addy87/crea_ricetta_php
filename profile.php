<script type="text/javascript" src="includes/data/jquery-1.8.3.js"></script>
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
			<h1 style="margin-bottom:30px; text-align:center">Profilo di <span style="color:#1abc9c"><?php echo $user_data["username"] ?></span></h1>			
		</div>
	</div>


	
	<div class="row">
		<div class="col-md-12">
			<table>
				<tr><th>Alcuni dati</th></tr>
			<?php
				echo "<tr><td>La tua mail è: <b>".$user_data["email"]."</b></td></tr>";

				$numero_ricette = get_dati_utente("ricette", $user_data["user_id"]);
				$numero_ingredienti = get_dati_utente("inventario", $user_data["user_id"]);
				$ricette_totali = get_dati_utente("ricette_totali", $user_data["user_id"]);
				$ingredienti_totali = get_dati_utente("ingredienti_totali", $user_data["user_id"]);

				switch ($numero_ricette) {
					case 0:
						echo "<tr><td>Hai <b>".$numero_ricette." ricette salvate</b>. Perchè non provi a <a href='ricetta.php'>creare la tua prima ricetta</a>? :-)</td></tr>";
						break;
					case 1:
						echo "<tr><td>Hai <b>".$numero_ricette." ricetta salvata</b>.</td></tr>";
						break;
					default:
						echo "<tr><td>Hai <b>".$numero_ricette." ricette salvate</b>.</td></tr>";
						break;
				}

				

				switch ($numero_ingredienti) {
					case 0:
						echo "<tr><td>Hai <b>".$numero_ingredienti." ingredienti salvati</b> nel tuo inventario. Perchè non provi ad <a href='inventario.php'>aggiungere il tuo primo ingrediente</a>? :-)</td></tr>";
						break;
					case 1:
						echo "<tr><td>Hai <b>".$numero_ingredienti." ingrediente salvato</b> nel tuo inventario.</td></tr>";
						break;
					default:
						echo "<tr><td>Hai <b>".$numero_ingredienti." ingredienti salvati</b> nel tuo inventario.</td></tr>";
						break;
				}

				echo "<tr><td>Sapevi che tutti gli utenti hanno salvato <b>".$ricette_totali." ricette</b> e <b>".$ingredienti_totali." ingredienti</b> finora? Wow!<br>Niente male per essere in <b>".user_count()." utenti</b> registrati ;-)</td></tr>";
			?>

			</table>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="panel-vari">
				<div class="col-md-6">
					<a type="button" class="btn btn-success btn-ricette" href="ricette.php"><img src="includes/data/images/ricette.png" /> RICETTE</a>
				</div>
				<div class="col-md-6">
					<a type="button" class="btn btn-info btn-inventario" href="inventario.php"><img src="includes/data/images/inventario.png" /> INVENTARIO</a>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default row sezione">		

				<div class="panel-body body-change">
					<div class="col-xs-6">
						<a type="button" class="btn btn-block btn-sm btn-primary" href="change_password.php">Cambia Password</a>
					</div>
					<div class="col-xs-6">
						<a type="button" class="btn btn-block btn-sm btn-primary" href="change_email.php">Cambia Email</a>
					</div>
				</div>

			</div>
		</div>
	</div>

		
</div>

<?php include 'includes/footer.php' ?>
<script type="text/javascript" src="includes/data/touch.js"></script>
<script>
	
</script>

<style>
	h1 {
		word-break: break-word;
	}
	table {
		width: 90%px;
		margin: auto;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
		border-bottom-left-radius: 5px;
		border-radius: 5px;
		background-color: whitesmoke;
		border: 1px solid transparent;
		border-bottom: 5px solid transparent;
		border-bottom-color: #bdc3c7;
		border-left-color: #dfe2e4;
		border-right-color: #dfe2e4;
		border-top-color: #dfe2e4;
		font-weight: 200;
	}
	td {
		padding: 20px;
		text-align: center;
	}

	th {
		background-color: #F1C40F;
		padding: 10px;
	}
	.panel-vari a img {
		margin: auto;
		display: block;
		height: 60px;
		margin-bottom: 20px;
	}

	.panel-vari {
		text-align: center;
		height: auto;
		margin-top: 50px;
	}

	.btn-ricette, .btn-inventario {
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
		border-bottom-left-radius: 5px;
		border-radius: 5px;
		border: 1px solid transparent;
		border-bottom: 5px solid transparent;
		border-bottom-color: #bdc3c7;
		border-left-color: #dfe2e4;
		border-right-color: #dfe2e4;
		border-top-color: #dfe2e4;
		width: 80%;
		padding: 70px;
		font-size: 24px;
		white-space: pre-wrap;
	}

	.btn-ricette {
		border-bottom-color: #49976A;
	}

	.btn-inventario {
		border-bottom-color: #245B80;
	}

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
		text-align: center;
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
