<?php 
   session_start();     	
?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>Domanda</title>
   <link rel="stylesheet" type="text/css" href="styles.css">
		<style type="text/css">

		div.top_box{

			padding-top: 50px;
			padding-right: 50px;
			padding-bottom: 300px;
			padding-left: 50px;
			background-image:url("ChiLoSa.png");
			background-repeat:no-repeat;
			background-position:top;
			background-color: white;

		}

		div.left_box{
			position: absolute;
			left: 50px;
			top: 450px;
			padding-top: 500px;
			padding-right: 50px;
			padding-bottom: 50px;
			padding-left: 200px;
			background-image:url("login.jpg");	
				
		}

		div.main_box{
			
			position: absolute;
			left: 400px;
			top: 500px;
			right: 75px;
			padding-top: 400px;
			padding-right: 50px;
			padding-bottom: 50px;
			padding-left: 600px;
			background-image:url("login.jpg");	

		}
		select.style{
			background-image:url("login.jpg");	
			color:#FFF;
			background-color:#6F9;
			width:150px;
			height:50px;
			font-size:20px;
		}
		div.ghost_left{
			position: absolute;
			left: 70px;
			top: 475px;
			padding-top: 450px;
			padding-right: 60px;
			padding-bottom: 50px;
			padding-left: 150px;
			background-color: white;
			opacity:0.5;
			
		}
		div.error_box{
			position: absolute;
			text-align:center;
			font-size:40px;
			padding-bottom: 50px;
			left: 450px;
			top: 550px;
			right: 130px;
			padding-top: 50px;
			padding-bottom: 125px;
			padding-left: 50px;
			padding-right: 50px;
			background-color: red;
			
		}

		div.ghost_box{
			position: absolute;
			left: 450px;
			top: 550px;
			right: 125px;
			padding-top: 25px;
			padding-bottom: 50px;
			padding-left: 50px;
			background-color: rgba(255, 255, 255, 0.7);
			background: rgba(255, 255, 255, 0.7);
			color: rgba(255, 255, 255, 0.7);
			
		}

		</style>
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
