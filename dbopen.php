<?php
    include "dbconfig.php";
	$conn_string="Host=".$dbhost." port=".$dbport." dbname=".$dbnome." user= ".$dbuser." password=".$dbpass;
    $dbconn=pg_connect($conn_string) or die("Impossibile connettersi a database");          
?>