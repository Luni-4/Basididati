<?php 
    //pagina di controllo
	session_start();
	require_once "dbopen.php";
	
	if(!isset($_GET["idd"]))
	{               //faccio un sondaggio
                    $categ=$_POST["categoria"];	
			        $testo=$_POST["testo"]; 
                    $testo=$testo."<br><br>";
                    for($i=0; $i<count($_POST)-5; $i++)		
                         $testo=$testo."<input type=radio name=sonda value=".$_POST[$i]." required>".$_POST[$i]."<br>";					$titolo=$_POST["titolo"];		
                    $nome=$_SESSION['user'];					
					$imgtesto="'".$_POST["imgtesto"]."'";;
					if(!empty($_POST["imgurl"]))
						$imgurl="'".$_POST["imgurl"]."'";						
					else
				    {
						$imgurl="NULL";
						$imgtesto="NULL";
					}					
					$query="INSERT INTO sondaggio(titolo,testo,imgurl,imgtesto,nome) VALUES ('$titolo','$testo',$imgurl,$imgtesto,'$nome') RETURNING idd";
					$query_risp=pg_query($dbconn,$query);
		            if(!$query_risp)
			               $message=pg_last_error($dbconn);	
					else
	                {					   
					  $row=pg_fetch_row($query_risp);					  
                      $query="INSERT INTO topic2(nomec,idd) VALUES ('$categ',$row[0])";
					  $query_risp=pg_query($dbconn,$query);
		               if(!$query_risp)
			               $message=pg_last_error($dbconn);	 
                       else
                           $message="Domanda inserita con successo!";	
                    }				   					       	
	}
	else
	{   
        //cambio il campo chiuso della categoria
		$idd=$_GET["idd"];
		$chiusa=$_GET["chiusa"];
		if($chiusa== 'f')
		{
		   $chiusa='TRUE';
		   $query="UPDATE sondaggio SET chiusa=$chiusa WHERE idd='$idd'";
		   $query_risp=pg_query($dbconn,$query);
		   if($query_risp)
			    $message="Risposta modificata con successo!";
		   else
			    $message=pg_last_error($dbconn)."Impossibile fare una modifica";
		}		
	}
    header("Location: faisondaggio.php?message=$message");	
?>
