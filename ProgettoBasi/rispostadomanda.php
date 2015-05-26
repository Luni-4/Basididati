<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>ripostaDomanda</title>	
</head>
	<body>
		<form action="risposta.php" method="GET">
		  Inserisci la tua risposta <input type="text" name="risposta" size="100" ><br>
		  <input type="submit" value="Invia Risposta">
		</form>
	</body>
</html>

 
 
 <?php
 require_once "dbopen.php";//devo sempre includerlo 
 
$_SESSION['idd']=$_GET['idd'];

 if(!empty($_SESSION['idd'])){
 
	$_SESSION['idd']=$_GET['idd'];//questa var deve essere passata alla pag successiva
	$idd= $_SESSION['idd'];
	$querydomanda="SELECT datad, testo, imgurl, imgtesto,nome FROM domandaperta WHERE idd='$idd'";
	$query=pg_query($dbconn,$querydomanda); 
	$row=pg_fetch_assoc($query);
	print $row['datad'].$row['testo'].$row['imgurl'].$row['imgtesto'].$row['nome'];//mostro la domandaperta
	$querydomanda="SELECT anonimo,nome,datar,testorisp,votopositivo,votonegativo,idr
					FROM rispostaperta NATURAL JOIN domandaperta
					WHERE idd='$idd'";//mostro sotto le relative risposte
	$query=pg_query($dbconn,$querydomanda);
	
	if($dbconn){//visualizzo le risposte
		while($row=pg_fetch_assoc($query)){
		print "<br>";
		if($row['anonimo']=='f')//faccio cosi per verificare che si falso, non mi torna un boolean
			print $row['nome'];
		else 
			print "anonimo";
		print $row['datar'];
		print $row['testorisp'];
		print $row['votopositivo']."<a href=voto.php?voto=positivo&idr=$row[idr]>VotaPositivo!</a>";
		print $row['votonegativo']."<a href=voto.php?voto=negativo&idr=$row[idr]>VotaNegativo!</a>";
		
		}
	}
	else{
		$message=pg_last_error($dbconn);
		exit("Errore nella query: ".$message);}
	
  }
  else{
	
		$message=pg_last_error($dbconn);
		exit("Errore nella query: ".$message);
  }
  
	
?>

