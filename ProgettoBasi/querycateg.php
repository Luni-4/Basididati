<?php
   // Indice
   // Supercategoria principale --> categoria che ha come valore di supercategoria NULL
   // Livello gerarchico --> livello della categoria all'interno dell'albero delle categoria 
   
   require_once "dbopen.php";
   
   $queryc="SELECT nomec,nomesuperc FROM categoria ORDER BY nomesuperc IS NULL DESC";

   $ca=pg_query($dbconn,$queryc) or die("Errore nella query");     
   
   // array che contiene nome categorie
   $categoria=pg_fetch_all_columns($ca,0);
   
   // array che contiene nome supercategorie
   $supercategoria=pg_fetch_all_columns($ca,1);
   
   // creazione array che conterrà per ogni categoria la sua supercategoria principale 
   $rootarr=array();
   // creazione array che conterrà per ogni categoria il suo livello gerarchico
   $giri=array();
   
   $contar=0; // conta supercategorie principali
   $root=0;   // identifica a quale supercategoria principale è associata la categoria
   
   
  for($i=0; $i<pg_num_rows($ca); $i++){	// ciclare per ogni categoria 
           $livello=0; // livello gerarchico di ogni singola categoria        		   
		   $j=$i;		  
		   while(($j=array_search($supercategoria[$j],$categoria)) !== false){	// ciclare finché non si trova supercategoria principale		   
			   		 $livello++;
					 $root=$j;
		   }// while	
		   $giri[]=$livello; // salvare il livello gerarchico della categoria nell'array 
            if($livello==0 && $j===false){ // se la categoria è supercategoria principale il suo livello è 0 quindi assegnare la sua root a -1
				$rootarr[]=-1;
				$contar++;
			}else{
				$rootarr[]=$root;
			}
   } // for  
  
  $root=0;
  while($root<$contar){ // per ogni supercategoria principale
	  print "$categoria[$root]<br>";
	  $temp=array_keys($rootarr,$root);	 // estrarre dal vettore rootarr gli indici delle categorie associati a supercategoria principale considerata
	  $tempi=array_combine($temp,$temp); // far combaciare gli indici dell'array temp con i suoi valori
	  $val=array_intersect_key($giri,$tempi); // eseguire intersezione insiemistica tra indici di array giri e quelli di array tempi in questo modo si trovano i livelli gerarchici associati a supercategoria principale considerata
	  $val=array_values($val); // riportare gli indici di vettore val con partenza da 0 a n
	  $p=max($val); // trovare il max dei livelli gerarchici della categoria considerata
	  $livello=1;
	  while($livello<=$p){ // ciclare per ogni livello gerarchico fino al massimo
		 for($i=0; $i<count($val); $i++){
			 if($val[$i]==$livello){ // se il livello gerarchico salvato in val è uguale al livello gerarchico considerato stampare
				print "$livello) ".$categoria[$temp[$i]]."<br>";
			}
		 } 
	  print"<br>";
	  $livello++;
	  }// while 
    $root++;
	print"<br>";
  }// while root
  
 ?>