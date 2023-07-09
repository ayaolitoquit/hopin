<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('check_session.php');
include('../connections.php');

// Check if the form is submitted
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $oldPassword = $_POST['oldpass'];
    $newPassword = $_POST['newpass'];
    $confirmPassword = $_POST['confirmpass'];

    // Perform additional validation as per your requirements
    // For example, check if the new password meets certain criteria

    // Query the database to check if the old password matches
    // This assumes you have a users table with columns 'email' and 'password'
    $query = "SELECT * FROM login WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        // Verify if the old password matches the stored password
        if (password_verify($oldPassword, $storedPassword)) {
            // Update the password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Perform the database update query here
            // For example, update the password for the user with the given email

            // Redirect the user to a success page or display a success message
            header("Location: account.php");
            var_dump($_POST);
            exit;
        } else {
            // Old password does not match
            echo "Old password is incorrect.";
        }
    } else {
        // User with the provided email does not exist
        echo "User does not exist.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="..\css\changepass.css ">
    <title>Hopin</title>
</head>

<body>
    <!-- sidebar -->
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3" style="width: 280px;">
        <img class="logo-sidebar" src="..\images\Logo.png" alt="">

        <ul class="nav nav-pills flex-column mb-auto mt-1 fw-bold">
            <li class="nav-item my-3">
                <a href="..\html\dashboard.php" class="nav-link link-dark" aria-current="page">
                Dashboard
                </a>
            </li>
            <li class="nav-item my-3">
                <a href="..\html\applicants.php" class="nav-link link-dark">
                Applicants
                </a>
            </li>
            <li class="nav-item my-3">
                <a href="..\html\jobs.php" class="nav-link link-dark">
                Jobs
                </a>
            </li>
            <li class="nav-item my-3">
                <a href="..\html\account.php" class="nav-link active d-flex align-items-center justify-content-center">
                Account
                </a>
            </li>
        </ul>

        <div class="custom-div row">
            <div class="col-4 iconUser-container">
                <img class="iconUser d-flex justify-content-center align-items-center mt-2" src="..\images\svg\icnUser.png" alt="">
            </div>
            <div class="col-8 d-flex justify-content-center flex-column flex-grow-1 mt-2 userDetails">
                    <h6>Sample Name</h6>
                    <p>Role</p>
            </div>
                
        </div>
    </div>

    
    <!-- content -->
            <section class="main container text-center">
                <div class="acc mx-auto">
                    <div class="accpass">
                        <h2>Account</h2>
                        <h5>Change password</h5>
                    </div>
                    <form class="input" action="changepass.php" method="POST">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <input type="password" name="oldpass" id="oldpass" placeholder="Old Password" required>
                        <input type="password" name="newpass" id="newpass" placeholder="New Password" required>
                        <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" required>
</form>
                    <div>
                        <button type="button" name="update" class="btn btn-light">Update</button>
                    </div>

                </div>

            </section>







    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
</body>
</html>