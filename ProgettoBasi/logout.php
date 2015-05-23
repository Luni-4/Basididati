<?php
// Rimozione di tutte le variabili di sessione
session_unset();
// Distruzione variabili di sessione
session_destroy();
header("Location: homePage.php");
?>
