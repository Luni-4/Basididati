function checkFormCreateAccount() { 
	// controllo di field username
	var nome = document.forms.registrazione.username.value;	
    if (nome == "") {
        alert("Inserire username"); 
		document.forms.registrazione.username.focus();
		return false;
    }
	// controllo di field email
	var email = document.forms.registrazione.email.value;
    if (email == "") {
        alert("Inserire email");
		document.forms.registrazione.email.focus();
        return false;
    }
	/* Controllo data<-- non è necessario controllare la data di nascita, è opzionale e i parametri min e max sono settati nell'html
	var giorno= document.forms.registra.giorno.value;
	var mese= document.forms.registra.mese.value;
	var anno= document.forms.registra.anno.value;
	if(!(giorno=="" || mese=="" || anno=="")){
		if(!checkDate(mese,giorno,anno)){
			alert("Data inesistente");
            return false;
		}
	}
	*/
	// Controllo di field residenza
	var residenza = document.forms.registrazione.residenza.value;
    if (residenza == "") {
        alert("Inserire residenza");
		document.forms.registrazione.residenza.focus();
        return false;
    }
	
	// Controllo di field di pass e che coincida con passConfirm (conferma password)
	var pass = document.forms.registrazione.pass.value;
	var passConfirm = document.forms.registrazione.passConfirm.value;
    if (pass == "" || passConfirm == "") {
        alert("Inserire una password e confermarla");
		document.forms.registrazione.pass.focus();
        return false;
    }
	if (pass != passConfirm) {
        alert("Le due password non coincidono");
		document.forms.registrazione.pass.focus();
		document.forms.registrazione.passConfirm.focus();
        return false;
    }
	//SE I CAMPI SONO PIENI ACCEDO AL CONTROLLO NEL DB
   document.forms.registrazione.submit(); //posso inviare al db per fare controlli di esistenza

}

function checkDate(m, d, y) {
  //  discuss at: http://phpjs.org/functions/checkdate/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Pyerre
  // improved by: Theriault
  //   example 1: checkdate(12, 31, 2000);
  //   returns 1: true
  //   example 2: checkdate(2, 29, 2001);
  //   returns 2: false
  //   example 3: checkdate(3, 31, 2008);
  //   returns 3: true
  //   example 4: checkdate(1, 390, 2000);
  //   returns 4: false

  return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0))
    .getDate();
}