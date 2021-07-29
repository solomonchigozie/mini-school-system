<?php 
session_start();
//logout user by destroying user session 
//before sending the user to the login page

session_destroy();
echo "<script>location='login.php'</script>";


?>