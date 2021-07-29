<?php 
//database connection
$dbname = "eit2";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if($connection){
    //echo "connected";
}else{
    echo "failed" . mysqli_connect_error();
}


?>