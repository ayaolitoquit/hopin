<?php 
include('check_session.php');
include('../connections.php');


$name_query = "SELECT * FROM login WHERE id = '".$_SESSION['USER_ID']."'";
$name_query_run = mysqli_query($connections, $name_query);
if($name_query_run->num_rows > 0){
    $row = $name_query_run->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="..\css\account.css">
    <title>Account</title>
    <script>
    if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, './dashboard.php');
        window.onpopstate = function () {
            window.location.href = 'login.php'; // Replace 'login.php' with your actual login page URL
        };
    }
</script>
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
                <h6><?php echo $row['firstname'] . " " . $row['lastname']; ?></h6>
                <p><?php echo $row['role'];  ?></p>
            </div>
                
        </div>
    </div>

    <!-- content -->
    <div class="main-content">
        <section class="idname container mb-3">
            <div class="idname">
                <div class="namee">
                    <h2>Name:<span id="name"><?php echo " " . $row['firstname'] . " " . $row['lastname']; ?></span></h2>
                </div>
            </div>
        </section>
        <section class="email container mb-3">
            <div class="email">
                <div>
                    <h2>Email:<span id="email"><?php echo " " . $row['email']; }?></span></h2>
                </div>
            </div>
        </section>
        <div class="logout-container">
        <form action="logout.php" method="post">
            <button type="submit" name="logout" class="logout btn"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.125 26.25C19.4234 26.25 19.7095 26.1315 19.9205 25.9205C20.1315 25.7095 20.25 25.4234 20.25 25.125C20.25 24.8266 20.1315 24.5405 19.9205 24.3295C19.7095 24.1185 19.4234 24 19.125 24H9.75C8.95435 24 8.19129 23.6839 7.62868 23.1213C7.06607 22.5587 6.75 21.7956 6.75 21V9C6.75 8.20435 7.06607 7.44129 7.62868 6.87868C8.19129 6.31607 8.95435 6 9.75 6H19.125C19.4234 6 19.7095 5.88147 19.9205 5.6705C20.1315 5.45952 20.25 5.17337 20.25 4.875C20.25 4.57663 20.1315 4.29048 19.9205 4.0795C19.7095 3.86853 19.4234 3.75 19.125 3.75H9.75C8.35761 3.75 7.02226 4.30312 6.03769 5.28769C5.05312 6.27226 4.5 7.60761 4.5 9V21C4.5 22.3924 5.05312 23.7277 6.03769 24.7123C7.02226 25.6969 8.35761 26.25 9.75 26.25H19.125ZM20.6115 9.2985C20.72 9.19821 20.8472 9.12029 20.9859 9.06918C21.1245 9.01807 21.2719 8.99477 21.4196 9.00063C21.5672 9.00648 21.7123 9.04136 21.8464 9.10328C21.9806 9.1652 22.1012 9.25294 22.2015 9.3615L26.7015 14.2365C26.8936 14.4444 27.0003 14.717 27.0003 15C27.0003 15.283 26.8936 15.5556 26.7015 15.7635L22.2015 20.6385C21.9988 20.8575 21.7174 20.987 21.4192 20.9985C21.1211 21.0101 20.8305 20.9027 20.6115 20.7C20.3925 20.4973 20.263 20.2159 20.2515 19.9177C20.2399 19.6196 20.3473 19.329 20.55 19.11L23.307 16.1235H11.625C11.3266 16.1235 11.0405 16.005 10.8295 15.794C10.6185 15.583 10.5 15.2969 10.5 14.9985C10.5 14.7001 10.6185 14.414 10.8295 14.203C11.0405 13.992 11.3266 13.8735 11.625 13.8735H23.3055L20.5485 10.887C20.4482 10.7785 20.3703 10.6513 20.3192 10.5126C20.2681 10.374 20.2448 10.2266 20.2506 10.0789C20.2565 9.9313 20.2914 9.78624 20.3533 9.65208C20.4152 9.51791 20.5029 9.39875 20.6115 9.2985Z" fill="black"/></svg>
            Logout</button>
        </form>
    </div>
    </div>
    
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>