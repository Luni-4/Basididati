<?php //pagina di controllo
	session_start();
	require_once "dbopen.php";
	if(!isset($_GET["idd"]))
	{
					$titolo=$_POST["titolo"];
					$testo=$_POST["testo"];
					$imgtesto="'".$_POST["imgtesto"]."'";;
					if(!empty($_POST["imgurl"]))
						$imgurl="'".$_POST["imgurl"]."'";						
					else
				    {
						$imgurl="NULL";
						$imgtesto="NULL";
					}				
					$user=$_SESSION["user"];			
					
					$query="INSERT INTO domandaperta(titolo,testo,imgurl,imgtesto,nome) VALUES ('$titolo','$testo',$imgurl,$imgtesto,'$user') RETURNING idd";
					$query_res=pg_query($dbconn,$query);
					if($query_res)
					{
						$row=pg_fetch_assoc($query_res);
						$idd_domanda=$row["idd"];
						$categ=$_POST["categoria"];
		                foreach ($categ as $c)
						{
		                     $querycategoria="INSERT INTO topic1 (nomec,idd) VALUES ('$c','$idd_domanda')";
		                     $categoria=pg_query($dbconn, $querycategoria) or die("Errore nella query");		
		                }	
                        $message="Domanda inserita con successo";									
					}
					else
						exit("Errore nella query: ".pg_last_error($dbconn));		
	}
	else
	{
		//cambio il campo chiuso della categoria
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
