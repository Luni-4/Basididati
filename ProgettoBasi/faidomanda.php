<?php
	session_start(); 
 ?>
  
<!DOCTYPE html>
	<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiDomanda</title>	
	</head>
		<body>
			
 <?php
	 require_once "dbopen.php";
	 //$user=$_SESSION["user"];
	 $user='alice';
	 if(isset($_GET["message"])){
		print $_GET["message"];
		unset($_GET["message"]);
		}
	else{};
	print"<a href=withinTheService.php>Torna alla pagina iniziale</a>";
	 print"<form action='domanda.php?' method=GET'>
			  Seleziona categoria <br><select name='categoria'>";
	 $querydomanda="SELECT nomec
				   FROM utente NATURAL JOIN preferenza
				   WHERE utente.nome='$user'";
	 $query=pg_query($dbconn,$querydomanda);
	 if($query){
		$categoria="categoria";
		$i=0;
		print "<option value='nessunascelta' selected>Scegli</option>";
		while($row=pg_fetch_assoc($query)){
			$cate=$categoria.$i;
			print "<option value=$row[nomec]>".$row['nomec']."</option>";
			$i++;
		}								
		print "</select>";
		print " Titolo domanda<input type='text' name='titolo' size='50'><br>
				  Poni domanda<input type='text' name='testo' size='100'><br>
				  <input type='url' name='imgurl'><br>
				  Descrizione immagine<input type='text' name='imgtesto' size='50'><br>
				  <input type='submit' value='Invia Risposta'>
				</form>
			</body>
		</html>";
	}
	 else{
			$message=pg_last_error($dbconn);
			$message=$message." impossibile visualizzare le categorie di interesse";
		}
	 
 ?>
 <h3>Visualizza le tue domande e modificane la visibilità!</h3>
 <?php
	$querydomanda="SELECT idd,titolo,testo,datad,imgurl,imgtesto,chiusa
				   FROM utente NATURAL JOIN domandaperta
				   WHERE utente.nome='$user'";
	 $query=pg_query($dbconn,$querydomanda);
	 if($query){
		while($row=pg_fetch_assoc($query)){
			if($row["chiusa"] == 'f')
				$chiusa="Chiudi";
			else
				$chiusa="Apri";
			print "Titolo : ".$row['titolo']."Testo : ".$row['testo']."<a href=domanda.php?idd=$row[idd]&chiusa=$row[chiusa]>$chiusa</a><br>";
		
		}					

	 }else{
		$message=pg_last_error($dbconn);
		$message=$message." impossibile visualizzare le vecchie domande";
	 
	 }
 
 
 ?>
 
 
 
 
 
 


