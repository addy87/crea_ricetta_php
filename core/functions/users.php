<?php

function aggiorna_ingrediente_inventario($username, $ingrediente_id, $nuovo_nome_ingrediente, $nuova_categoria_ingrediente, $nuova_nota_ingrediente) {
	$nuova_categoria_ingrediente = strtoupper($nuova_categoria_ingrediente);
	mysql_query("UPDATE inventario SET nome_ingrediente = '$nuovo_nome_ingrediente', categoria = '$nuova_categoria_ingrediente', inventario_note = '$nuova_nota_ingrediente' WHERE username = '$username' AND ingrediente_id = '$ingrediente_id'");
}


function get_ingredienti_inventario($user_id) {	
	$user_id = (int)$user_id;
	$username = username_from_user_id($user_id);

	if( mysql_result(mysql_query("SELECT COUNT('ingrediente_id') from inventario WHERE username = '$username'"), 0)!= 0) {
		$query = mysql_query("SELECT * FROM inventario WHERE username = '$username'");
		$ingredienti_inventario = array();
		while ($ingrediente_inventario = mysql_fetch_assoc($query)) {
			$ingredienti_inventario[] = $ingrediente_inventario;
		}
		return $ingredienti_inventario;
	} else {
		return "zero_ingredienti_inventario";
	}	

}

function aggiungi_ingrediente_inventario($username, $nome_ingrediente_inventario, $categoria_ingrediente, $inventario_note) {
	$categoria_ingrediente = strtoupper($categoria_ingrediente);
	if (!isset($inventario_note))
		mysql_query("INSERT INTO inventario (username, nome_ingrediente, categoria) VALUES ('$username', '$nome_ingrediente_inventario', '$categoria_ingrediente')")or die(mysql_error());
	else
		mysql_query("INSERT INTO inventario (username, nome_ingrediente, categoria, inventario_note) VALUES ('$username', '$nome_ingrediente_inventario', '$categoria_ingrediente', '$inventario_note')")or die(mysql_error());
}

function cancella_ingrediente_inventario($username, $id) {
	$id = (int) $id;
	mysql_query("DELETE FROM inventario WHERE ingrediente_id = '$id' AND username = '$username'") or die(mysql_error());
	return true;
}


function controllo_esistenza_ingrediente_in_inventario($username, $nome_ingrediente_inventario) {

	$controllo_esistenza = mysql_result(mysql_query("SELECT COUNT('ingrediente_id') from inventario WHERE nome_ingrediente = '$nome_ingrediente_inventario' AND username = '$username'"), 0);
	if ($controllo_esistenza == 0) {
		return true;
	} else if ($controllo_esistenza > 0) {
		return false;
	}
}


function get_ricette($user_id) {	
	$user_id = (int)$user_id;
	$username = username_from_user_id($user_id);

	if( mysql_result(mysql_query("SELECT COUNT('ricetta_id') from ricette WHERE username = '$username'"), 0)!= 0) {
		$query2 = mysql_query("SELECT * FROM ricette WHERE username = '$username'");
		$ricette = array();
		while ($ricetta = mysql_fetch_assoc($query2)) {
			$ricette[] = $ricetta;
		}

		return $ricette;
	} else {
		return "zero_ricette";
	}	

}


function get_ricette_titoli($user_id) {
	$user_id = (int)$user_id;
	$ricette = get_ricette($user_id);

	$titoli = array();

	foreach($ricette as $titolo) {
		$titoli[] = $titolo["titolo_ricetta"]; 
	}
	return $titoli;
}

function get_ricetta_code($user_id, $ricetta_id) {
	$ricetta_id = (int)$ricetta_id;
	$username = username_from_user_id($user_id);

	if(mysql_result(mysql_query("SELECT COUNT('ricetta_id') from ricette WHERE username = '$username' AND ricetta_id = '$ricetta_id'"), 0)!= 0) {
		$query = mysql_query("SELECT code_ricetta FROM ricette WHERE ricetta_id = '$ricetta_id' AND username = '$username'");

		return mysql_result($query, 0);
	} else {
		
		exit();
	}

}

function get_ricetta_note($user_id, $ricetta_id) {
	$ricetta_id = (int)$ricetta_id;
	$username = username_from_user_id($user_id);

	if(mysql_result(mysql_query("SELECT COUNT('ricetta_id') from ricette WHERE username = '$username' AND ricetta_id = '$ricetta_id'"), 0)!= 0) {
		$query = mysql_query("SELECT osservazioni FROM ricette WHERE ricetta_id = '$ricetta_id' AND username = '$username'");

		return mysql_result($query, 0);
	} else {
		
		exit();
	}
}



function cancella_ricetta($user_id, $ricetta_id) {
	$user_id = (int)$user_id;
	$username = username_from_user_id($user_id);
	mysql_query("DELETE FROM ricette WHERE ricetta_id = '$ricetta_id' AND username = '$username'") or die(mysql_error());
	return true;
}


function aggiorna_ricetta($user_id, $ricetta_id, $code_ricetta, $osservazioni) {
	$user_id = (int)$user_id;
	$ricetta_id = (int)$ricetta_id;
	$username = username_from_user_id($user_id);
	mysql_query("UPDATE ricette SET code_ricetta = '$code_ricetta', osservazioni = '$osservazioni' WHERE username = '$username' AND ricetta_id = $ricetta_id");
}


