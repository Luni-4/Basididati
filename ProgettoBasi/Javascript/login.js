function checkLogin() { 
    // controllo di field username
    var nome = document.forms.registrazione.user.value;	
    if (nome.length == 0) {
        alert("Inserire username"); 
		return false;
    }
	
    // controllo di field email
    var email = document.forms.registrazione.email.value;
    if (email.length == 0) {
        alert("Inserire email");
        return false;
    }
	
    // controllo di field password (molto probabilmente non va su chrome)
    var pass = document.forms.registrazione.pass.value;
    if (pass.length == 0) {
        alert("Inserire password");
        return false;
    }
	
}