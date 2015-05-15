<!DOCTYPE html>
<html>
	<head>
		<title>ExamChiLoSa</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="Css/examStyle.css">
		<script src="Javascript/login.js"></script>
	</head>
	<body>
		<div class="top_login">
			<p class="log">Non sei ancora registrato?
				<a href="paginaRegistrazione.php"> Registrati ora!</a>
			</p>
		</div>
		<div class="img">
			<img src="Immagini/ChiLoSa.png" width="700" height="700">
		</div>
		<div class="box"></div> 
		<?php include "error.php"; ?> 		
		<div class="box_login">
				<form name="registrazione" action="checkCredenziali.php" method=POST onsubmit="return checkLogin()">
					<?php
					    $nome=""; $em="";
					    if(isset($_GET["user"]))
							$nome=$_GET["user"];
						if(isset($_GET["email"]))
							$em=$_GET["email"];
						print"<p class=\"submit\">Username : </p><input type=\"text\" name=\"user\" value=\"$nome\" maxlength=\"16\">\n";
						print"<p class=\"submit\">	Email : </p><input type=\"email\" name=\"email\" value=\"$em\" maxlength=\"16\">\n";					
					?>
					<p class="submit">	Password : </p><input type="password" name="pass" maxlength=16>
					<p align="center"><input type="submit" value="Accedi"></p>
				</form>
		</div> 		    
	</body>
</html>



