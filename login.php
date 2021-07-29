<?php
session_start();

//database connection file
include("inc/config.php");

$email = "";
$success = "";
$error = array();

//if form is submitted
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $pass = mysqli_real_escape_string($connection, $_POST['password']);
    
    //lets check for erros in the fields
    if(empty($email)){
        array_push($error, "email cannot be empty");
    }
    if(empty($pass)){
        array_push($error, "password cannot be empty");
    }
    
    //if there are no errors in the form then 
    //fetch the user data from the database
    
    if(count($error)==0){
        //encrypt password
        $password = md5($pass);

        //check for user data 
        $sql = "SELECT * FROM users where email='$email' AND password='$password' "; 
        
        $query = mysqli_query($connection, $sql);
        
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){
                // $success = $row['fullname'];
                //add user details to a session and send user to dashboard
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['userid'] = $row['id'];

                echo "<script>location='index.php'</script>";
            }
        }else{
            $success = "<span class='text-danger'>Invalid email or password</span>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-primary">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="reg__form" autocomplete="off">
        <h1 class="text-center">Login</h1>
        <?php echo $success; ?>
        <?php
            foreach($error as $errors){
                echo "<p class='text-danger text-center'>".
                    $errors . "<br> </p>";
            }
        ?>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>">
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group text-center">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
        <div class="text-center">
            <a href="register.php">Create an account</a>
        </div>
    </form> 

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
</html>