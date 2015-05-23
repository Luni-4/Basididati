function checkLogin() { 
    // controllo di field username
    var nome = document.forms.registrazione.user.value;	
    if (nome.length == 0) {
        alert("Inserire username"); 
		document.forms.registrazione.user.focus();
		return false;
    }
	
    // controllo di field email
    var email = document.forms.registrazione.email.value;
    if (email.length == 0) {
        alert("Inserire email");	
		document.forms.registrazione.email.focus();
        return false;
    }
	
    // controllo di field password (molto probabilmente non va su chrome)
    var pass = document.forms.registrazione.pass.value;
    if (pass.length == 0) {
        alert("Inserire password");
		document.forms.registrazione.pass.focus();
        return false;
    }
	
}

function checkFormCreateAccount() { 
	// controllo di field username
	var nome = document.forms.registrazione.username.value;	
    if (nome.length == 0) {
        alert("Inserire username");
        document.forms.registrazione.username.focus(); 		
		return false;
    }
	// controllo di field email
	var email = document.forms.registrazione.email.value;
    if (email.length == 0) {
        alert("Inserire email");
        document.forms.registrazione.email.focus();		
        return false;
    }	
	
	// Controllo di field pass
	var pass = document.forms.registrazione.pass.value;	
    if (pass.length == 0) {
        alert("Inserire una password");
		document.forms.registrazione.pass.focus();
        return false;
    }
	
	// Controllo di field passConfirm
	var passConfirm = document.forms.registrazione.passConfirm.value;
	if (passConfirm.length == 0) {
        alert("Inserire conferma password");		
		document.forms.registrazione.passConfirm.focus();
        return false;
    }
	
	// Controllo password
	if (pass != passConfirm) {
        alert("Le due password non coincidono, controllare uguaglianza");
        document.forms.registrazione.pass.focus();		
        return false;
    }	
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
