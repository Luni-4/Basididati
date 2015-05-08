<?php /*questo file php si occupa solo del check e di reindirizzare alla pag corretta: o al login da rifare o fa entrare nel servizio*/

$user= $_GET["user"];
$pass = $_GET["pass"];
$email = $_GET["email"];
	/*per dare info all'utente sul tipo di "errore" commesso*/

/*controllo solo che i campi siano pieni*/
	if($user == NULL){/*vari if per discriminare l'errore*/
		Header("Location: experiment.php?message_error=0&user=$user&pass=$pass&email=$email");
		}
	else
		if($pass == NULL){
			Header("Location: experiment.php?message_error=2&user=$user&pass=$pass&email=$email");
		}
		else
			if($email  == NULL){
				Header("Location: experiment.php?message_error=1&user=$user&pass=$pass&email=$email");
				}
			/*else -> i campi sono pieni e posso accedere al db per verificarne esistenza */
				

?>
