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

    // Controllo data
	var giorno= document.forms.registrazione.giorno.value;
	var mese= document.forms.registrazione.mese.value;
	var anno= document.forms.registrazione.anno.value;
	
	if((giorno.length == 0 || mese.length == 0 || anno.length == 0) && !(giorno.length == 0 && mese.length == 0 && anno.length == 0 )){
		alert("O si inerisce data completa o non si inserisce");
		return false;
	}
	if(!(giorno.length == 0 && mese.length == 0 && anno.length == 0) && !checkDate(mese,giorno,anno)){
			alert("Data inesistente");
            return false;
	}
		
	
	// Controllo categorie		
	var categ = document.forms.registrazione.elements['categ[]'];	
	var c=0;
	for (var i=0; i<categ.length; i++) {
        if (categ[i].checked){
            c++;
		}
     }
	 
	 if(c == 0){
	   alert("Inserisci una categoria");
	   return false;
     }	   
}

function checkDate(m, d, y) {  
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net) 
  
  return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0))
    .getDate();
}