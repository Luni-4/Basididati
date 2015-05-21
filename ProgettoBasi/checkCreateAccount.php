<?php 

  // Controlli
  if(empty($_POST["username"])){	
	  Header("Location: paginaRegistrazione.php?message_error=0");
  }elseif(empty($_POST["email"])){
	  $user=$_POST["username"];
	  Header("Location: paginaRegistrazione.php?message_error=1&user=$user");
  }elseif(empty($_POST["pass"])){
	  $user=$_POST["username"];
	  $email=$_POST["email"];
	  Header("Location: paginaRegistrazione.php?message_error=2&user=$user&email=$email");	
  }elseif(empty($_POST["passConfirm"])){
	  $user=$_POST["username"];
	  $email=$_POST["email"];
	  Header("Location: paginaRegistrazione.php?message_error=3&user=$user&email=$email");
  }else{
	  $user=$_POST["username"];
	  $email=$_POST["email"];
	  $pass=$_POST["pass"];
	  $passc=$_POST["passConfirm"];
	  if(trim($pass) != trim($passc))
		Header("Location: paginaRegistrazione.php?message_error=4&user=$user&email=$email");	
  }
  
  // Residenza e data
  $residenza=$_POST["residenza"];		
  

  include "dbopen.php"; // apertura database
	
	// controllo esistenza nel database di utente e email	
	$queryricerca="SELECT nome FROM utente WHERE nome='$user' AND email='$email'";
	$ricerca=pg_query($dbconn, $queryricerca) or die("Errore nella query");	
	
	
	// Se utente non esiste aggiunta a database
	if(pg_num_rows($ricerca) == 0){ 
		
		if(empty($_POST["residenza"]) & !empty($_POST["bday"])){
			$data=$_POST["bday"];
			$queryinserimento="INSERT INTO utente(nome,email,password,datanascita) VALUES ('$user','$email','$pass','$data')";
		}elseif(empty($_POST["bday"]) & !empty($_POST["residenza"])){
			$residenza=$_POST["residenza"];	
		    $queryinserimento="INSERT INTO utente(nome,email,password,residenza) VALUES ('$user','$email','$pass','$residenza')";
		}elseif(empty($_POST["bday"]) && empty($_POST["residenza"])){
			$queryinserimento="INSERT INTO utente(nome,email,password) VALUES ('$user','$email','$pass')";
		}else{
			$data=$_POST["bday"];
			$residenza=$_POST["residenza"];	
			$queryinserimento="INSERT INTO utente(nome,email,password,residenza,datanascita) VALUES ('$user','$email','$pass','$residenza','$data')";
		}
		
		// Lancio query
		$inserimento=pg_query($dbconn, $queryinserimento) or die("Errore nella query");
		
	    // Query inserimento categoria
		$categ=$_POST["categ"];
		$querycategoria="INSERT INTO preferenza(nome,nomec) VALUES ('$user','$categ')";
		$categoria=pg_query($dbconn, $querycategoria) or die("Errore nella query");
		
		// Chiusura database e redirect
        include "dbclose.php"; 
        Header("Location: login.php?message_error=5");		
	}
	
	// Utente esiste già
	include "dbclose.php";
	Header("Location: paginaRegistrazione.php?message_error=6");
?>
