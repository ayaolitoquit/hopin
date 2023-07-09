<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../connections.php");
$msg="";

if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($connections,$_POST['email']);
    $password=mysqli_real_escape_string($connections,$_POST['password']);
    $sql=mysqli_query($connections,"SELECT * FROM login WHERE email='$email' && password='$password'");
    $num=mysqli_num_rows($sql);

    if($num>0){
        $row=mysqli_fetch_assoc($sql);
        $_SESSION['USER_ID']=$row['id'];
        $_SESSION['USER_NAME']=$row['firstname'];
        header("Location: dashboard.php");
    } else{
        $msg="Please enter valid email and password!";
    }
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
                            <button type="submit" name="submit" class=" btn btn-white shadow p-2 mb-5 bg-body-tertiary rounded-5  ">Login</button>
                        </div>
                        <div class="error text-center">
                            <p><?php echo $msg ?> </p> 
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