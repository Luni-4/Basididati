<?php

	session_start();
	require_once "dbopen.php";
	$message="";

	if(isset($_GET["risposta"]) && isset($_SESSION["user"]) && isset($_SESSION["idd"]) && isset($_SESSION["chiusa"])){
		$risposta=$_GET["risposta"];
		$user=$_SESSION["user"];
		$idd=$_SESSION["idd"];
		$chiusa=$_SESSION["chiusa"];
		if($chiusa=='f'){
		if(isset($_GET["anonimo"]))
			$anonimo=TRUE;
		else
			$anonimo=FALSE;
		$query="INSERT INTO rispostaperta(testorisp,nome,idd,anonimo) VALUES ('$risposta','$user','$idd','$anonimo')";
		$query_insert=pg_query($dbconn,$query); 
		if($query_insert)
			$message="Risposta inserita con successo";			
		else
			$message="Impossibile inviare la risposta";
		}else
			$message="Ops, la domanda e' stata chiusa, impossibile inviare una risposta !<br>";
	}
	else
		$message="Errore nel servizio, riprovare a caricare";
	header("Location: rispostadomanda.php?message=$message&anonimo=$anonimo");
	//non posso distruggere la session qui perche sono ancora all'interno del servizio
	
	
	

?>
