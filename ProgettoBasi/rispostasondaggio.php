<?php
 session_start();   
 ?>
 
<!DOCTYPE html>
<html>
 <head>
   <meta charset="UTF-8">
   <title>ripostaSondaggio</title>	
   <link rel="stylesheet" type="text/css" href="Css/styles.css">
</head>
	<body style='background-color:#6F6'>
	<div class='top_box'></div>
	<div id='cssmenu'>
			<ul>
					 <li><a href='withinTheService.php'><span>|Torna Indietro|</span>	</a></li>
					 <li><a href='#'><span>|Vai alla tua pagina|</span></a></li>
					 <li class='last'><a href='logout.php'><span>|Logout|</span></a></li>		  
			</ul>
	</div>
	<div class='utility_background'>
	<div class='ghost_utility'>
	    <?php
		  if(isset($_GET["message"]))
	        print "<h3 style='color:red'>".$_GET["message"]."</h3>";         
		  else
		  {			 
		    require_once "dbopen.php"; 
		    if(!empty($_GET['idd']))
		    {
		         $_SESSION['idds']=$_GET['idd'];
			     $idd=$_GET['idd'];	
                 $utente=$_SESSION["user"];				 
		         $query="SELECT titolo,testo,chiusa,imgurl,imgtesto 
			             FROM sondaggio
					     WHERE idd='$idd'";
			     $query_res=pg_query($dbconn,$query);
			     if($query_res)
				 {
					$row=pg_fetch_row($query_res);
					if($row[3]!=NULL)
						print "<img src='$row[3]' style='width:304px;height:228px;position:absolute;right:100px;'>";
					else
						print "<img src='Immagini/image_not_found.jpg' style='width:304px;height:228px;position:absolute;right:100px;'>";
						
					if($row[4]!=NULL)
						print "<div style='position:absolute;right:100px;top:300px;'><u>Descrizione Immagine: </u>".$row[4]."</div><br><br>";
					else
						print "<div style='position:absolute;right:100px;top:300px'><u>Descrizione Immagine: </u> Non disponibile </div><br><br>";
					if($row[2] == 't'){
				       print"<h1><b>Titolo: </b>". $row[0]."</h1>";
				       print"<h1><b>Testo: </b>".$row[1]."</h1>";
					   print"<br><br><h3 style='color:red'> La domanda è chiusa, non puoi rispondere</h3>";
					}
					else
					{
						$query="SELECT idd 
			                    FROM rispostapredefinita
					            WHERE idd='$idd' AND nome='$utente'";
						$query_res=pg_query($dbconn,$query);
						if($query_res)
						{
							if(pg_num_rows($query_res) == 0)
							{						
						        print"<form action=rispostacheck.php method=POST>";
						        print"<h1><b>Titolo: </b>". $row[0]."</h1>";
								print"<h1><b>Testo: </b>".$row[1]."</h1>";
						        print"<br><br>
		                        <input type=checkbox name=anonimo class='error'> Anonimo<br>
		                        <input type='submit' value='Invia Risposta' class='myButton' style='position:absolute;right:150px;top:425px'>
		                      </form>";
							}
							else
							{
								print"<h2><b>Titolo: </b>". $row[0]."</h2>";
								print"<h2><b>Testo: </b>".$row[1]."</h2>";
					            print"<br><br><h3 style='color:red'>Hai già votato per questo sondaggio</h3>";
								print"<h2 style='color:green'>Ecco le risposte del sondaggio</h2>";
								print"<h3 style='color:blu'>(Quelle non riportate non hanno ottenuto votazione)</h3>";
								 // mostro risposte 
			                    $querysondaggio="SELECT testorisp, count(testorisp) AS p
							                     FROM rispostapredefinita
							                     WHERE idd='$idd'
							                     GROUP BY testorisp";
			                    $query=pg_query($dbconn,$querysondaggio);			
			                    if($query)
			                    {
				                   print"<h2 style='color:green'><u>Testo e voto (clicca su voto per vedere chi ha votato!)</u></h2>";
				
					               if(pg_num_rows($query) != 0)
					               {						
					                  while($row=pg_fetch_array($query))
					                  {
						                 print "$row[0] <a href=votosondaggio.php?risposta=$row[0]>$row[1]</a><br>";						
					                  }
					               }
			                    } // if query risposte
			                      else			
				                      exit("Errore nella query: ".pg_last_error($dbconn));	  
							
						    }// query già votato
						}
						else
						   exit("Errore nella query: ".pg_last_error($dbconn));	 
					}// query chiusura
			     }// query sondaggio
				 else
					exit("Errore nella query: ".pg_last_error($dbconn));
		    }// session
	     }// message
		?>  
			</div>
		</div>
   </body>
</html>