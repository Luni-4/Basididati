function checkFormCreateAccount() { 
	
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