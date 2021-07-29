<?php 
session_start();
//database connection file
include("inc/config.php");

//take user to homepage if they are not logged in
if(!(isset($_SESSION['userid']))){
	echo "<script>location='login.php'</script>";
}

$success = "";
$error = array();
//if form is submitted
if(isset($_POST['submit'])){
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $level = mysqli_real_escape_string($connection, $_POST['level']);
	
	#file name with a random number so that similar dont get replaced
    $passport = rand(1000,10000)."-".$_FILES["file"]["name"];

    //allowed file 
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", 
    "gif" => "image/gif", "png" => "image/png");

    //extension
    $extension = pathinfo($passport, PATHINFO_EXTENSION);
	#temporary name to store file
    $tname = $_FILES["file"]["tmp_name"];
    #upload size 
    $filesize = $_FILES["file"]["size"];

    #max size
    $maxsize = 1 * 1024 * 1024; //1mb
    //lets check for erros in the fields
    if(empty($fullname)){
        array_push($error, "fullname cannot be empty");
    }
    if(empty($dob)){
        array_push($error, "date of birth cannot be empty");
    }
    if(empty($level)){
        array_push($error, "level cannot be empty");
    }
	if(!array_key_exists($extension, $allowed)){
        array_push($error, "Only jpg, png, and jpeg files are allowed ");
    }
    if($filesize > $maxsize){
        array_push($error,"Image size is too large, images should be less than 1mb");
    }
    
    //if there are no errors in the form then continue
    if(count($error)==0){
		#move uploaded files to specific location
        move_uploaded_file($tname, "uploads/".$passport);

        //insert into the database
        $insert = "INSERT INTO student(fullname, dob, level, passport) 
        VALUES('$fullname', '$dob', '$level','$passport')";

        if(mysqli_query($connection, $insert)){
            $success = "<div class='text-success text-center'>
				Student was added successfully</div>";
        }else{
            $success = "<span class='text-danger'>failed".mysqli_error()."</span>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php  require("inc/nav.php"); ?>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="st__form" autocomplete="off" enctype="multipart/form-data">
        <h3 class="text-center">Add New Student</h3>
        <?php echo $success; ?>
        <?php
            foreach($error as $errors){
                echo "<p class='text-danger text-center'>".
                    $errors . "<br> </p>";
            }
        ?>

        <div class="form-group">
            <label for="fullname">Fullname: </label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth: </label>
            <input type="date" name="dob" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="level">Level: </label>
            <select name="level" class="form-control">
				<option value="100">100 Level</option>
				<option value="200">200 Level</option>
				<option value="300">300 Level</option>
			</select>
        </div>
		<div class="form-group">
            <label for="passport">Passport: </label>
            <input type="file" accept="image/*"  name="file" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
        </div>
    </form> 
	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
</html>