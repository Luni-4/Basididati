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
		  <input type="checkbox" name="anonimo" > Anonimo<br>
		  <input type="submit" value="Invia Risposta">
		</form>
	</body>
</html>

 
 
 <?php
 require_once "dbopen.php";//devo sempre includerlo 
 
 if(isset($_GET["message"]))
	print $_GET["message"];
	
 else{}
 
   if(isset($_GET['idd'])){
	$_SESSION['idd']=$_GET['idd'];//TODO nella pagina within... devo ricordarmi di mettere un unset per $_session[idd]
	$idd= $_SESSION['idd'];
	$querydomanda="SELECT datad, testo, imgurl,chiusa,imgtesto,nome FROM domandaperta WHERE idd='$idd'";
	$query=pg_query($dbconn,$querydomanda); 
	if($query){
		$row=pg_fetch_assoc($query);
		$_SESSION["chiusa"]=$row['chiusa'];//col get non va
		print $row['datad'].$row['testo'].$row['imgurl'].$row['imgtesto'].$row['nome'];//mostro la domandaperta
		$querydomanda="SELECT anonimo,nome,datar,testorisp,votopositivo,votonegativo,idr
	    				FROM rispostaperta 
						WHERE idd='$idd'
						ORDER BY datar";//mostro sotto le relative risposte
		$query=pg_query($dbconn,$querydomanda);
		if($query){//visualizzo le risposte
			while($row=pg_fetch_assoc($query)){
				print "<br>";
				//controllo dei voti
				$idr=$row['idr'];
				print $row['datar'];
				print $row['testorisp'];
				$query_voto="SELECT COUNT(*) AS votonegativo
								FROM voto
								WHERE idr='$idr'
								GROUP BY voto
								HAVING voto='FALSE'
								 ";
				$query_res=pg_query($dbconn,$query_voto);
				if($query_res){
					$row1=pg_fetch_assoc($query_res);
					$votonegativo=$row1["votonegativo"];
					$query_voto="SELECT COUNT(*) AS votototale
								 FROM voto
								 WHERE idr='$idr'
								";
					$query_res=pg_query($dbconn,$query_voto);
					if($query_res){
						$row1=pg_fetch_assoc($query_res);
						$tot=$row1["votototale"];
						$votopositivo=$tot-$votonegativo;
					}else
						exit("Errore nella query: ".pg_last_error($dbconn));

				}else
					exit("Errore nella query: ".pg_last_error($dbconn));

				if($row['anonimo']=='f')//faccio cosi per verificare che sia falso
					print $row['nome'];
				else 
					print "anonimo";
				
				print $votopositivo."<a href=voto.php?voto=positivo&idr=$row[idr]> VotaPositivo! </a>";
				print "-".$votonegativo."<a href=voto.php?voto=negativo&idr=$row[idr]> VotaNegativo! </a>";
			}
		}
		else
			exit("Errore nella query: ".pg_last_error($dbconn));
		
	}
	else
		exit("Errore nella query: ".pg_last_error($dbconn));
}
else			
	header("Location: withinTheService.php");
		
?>

