<?php
	session_start(); 
 ?>
 <!DOCTYPE html>
	<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiDomanda</title>	
	</head>
	<body>
			
    <?php
	   require_once "dbopen.php";
	   //$user=$_SESSION["user"];
	   $user='oite';
	   if(isset($_GET["message"])){
		  print $_GET["message"];		 
	   }
	   else{}
    ?>
	<a href=withinTheService.php>Torna alla pagina iniziale</a>
	  <form action='domanda.php?' method=GET'>	     
			  Seleziona categoria <br>
			     <select name='categoria'>
				   <option value='nessunascelta' selected>Scegli</option>
			       <?php	 
	                  $querydomanda="SELECT nomec
				                     FROM preferenza
				                     WHERE nome='$user'";
	                  $query=pg_query($dbconn,$querydomanda);
	                  if($query){
		                  
		                  while($row=pg_fetch_assoc($query))
			                    print "<option value=$row[nomec]>".$row['nomec']."</option>";
			                  
				      }else		                
			                exit("Errore nella query: ".pg_last_error($dbconn));
                    ?>					
		         </select>
		       Titolo domanda<input type='text' name='titolo' size='50' required><br>
			   Poni domanda<input type='text' name='testo' size='100' required><br>
			   <input type='url' name='imgurl'><br>
			   Descrizione immagine<input type='text' name='imgtesto' size='50'><br>
			   <input type='submit' value='Invia Risposta'>
		</form>	 
	 
     <h3>Visualizza le tue domande e modificane la visibilità!</h3>

     <?php
	      $querydomanda="SELECT idd,titolo,testo,datad,imgurl,imgtesto,chiusa
				         FROM utente NATURAL JOIN domandaperta
				         WHERE utente.nome='$user'";
	      $query=pg_query($dbconn,$querydomanda);
	      if($query){
		    while($row=pg_fetch_assoc($query)){
			if($row["chiusa"] != 'f') //se scrivo FALSE non me lo prende
				print "Titolo : ".$row['titolo']."Testo : ".$row['testo']."Chiusa <br>";
			else
				print "Titolo : ".$row['titolo']."Testo : ".$row['testo']."<a href=domanda.php?idd=$row[idd]>Risposta aperta: Chiudi</a><br>";
		}					

	 }else
		exit("Errore nella query: ".pg_last_error($dbconn));
	  
     ?>
  	 </body>
 </html> 
 
 
 
 


