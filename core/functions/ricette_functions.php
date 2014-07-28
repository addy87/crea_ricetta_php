<?php


$path = dirname( dirname(__FILE__) );
require $path."/init.php";

if (logged_in() === false) {
	exit();
}

if (isset($_GET["carica_ricette"]) && empty($_GET["carica_ricette"])) {
	$ricette = get_ricette($user_data["user_id"]);

	if ($ricette != "zero_ricette") {
		
		foreach ($ricette as $ricetta) {
			echo "<option value='". $ricetta["ricetta_id"] ."'>". $ricetta["titolo_ricetta"] ."</option>";
		}
		
	}
}

if (isset($_GET["carica_ricetta"]) && !empty($_GET["carica_ricetta"])) {
	$ricetta_id = (int)$_GET["carica_ricetta"];
	$user_id = (int) $user_data["user_id"];
	echo get_ricetta_code($user_id, $ricetta_id);
}

if (isset($_GET["aggiorna_ricetta"]) && !empty($_GET["aggiorna_ricetta"])) {
	$user_id = (int) $user_data["user_id"];
	$ricetta_id = (int)$_GET["aggiorna_ricetta"];
	$code_ricetta = mysql_real_escape_string($_GET["code_ricetta"]);
	aggiorna_ricetta($user_id, $ricetta_id, $code_ricetta);
}



if (isset($_POST["salva_ricetta"]) && !empty($_POST["salva_ricetta"]) && isset($_POST["titolo_ricetta"]) && !empty($_POST["titolo_ricetta"])) {

	$user_id = (int) $user_data["user_id"];
	$titolo_ricetta = $_POST["titolo_ricetta"];
	$code_ricetta = mysql_real_escape_string($_POST["salva_ricetta"]);


	
	if(!salva_ricetta($user_id, $titolo_ricetta, $code_ricetta)) {
		echo "Attenzione, è già presente una ricetta con questo nome. Per aggiornare una ricetta esistente, caricala e clicca il pulsante AGGIORNA RICETTA ESISTENTE";
	} else {
		echo "Ricetta ". $titolo_ricetta . " salvata!";

	}

}

?>