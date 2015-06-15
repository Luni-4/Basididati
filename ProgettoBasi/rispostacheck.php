<!--Pagina per l'inserimento delle risposte predefinite di un sondaggio -->
<?php
	session_start();
	require_once "dbopen.php";	

	if(isset($_SESSION["user"]) && isset($_SESSION["idds"]))
	{
		$risposta=$_POST["sonda"];
		$user=$_SESSION["user"];
		$idd=$_SESSION["idds"];		
		if(isset($_POST["anonimo"]))
			    $anonimo='TRUE';
		else
			    $anonimo='FALSE';
		$query="INSERT INTO rispostapredefinita(testorisp,nome,idd,anonimo) VALUES ('$risposta','$user','$idd',$anonimo)";
		$query_insert=pg_query($dbconn,$query); 
		if($query_insert)			
			    $message="Risposta inserita con successo";		
	    else
			$message="Impossibile inviare la risposta";	        			  
	}
	else
		$message="Errore nel servizio, riprovare a caricare";
	header("Location: rispostasondaggio.php?message=$message");
	
?>
