<?php 
	session_start(); // Apertura sessione	
	
	 $user=trim($_POST["user"]);
     $email=trim($_POST["email"]);
	 $pass=trim($_POST["pass"]);
	
	  require_once "dbopen.php"; // apertura database
	 
		// controllo esistenza nel database di utente, email e password
		$queryricerca="SELECT nome, email, password FROM utente WHERE nome='$user' AND email='$email' AND password='$pass'";
		$ricerca=pg_query($dbconn, $queryricerca) or die("Errore nella query");
		
		if(pg_num_rows($ricerca) == 0){
			Header("Location: homePage.php?message_error=7");					
		}else{
			// Variabili di sessioni da mantenere quando utente si logga
	        $_SESSION["utente"]=$user;
	
	        // Invio domanda
	        Header("Location: paginaRegistrazione.php");	
		}
	}
?>
