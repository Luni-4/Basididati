
<?php

	session_start();
	require_once "dbopen.php";
	if(isset($_GET["voto"]) && isset($_GET["idr"]) && isset($_SESSION["user"])){
	$user=$_SESSION["user"];
	$query="SELECT tipo FROM utente WHERE nome='$user'";
	$query_res=pg_query($dbconn,$query); 
		if($query_res){
		
			$row=pg_fetch_assoc($query_res);
			if($row['tipo']=='vip'){
				$idr=$_GET["idr"];
				$query="SELECT votopositivo,votonegativo FROM rispostaperta WHERE idr='$idr'";
				$query_res=pg_query($dbconn,$query); 
				if($query_res){
					$row=pg_fetch_assoc($query_res);
					if($_GET["voto"]=="positivo"){
						$voto=$row["votopositivo"]+1;
						$query="UPDATE rispostaperta SET votopositivo='$voto' WHERE idr='$idr'";
						$query_res=pg_query($dbconn,$query); 
						if($query_res){
							$message="Votazione inserita con successo!";
							header("Location: rispostadomanda.php?message=$message");
						}
						else{
							$message="Impossibile dare una votazione9";
							header("Location: rispostadomanda.php?message=$message");
						}
						
						
					}else{
					
						$voto=$row["votonegativo"]-1;
						$query="UPDATE rispostaperta SET votonegativo='$voto' WHERE idr='$idr'";
						$query_res=pg_query($dbconn,$query); 
						if($query_res){
							$message="Votazione inserita con successo!";
							header("Location: rispostadomanda.php?message=$message");
							
						}
						else{
							$message="Impossibile dare una votazione8";
							header("Location: rispostadomanda.php?message=$message");
						}
					
					}
				}else
					$message="Impossibile dare una votazione1";
			}
			else
				$message="Non puoi dare una votazione poiche' non sei vip!2";

		}else
			$message="Impossibile dare una votazione3";
	}else
			$message="Impossibile dare una votazione4";
	
	?>