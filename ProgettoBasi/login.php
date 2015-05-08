<!DOCTYPE html>
<html>
<head>    
 <meta charset="UTF-8">
</head>
<body>
	<!-- Gestore errore -->
	<div> 
		<?php include "error.php"; ?>
	</div> 
   <form action="checker.php" method="get">	
       <table>		  
          <tr><td>username</td><td><input type="text" name="username" size=20 ></td></tr>
          <tr><td>email</td><td><input type ="text" name="email" size = 20></td></tr>
          <tr><td><input type="submit" value="Invia"></td></tr>
      </table>
   </form>  
</body>
</html>