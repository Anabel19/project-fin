<?php
   session_start();
   
   unset($_SESSION['loggedIN']);
   session_destroy();
   header( 'Location: users.html');
   //header("Location: login.json.php");
   exit();
?>