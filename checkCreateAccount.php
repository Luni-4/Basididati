<?php 

include "dbopen.php"; // apertura database

// Residenza e data
$residenza=$_POST["residenza"];
$data=$_POST["bday"];

// Controlli
if(empty($_POST["username"])){	
	Header("Location: paginaRegistrazione.php?message_error=0");
}elseif(empty($_POST["email"])){
	$user=$_POST["username"];
	Header("Location: paginaRegistrazione.php?message_error=1&user=$user");
}elseif(empty($_POST["pass"])){
	$user=$_POST["username"];
	$email=$_POST["email"];
	Header("Location: paginaRegistrazione.php?message_error=2&user=$user&email=$email");	
}elseif(empty($_POST["passConfirm"])){
	$user=$_POST["username"];
	$email=$_POST["email"];
	Header("Location: paginaRegistrazione.php?message_error=3&user=$user&email=$email");
}else{
	$pass=$_POST["pass"];
	$passc=$_POST["passConfirm"];
	if(trim($pass) != trim($passc)){
		Header("Location: paginaRegistrazione.php?message_error=4&user=$user&email=$email");
	}
}
	// controllo esistenza nel database di utente e email
	$queryricerca="SELECT username FROM Utente WHERE username = '".$user."' AND email='".$email."';";
	$risultato=pg_query($dbconn, $queryricerca) or die("Errore nella query");
	if(pg_num_rows($risultato) == 0) {
		$queryinserimento="INSERT INTO Utente VALUES ('".$user."','".$email."','".$pass."','Normale','".$residenza."','".$data."';"
		$risultato1=pg_query($dbconn, $queryinserimento) or die("Errore nella query");
		Header("Location: login.php?message_error=5");
	}
	// aggiunta categorie...
	Header("Location: paginaRegistrazione.php?message_error=6");

include "dbclose.php"; // chiusura database
?>
