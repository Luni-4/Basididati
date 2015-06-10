<!DOCTYPE html>
<html>
	<head>
	   <meta charset="UTF-8">
	   <title>faiSondaggio</title>	
	   <link rel="stylesheet" type="text/css" href="Css/styles.css">	
	</head>
	<body style="background-color:#6F6">
		<div class="top_box"></div>
		<div id="cssmenu">
				<ul>
						 <li><a href="withinTheService.php?sceltacategoria=tutti"><span>|Torna Indietro|</span></a></li>
						 <li><a href="profiloUtente.php"><span>|Vai alla tua pagina|</span></a></li>
						 <li class="last"><a href="logout.php"><span>|Logout|</span></a></li>		  
				</ul>
		</div>
		<div class="utility_background">
			<div class="ghost_utility"><b>
		      <form action="faisondaggio.php" method="POST">	  			  
				   Quante risposte vuoi che ci siano nel sondaggio? 
				   <select name="risp" class="style">
						 <option value="2">2</option>
						 <option value="3">3</option>
						 <option value="4">4</option>
						 <option value="5">5</option>
					</select> 
				    <input type="submit" value="Invia " class="myButton" >
		      </form>
		</div>
	</div>
    </body>
 </html>