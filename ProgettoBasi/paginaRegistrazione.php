<!DOCTYPE html>
<html>
	<head>
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
						<p>Scegli una categoria di interesse </br></p>
						<p>(N.B: potrai cambiare preferenza in un secondo momento)</p>
						<select name="categ">
						    <?php
						         include "dbopen.php";
								 $querycategorie="SELECT nomec FROM categoria";
								 $categorie=pg_query($dbconn,$querycategorie) or die("Errore nella query");
								 while($row=pg_fetch_row($categorie)){
									 print"<option value=\"$row[0]\">$row[0]</option>\n";
								 }
								 include "dblcose.php";
							?> 
						</select>
						<div class="btn">
						  <p>Invia registrazione</p>
							<input type="submit" value="Invia">  
						</div>
					</section>
				</form>
		</section>  
	</body>
</html>