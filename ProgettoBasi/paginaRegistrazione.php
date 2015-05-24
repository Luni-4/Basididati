<!DOCTYPE html>
<html>
	<head>
	    <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="Css/bar2.css">
		<script src="Javascript/login.js"></script>
	</head>
	<body>
		<section class="cform">
			<article class="title">
				<p>Registrazione</p>
			</article>
				<form name="registrazione" action="checkCreateAccount.php" method=POST onsubmit="return checkFormCreateAccount()">
					<section class="form">
						<p>*Nuovo username</p>
							<input type="text" name="username">
						<p>*Email</p>
							<input type="email" name="email">
						<p>*Scegli una password</p>
							<input type="password" name="pass">
						<p>*Ripeti la password</p>
							<input type="password" name="passConfirm">
						<p>Data di Nascita</p>
							<input type="date" name="bday" max="2004-12-31" min="1899-01-31"><br><br>
						<p>Residenza</p>
							<input type="text" name="residenza">
						<p>Scegli una categoria di interesse <br></p>
						<p>(N.B: Devi scegliere almeno una categoria di interesse)</p>
						    <?php
						         include "dbopen.php";
								 $querycategorie="SELECT nomec FROM categoria";
								 $categorie=pg_query($dbconn,$querycategorie) or die("Errore nella query");
								 while($row=pg_fetch_assoc($categorie)){
									print "<input type=\"checkbox\" name=\"categ[]\" value=".$row['nomec'].">";									
									print "<label for=\"checkbox\">".$row["nomec"]."</label><br><br>";
									//while<-generazione delle sottocategorie, da definire il rapporto tra sottocategoria e categoria
								 }								 
							?> 
						<div class="btn">
						  <p>Invia registrazione</p>
							<input type="submit" value="Invia">  
						</div>
						<?php 						 
			              //checkAccount controlla solo che i campi siano pieni, poi necessita del controllo all'interno del db
			              if(isset($_GET["message_error"])) 
                          {
			                 print "<div class=\"box_error\">";
							 require_once "error.php";
							 print"</div>";
						  }					
						?>
					</section>
				</form>
		</section>  
	</body>
</html>