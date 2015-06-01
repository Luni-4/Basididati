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
			   $_SESSION["user"]='oite'; //da togliere quando tutto sara' unito, implementazione farlocca
			   $user=$_SESSION["user"];
	           if(!isset($_SESSION["user"])){
		           header("Location: homePage.php?message_error=9");
			   }		
			?>
			<div class='top_box'></div>
			<div id='cssmenu'>
			<ul>
					 <li><a href='#'><span>|Ultime Domande|</span>	</a></li>
					   <li><a href='faidomanda.php'><span>|Fai una domanda|</span></a></li> <!-- da fare con query la selezione delle categorie-->
						<li>
							<select class='style'>
									<option value='categoria1'>|Cucina|</option>
									<option value='categoria2'>|Sport|</option>	
									<option value='categoria3'>|Informatica|</option>
									<option value='categoria4'>|Animali|</option>
							</select>
					   </li>
						<li><a href='#'><span>|Vai alla tua pagina|</span></a></li>
					   <li class='last'><a href='logout.php'><span>|Logout|</span></a></li>
					  
					</ul>
				</div>
			<div class='main_box'></div>
			<div class='ghost_box'>
			<?php	
					require_once "dbopen.php";
					
					// Query per creare vista di categorie associate a quel utente
					$queryview="CREATE OR REPLACE VIEW preferenzaUtente(nome,nomec) as 
								SELECT nome,nomec
								FROM utente NATURAL JOIN preferenza
								WHERE utente.nome='$user'";
								
					$query_create_view=pg_query($dbconn,$queryview);   
					
					//Query per trovare domande aperte e sondaggi più recenti relativi alle categorie scelte dall'utente connesso
					if($query_create_view)
					{       
				            //query per domanda
							$querydomanda="SELECT nome,testo,datad,idd,nomec
										   FROM domandaperta NATURAL JOIN topic1
										   WHERE datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic1.nomec IN (SELECT nomec FROM preferenzaUtente)";   
							$query_res=pg_query($dbconn,$querydomanda);
							
							if($query_res)
							{
								print "<div style='color:black'>Domande: </div>";
								while($row=pg_fetch_assoc($query_res)){
									print "<div style='background-color:#00CC99;width:675px;padding-left:10px'>Utente: ".$row["nome"]." ,Data: ".$row["datad"]." ,Categoria: ".$row["nomec"]."<a href=rispostadomanda.php?idd=$row[idd]>Risposta</a><br></div>";
									print "<div style='background-color:white;width:675px;color:black;padding-left:10px'>".$row["testo"]."<br></div>";
							    }
							}else{
								exit("Errore nella query: ".pg_last_error($dbconn));
							}
							
							//query per sondaggio
							$querysondaggio="SELECT nome,testo,datad,idd,nomec
											 FROM sondaggio NATURAL JOIN topic2
											 WHERE datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic2.nomec IN (SELECT nomec FROM preferenzaUtente)";
							$query_res=pg_query($dbconn,$querysondaggio);
							if($query_res)
							{
									print "<div style='color:black'>Sondaggio: </div>";
									while($row=pg_fetch_assoc($query_res)){
										print "<div style='background-color:#00CC99;width:675px;padding-left:10px'>Utente: ".$row["nome"]." ,Data: ".$row["datad"]." ,Categoria: ".$row["nomec"]."<a href=rispostasondaggio.php?idd=$row[idd]>Risposta</a><br></div>";
										print "<div style='background-color:white;width:675px;color:black;padding-left:10px'>".$row["testo"]."<br></div>";
									}
							}else{
									exit("Errore nella query: ".pg_last_error($dbconn));
							}
					}
					else{
					        exit("Errore nella query: ".pg_last_error($dbconn));
					}	
            ?>					
			</div>
			<div class='left_box'></div>
			<div class='ghost_left'>				
			<?php
			                //controllo se l'utente e' vip								
							$query="SELECT nome,tipo
									FROM utente
									WHERE nome='$user'";
							$query_res=pg_query($dbconn,$query);
							if($query_res)
							{								
									$row=pg_fetch_assoc($query_res);
									$typeuser=$row["tipo"];
									$nomeuser=$row["nome"];
									
									if($typeuser=="vip"){									
										print"Ciao ".$row["nome"]." !<br> Utente di tipo: ".$typeuser;
									}
									else
									{
										print"Ciao ".$row["nome"]." !<br> Utente di tipo: ".$typeuser;
										//query per aggiornare il profilo dell'utente
										$query="SELECT COUNT(*) AS numrisposte
												FROM rispostaperta NATURAL JOIN utente
												WHERE utente.nome='$user'";
										
										$query_res=pg_query($dbconn,$query);
									    if($query_res)
										{
										       $row=pg_fetch_assoc($query_res);
										       $numrisposte=$row["numrisposte"];
										       $query="SELECT SUM(votopositivo) AS votipositivi, SUM(votonegativo) AS votinegativi
												       FROM rispostaperta
												       WHERE nome='$user'";
													   
										       $query_res=pg_query($dbconn,$query);
											   
										       if($query_res)
											   {											   
											         $row=pg_fetch_assoc($query_res);
											         $votipositivi=$row["votipositivi"];
											         $votinegativi=$row["votinegativi"];
											         if($numrisposte==2 && $votipositivi>=$votinegativi){
												                  $query="UPDATE utente SET tipo='vip' WHERE nome='$user'";  //promozione a vip
												                  $query_res=pg_query($dbconn,$query);
												                  if(!$query_res){												
													                    exit("Errore nella query: ".pg_last_error($dbconn));																		
												                  }
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
							else
							{
							   exit("Errore nella query: ".pg_last_error($dbconn));
							}									
			?>
			</div>
  </body>
</html>
