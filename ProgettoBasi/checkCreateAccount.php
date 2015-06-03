<?php 
  session_start();
  
  // Controlli  
  if(empty($_POST["categ"])){
	  $user=$_POST["username"];
	  $email=$_POST["email"];	  
	  Header("Location: paginaRegistrazione.php?message_error=8&user=$user&email=$email");  
  }elseif((empty($_POST["giorno"]) || empty($_POST["mese"]) || empty($_POST["anno"])) && !(empty($_POST["giorno"]) && empty($_POST["mese"]) && empty($_POST["anno"])) ){
	  $user=$_POST["username"];
	  $email=$_POST["email"];	  
	  Header("Location: paginaRegistrazione.php?message_error=10&user=$user&email=$email"); 
  }elseif(!(empty($_POST["giorno"]) && empty($_POST["mese"]) && empty($_POST["anno"])) && !checkdate($_POST["mese"],$_POST["giorno"],$_POST["anno"])){
	 $user=$_POST["username"];
	 $email=$_POST["email"];	  
	 Header("Location: paginaRegistrazione.php?message_error=11&user=$user&email=$email"); 
  }else
  {
	  $pass=trim($_POST["pass"]);
	  $passc=$_POST["passConfirm"];
	  if($pass != trim($passc))
		Header("Location: paginaRegistrazione.php?message_error=4&user=$user&email=$email");	
	  $user=trim($_POST["username"]);
	  $email=trim($_POST["email"]);
	  
	  // Data
      $anno=trim($_POST["anno"]);
	  $mese=trim($_POST["mese"]);
	  $giorno=trim($_POST["giorno"]);	  
	  $data=(!empty($giorno) && !empty($mese) && !empty($anno)) ? "'$anno-$mese-$giorno'" : "NULL";

    require_once "dbopen.php"; // apertura database
	
	// controllo esistenza nel database di utente e email	
	$queryricerca="SELECT nome FROM utente WHERE nome='$user' OR email='$email'";
	$ricerca=pg_query($dbconn, $queryricerca) or die("Errore nella query");	
	
	// Se utente non esiste aggiunta a database
	if(pg_num_rows($ricerca) == 0)
	{ 	
		// Valori e Controllo 	    
	    if(empty($_POST["residenza"]))
			$residenza="NULL";
		else
			$residenza="'".$_POST["residenza"]."'";
	    $queryinserimento="INSERT INTO utente(nome,email,password,residenza,datanascita) VALUES ('$user','$email','$pass',$residenza,$data)";	
		
		// Lancio query
		$inserimento=pg_query($dbconn, $queryinserimento) or die("Errore nella query");
		
	    // Query inserimento categoria
		$categ=$_POST["categ"];
		foreach ($categ as $c){
		    $querycategoria="INSERT INTO preferenza(nome,nomec) VALUES ('$user','$c')";
		    $categoria=pg_query($dbconn, $querycategoria) or die("Errore nella query");		
		}
		
		// Variabili di sessioni che voglio mantenere quando utente si logga
	    $_SESSION["user"]=$user;
		
		// Mandare a domanda.php
        Header("Location: withinTheService.php");		
	}else	
	 // Utente esiste già	
	 Header("Location: paginaRegistrazione.php?message_error=6");
  }
?>
