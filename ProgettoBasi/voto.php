
<?php

	session_start();
	require_once "dbopen.php";
	$message="";
	$idr="";
	if(isset($_GET["voto"]) && isset($_GET["idr"]) && isset($_SESSION["user"])&& isset($_SESSION["idd"])){
		$user=$_SESSION["user"];
		$idd=$_SESSION["idd"];
		$query="SELECT tipo FROM utente WHERE nome='$user'";
		$query_res=pg_query($dbconn,$query); 
			if($query_res){
				$row=pg_fetch_assoc($query_res);
				if($row['tipo']=='vip'){
					$idr=$_GET["idr"];
					if($_GET["voto"]=="positivo")
						$voto="TRUE";
					else
						$voto="FALSE";
					$query="INSERT INTO voto (nome,idr,voto) VALUES ('$user','$idr','$voto')";
					$query_res=pg_query($dbconn,$query); 
					if($query_res)
						$message="Votazione inserita con successo!";
					else 
						$message="Mi spiace, ma hai gia' votato!";
					
					header("Location: rispostadomanda.php?message=$message&idd=$idd");
				}
				else{
					$message="Non puoi dare una votazione poiche' non sei vip!";
					header("Location: rispostadomanda.php?message=$message&idd=$idd");}
			}else
				exit("Errore nella query: ".pg_last_error($dbconn));
	}else
		header("Location: withinTheService.php");
	
	?>