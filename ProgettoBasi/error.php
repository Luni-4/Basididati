<?php
   /* Lista errori: 
      0 ---> Utente non trovato o non corretto
	  1 ---> email non trovata  o non corretta
	  2 ---> pass non corretta
	  3 ---> password di conferma non valida
	  4 ---> password non uguali tra loro
	  5 ---> inserimento avvenuto con successo
	  6 ---> utente e email esistono gia
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
				case 3:
					echo"<h1>Password di conferma non valida</h1>\n";
					echo"<h3>La password di conferma inserita non è corretta</h3>\n";
				break;
				case 4:
					echo"<h1>Password non uguali tra loro</h1>\n";
					echo"<h3>Le password non sono uguali</h3>\n";
				break;
				case 5:
					echo"<h1>Inserimento avvenuto con successo</h1>\n";
					echo"<h3>Puoi loggarti</h3>\n";
				break;
				case 6:
					echo"<h1>Utente già esistente</h1>\n";
					echo"<h3>Cambia username o email</h3>\n";
				break;		
                case 7:
				    echo"<h1>Utente non esistente nel dbms</h1>\n";
					echo"<h3>Inserisci valori corretti</h3>\n";
                break;	                			
				default:
					echo"Errore nel sistema\n";
		   } 
   }
 ?>       