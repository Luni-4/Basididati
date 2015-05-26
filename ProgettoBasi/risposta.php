<?php

	session_start();
	require_once "dbopen.php";
	$message="";
	
	if(isset($_GET["risposta"]) && isset($_SESSION["user"]) && isset($_SESSION["idd"])){
		$risposta=$_GET["risposta"];
		$user=$_SESSION["user"];
		$idd=$_SESSION["idd"];
		$query="INSERT INTO rispostaperta(testorisp,nome,idd) VALUES ('$risposta','$user','$idd')";
		$query_insert=pg_query($dbconn,$query); 
		if($query_insert)
			$message="Risposta inserita con successo";			
		else
			$message="Impossibile inviare la risposta";
	}
	else
		$message="Errore nel servizio, riprovare a caricare";
	//header("Location: rispostadomanda.php?succes=$message"); problema per ripulire le variabili se provo a tornare nella pagina rispostadomanda.php
	print "$message <a href='withinTheService.php'>Clicca qui per tornare indietro </a>";
	//non posso distruggere la session qui perche sono ancora all'interno del servizio
	
	
	

?>
