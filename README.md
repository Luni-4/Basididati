# Basididati
- Nel javascript di login il codice relativo a password potrebbe non funzionare su chrome, prova a vedere se è vero-->FUNZIONA

Cose da fare:
- Fixare la parte grafica
- Sistemare schema logico-->FATTO
- Realizzare file.txt con query DDL creazione database
- Unire database a progetto 
-Nella pagine homePage.php e in paginaRegistrazione.php dobbiamo ricordarci che in fondo avremo uno spazio per riportare il msg di error
nel caso non sia possibile accedere/iscriversi nel DB (pagine che fanno verifica nel DB: checkCredenziali.php e checkCreateAccount.php
-> entrano nel DB-> messaggio di errore delegato a error.php)

Modifiche apportate (17/05/2015 ->Alice):
- login.js : ho accorpato la funzione che avevamo in checkField.js-> possiamo togliere questo file
- paginaRegistrazione-> terminata, indentata, messo js e funzionante, cambiato alcuni campi input, css directory cambiata e funzionante
- schemaLogico e schemaRistrutturato finiti con tutte le modifiche

N.B: - dubbio esistenziale: il testo delle varie domande e rispsote, lo consideriamo attributo nel db o cosa?
	 - ho un problema a scrivere topic1 e topic2, dai un occhiata al .sql
