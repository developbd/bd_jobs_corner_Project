<?php
   session_start();
   unset($_SESSION['super_admin']);
   session_destroy(); 
   header("Location: index");
   //exit();
?>