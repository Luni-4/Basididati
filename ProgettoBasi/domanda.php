<?php 
    //pagina di controllo
	session_start();
	require_once "dbopen.php";
	
	//controllo che i campi di interesse siano riempiti
	if(!isset($_GET["idd"]) && !isset($_GET["chiusa"])){//faccio una domanda	
		if($_GET["categoria"]!='nessunascelta'){
			        $testo=$_GET["testo"];
		            $titolo=$_GET["titolo"];
					$imgurl=$_GET["imgurl"];
					$imgtesto=$_GET["imgtesto"];
					$query="INSERT INTO domandaperta(titolo,testo,imgurl,imgtesto) VALUES ('$titolo','$testo','$imgurl','$imgtesto')";
					$message="Domanda inserita con successo!";
		}
		else
		    $message="Selezionare una categoria come topic!";
			
	}
	}else
	{   
        //cambio il campo chiuso della categoria
		$idd=$_GET["idd"];
		$chiusa=$_GET["chiusa"];
		if($chiusa== 'f')
			$chiusa= 't';
		else
			$chiusa= 'f';
		$query="UPDATE domandaperta SET chiusa='$chiusa' WHERE idd='$idd'";
		$query_risp=pg_query($dbconn,$query);
		if($query_risp)
			$message="Risposta modificata con successo!";
		else
			$message=pg_last_error($dbconn)."Impossibile fare una modifica";
		
	}
	header("Location: faidomanda.php?message=$message");
?>