function modifica_ricetta($user_id, $ricetta_id) {
	$user_id = (int)$user_id;
	$ricetta_id = (int)$ricetta_id;
	$username = username_from_user_id($user_id);
	if(mysql_result(mysql_query("SELECT COUNT('ricetta_id') from ricette WHERE username = '$username' AND ricetta_id = '$ricetta_id'"), 0) != 0) {
		header("Location: ricetta.php?modifica_ricetta=".$ricetta_id);
		exit();
	} else {
		header("Location: profile.php");
		exit();
	}
}

function salva_ricetta($user_id, $titolo_ricetta, $ricetta_code, $osservazioni) {
	$user_id = (int) $user_id;
	$titolo_ricetta = sanitize($titolo_ricetta);
	$username = username_from_user_id($user_id);
	$code_ricetta = $ricetta_code;
	$osservazioni = $osservazioni;
	$data = date("d-m-Y H:i:s");

	$controllo_esistenza = mysql_result(mysql_query("SELECT COUNT('titolo_ricetta') from ricette WHERE titolo_ricetta = '$titolo_ricetta' AND username = '$username'"), 0);

	if ($controllo_esistenza == 0) {
		mysql_query("INSERT INTO ricette (username, titolo_ricetta, code_ricetta, osservazioni, data) VALUES ('$username', '$titolo_ricetta', '$ricetta_code', '$osservazioni', '$data')") or die(mysql_error());
		return true;
	} else {
		return false;
	}

}

function recover($mode, $email) {
	$mode = sanitize($mode);
	$email = sanitize($email);

	$user_data = user_data(user_id_from_email($email), "username", "user_id");

	if ($mode == "username") {
		email("$email", "Il tuo username [CREA RICETTA]", "Ciao!\nil tuo username è: ".$user_data["username"]."\n:-)\n\nAugusten");
	} else if ($mode == "password") {
		$generated_password = substr(md5(rand(999, 9999999)), 0, 8);
		change_password($user_data["user_id"], $generated_password);
		email("$email", "La tua nuova password [CREA RICETTA]", "Ciao!\nla tua nuova password è: ".$generated_password."\n:-)\n\nAugusten");
	}
}


function username_from_user_id($user_id) {
	$query = mysql_query("SELECT username FROM users WHERE user_id = '$user_id'");
	$username = mysql_result($query, 0, "username");

	return $username;
}


function activate($email, $email_code) {
	$email = mysql_real_escape_string($email);
	$email_code = mysql_real_escape_string($email_code);

	if (mysql_result(mysql_query("SELECT COUNT(user_id) from users WHERE email = '$email' AND email_code = '$email_code' AND active = 0"), 0) == 1) {
		mysql_query("UPDATE users SET active = 1 WHERE email = '$email'");
		return true;
	} else {
		return false;
	}
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	$password = md5($password);

	mysql_query("UPDATE users SET password = '$password' WHERE user_id = '$user_id'");
}

function change_email($user_id, $email) {
	$user_id = (int)$user_id;
	$email = sanitize($email);

	mysql_query("UPDATE users SET email = '$email' WHERE user_id = '$user_id'");
}


function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	$register_data["password"] = md5($register_data["password"]);
	
	$data = "'".implode("', '", $register_data)."'";
	$fields = implode(", ", array_keys($register_data));

	mysql_query("INSERT INTO users ($fields) VALUES ($data)");

	//email($register_data["email"], "Attivazione account [CREA RICETTA]", "Ciao ".$register_data["username"].",\n per attivare il tuo account clicca il link seguente: \n http://augusten.altervista.org/crea-ricetta/activate.php?email=".$register_data["email"]."&email_code=".$register_data["email_code"]."\nAugusten");
}

function user_count() {
	return mysql_result(mysql_query("SELECT COUNT(user_id) FROM users WHERE active = 1"), 0);
}

function user_data($user_id) {
	$data = array();
	$user_id = (int) $user_id;

	$func_num_args = func_num_args(); //numero degli argomenti
	$func_get_args = func_get_args(); //ritorna gli argomenti

	if ($func_num_args > 1) {
		unset($func_get_args[0]); //toglie il primo user_id inutile

		$fields = implode(', ', $func_get_args); //per creare una stringa da usare come query

		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE user_id = '$user_id'"));

		return $data;
	}
}

function logged_in() {
	if( isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) {
		return true;
	} else {
		return false;
	}
}

function user_exists($username) {
	$username = sanitize($username); //in general.php
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username'"); //se 0 non esiste

	return (mysql_result($query, 0) == 1) ? true : false;
}

function email_exists($email) {
	$email = sanitize($email); //in general.php
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE email = '$email'"); //se 0 non esiste

	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_active($username) {
	$username = sanitize($username); //in general.php
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' AND active = 1"); //se 0 non esiste

	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
	$username = sanitize($username); //in general.php
	$query = mysql_query("SELECT user_id FROM users WHERE username = '$username'");

	return mysql_result($query, 0, "user_id");
}

function user_id_from_email($email) {
	$email = sanitize($email); //in general.php
	$query = mysql_query("SELECT user_id FROM users WHERE email = '$email'");

	return mysql_result($query, 0, "user_id");
}

function login($username, $password) {
	$user_id = user_id_from_username($username);

	$username = sanitize($username); //in general.php
	$password = md5($password);

	$query = mysql_query("SELECT COUNT(user_id) from users WHERE username = '$username' AND password = '$password'");

	return (mysql_result($query, 0) == 1) ? $user_id : false;
}


?>