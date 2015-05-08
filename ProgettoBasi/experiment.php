<!DOCTYPE html>
<html>
<head>
	<title>ExamChiLoSa</title>
	<link rel="stylesheet" type="text/css" href="examStyle.css">
</head>
<body>
	<div class="top_login"><p class="log">Non sei ancora registrato?<a href="paginaRegistrazione.php"> Registrati ora!</a></p></div>
	<div class="img"><img src="ChiLoSa.png" width="700" height="700"></div>
	<div class="box"></div>
	
<?php
	include "error.php"; 
	if(isset($_GET["message_error"])){/*basta che solo una sia settata*/

echo<<< OK
	<div class="box_login">
		<form name="registrazione" action="checkCredenziali.php" method=GET>
OK;
echo '		<p class="submit">	Username : </p><input type="text" name="user" value="'.$_GET["user"].'">';
echo '			<p class="submit">	Email : </p><input type="text" name="email" value="'.$_GET["email"].'">';
echo '			<p class="submit">	Password : </p><input type="password" name="pass" value="'.$_GET["pass"].'">';	

echo<<<KO
		<p align="center"><input type="submit" value="Accedi"></p>
		</form>
	</div>
KO;
echo "qui".$_GET["message_error"];
}
else{

echo<<<VAR
 	<div class="box_login">
		<form name="registrazione" action="checkCredenziali.php" method=GET>
			<p class="submit">	Username : </p><input type="text" name="user" value="NOpe">
			<p class="submit">	Email : </p><input type="text" name="email">
			<p class="submit">	Password : </p><input type="password" name="pass">
			<p align="center"><input type="submit" value="Accedi"></p>
		</form>
	</div> 
VAR;

}
?>
</body>
</html>
