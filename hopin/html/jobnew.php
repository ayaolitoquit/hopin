<?php 
include('check_session.php');
include("../connections.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $jobtitle = $_POST["jobtitle"];
    $jobsalary = $_POST["jobsalary"];
    $jobstatus = $_POST["jobstatus"];
    $jobcontract = $_POST["jobcontract"];
    $jobdesc = $_POST["Job_desc"]; // Job Description
    $jobreqs = $_POST["Job_reqs"]; // Requirements

    // Prepare and execute SQL statement
    $sql = "INSERT INTO jobs (Job_title, Job_salary, Job_status, Job_contract, Job_desc, Job_reqs)
            VALUES ('$jobtitle', '$jobsalary', '$jobstatus', '$jobcontract', '$jobdesc', '$jobreqs')";

    // Check the database connection
    if (!$connections) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // if ($connections->connect_error) {
    //     die("Connection failed: " . $connections->connect_error);
    // }

    if ($connections->query($sql) === true) {
        header("Location: jobs.php");
        echo "New job created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connections);
    }

    // Close the database connection
    $connections->close();
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
    <link rel="stylesheet" href="..\css\jobnew.css">
    <title>Jobs</title>
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
                <h2>Create New Job</h2>
                <form method="POST" >
                    <div class="input">
                        <div>
                            <h5>Job Title</h5>
                            <input type="text" name="jobtitle" id="jobtitle">
                        </div>  
                        <div>
                            <h5>Estimated Salary</h5>
                            <input type="text" name="jobsalary" id="jobsalary">
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
                            <textarea class="p-3" name="Job_desc" rows="4" cols="50"></textarea>
                            <h5>Requirements</h5>
                            <textarea class="p-3" name="Job_reqs" rows="4" cols="50"></textarea>
                        </div>   
                    </div>
                    <div class="d-grid gap-2 col-3 mx-auto mt-3">
                            <button type="submit" name="save" class="btn btn-light btn-outline-dark btn-sm">Save</button>
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