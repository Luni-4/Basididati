<?php //pagina di controllo
	session_start();
	require_once "dbopen.php";
	//controllo che i campi di interesse siano riempiti
	if(!isset($_GET["idd"])){//faccio una domanda
		if(!empty($_GET["testo"])){
			$testo=$_GET["testo"];
			if(!empty($_GET["titolo"])){
				$titolo=$_GET["titolo"];
				if($_GET["categoria"]!='nessunascelta'){
					$imgurl=$_GET["imgurl"];
					$imgtesto=$_GET["imgtesto"];
					$user=$_SESSION["user"];
					$query="INSERT INTO domandaperta(titolo,testo,imgurl,imgtesto,nome) VALUES ('$titolo','$testo','$imgurl','$imgtesto','$user') RETURNING idd";
					$query_res=pg_query($dbconn,$query);
					if($query_res){
						$row=pg_fetch_assoc($query_res);
						$idd_domanda=$row["idd"];
						$categoria=$_GET["categoria"];
						$query="INSERT INTO topic1 (nomec,idd) VALUES ('$categoria','$idd_domanda')";
						$query_res=pg_query($dbconn,$query);
						if($query_res)
							$message="Domanda inserita con successo!";
						else
							exit("Errore nella query: ".pg_last_error($dbconn));
					}else
						exit("Errore nella query: ".pg_last_error($dbconn));
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
		$query="UPDATE domandaperta SET chiusa='TRUE' WHERE idd='$idd'";
		$query_risp=pg_query($dbconn,$query);
		if($query_risp)
			$message="Risposta modificata con successo!";
		else
			exit("Errore nella query: ".pg_last_error($dbconn));
	}
	header("Location: faidomanda.php?message=$message");



?>
