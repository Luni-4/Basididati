<?php 
   session_start();     	
?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>Domanda</title>
   <link rel="stylesheet" type="text/css" href="Css/styles.css">		
</head>
  
  <body style='background-color:#6F6'>
			<?php
			   $_SESSION["utente"]='oite'; //da togliere quando tutto sara' unito, implementazione farlocca
	           if(!isset($_SESSION["utente"])){
		           header("Location: homePage.php?message_error=9");
			   }		
			?>
			<div class='top_box'></div>
			<div id='cssmenu'>
			<ul>
					 <li><a href='#'><span>|Ultime Domande|</span>	</a></li>
					   <li><a href='#'><span>|Choose category!| ----></span></a></li>
						<li>
							<select class='style'>
									<option value='categoria1'>|Cucina|</option>
									<option value='categoria2'>|Sport|</option>	
									<option value='categoria3'>|Informatica|</option>
									<option value='categoria4'>|Animali|</option>
							</select>
					   </li>
						<li><a href='#'><span>|Vai alla tua pagina|</span></a></li>
					   <li class='last'><a href='#'><span>|Logout|</span></a></li>
					  
					</ul>
				</div>
			<div class='left_box'></div>
			<div class='ghost_left'></div>	
			<div class='main_box'></div>
			<div class='ghost_box'>
			<?php	
					require_once "dbopen.php";
					// Query per creare vista di categorie associate a quel utente
					$queryview="CREATE OR REPLACE VIEW preferenzaUtente(nome,nomec) as 
							SELECT nome,nomec
							FROM utente NATURAL JOIN preferenza
							WHERE utente.nome='oite'";
					$query_create_view=pg_query($dbconn,$queryview);   
					//Query per trovare domande aperte e sondaggi più recenti relativi alle categorie scelte dall'utente connesso
					if($query_create_view)
					{
							$querydomanda="SELECT nome,testo,datad,idd,nomec
										   FROM domandaperta NATURAL JOIN topic1
										   WHERE chiusa='FALSE' AND datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic1.nomec IN (SELECT nomec FROM preferenzaUtente)
										   UNION
										   SELECT nome,testo,datad,idd,nomec
										   FROM sondaggio NATURAL JOIN topic2
										   WHERE chiusa='FALSE' AND datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic2.nomec IN (SELECT nomec FROM preferenzaUtente)";
							$query_res=pg_query($dbconn,$querydomanda);
							if($query_res)
							{
								while($row=pg_fetch_assoc($query_res)){
									print "<div style='background-color:#00CC99;width:675px;padding-left:10px'>Utente: ".$row["nome"]." ,Data: ".$row["datad"]." ,Categoria: ".$row["nomec"]."<br></div>";
									print "<div style='background-color:white;width:675px;color:black;padding-left:10px'>".$row["testo"]."<br></div>";
								}
								print "</div>";
							
							}
							else{
								$message=pg_last_error($dbconn);
								exit("Errore nella query: ".$message);
							}
					}else{
						$message=pg_last_error($dbconn);
						exit("Errore nella query: ".$message);
					}			 
			?>
  </body>
</html>