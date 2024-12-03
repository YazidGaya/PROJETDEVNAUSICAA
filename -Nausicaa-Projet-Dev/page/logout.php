<?php
//fermeture de la session
session_start();

session_unset(); //détruire les variables de sessions
session_destroy(); 
setcookie("username", "", 0);
setcookie("password", "", 0);
header("Location: index.php");
?>