<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>ripostaSondaggio</title>	
</head>
	<body>
	    <?php
		  if(isset($_GET["message"])){
			 print"<a href=withinTheService.php>Torna alla pagina iniziale</a><br><br>";
	         print $_GET["message"];         
		  }else
		  {			 
		    require_once "dbopen.php"; 
		    if(!empty($_GET['idd']))
		    {
		         $_SESSION['idds']=$_GET['idd'];
			     $idd=$_GET['idd'];	
                 $utente=$_SESSION["user"];				 
		         $query="SELECT titolo,testo,chiusa 
			             FROM sondaggio
					     WHERE idd='$idd'";
			     $query_res=pg_query($dbconn,$query);
			     if($query_res)
				 {
					$row=pg_fetch_row($query_res);					
					if($row[2] == 't'){
				       print"$row[0]<br><br>";
				       print"$row[1]";
					   print"<br><br> La domanda è chiusa, non puoi rispondere<br><br>";
					   print"<a href=withinTheService.php>Torna alla pagina iniziale</a>";
					}
					else
					{
						$query="SELECT idd 
			                    FROM rispostapredefinita
					            WHERE idd='$idd' AND nome='$utente'";
						$query_res=pg_query($dbconn,$query);
						if($query_res)
						{
							if(pg_num_rows($query_res) == 0)
							{						
						        print"<form action=rispostacheck.php method=POST>";
						        print"$row[0]<br><br>";
				                print"$row[1]";
						        print"<br><br>
		                        <input type=checkbox name=anonimo> Anonimo<br>
		                        <input type=submit value=Invia Risposta>
		                      </form>";
							}
							else
							{
								print"$row[0]<br><br>";
				                print"$row[1]";
					            print"<br><br>Hai già votato per questo sondaggio<br><br>";
					            print"<a href=withinTheService.php>Torna alla pagina iniziale</a>";
							}
						}// query già votato
						 else
						   exit("Errore nella query: ".pg_last_error($dbconn));	 
					}// query chiusura
			     }
				 else
					exit("Errore nella query: ".pg_last_error($dbconn));
		?>
		  
		<br><br><br>Ecco le risposte alla query
        <?php		
            // mostro risposte 
			   $querysondaggio="SELECT anonimo,nome,datar,testorisp,idr
							    FROM rispostapredefinita
							    WHERE idd='$idd'
							    ORDER BY datar";
			   $query=pg_query($dbconn,$querysondaggio);			
			   if($query)
			   {
				    //visualizzo le risposte
					while($row=pg_fetch_assoc($query))
					{
						print "<br>";
						if($row['anonimo']=='f')
							print $row['nome'];
						else 
					        print "anonimo";
						print $row['datar'];
						print $row['testorisp'];						
					}
			    }
			    else			
				     exit("Errore nella query: ".pg_last_error($dbconn));
			
		    }// session
	      }// message
        ?>
   </body>
</html>