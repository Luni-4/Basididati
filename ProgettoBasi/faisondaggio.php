<?php
	session_start(); 
 ?>
 <!DOCTYPE html>
	<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiSondaggio</title>	
	</head>
	<body>
			
    <?php
	   require_once "dbopen.php";
	   //$user=$_SESSION["user"];
	   $user='mik';
	   if(isset($_GET["message"])){
		  print"<a href=withinTheService.php>Torna alla pagina iniziale</a><br><br>";
		  print"<a href=faisondaggio.php>Fai un altro sondaggio</a><br><br>";
		  print $_GET["message"];          
	   }
	   else
	   {
    ?>
	<a href=withinTheService.php>Torna alla pagina iniziale</a>
	  <form action='sondaggio.php' method=POST>	     
			  Seleziona categoria <br>
			     <select name='categoria'>				   
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
		       Titolo sondaggio<input type='text' name='titolo' size='50' required><br>
			   Testo sondaggio<input type='text' name='testo' size='100' required><br>
			   Url immagine<input type='url' name='imgurl'><br>
			   Descrizione immagine<input type='text' name='imgtesto' size='50'><br>
			   <?php
			      $risp=$_POST["risp"];
				  for($i=0; $i<$risp; $i++){
					  print"<input type='text' name='$i' size='100' required><br>";
				  }
			   ?>
			   <input type='submit' value='Invia Risposta'>
		</form>	 
	 
     <h3>Visualizza i tuoi sondaggi</h3>
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
					 print "Titolo : ".$row['titolo']."Testo : ".$row['testo']."<a href=sondaggio.php?idd=$row[idd]&chiusa=$row[chiusa]>$chiusa</a><br>";
				 }
				 else
					print "Titolo : ".$row['titolo']."Testo : ".$row['testo']."<br>";
			    }// while
	      }
		  else 
		  {
		     $message=pg_last_error($dbconn)." impossibile visualizzare le vecchie domande"; 
	      }
	    }// else sessione
     ?>
    </body>
 </html>