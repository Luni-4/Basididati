<?php
	session_start(); 
 ?>
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiDomanda</title>	
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
	   $user=$_SESSION["user"];	   
	   if(isset($_GET["message"]))
		 print "<h3 style=\"color:red\">".$_GET["message"]."</h3>";      
	   else
	   {
    ?>
				<form action="domanda.php" method="POST">	     
					Seleziona categoria: Usa ctrl + left mouse per una selezione multipla! <br>
					<select name="categoria[]" class="style" multiple="multiple" tabindex="1" required>						   
						   <?php
						      require_once "dbopen.php";
							  $i=0;
							  $querydomanda="SELECT nomec
											 FROM preferenza
											 WHERE nome='$user'";
							  $query=pg_query($dbconn,$querydomanda);//per stampare le categorie di preferenza
							  if($query)				
								  while($row=pg_fetch_assoc($query))
										print "<option value=$row[nomec]>".$row["nomec"]."</option>";								  
							  else		                
									exit("Errore nella query: ".pg_last_error($dbconn));
							?>					
					</select>					
					<br>
					Titolo domanda<input type="text" name="titolo" size="50" maxlength="50" required><br>
					Poni domanda<br><textarea name="testo" rows="4" cols="100" required></textarea><br>
					Carica la tua Immagine<input type="url" name="imgurl" ><br>
					Descrizione immagine<input type="text" name="imgtesto" size="50"><br>
					<input type="submit" value="Invia Domanda" class="myButton" style="position:absolute;right:100px;top:100px">
				</form>	 
			  </b></div>
			<div class="ghost_utility">
				<h3 style="color:green">Visualizza le tue domande e modificane la visibilità!</h3>

			<?php
				  $querydomanda="SELECT idd,titolo,testo,datad,imgurl,imgtesto,chiusa
								 FROM utente NATURAL JOIN domandaperta
								 WHERE utente.nome='$user'";
				  $query=pg_query($dbconn,$querydomanda);
				  if($query)
				  {
					while($row=pg_fetch_assoc($query))
					{
						if($row["chiusa"] != 'f') 
							print "<b><u>Titolo </u></b> : ".$row["titolo"]."<b><u> Testo </u></b>: ".$row["testo"]."<b><u> Chiusa </u><b><br>";
						else
							print "<b><u>Titolo </u></b> : ".$row["titolo"]."<b><u> Testo</u></b> : ".$row["testo"]."<a href=domanda.php?idd=$row[idd]><b><u> Risposta aperta: Chiudi</u><b></a><br>";
					}					

				 }
				 else
					exit("Errore nella query: ".pg_last_error($dbconn));		
	    }// messaggio	  
			?>
			</div>
		</div>
  	 </body>
 </html> 
 
 
 
 


