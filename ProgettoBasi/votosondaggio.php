<!--Pagina che permette di vedere chi ha dato una risposta a un sondaggio preciso e di indirizzare alla pagina personale -->
<?php
 session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>VotoSondaggio</title>	
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
					   
					   require_once "dbopen.php"; 
					   $risposta=$_GET["risposta"];
					   $idd=$_SESSION["idds"];   
					   $utente=$_SESSION["user"]; 
					   $query="SELECT nome,anonimo,datar
							   FROM rispostapredefinita 
							   WHERE testorisp='$risposta' AND idd='$idd'
							   ORDER BY datar";
						$query_res=pg_query($dbconn,$query);
						print "<h2 style=\"color:green\">Utenti che hanno votato la risposta selezionata:</h2>";
						if($query_res)
						{   
								   while($row=pg_fetch_array($query_res))
								   {
										if($row["anonimo"]== 'f')
											 $nome="<a href=\"profiloUtente.php?utente=$row[nome]\">$row[nome]</a>";					
										else
											$nome="Anonimo";					
										if($row["nome"] == $utente)
											$nome="<a href=\"profiloUtente.php\">Tu</a>";
										print "Utente: $nome Data Risposta: $row[datar]<br>";						
								   }
						}
						else
							exit("Errore nella query: ".pg_last_error($dbconn));
					?>
			</div>
		</div>
   </body>
</html>