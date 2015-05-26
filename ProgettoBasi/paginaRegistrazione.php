<!DOCTYPE html>
<html>
	<head>
	    <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="Css/bar2.css">
		<script src="Javascript/login.js"></script>
	</head>
	<body>
		<section class="cform">
			<article class="title">
				<p>Registrazione</p>
			</article>
				<form name="registrazione" action="checkCreateAccount.php" method=POST onsubmit="return checkFormCreateAccount()">
					<section class="form">
					    <?php
						  $nome=NULL; $em=NULL;
					      if(isset($_GET["user"]))
							$nome="value=".$_GET["user"];
						  if(isset($_GET["email"]))
							$em="value=".$_GET["email"];
						  print"<p>*Nuovo username</p>\n
						        <input type=\"text\" name=\"username\" $nome maxlength=\"16\">\n";
						  print"<p>*Email</p>\n
						          <input type=\"email\" name=\"email\" $em maxlength=\"16\">\n";										
					    ?>						
						<p>*Scegli una password</p>
							<input type="password" name="pass">
						<p>*Ripeti la password</p>
							<input type="password" name="passConfirm">
						<p>Data di Nascita</p>
						<table>
						  <tr>
						    <td>
							   <select name="giorno">
					              <option value=""></option>
					              <?php 
							        for($i=1; $i<32; $i++)
						               print"<option value=\"$i\">$i</option>\n";					              
					              ?>
				               </select>
				            </td>
				            <td>
				                <select name="mese">
					              <option value=""></option>
					              <?php 
					                $mesi = array("Gennaio", "Febbraio", "Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
					                for($i=1; $i<13; $i++){
						              $t=$i-1;
						              print"<option value=\"$i\">$mesi[$t]</option>\n";
					                }
					              ?>
				                </select>
				            </td>
				            <td>
				                <select name="anno">
					              <option value=""></option>
					              <?php 
					              for($i=1900; $i<2101; $i++)
						            print"<option value=\"$i\">$i</option>\n";					   
					              ?>
				                </select>
                            </td>
						  </tr>
						</table>
						<p>Residenza</p>
							<input type="text" name="residenza">
						<p>Scegli una categoria di interesse <br></p>
						<p>(N.B: Devi scegliere almeno una categoria di interesse)</p>
						    <?php
						         include "dbopen.php";
								 $querycategorie="SELECT nomec FROM categoria WHERE nomesuperc IS NULL";
								 $categorie=pg_query($dbconn,$querycategorie) or die("Errore nella query");
								 while($row=pg_fetch_assoc($categorie)){
									print "<input type=\"checkbox\" name=\"categ[]\" value=".$row["nomec"].">";									
									print "<label for=\"checkbox\">".$row["nomec"]."</label><br><br>";
									//while<-generazione delle sottocategorie, da definire il rapporto tra sottocategoria e categoria
								 }								 
							?> 
						<div class="btn">
						  <p>Invia registrazione</p>
							<input type="submit" value="Invia">  
						</div>
						<?php 						 
			              //checkAccount controlla solo che i campi siano pieni, poi necessita del controllo all'interno del db
			              if(isset($_GET["message_error"])) 
                          {
			                 print "<div class=\"box_error\">";
							 require_once "error.php";
							 print"</div>";
						  }					
						?>
					</section>
				</form>
		</section>  
	</body>
</html>