<?php 
//database connection file
include("inc/config.php");

$fullname = "";
$email = "";
$phone = "";
$success = "";
$error = array();

//if form is submitted
if(isset($_POST['submit'])){
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $pass = mysqli_real_escape_string($connection, $_POST['password']);
    $confirmpassword=mysqli_real_escape_string($connection, $_POST['confirmpassword']);
    
    //lets check for erros in the fields
    if(empty($fullname)){
        array_push($error, "fullname cannot be empty");
    }
    if(empty($email)){
        array_push($error, "email cannot be empty");
    }
    if(empty($phone)){
        array_push($error, "phone cannot be empty");
    }
    if(empty($pass != $confirmpassword)){
        array_push($error, "Two passwords do not match");
    }
    
    //if there are no errors in the form then continue
    if(count($error)==0){
        //encrypt password
        $password = md5($pass);

        //insert into the database
        $insert = "INSERT INTO users(fullname, email, phone, password) 
        VALUES('$fullname', '$email', '$phone','$password')";

        if(mysqli_query($connection, $insert)){
            $success = "<span class='text-success'>Registered successfully</span>";
        }else{
            $success = "<span class='text-danger'>failed</span>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-primary">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="reg__form" autocomplete="off">
        <h1 class="text-center">Register</h1>
        <?php echo $success; ?>
        <?php
            foreach($error as $errors){
                echo "<p class='text-danger text-center'>".
                    $errors . "<br> </p>";
            }
        ?>
        <div class="form-group">
            <label for="fullname">Fullname: </label>
            <input type="text" name="fullname" class="form-control" value="<?php echo $fullname ?>">
        </div>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number: </label>
            <input type="phone" name="phone" class="form-control" value="<?php echo $phone ?>">
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="confirmpassword">Confirm Password: </label>
            <input type="password" name="confirmpassword" class="form-control">
        </div>
        <div class="form-group text-center">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
        <div class="text-center">
            <a href="login.php">Already have an account, Login</a>
        </div>
    </form> 

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
</html>