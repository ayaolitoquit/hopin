<?php
include("../connections.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $applicantjob = $_POST["applicantjob"];

    // File Upload
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $fileData = file_get_contents($_FILES['fileInput']['tmp_name']);

        // Escape special characters in the file data
        $fileData = $connections->real_escape_string($fileData);
    } else {
        // Handle file upload error or lack of file input
        // You can redirect or display an error message here
        // For example:
        die("Error uploading file.");
    }

    $sql = "INSERT INTO applicants (Applicant_name, Applicant_email, Applicant_job, fileInput)
            VALUES ('$fullname','$email','$applicantjob','$fileData')";

    if (!$connections) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($connections->query($sql) === true) {
        header("Location: applicants.php");
        echo "New applicant added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $connections->error;
    }

    // Check if query execution was successful
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jobContract = $row["Job_contract"];
            echo "<option value='$jobContract'>$jobContract</option>";
        }
    } else {
        echo "<option value=''>No contracts found</option>";
    }

    $connections->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\applicantnew.css">
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
                    <h6>Sample Name</h6>
                    <p>Role</p>
            </div>
                
        </div>
    </div>
    
    <!-- content -->
    <section class="main container position-absolute mt-1">
        <div class="content">
            <div>
                <h2>Create Profile</h2>
                <form id="uploadForm" method="POST" action="applicantsnew.php" enctype="multipart/form-data" >
                    <div class="input">
                        <div>
                            <h5>Full Name</h5>
                            <input type="text" name="fullname" id="fullname" required>
                        </div>
                        <div>
                            <h5>Email</h5>
                            <input type="text" name="email" id="email" required>
                        </div>
                        <div>
                            <h5>Applying for:</h5>
                            <select name="applicantjob" id="applicantjob" class="form-select">
                                <?php 
                                $sql = "SELECT DISTINCT Job_title FROM jobs WHERE Job_status = 'Active'";
                                $result = mysqli_query($connections, $sql);
                                
                                // Check if query execution was successful
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $jobTitle = $row["Job_title"];
                                        echo "<option value='$jobTitle' selected>$jobTitle</option>";
                                    }
                                } else {
                                    echo "<option value=''>No jobs found</option>";
                                }
                                
                                // Close the database connection
                                mysqli_close($connections);
                                ?>
                                </select>
                        </div>
                        <div>
                            
                            <h5>Contract</h5>
                            <select name="jobcontract" id="jobcontract" class="form-select">
                                <?php
                                include("../connections.php");

                                // Fetch job contracts with active status from the jobs table
                                $sql = "SELECT DISTINCT Job_contract FROM jobs WHERE Job_status = 'active'";
                                $result = mysqli_query($connections, $sql);

                                // Check if query execution was successful
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $jobContract = $row["Job_contract"];
                                        echo "<option value='$jobContract' selected>$jobContract</option>";
                                    }
                                } else {
                                    echo "<option value=''>No active job contracts found</option>";
                                }

                                // Close the database connection
                                mysqli_close($connections);
                                ?>
                            </select>
                        </div>
   
                            </select>
                        </div>

                        
                        <div class=" resume">
                            <input type="file" name="fileInput" id="fileInput" required>
                            <!-- <input type="submit" value="Upload"> -->
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