<?php 
//Reanudamos la sesión 
@session_start(); 
//Validamos si existe realmente una sesión activa o no 
if($_SESSION["loggedIN"] != "SIP")
{ 
  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
  header("Location: users.html"); 
  exit(); 
} 
else echo '{"response": "BIENVENIDO": "' . $_SESSION['userA'] . '"}';
?>