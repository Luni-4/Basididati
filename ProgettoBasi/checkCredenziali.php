<?php /*questo file php si occupa solo del check e di reindirizzare alla pag corretta: o al login da rifare o fa entrare nel servizio*/
/*CON I CAMBIAMENTI IN JS: QUESTA PAGINA FA CONTROLLO DI ESISTENZA NEL DB*/
$user= $_POST["user"];
$pass = $_POST["pass"];
$email = $_POST["email"];
	/*per dare info all'utente sul tipo di "errore" commesso*/

/*controllo solo che i campi siano pieni
  l'utilizzo del metodo empty() invece della condizione == NULL risulta più veloce ed efficiente
*/
	if(empty($user)){/*vari if per discriminare l'errore*/
		Header("Location: homePage.php?message_error=0&user=$user&email=$email");
		}
	else
		if(empty($email)){
			Header("Location: homePage.php?message_error=1&user=$user&email=$email");
		}
		else
			if(empty($pass)){
				Header("Location: homePage.php?message_error=2&user=$user&email=$email");
				}
			/*else -> i campi sono pieni e posso accedere al db per verificarne esistenza */
				

?>
