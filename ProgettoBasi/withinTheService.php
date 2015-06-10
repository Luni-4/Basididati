<?php 
   session_start();     	
?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>PaginaPrincipale</title>
   <link rel="stylesheet" type="text/css" href="Css/styles.css">		
</head>
  
  <body style='background-color:#6F6'>
		<?php
			if(!isset($_SESSION["user"])){
		      header("Location: homePage.php?message_error=9");
			}
            else
            {				   
		?>
			<div class="top_box"></div>
			<div id="cssmenu">
			<ul><ul>
					 <li><a href="sondaggiorisp.php"><span>|Fai/Modifica Sondaggio|</span>	</a></li>
					   <li><a href="faidomanda.php"><span>|Fai/Modifica Domanda|</span></a></li> 
				
						<li>Categoria
						<ul>
							<li><a href="withinTheService.php?sceltacategoria=tutti">Tutti</a></li>
						   <?php
						      require_once "dbopen.php";	
						      $user=$_SESSION["user"];
							  $querydomanda="SELECT nomec
											 FROM preferenza
											 WHERE nome='$user'";
							  $query=pg_query($dbconn,$querydomanda);//per stampare le categorie di preferenza
							  if($query)
								  while($row=pg_fetch_assoc($query))
										print "<li><a href=\"withinTheService.php?sceltacategoria=$row[nomec]\">$row[nomec]</a></li>";
							  else		                
									exit("Errore nella query: ".pg_last_error($dbconn));
							?>					
							</ul>
						</li>
						<li><a href="profiloUtente.php"><span>|Vai alla tua pagina|</span></a></li>
					   <li class="last"><a href="logout.php"><span>|Logout|</span></a></li>
					  
					</ul>
					  
					</ul>
				</div>
			<div class="main_box">
			<div class="ghost_box">
			<?php	
					    $sceltacategoria=$_GET["sceltacategoria"];
					
						// Query per creare vista di categorie associate a quel utente
						if($sceltacategoria=="tutti")
							$queryview="CREATE OR REPLACE VIEW preferenzaUtente(nome,nomec) as 
										SELECT nome,nomec
										FROM preferenza
										WHERE nome='$user'";
						else			
							$queryview="CREATE OR REPLACE VIEW preferenzaUtente(nome,nomec) as 
										SELECT nome,nomec
										FROM preferenza
										WHERE nome='$user' AND nomec='$sceltacategoria'";
						$query_create_view=pg_query($dbconn,$queryview);   
						
						//Query per trovare domande aperte e sondaggi più recenti relativi alle categorie scelte dall'utente connesso
						if($query_create_view)
						{       
								//query per domanda
								$querydomanda="SELECT DISTINCT nome,titolo,testo,datad,idd
											   FROM domandaperta NATURAL JOIN topic1
											   WHERE datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic1.nomec IN (SELECT nomec FROM preferenzaUtente)";   
								$query_res=pg_query($dbconn,$querydomanda);
								
								if($query_res)
								{
									print "<div style='color:black;font-size:30px'>Domande: </div>";
									while($row=pg_fetch_assoc($query_res))
									{   
								        print "<div style='background-color:#00CC99;width:750px;padding-left:10px;font-size:20px'> Utente: ".$row["nome"]." , Titolo: ".$row["titolo"]." , Data: ".$row["datad"]." , Categorie: "; 
										$iden=$row["idd"];
										$querycateg="SELECT nomec 
										             FROM topic1
													 WHERE idd='$iden'";
									    $query_c=pg_query($dbconn,$querycateg);										
										if($query_c)
										{
											   for($i=0; $i<pg_num_rows($query_c)-1; $i++)
											   {
													$rowc=pg_fetch_assoc($query_c);								    
													print"$rowc[nomec], ";
											   }
											   $rowc=pg_fetch_assoc($query_c);
											   print"$rowc[nomec]  ";
										   
										}
										else
										   exit("Errore nella query: ".pg_last_error($dbconn));
									   
									    print"<a href=\"rispostadomanda.php?idd=$row[idd]\">Risposta</a><br></div>";
										print "<div style='background-color:white;width:750px;color:black;padding-left:10px;font-size:20px'>".$row["testo"]."<br></div>";
									}// while domande
								}
								else
								   exit("Errore nella query: ".pg_last_error($dbconn));				

							   
								
								//query per sondaggio
								$querysondaggio="SELECT DISTINCT nome,titolo,testo,datad,idd
												 FROM sondaggio NATURAL JOIN topic2
												 WHERE datad > CURRENT_TIMESTAMP - INTERVAL '7 days' AND topic2.nomec IN (SELECT nomec FROM preferenzaUtente)";
								$query_res=pg_query($dbconn,$querysondaggio);
								if($query_res)
								{
									print "<div style='color:black;font-size:30px'>Sondaggi: </div>";
									while($row=pg_fetch_assoc($query_res))
									{   
								        print "<div style='background-color:#00CC99;width:750px;padding-left:10px;font-size:20px'> Utente: ".$row["nome"]." , Titolo: ".$row["titolo"]." , Data: ".$row["datad"]." , Categorie: "; 
										$iden=$row["idd"];
										$querycateg="SELECT nomec 
										             FROM topic2
													 WHERE idd='$iden'";
									    $query_c=pg_query($dbconn,$querycateg);										
										if($query_c)
										{
											   for($i=0; $i<pg_num_rows($query_c)-1; $i++)
											   {
													$rowc=pg_fetch_assoc($query_c);								    
													print"$rowc[nomec], ";
											   }
											   $rowc=pg_fetch_assoc($query_c);
											   print"$rowc[nomec]  ";
										   
										}
										else
										   exit("Errore nella query: ".pg_last_error($dbconn));
									   
									    print"<a href=\"rispostasondaggio.php?idd=$row[idd]\">Mostra</a><br></div>";										
									}// while sondaggio
								}
								else
								   exit("Errore nella query: ".pg_last_error($dbconn));		
								
						}
						else
							exit("Errore nella query: ".pg_last_error($dbconn));						
            ?>	</div>				
			</div>
			<div class='left_box'>
					
			<?php
			                //controllo se l'utente e' vip	
							print "<img src='Immagini/user.png' style='width:150px;height:150px;position:absolute;top:50px'>";
							$query="SELECT nome,tipo
									FROM utente
									WHERE nome='$user'";
							$query_res=pg_query($dbconn,$query);
							if($query_res)
							{								
									$row=pg_fetch_assoc($query_res);
									$typeuser=$row["tipo"];
									$nomeuser=$row["nome"];
									
									if($typeuser=="vip")									
										print"Ciao ".$row["nome"]." !<br> Utente di tipo: ".$typeuser;									
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
											         if($numrisposte==2 && $votipositivi>=$votinegativi)
													 {
												            $query="UPDATE utente SET tipo='vip' WHERE nome='$user'";  //promozione a vip
												            $query_res=pg_query($dbconn,$query);
												            if(!$query_res)												
													            exit("Errore nella query: ".pg_last_error($dbconn));													             
													 }			 
											    }
												else							                    
							                        exit("Errore nella query: ".pg_last_error($dbconn));
							                    
										}
										else							            
							              exit("Errore nella query: ".pg_last_error($dbconn));										
									}// controllo utente normale diventa vip											
							}
							else							
							   exit("Errore nella query: ".pg_last_error($dbconn));
								
			}// sessione							
			?>
				</div>
			
  </body>
</html>
