function checkForm() { 
	// controllo di field username
	var nome = document.forms.registra.username.value;	
    if (nome == "") {
        alert("Inserire username"); 
		return false;
    }
	// controllo di field email
	var email = document.forms.registra.email.value;
    if (email == "") {
        alert("Inserire email");
        return false;
    }
	// Controllo data
	var giorno= document.forms.registra.giorno.value;
	var mese= document.forms.registra.mese.value;
	var anno= document.forms.registra.anno.value;
	if(!(giorno=="" || mese=="" || anno=="")){
		if(!checkDate(mese,giorno,anno)){
			alert("Data inesistente");
            return false;
		}
	}
	// Controllo di field residenza
	var residenza = document.forms.registra.residenza.value;
    if (residenza == "") {
        alert("Inserire residenza");
        return false;
    }
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