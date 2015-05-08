<?php
session_start();
//include "dbopen.php";  file che contiene comandi apertura dbms

if(empty($_GET['username']) || empty($_GET['email'])){
  Header("Location: login.php?e=0");
}
// username field non vuoto
/*if(!empty($_GET['username'])){	
	// Controllo di esistenza nel dbms di username
	// se esiste 		
		if(empty($_GET['email'])){
			Header("Location: login.php?e=1");
	    }
		// controllo matching di email
	// altrimenti
	   // Header("Location: login.php?e=0");	
}*/

  // parte analisi dati da database
  /*$user=$_GET['username'];
  $password=$_GET['email'];
  
  $query="SELECT password FROM utente WHERE nomeu = '".$user."'";
  $tab=mysqli_query($dbconn,$query) or die("Errore nella query");   
  $nr=mysqli_num_rows($tab);
  if($nr==0)  
    Header("Location: errore.php?e=0"); 
  else
  {
    $pass=mysqli_fetch_array($tab);  
    $passor=$pass['password'];       
    if(trim($passor)==trim($password)){  
      $ses=substr($user, 0, 1);      
      $_SESSION['gelat']=$ses;  
      Header("Location: /");
    }else
     Header("Location: errore.php?e=1");
  }*/

//include "dbclose.php"; file che contiene comandi chiusura dbms
?>




