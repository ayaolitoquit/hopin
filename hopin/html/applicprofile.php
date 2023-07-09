<?php 
include('check_session.php');
include("../connections.php");



function getJobContract($jobcontract) {
    global $connections;

    $jobcontract = $connections->real_escape_string($jobcontract);

    $sql = "SELECT Job_contract FROM jobs WHERE Job_title = '$jobcontract'";
    $result = $connections->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Job_contract"];
    }

    return "N/A";
}

function getJobStatus($statusId) {
    global $connections;

    //statusId = Job_title
    $statusId = $connections->real_escape_string($statusId);

    $sql = "SELECT Job_status FROM jobs WHERE Job_title = '$statusId'";
    // echo $statusId;
    $result = $connections->query($sql);

    // if ($result && $result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     return $row["Job_status"];
    // }

    return "Unknown";
}

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
    <link rel="stylesheet" href="..\css\applicprofile.css">
    <title>Applicants</title>
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
                <a href="..\html\applicants.php" class="nav-link active d-flex align-items-center justify-content-center">
                Applicants
                </a>
            </li>
            <li class="nav-item my-3">
                <a href="..\html\jobs.php" class="nav-link link-dark">
                Jobs
                </a>
            </li>
            <li class="nav-item my-3">
                <a href="..\html\account.php" class="nav-link link-dark">
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
                <p><?php echo $row['role']; } ?></p>
            </div>
                
        </div>
    </div>
    
    <!-- content -->
            <section class="main container">
                <div class="content">
                    <div class="back">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-black" href="applicants.php"><svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="mask0_638_29" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="4" width="43" height="37"><path fill-rule="evenodd" clip-rule="evenodd" d="M41.25 38.2837C36.6628 32.6841 32.5894 29.5069 29.0288 28.7512C25.4691 27.9966 22.08 27.8822 18.8606 28.4091V38.4375L3.75 22.0734L18.8606 6.5625V16.0941C24.8128 16.1409 29.8725 18.2766 34.0406 22.5C38.2078 26.7234 40.6116 31.9847 41.25 38.2837Z" fill="white" stroke="white" stroke-width="4" stroke-linejoin="round"/></mask><g mask="url(#mask0_638_29)"><path d="M0 0H45V45H0V0Z" fill="black"/></g></svg>
                        </a>
                    </div>
                    <div class="headd d-flex align-items-center justify-content-between">
                        <div class="profile">
                            <img src="..\images\blankprofile.png" class="rounded-circle" alt="#">
                        </div>
                        <div class="name">
                            <p class="text-align-start fs-4">
                                <?php 
                                $applicantid = $_GET['applicantid'];

                                $sqlapplicant = "SELECT * FROM applicants WHERE Applicant_id = $applicantid";
                                $resultjapplicant = $connections->query($sqlapplicant);
                                $row = mysqli_fetch_assoc($resultjapplicant);
                                
                                echo $row["Applicant_name"];
                                ?>
                            </p>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="status ">
                                <h2>Status</h2>
                                <p class="fs-2"><?php echo getJobStatus($row["Applicant_job"]); ?></p>
                            </div>
                            <div class="current ">
                                <h2>Current Job</h2>
                                <p class="fs-2"><?php echo $row["Applicant_job"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="lower-details">
                        <div class=" d-flex flex-row">
                            <div>
                                <!-- email -->
                                <h2>Email: <span><?php echo $row["Applicant_email"] ?></span></h2>
                                
                            </div>
                            <div>
                                <!-- contract -->
                                <h2>Contract: <span><?php echo getJobContract($row["Applicant_job"])?></span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    <!-- </div>
                        <div class="skills ">
                            <h2>SKILLS</h2>
                            <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ut error illum, ex debitis eos culpa cumque accusamus animi. Illum facere, adipisci ipsam odio ea illo? Odio molestias modi velit!</p>
                        </div>
                        <div class="exp ">
                            <h2>EXPERIENCE</h2>
                            <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ut error illum, ex debitis eos culpa cumque accusamus animi. Illum facere, adipisci ipsam odio ea illo? Odio molestias modi velit!</p>
                        </div>
                        <div class="fields ">
                            <h2>FIELDS</h2>
                            <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quos cumque molestias porro maxime veritatis eaque neque eligendi necessitatibus odit, commodi qui ex dicta quaerat vero rem, aspernatur impedit numquam, ipsa possimus voluptatem voluptates.</p>
                        </div>

                    </div> -->

            </section>

    
    <!-- Javascript -->
    <script>index.js</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>