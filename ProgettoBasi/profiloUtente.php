<?php 
   session_start();     	
?>
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>ProfiloUtente</title>	
	   <link rel="stylesheet" type="text/css" href="Css/styles.css">	
	</head>
	<body style="background-color:#6F6">
		<div class="top_box"></div>
		<div id="cssmenu">
				<ul>				        						  
						<li><a href="withinTheService.php"><span>|Torna Indietro|</span></a></li>                        
                        <li class="last"><a href="logout.php"><span>|Logout|</span></a></li>						
				</ul>
		</div>
			<div class="left_box">Profilo Utente
				<img src="Immagini/user.png" style="width:150px;height:150px;position:absolute;top:50px;left:25px">
			</div>
			<div class="main_box">
			<div class="ghost_box">					
			<?php	
					require_once "dbopen.php";
					if(empty($_GET["utente"]))
					       $utente=$_SESSION["user"];
					else
						   $utente=$_GET["utente"];
					// Query per trovare dati utente
					$queryutente="SELECT email,residenza,tipo,datanascita
							      FROM utente
							      WHERE nome='$utente'";
					$utentequery=pg_query($dbconn,$queryutente); 						
					if($queryutente)
					{
						$ut=pg_fetch_assoc($utentequery);
						// Stampare valori tupla utente
						print "<p style=\"color:black;position:absolute;left:200px;font-size:40px;top:-40px\"> Informazioni personali: </p>";
					    print "<div style=\"background-color:#00CC99;width:675px;padding-left:10px\">";
						     print "<p>Username: ".$utente."</p>\n";
						     print "<p>Email: ".$ut["email"]."</p>\n";
						     print "<p>Residenza: ".(empty($ut["residenza"]) ? "Non pervenuta" : $ut["residenza"])."</p>\n";
						     print "<p>Sei un utente: ".$ut["tipo"]."</p>\n";
						     print "<p>Data di nascita: ".(empty($ut["datanascita"]) ? "Non pervenuta" : $ut["datanascita"])."</p>\n";												
					    print"</div>";
					}
					else
						exit("Errore nella query: ".pg_last_error($dbconn));								 
			?>
			</div>
		</div>
  </body>
</html>
