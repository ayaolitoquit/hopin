<?php 
include('check_session.php');
include("../connections.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$updateid = $_GET['updateid'];

$sqll = "SELECT * FROM jobs WHERE Job_id = $updateid";
$result = mysqli_query($connections,$sqll);
$row = mysqli_fetch_assoc($result);
$jobtitle = $row["Job_title"];
$jobsalary = $row["Job_salary"];
$jobstatus = $row["Job_status"];
$jobcontract = $row["Job_contract"];
$jobdesc = $row["Job_desc"];
$jobreqs = $row["Job_reqs"];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updateid = $_GET['updateid'];

    $jobtitle = mysqli_real_escape_string($connections, $_POST["jobtitle"]);
    $jobsalary = mysqli_real_escape_string($connections, $_POST["jobsalary"]);
    $jobstatus = mysqli_real_escape_string($connections, $_POST["jobstatus"]);
    $jobcontract = mysqli_real_escape_string($connections, $_POST["jobcontract"]);
    $jobdesc = mysqli_real_escape_string($connections, $_POST["jobdesc"]);
    $jobreqs = mysqli_real_escape_string($connections, $_POST["jobreqs"]);

    $sql = "UPDATE jobs SET Job_title='$jobtitle', Job_salary='$jobsalary', Job_status='$jobstatus', Job_contract='$jobcontract', Job_desc='$jobdesc', Job_reqs='$jobreqs' WHERE Job_id='$updateid'";

    // $sql = "UPDATE applicants SET Applicant_name='$Applicant_name', Applicant_email='$email', Applicant_job='$jobTitle', fileInput='$fileData' WHERE Applicant_id='$id'";";

    // if (!$connections) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }

    if ($connections->query($sql) === true) {
        header("Location: jobs.php");
        echo "Job updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $connections->error;
    }

    //// Check if query execution was successful
    // if ($result && mysqli_num_rows($result) > 0) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $jobContract = $row["Job_contract"];
    //         echo "<option value='$jobContract'>$jobContract</option>";
    //     }
    // } else {
    //     echo "<option value=''>No contracts found</option>";
    // }

    $connections->close();
}

// if(isset($_GET['updateid'])){
//     $id = $_GET["updateid"];

//     if(isset($_POST['update'])){
//         $jobtitle = $_POST["jobtitle"];
//         $jobsalary = $_POST["jobsalary"];
//         $jobstatus = $_POST["jobstatus"];
//         $jobcontract = $_POST["jobcontract"];
//         $jobdesc = $_POST["jobdesc"];
//         $jobreqs = $_POST["jobreqs"];

//         $sql = "UPDATE jobs SET Job_title='$jobtitle', Job_salary='$jobsalary', Job_status='$jobstatus', Job_contract='$jobcontract', Job_desc='$jobdesc', Job_reqs='$jobreqs' WHERE Job_id='$id'";
//         $result = mysqli_query($connections, $sql);
        
//         if($result){
//             header("Location: jobs.php");
//             exit(); 
//         } else {
//             die(mysqli_error($connections));
//         }
//     }
//     } else {
//     die("Missing or invalid updateid parameter.");
// }

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
    <link rel="stylesheet" href="..\css\jobnew.css">
    <title>Update</title>
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
                <a href="..\html\jobs.php" class="nav-link active d-flex align-items-center justify-content-center">
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
    <section class="main container position-absolute mt-1">
        <div class="content">
            <div>
                <h2>Update Job</h2>
                <form method="POST">
                    <div class="input">
                        <div>
                            <h5>Job Title</h5>
                            <input type="text" name="jobtitle" id="jobtitle" value=<?php echo $jobtitle ?>>
                        </div>  
                        <div>
                            <h5>Estimated Salary</h5>
                            <input type="text" name="jobsalary" id="jobsalary" value=<?php echo $jobsalary ?>>
                        </div>
                        <div>
                            <h5>Contract</h5>
                            <select name="jobcontract" id="jobcontract" class="drp form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="Full-time" selected>Full-Time</option>
                                <option value="Part-time">Part-Time</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                        <div class="me-2">
                            <h5>Status</h5>
                            <select name="jobstatus" id="jobstatus" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="Active" selected>Active</option>
                                <option value="Filled">Filled</option>
                                <option value="Interviewing">For Interviewing</option>
                                <option value="Reopened">Reopened</option>
                            </select>
                        </div>
                        <div class="jobdesc">
                            <h5>Job Description</h5>
                            <textarea class="p-3" name="jobdesc" rows="4" cols="50"><?php echo $jobdesc ?></textarea>
                            <h5>Requirements</h5>
                            <textarea class="p-3" name="jobreqs" rows="4" cols="50"><?php echo $jobreqs ?></textarea>
                        </div>   
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto mt-3">
                            <button type="submit" name="update" class="btn btn-light btn-outline-dark btn-sm">Update</button>
                        </div>
                    </form>
            </div>
            

            
        </div>
    </section>

    
    <!-- Javascript -->
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>