<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" 
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">School System</a>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="addstudent.php">Add Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="allstudent.php">All Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="profile.php">
                    <?php echo $_SESSION['fullname']; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>