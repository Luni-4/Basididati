<!--Pagina per inviare una risposta ad una domanda aperta -->
<?php
	session_start();
	require_once "dbopen.php";
	if(isset($_SESSION["user"]) && isset($_SESSION["idd"]) && isset($_SESSION["chiusa"])){
		$risposta=$_POST["risposta"];
		$user=$_SESSION["user"];
		$idd=$_SESSION["idd"];
		$chiusa=$_SESSION["chiusa"];
		if($chiusa=='f')
		{
			if(isset($_POST["anonimo"]))
				$anonimo='TRUE';
			else
				$anonimo='FALSE';
			$query="INSERT INTO rispostaperta(testorisp,nome,idd,anonimo) VALUES ('$risposta','$user','$idd','$anonimo')";
			$query_insert=pg_query($dbconn,$query); 
			if($query_insert)
				$message="Risposta inserita con successo";			
			else
				exit("Errore nella query: ".pg_last_error($dbconn));
		}
		else
			$message="Ops, la domanda è stata chiusa, impossibile inviare una risposta !";
	}
	else
		$message="Errore nel servizio, riprovare a caricare";
	header("Location: rispostadomanda.php?message=$message");
?>
