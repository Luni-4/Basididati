<?php //pagina di controllo
	session_start();
	require_once "dbopen.php";
	//controllo che i campi di interesse siano riempiti
	if(!isset($_GET["idd"]) && !sset($_GET["chiusa"])){//faccio una domanda
		if(!empty($_GET["testo"])){
			$testo=$_GET["testo"];
			if(!empty($_GET["titolo"])){
				$titolo=$_GET["titolo"];
				if($_GET["categoria"]!='nessunascelta'){
					$imgurl=$_GET["imgurl"];
					$imgtesto=$_GET["imgtesto"];
					$query="INSERT INTO domandaperta(titolo,testo,imgurl,imgtesto) VALUES ('$titolo','$testo','$imgurl','$imgtesto')";
					$message="Domanda inserita con successo!";
				}
				else
					$message="Selezionare una categoria come topic!";
			}else{
				$message="Devi mettere un titolo!";
			}
		}else{
			$message="Devi mettere un testo!";
		}
	}else{//cambio il campo chiuso della categoria
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
		else{
			$message=pg_last_error($dbconn);
			$message=$message."Impossibile fare una modifica";
			}
	}
	header("Location: faidomanda.php?message=$message");



?>
