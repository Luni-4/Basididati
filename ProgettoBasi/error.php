<?php
   /* Lista errori: 
      0 ---> Utente non trovato o non corretto
	  1 ---> email non trovata  o non corretta
	  2 ---> pass non corretta
	  x ---> valore di errore che vogliamo */
	  
   if(isset($_GET['message_error'])) 
   {
		$err=$_GET['message_error'];	
		switch ($err) 
		   {
				case 0:		
				  echo"<h1>Username non trovato</h1>\n";
				  echo"<h3>Lo username inserito non è corretto</h3>\n";
				break;
				case 1:
					echo"<h1>Email non trovata</h1>\n";
					echo"<h3>La email inserita non è corretta</h3>\n";
				break;
				case 2:
					echo"<h1>Password non valida</h1>\n";
					echo"<h3>La password inserita non è corretta</h3>\n";
				break;
				default:
					echo"Errore nel sistema\n";
		   } 
   }
 ?>       