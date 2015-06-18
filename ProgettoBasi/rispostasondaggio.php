<!-- Pagina in cui e' possibile dare una risposta predefinita oppure guardare quante risposte predefinite sono gia' state date e da chi-->
<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>RispostaSondaggio</title>	
	   <link rel="stylesheet" type="text/css" href="Css/styles.css">	
	</head>
	<body style="background-color:#6F6">
		<div class="top_box"></div>
		<div id="cssmenu">
				<ul>
						 <li><a href="withinTheService.php"><span>|Torna Indietro|</span></a></li>
						 <li><a href="profiloUtente.php"><span>|Vai alla tua pagina|</span></a></li>
						 <li class="last"><a href="logout.php"><span>|Logout|</span></a></li>		  
				</ul>
		</div>
		<div class="utility_background">
			<div class="ghost_utility"><b>
						<?php
						  if(isset($_GET["message"]))						  
							print "<h3 style=\"color:red\">".$_GET["message"]."</h3><br>";                             
						  else
						  {			 
							require_once "dbopen.php"; 
							if(!empty($_GET["idd"]))
							{
								 $_SESSION["idds"]=$_GET["idd"];
								 $idd=$_GET["idd"];	
								 $utente=$_SESSION["user"];				 
								 $query="SELECT titolo,testo,chiusa,imgurl,imgtesto 
										 FROM sondaggio
										 WHERE idd='$idd'";
								 $query_res=pg_query($dbconn,$query);
								 if($query_res)
								 {
									$row=pg_fetch_assoc($query_res);
									if($row["imgurl"] != NULL)
										print "<img src=\"$row[imgurl]\" style=\"width:304px;height:228px;position:absolute;right:100px;\">";
									else
										print "<img src=\"Immagini/image_not_found.jpg\" style=\"width:304px;height:228px;position:absolute;right:100px;\">";
										
										
									if($row["imgtesto"] != NULL)
										print "<div style=\"position:absolute;right:100px;top:300px;\"><u>Descrizione Immagine: </u>".$row["imgtesto"]."</div><br><br>";
									else
										print "<div style=\"position:absolute;right:100px;top:300px\"><u>Descrizione Immagine: </u> Non disponibile </div><br><br>";
									
									
									if($row["chiusa"] == 't')
									{
									   print"<h1><b>Titolo: </b>". $row["titolo"]."</h1>";
									   print"<h1><b>Testo: </b>".$row["testo"]."</h1>";
									   print"<br><br><h3 style=\"color:red\"> La domanda è chiusa, non puoi rispondere</h3>";
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
												print"<form action=\"rispostacheck.php\" method=\"POST\">";
												print"<h1><b>Titolo: </b>". $row["titolo"]."</h1>";
												print"<h1><b>Testo: </b>".$row["testo"]."</h1>";
												print"<br><br>
												<input type=checkbox name=anonimo class=\"error\"> Anonimo<br>
												<input type=\"submit\" value=\"Invia Risposta\" class=\"myButton\" style=\"position:absolute;right:150px;top:425px\">
											    </form>";
											}
											else
											{
												print"<h2><b>Titolo: </b>". $row["titolo"]."</h2>";
												print"<h2><b>Testo: </b>".$row["testo"]."</h2>";
												print"<br><br><h3 style=\"color:red\">Hai già votato per questo sondaggio</h3>";
												print"<h2 style=\"color:green\">Ecco le risposte del sondaggio</h2>";
												print"<h3 style=\"color:blu\">(Quelle non riportate non hanno ottenuto votazione)</h3>";
												 // mostro risposte 
												$querysondaggio="SELECT testorisp, count(testorisp) AS p
																 FROM rispostapredefinita
																 WHERE idd='$idd'
																 GROUP BY testorisp
																 ORDER BY p DESC"; // ordinamento dal maggior numero di voti al minore
												$query=pg_query($dbconn,$querysondaggio);			
												if($query)
												{
												   print"<h2 style=\"color:green\"><u>Testo e voto (clicca su voto per vedere chi ha votato!)</u></h2>";
								
												   if(pg_num_rows($query) != 0)												   						
													  while($row=pg_fetch_assoc($query))													  
														 print "$row[testorisp] <a href=votosondaggio.php?risposta=$row[testorisp]>$row[p]</a><br>";														  
												   
												} // if query risposte
												  else			
													  exit("Errore nella query: ".pg_last_error($dbconn));	  
											
											}// query già votato
										}
										else
										   exit("Errore nella query: ".pg_last_error($dbconn));	 
									}// query chiusura
								 }// query sondaggio
								 else
									exit("Errore nella query: ".pg_last_error($dbconn));
							}// session
						 }// message
		                 ?>  
			</b></div>
		</div>
   </body>
</html>