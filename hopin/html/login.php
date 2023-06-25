<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../connections.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form is submitted
    // Rest of your code for login verification

    $email = $_POST['email'];
    $password = $_POST['password'];
    print_r($_POST);

    $query = "SELECT * FROM login WHERE email = ?";
    $statement = mysqli_prepare($connections, $query);
    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result)) {
        $hashedPassword = $row['password'];
        // Verify the entered password against the stored hashed password
        if ($password === $hashedPassword) {
            // Password matches
            echo "Login successful";
            // header("Location: dashboard.php");
            echo "Entered Password: " . $password . "<br>";
            echo "Hashed Password from DB: " . $hashedPassword . "<br>";
            echo "password_verify() Result: " . var_export(password_verify($password, $hashedPassword), true) . "<br>";
            echo "Login successful";
            header("Location: dashboard.php");
            exit;
        } else {
            // Password does not match
            echo "Invalid password";
            echo "Entered Password: " . $password . "<br>";
            echo "Hashed Password from DB: " . $hashedPassword . "<br>";
            echo "password_verify() Result: " . var_export(password_verify($password, $hashedPassword), true) . "<br>";
            echo "Invalid password";
        }

        if ($password === $hashedPassword) {
            // Password matches
            session_start();
            $_SESSION['name'] = $row['name'];
            header("Location: dashboard.php");
            exit;
        }
    }
    } else {
        // No matching email found
        echo "Invalid email or password";
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
        crossorigin="anonymous">
        <link rel="stylesheet" href="../css/login.css">

    
    <title>Login</title>
</head>

<body class="container-fluid custom-bg">
    <div class="container">
        <div class="row">
        
        <div class="containerr"></div>
            <div class="col">
                <div class="container login-container">
                    <div class="text-center d-lg-flex">
                        <img src="../images/logo.png" alt="Logo" class="d-block mx-auto mb-4">
                    </div>

                    

                    <form method="POST" style="justify-content: center;">
                        <div class=" mb-3 mx-auto ">   
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class=" mb-3 mx-auto">
                            
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="col-12 text-center"> 
                            <button type="submit" name="submit" class=" btn btn-white shadow p-2 mb-5 bg-body-tertiary rounded-5  ">Submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div class="col d-none d-md-block">
                    <img src="../images/imgLogin.png" alt="Login Image" class="login-image">
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>