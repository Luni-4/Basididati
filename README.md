# Basididati

Cose da fare:
- Fixare la parte grafica
- Unire database a progetto 
-Nella pagine homePage.php e in paginaRegistrazione.php dobbiamo ricordarci che in fondo avremo uno spazio per riportare il msg di error
nel caso non sia possibile accedere/iscriversi nel DB (pagine che fanno verifica nel DB: checkCredenziali.php e checkCreateAccount.php
-> entrano nel DB-> messaggio di errore delegato a error.php) -> SPAZIO TE NE OCCUPI TU VIA INTERFACCIA GRAFICA? BASTEREBBE UN DIV IN CUI INSERIRE L'INCLUDE A ERROR.PHP

Cose fatte:
-Tolto attributo composto da schema concettuale ristrutturato, non esiste dopo ristrutturazione
- Modificata parte grafica schema logico
- Per il testo della domanda direi di usare un cblob(dominio sql per gestione caratteri) e mettere limite su lunghezza domanda e risposta
- Eliminato mystyle.css

N.B: 
	 - ho un problema a scrivere topic1 e topic2, dai un occhiata al .sql
