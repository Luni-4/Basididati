<?php 
  session_start();
  
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
  }elseif(empty($_POST["categ"])){
	  $user=$_POST["username"];
	  $email=$_POST["email"];	  
	  Header("Location: paginaRegistrazione.php?message_error=8&user=$user&email=$email");  
  }else{
	  $user=trim($_POST["username"]);
	  $email=trim($_POST["email"]);
	  $pass=trim($_POST["pass"]);
	  $passc=$_POST["passConfirm"];
	  if($pass != trim($passc))
		Header("Location: paginaRegistrazione.php?message_error=4&user=$user&email=$email");	
  }  

  require_once "dbopen.php"; // apertura database
	
	// controllo esistenza nel database di utente e email	
	$queryricerca="SELECT nome FROM utente WHERE nome='$user' OR email='$email'";
	$ricerca=pg_query($dbconn, $queryricerca) or die("Errore nella query");	
	
	// Se utente non esiste aggiunta a database
	if(pg_num_rows($ricerca) == 0)
	{ 	
		// Valori e Controllo 
	    $data=!empty($data) ? "'array('bgday' => serialize($_POST))'" : "NULL";
	    $residenza=!empty($residenza) ? "'array('residenza' => serialize($_POST))'" : "NULL";
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
	    $_SESSION["email"]=$email;	
		
		// Mandare a domanda.php
        Header("Location: domanda.php");		
	}else	
	 // Utente esiste già	
	 Header("Location: paginaRegistrazione.php?message_error=6");
?>
