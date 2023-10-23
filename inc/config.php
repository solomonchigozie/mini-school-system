<?php 
//database connection
$dbname = "minischool";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if($connection){
    //echo "connected";
}else{
    echo "failed" . mysqli_connect_error($connection);
}


?>