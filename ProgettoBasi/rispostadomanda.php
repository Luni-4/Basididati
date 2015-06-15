<!--Pagina per visualizzare maggiori dettagli della domanda selezionata, rispondere, visualizzare le risposte coi voti ed eventualmente votare -->
<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>RispostaDomanda</title>	
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
			<div class="ghost_utility">
			<?php
				 if(isset($_GET["message"]))
				   print "<h3 style=\"color:red\">".$_GET["message"]."</h3>"; 	
				 else
				{  
						$_SESSION["idd"]=$_GET["idd"];
						$idd= $_GET["idd"];
						
						require_once "dbopen.php"; 
						$querydomanda="SELECT datad, testo, imgurl,chiusa,imgtesto,nome,titolo 
									   FROM domandaperta 
									   WHERE idd='$idd'";
						$query=pg_query($dbconn,$querydomanda); 
						if($query)
						{
							$row=pg_fetch_assoc($query);
							$_SESSION["chiusa"]=$row["chiusa"];
							print "<h2>Domanda:</h2>";
							print "<h3>Titolo:</h3>".$row["titolo"]."<br>";
							
							if($row["imgurl"] != NULL)
								print "<img src=\"$row[imgurl]\" style=\"width:304px;height:228px;position:center\">";
							else
								print "<img src=\"Immagini/image_not_found.jpg\" style=\"width:304px;height:228px;position:center\">";
								
							if($row["imgtesto"] != NULL)
								print "<u>Descrizione Immagine: </u>".$row["imgtesto"]."<br><br>";
							else
								print "<u>Descrizione Immagine: </u> Non disponibile <br><br>";
							
							print "<u>Data: </u>".$row["datad"]."<u> Testo: </u>".$row["testo"]."<u> Nome: </u>".$row["nome"];
							
							if($row["chiusa"]=='f')
						    {
								print "<u> Stato:</u> <h2>Aperta</h2>";
							    print"<form action=\"risposta.php\" method=\"POST\">
								   Risposta:<br> <textarea name=\"risposta\" rows=\"4\" cols=\"100\"  required></textarea><br>
								   <input type=\"checkbox\" name=\"anonimo\" class=\"error\"> Anonimo<br>
								   <input type=\"submit\" value=\"Invia Risposta\" class=\"myButton\" style=\"position:absolute;top:300px;right:100px\">
					           </form>";
							}
							else
								print "<u> Stato:</u> <h2>Chiusa</h2>";		
							
							
							$querydomanda="SELECT anonimo,nome,datar,testorisp,idr
											FROM rispostaperta 
											WHERE idd='$idd'
											ORDER BY datar";
							$query=pg_query($dbconn,$querydomanda);
							if($query)
							{
								//visualizzo le risposte
								while($row=pg_fetch_assoc($query))
								{
									print "<br>";
									//controllo dei voti
									print "<p style=\"background-color:white\">";
									$idr=$row["idr"];
									print "<b>Data: </b>".$row["datar"];
									print "<b>Risposta: </b>".$row["testorisp"];
									$query_voto="SELECT COUNT(*) AS votonegativo
												 FROM voto
												 WHERE idr='$idr'
												 GROUP BY voto
												 HAVING voto='FALSE'";
									$query_res=pg_query($dbconn,$query_voto);
									
									if($query_res)
									{
										$row1=pg_fetch_assoc($query_res);
										$votonegativo=$row1["votonegativo"];
										if($votonegativo==NULL)
											$votonegativo=0;						
										$query_voto="SELECT COUNT(*) AS votototale
													 FROM voto
													 WHERE idr='$idr'";
										$query_res=pg_query($dbconn,$query_voto);
										if($query_res)
										{
												$row1=pg_fetch_assoc($query_res);
												$tot=$row1["votototale"];
												$votopositivo=$tot-$votonegativo;
										}else
											exit("Errore nella query: ".pg_last_error($dbconn));				

									}else
										exit("Errore nella query: ".pg_last_error($dbconn));
									
									print "<b>Utente: </b>";
									
									if($row["anonimo"]=='f')
										print $row["nome"];
									else 
										print "anonimo ";
									
									print "<b>TotPositivi: ".$votopositivo."</b> "."<b><a href=\"voto.php?voto=positivo&idr=$row[idr]\"> VotaPositivo!</a></b>";
									print "<b>TotNegativi: ".$votonegativo."</b> "."<b><a href=\"voto.php?voto=negativo&idr=$row[idr]\"> VotaNegativo!</a></b>";
									print "</p>";
								}
							}
							else
								exit("Errore nella query: ".pg_last_error($dbconn));
							
						}
						else
							exit("Errore nella query: ".pg_last_error($dbconn));
			    }			
			?>
			</div>
		</div>
	</body>
</html>