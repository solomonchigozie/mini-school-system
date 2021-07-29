<?php 
session_start();
//database connection file
include("inc/config.php");

//take user to login if they are not logged in
if(!(isset($_SESSION['userid']))){
	echo "<script>location='login.php'</script>";
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

    <div class="row p-5">
        <div class="col-md-8 offset-md-2 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">All Student</h5>
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Date of birth</th>
									<th>Level</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = mysqli_query($connection, "SELECT * FROM student");
									while($row =mysqli_fetch_assoc($sql)){
								?>
								<tr>
									<th><?php echo $row['fullname'] ?></th>
									<th><?php echo $row['dob'] ?></th>
									<th><?php echo $row['level'] ?></th>
									<th>
										<a href="editstudent.php?studentid=<?php echo $row['id'] ?>" class="btn btn-success">
											View
										</a>
										<a href="deletestudent.php?studentid=<?php echo $row['id'] ?>" class="btn btn-danger">
											Delete
										</a>
									</th>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
						
                    </p>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
</html>