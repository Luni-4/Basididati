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
		<body style='background-color:#6F6'>
		<div class='top_box'></div>
		<div id='cssmenu'>
				<ul>
						 <li><a href='withinTheService.php'><span>|Torna Indietro|</span>	</a></li>
						 <li><a href='#'><span>|Vai alla tua pagina|</span></a></li>
						 <li class='last'><a href='logout.php'><span>|Logout|</span></a></li>		  
				</ul>
		</div>
		<div class='utility_background'>
			<div class='ghost_utility'><b>		
    <?php
	   require_once "dbopen.php";
	   //$user=$_SESSION["user"];
	   $user='oite';
	   if(isset($_GET["message"]))
		 print "<h3 style='color:red'>".$_GET["message"]."</h3>";          
	   
	   else
	   {}
    ?>
	  <form action='sondaggio.php' method=POST>	     
			  Seleziona categoria 
			     <select name='categoria' class="style">				   
			       <?php					   
	                  $querydomanda="SELECT nomec
				                     FROM utente NATURAL JOIN preferenza
				                     WHERE utente.nome='$user'";
	                  $query=pg_query($dbconn,$querydomanda);
	                  if($query){		                 	
		                  while($row=pg_fetch_assoc($query)){			            
			                    print "<option value=$row[nomec]>".$row['nomec']."</option>";			                    
		                  }
				      }else		                
			                $message=pg_last_error($dbconn)." impossibile visualizzare le categorie di interesse";
                    ?>					
		         </select>
				 <br>
		       Titolo sondaggio<input type='text' name='titolo' size='50' required><br>
			   Testo sondaggio<textarea name="risposta" rows="4" cols="150" required></textarea><br>
			   Url immagine<input type='url' name='imgurl'><br>
			   Descrizione immagine<input type='text' name='imgtesto' size='50'><br>
			   <?php
				if(isset($_POST["risp"])){
					  $risp=$_POST["risp"];
					  for($i=0; $i<$risp; $i++){
						  print"<input type='text' name='$i' size='100' required><br>";
					  }
				  }else{
					print "<h3 style='color:red'><a href='sondaggiorisp.php'>Se vuoi inserire un altro sondaggio clicca qui!<a></h3>";
				  }
			   ?>
			   <input type="submit" value="Invia Sondaggio" class="myButton" style="position:absolute;right:100px;top:150px">
		</form>	 
	</b></div>
	<div class='ghost_utility'>	
		 <h3 style="color:green">Visualizza i tuoi sondaggi</h3>
		 <?php
			  $querydomanda="SELECT idd,titolo,testo,datad,imgurl,imgtesto,chiusa
							 FROM sondaggio
							 WHERE nome='$user'";
			  $query=pg_query($dbconn,$querydomanda);
			  if($query)
			  {
				   while($row=pg_fetch_assoc($query)){
					 if($row["chiusa"] == 'f')
					 {
						 $chiusa="Chiudi";				     	
						 print "<b><u>Titolo : </u></b>".$row['titolo']." <b><u>Testo : </u></b>".$row['testo']."<a href=sondaggio.php?idd=$row[idd]&chiusa=$row[chiusa]>$chiusa</a><br>";
					 }
					 else
						print "<b><u>Titolo : </u></b>".$row['titolo']." <b><u>Testo : </u></b>".$row['testo']."<br>";
					}// while
			  }
			  else 
			  {
				 $message=pg_last_error($dbconn)." impossibile visualizzare le vecchie domande"; 
			  }
			
		 ?>
			</div>
		</div>
    </body>
 </html>