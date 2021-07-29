<?php 
session_start();
//database connection file
include("inc/config.php");

//take user to login if they are not logged in
if(!(isset($_SESSION['userid']))){
	echo "<script>location='login.php'</script>";
}

//get the students data using the studentid sent using get request
if(isset($_GET['studentid'])){
	$id= $_GET['studentid'];
	$sql = mysqli_query($connection, "DELETE FROM student where id='$id'");
	
	echo "<script>location='allstudent.php'</script>";
}

?>