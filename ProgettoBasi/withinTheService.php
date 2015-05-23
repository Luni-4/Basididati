<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HomePage</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<style type="text/css">

div.top_box{

	padding-top: 50px;
    padding-right: 50px;
    padding-bottom: 300px;
    padding-left: 50px;
	background-image:url("ChiLoSa.png");
	background-repeat:no-repeat;
	background-position:top;
	background-color: white;

}

div.left_box{
	position: absolute;
    left: 50px;
    top: 450px;
	padding-top: 500px;
    padding-right: 50px;
    padding-bottom: 50px;
    padding-left: 200px;
	background-image:url("login.jpg");	
		
}

div.main_box{
	
	position: absolute;
    left: 400px;
    top: 500px;
	right: 75px;
	padding-top: 400px;
    padding-right: 50px;
    padding-bottom: 50px;
    padding-left: 600px;
	background-image:url("login.jpg");	

}
select.style{
	background-image:url("login.jpg");	
	color:#FFF;
	background-color:#6F9;
	width:150px;
	height:50px;
	font-size:20px;
}
div.ghost_left{
	position: absolute;
    left: 70px;
    top: 475px;
	padding-top: 450px;
    padding-right: 60px;
    padding-bottom: 50px;
    padding-left: 150px;
	background-color: white;
	opacity:0.5;
	
}
div.error_box{
	position: absolute;
	text-align:center;
	font-size:40px;
	padding-bottom: 50px;
    left: 450px;
    top: 550px;
	right: 130px;
	padding-top: 50px;
    padding-bottom: 125px;
    padding-left: 50px;
	padding-right: 50px;
	background-color: red;
	
}

div.ghost_box{
	position: absolute;
    left: 450px;
    top: 550px;
	right: 125px;
	padding-top: 25px;
    padding-bottom: 50px;
    padding-left: 50px;
	background-color: rgba(255, 255, 255, 0.7);
	background: rgba(255, 255, 255, 0.7);
	color: rgba(255, 255, 255, 0.7);
	
}

</style>
</head>
<?php

//VERIFICO LA PRESENZA DELLE VAR DI SESSIONE PER L'UTENTE DA UTILIZZARE NELLE QUERY
	session_start();
	$message="";
	$_SESSION["utente"]='oite'; //da togliere quando tutto sara' unito, implementazione farlocca
	if (isset($_SESSION["utente"])){
			$conn = pg_connect("host=localhost port=5432 dbname=ChiLoSa user=postgres password=1234 ");
			if(!$conn){
				$message="OPS qualcosa sembra essere andato storto :(";
			}else{//la connessione e' andata a buon fine
				$query="CREATE OR REPLACE VIEW preferenzaUtente(nome,nomec) as 
		SELECT nome,nomec
		FROM utente NATURAL JOIN preferenza NATURAL JOIN categoria
		WHERE utente.nome='oite'";
				$query_create_view=pg_query($conn,$query);//prima query per caricare le domande più recenti nella homepage
				if($query_create_view){//tutto ok
					$query="select nome,testo,datad,idd,nomec
	from domandaperta NATURAL JOIN topic1 NATURAL JOIN categoria
	where chiusa='FALSE' AND (datad-current_timestamp)<INTERVAL'7 days' AND categoria.nomec in (select nomec from preferenzaUtente)
	UNION
	select nome,testo,datad,idd,nomec
	from sondaggio NATURAL JOIN topic2 NATURAL JOIN categoria
	where chiusa='FALSE' AND (datad-current_timestamp)<INTERVAL'7 days' AND categoria.nomec in (select nomec from preferenzaUtente)";
					$query_res=pg_query($conn,$query);
					if($query_res){//seconda query ok
						print "<div class='main_box'></div>";
						print "<div class='ghost_box'>";
						while($row=pg_fetch_assoc($query_res)){
							print "<div style='background-color:#00CC99;width:675px;padding-left:10px'>Utente: ".$row["nome"]." ,Data: ".$row["datad"]." ,Categoria: ".$row["nomec"]."<br></div>";
							print "<div style='background-color:white;width:675px;color:black;padding-left:10px'>".$row["testo"]."<br></div>";
						}
						print "</div>";
					
					}
					else{
						$message=pg_last_error($conn);
						exit("Errore nella query: ".pg_last_error($conn));
					}
				}else{
					$message=pg_last_error($conn);
					exit("Errore nella query: ".pg_last_error($conn));
				}
			}
			
			print"<body style='background-color:#6F6'>";
			print"<div class='top_box'></div>";
			print"<div id='cssmenu'>";
			print"<ul>
					 <li><a href='#'><span>|Ultime Domande|</span>	</a></li>
					   <li><a href='#'><span>|Choose category!| ----></span></a></li>
						<li>
							<select class='style'>
									<option value='categoria1'>|Cucina|</option>
									<option value='categoria2'>|Sport|</option>	
									<option value='categoria3'>|Informatica|</option>
									<option value='categoria4'>|Animali|</option>
							</select>
					   </li>
						<li><a href='#'><span>|Vai alla tua pagina|</span></a></li>
					   <li class='last'><a href='#'><span>|Logout|</span></a></li>
					  
					</ul>
				</div>
			<div class='left_box'></div>
			<div class='ghost_left'></div>";
			if(!empty($message))
				print"<div class='error_box'>
			<p>$message</p></div>
			</body>";
			
	}else//qualcosa e' andato storto nella connessione
		header("Location: paginaInizio.php");
?>
</html>
