<?php
   require_once "dbopen.php";
   
   $queryc="SELECT nomec,nomesuperc FROM categoria";
   
   $ca=pg_query($dbconn,$queryc) or die("Errore nella query");   
   
   // lunghezza array dimensione numero di tuple restituite da query
   $perc=pg_num_rows($ca);
   
   // array che contiene nome categorie
   $categoria=pg_fetch_all_columns($ca,0);
   
   // array che contiene nome supercategorie
   $supercategoria=pg_fetch_all_columns($ca,1);
   
   // creazione array che conterrà percorso e riempimento
   $percorso=array_fill(0, $perc, "");
   
  // Trovare percorso per ogni categoria   
  for($i=0; $i<$perc; $i++){	            
		   $j=$i;
		   $percorso[$i]=$percorso[$i]."$j";
		   while(($j=array_search($supercategoria[$j],$categoria)) !== false){	// ciclare finché il valore inserito in vettore supercategoriaè NULL		   
			   $percorso[$i]=$percorso[$i]."$j"; // concatenazione di stringhe che indica percorso categorie			 
		   }// while	   
   } // for
   
   $percof=array(); // array che contiene percorsi finali
   
   $a=0; 
   for($i=0; $i<$perc; $i++){
	  $c=0;
	  $perco=$percorso; // copia array percorso
	  array_splice($perco, $i, 1); // selezionare e eliminare elemento corrente da vettore	  
      for($j=0; $j<count($perco); $j++){
	      if((strpos($perco[$j],$percorso[$i])) !== false){ // se  esiste percorso simile dentro vettore eliminarlo
			  $c++;
              break;			  
		  }
	  }	
      if($c == 0){
		  $percof[$a]=$percorso[$i];
		  $a++;
	  }
   }   
   
   for($i=0; $i<count($percof); $i++){
	   for($j=0; $j<strlen($percof[$i]); $j++)
		   print " ".$categoria[strval(substr($percof[$i],$j,1))];
	   print"<br>";
   }
 ?>