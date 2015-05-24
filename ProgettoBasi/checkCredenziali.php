<?php 
	session_start(); // Apertura sessione
	
	// Controlli
	if(empty($_POST["user"])){	
	  Header("Location: homePage.php?message_error=0");
    }elseif(empty($_POST["email"])){
	  $user=$_POST["user"];
	  Header("Location: homePage.php?message_error=1&user=$user");
    }elseif(empty($_POST["pass"])){
	  $user=$_POST["user"];
	  $email=$_POST["email"];
	  Header("Location: homePage.php?message_error=2&user=$user&email=$email");
    }
	
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
	        $_SESSION["user"]=$user;
	        $_SESSION["email"]=$email;	
	
	        // Invio domanda
	        Header("Location: paginaRegistrazione.php");	
		}
?>
