<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bar2.css">
</head>
<body>
<section class="cform">
  <article class="title">
    <p>Registrazione</p>
  </article>
  <form name="registrazione" action="checkCreateAccount.php" method=GET>
	  <section class="form">
		<p>*Nuovo username</p>
		<input type="text" name="username">
		<p>*Email</p>
		<input type="text" name="email">
		<p>*Scegli una password</p>
		<input type="text" name="pass">
		<p>*Ripeti la password</p>
		<input type="text" name="passConfirm">
		<p>Data di Nascita</p>
		<input type="date" name="bday" max="2004-12-31" min="1899-01-31"><br><br>
		<p>Residenza</p>
		<input type="text" name="residenza">
		<p>Scegli una categoria di interesse </br></p>
		<p>(N.B: potrai cambiare preferenza in un secondo momento)</p>
		<select>
			  <option value="categoria1">Cucina</option>
			  <option value="categoria2">Sport</option>
			  <option value="categoria3">Informatica</option>
			  <option value="categoria4">Animali</option>
		</select>
		<div class="btn">
		  <p>Invia registrazione</p>
		<input type="submit" value="Invia">  
		</div>
	  </section>
  </form>
</section>  
  
</body>
</html>