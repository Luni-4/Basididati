<?php /*questo file php si occupa solo del check e di reindirizzare alla pag corretta: o al login da rifare o fa entrare nel servizio*/

$user= $_GET["username"];
$pass = $_GET["pass"];
$passConfirm=$_GET["passConfirm"];
$email = $_GET["email"];
$data=$_GET["bday"];
$residence=$_GET["residenza"];
print("<script type='text/javascript' src='checkfield.js'></script>");
print("<script type='text/javascript'>
        checkFormCreateAccount();
        </script>
		ci sono")
	
?>
