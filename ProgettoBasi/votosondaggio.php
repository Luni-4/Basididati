<?php
   session_start();
   require_once "dbopen.php"; 
   $risposta=$_GET["risposta"];
   $idd=$_SESSION["idds"];   
   $utente=$_SESSION["user"]; 
   $query="SELECT nome,anonimo,datar
           FROM rispostapredefinita 
		   WHERE testorisp='$risposta' AND idd='$idd'
		   ORDER BY datar";
		   $query_res=pg_query($dbconn,$query);
		   if($query_res)
		   {   
	           while($row=pg_fetch_array($query_res))
			   {
				    if($row[1]== 'f')
						$nome=$row[0];					
					else
						$nome="Anonimo";					
					if($row[0] == $utente)
						$nome="Tu";
					print "$nome $row[2]<br>";						
			   }
		   }
		   else
		      exit("Errore nella query: ".pg_last_error($dbconn));
?>