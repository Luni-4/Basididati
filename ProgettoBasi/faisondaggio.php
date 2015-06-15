<?php
	session_start(); 
 ?>
<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiSondaggio</title>	
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
	      <form action="sondaggio.php" method=POST>	     
			    Seleziona categoria: Usa ctrl + left mouse per una selezione multipla!  <br>
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
		       Titolo sondaggio<input type="text" name="titolo" maxlength="50" size="50" required><br>
			   Testo sondaggio<br><textarea name="risposta" rows="4" cols="100" required></textarea><br>
			   Url immagine<input type="url" name="imgurl"><br>
			   Descrizione immagine<input type="text" name="imgtesto" size="50"><br>
			   <?php
				 $risp=$_POST["risp"];
			     for($i=0; $i<$risp; $i++)
						  print"<input type='text' name='$i' size='100' required><br>";					  
			   ?>
			   <input type="submit" value="Invia Sondaggio" class="myButton" style="position:absolute;right:100px;top:75px">
		  </form>	 
	      </b></div>
	      <div class="ghost_utility">	
		    <h3 style="color:green">Visualizza i tuoi sondaggi</h3>
		    <?php
			  $querydomanda="SELECT idd,titolo,testo,datad,imgurl,imgtesto,chiusa
							 FROM sondaggio
							 WHERE nome='$user'";
			  $query=pg_query($dbconn,$querydomanda);
			  if($query)
			  {
				   while($row=pg_fetch_assoc($query))
				   {
						 if($row["chiusa"] == 'f')
						 {
							 $chiusa="Chiudi";				     	
							 print "<b><u>Titolo : </u></b>".$row["titolo"]." <b><u>Testo : </u></b>".$row["testo"]."<a href=sondaggio.php?idd=$row[idd]&chiusa=$row[chiusa]>$chiusa</a><br>";
						 }
						 else
							print "<b><u>Titolo : </u></b>".$row["titolo"]." <b><u>Testo : </u></b>".$row["testo"]."<br>";
					}// while
			  }
			  else 			  
				exit("Errore nella query: ".pg_last_error($dbconn));
	    }// messaggio
		    ?>
			</div>
		 </div>		
    </body>
 </html>