<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>ripostaDomanda</title>
   <link rel="stylesheet" type="text/css" href="Css/styles.css">	
</head>
	<body style='background-color:#6F6'>
	<div class='top_box'></div>
	<div id='cssmenu'>
			<ul>
					 <li><a href='withinTheService.php'><span>|Torna Indietro|</span>	</a></li>
					 <li><a href='profiloUtente.php'><span>|Vai alla tua pagina|</span></a></li>
					 <li class='last'><a href='logout.php'><span>|Logout|</span></a></li>		  
			</ul>
	</div>
	<div class='utility_background'>
	<div class='ghost_utility'>
		<form action="risposta.php" method="GET">
		  Risposta: <textarea name="risposta" rows="4" cols="150" > Inserisci qui la tua risposta!</textarea><br>
		  <input type="checkbox" name="anonimo" class="error"> Anonimo<br>
		  <input type="submit" value="Invia Risposta" class="myButton" style="position:absolute;top:300px;right:100px">
		</form>

 <?php
 require_once "dbopen.php";//devo sempre includerlo 
 
 if(isset($_GET["message"]))
	print "<h3 style='color:red'>".$_GET["message"]."</h3>";
	
 else{}
 
   if(isset($_GET['idd'])){
	$_SESSION['idd']=$_GET['idd'];//TODO nella pagina within... devo ricordarmi di mettere un unset per $_session[idd]
	$idd= $_SESSION['idd'];
	$querydomanda="SELECT datad, testo, imgurl,chiusa,imgtesto,nome,titolo FROM domandaperta WHERE idd='$idd'";
	$query=pg_query($dbconn,$querydomanda); 
	if($query){
		$row=pg_fetch_assoc($query);
		$_SESSION["chiusa"]=$row['chiusa'];//col get non va
		print "<h2><b>Domanda: </h2>";
		print "<h3><u><b>Titolo: </u>".$row["titolo"]."<br>";
		if($row["imgurl"]!=NULL)
			print "<img src='$row[imgurl]' style='width:304px;height:228px;position:center'>";
		else
			print "<img src='Immagini/image_not_found.jpg' style='width:304px;height:228px;position:center'>";
			
		if($row["imgtesto"]!=NULL)
			print "<u>Descrizione Immagine: </u>".$row["imgtesto"]."<br><br>";
		else
			print "<u>Descrizione Immagine: </u> Non disponibile <br><br>";
		print "<u>Data: </u>".$row['datad']."<u> Testo: </u>".$row['testo']."<u> Nome: </u>".$row['nome'];//mostro la domandaperta
		if($row['chiusa']=='f')
			print "<u> Stato</u>: Aperta </b></h2>";
		else
			print "<u> Stato</u>: Chiusa </b></h2>";
		$querydomanda="SELECT anonimo,nome,datar,testorisp,idr
	    				FROM rispostaperta 
						WHERE idd='$idd'
						ORDER BY datar";//mostro sotto le relative risposte
		$query=pg_query($dbconn,$querydomanda);
		if($query){//visualizzo le risposte
			while($row=pg_fetch_assoc($query)){
				print "<br>";
				//controllo dei voti
				print "<p style=background-color:white>";
				$idr=$row['idr'];
				print "<b>Data: </b>".$row['datar']." ";
				print "<b>Risposta: </b>".$row['testorisp']." ";
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
					if($votonegativo==NULL)//se non si sono espresse votazioni al riguardo
						$votonegativo=0;
					else{}
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
				print "<b>Utente: </b>";
				if($row['anonimo']=='f')//faccio cosi per verificare che sia falso
					print $row['nome']." ";
				else 
					print "anonimo ";
				
				print "<b>TotPositivi: ".$votopositivo." "."<a href=voto.php?voto=positivo&idr=$row[idr]> VotaPositivo! </b></a>";
				print "<b>TotNegativi: ".$votonegativo." "."<a href=voto.php?voto=negativo&idr=$row[idr]> VotaNegativo! </b></a>";
				print "</p>";
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
			</div>
		</div>
	</body>
</html>