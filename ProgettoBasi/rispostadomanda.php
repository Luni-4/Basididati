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
 <?php
 require_once "dbopen.php"; 
 
 if(isset($_GET["message"])){
	print $_GET["message"];	
 }
 else
 {
    if(isset($_GET['idd']))//vuol dire che e' la prima volta che entro in questa pagina e non ci sono arrivato con header
	    $_SESSION['idd']=$_GET['idd'];//TODO nella pagina within... devo ricordarmi di mettere un unset per $_session[idd]
    if(!empty($_SESSION['idd'])){
		$idd= $_SESSION['idd'];
		$querydomanda="SELECT datad, testo, imgurl,chiusa,imgtesto,nome FROM domandaperta WHERE idd='$idd'";
		$query=pg_query($dbconn,$querydomanda); 
		if($query){
			$row=pg_fetch_assoc($query);
			$_SESSION["chiusa"]=$row['chiusa'];//col get non va
			print $row['datad'].$row['testo'].$row['imgurl'].$row['imgtesto'].$row['nome'];//mostro la domandaperta
			
			$querydomanda="SELECT anonimo,nome,datar,testorisp,votopositivo,votonegativo,idr
							FROM rispostaperta NATURAL JOIN domandaperta
							WHERE idd='$idd'
							ORDER BY datar";//mostro sotto le relative risposte
			$query=pg_query($dbconn,$querydomanda);
			
			if($query){//visualizzo le risposte
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
			else
			{
				exit("Errore nella query: ".pg_last_error($dbconn));
			}
		}
		else
		{
			exit("Errore nella query: ".pg_last_error($dbconn));
		}
	
	}
  }	
?>
   </body>
</html>