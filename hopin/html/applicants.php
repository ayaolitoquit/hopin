    <?php

    // TO DO:
    //applicant status: Under review, For interview, Hired
    include('check_session.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../connections.php");

    if ($connections->connect_error) {
        die("Connection failed: " . $connections->connect_error);
    }

    $filtervalues = "";
    if(isset($_GET['search'])){
        $filtervalues = $_GET['search'];
        $sql = "SELECT * FROM applicants WHERE Applicant_name LIKE '%$filtervalues%'";
        $result = $connections->query($sql);

    }else{
        $sql = "SELECT * FROM applicants";
        $result = $connections->query($sql);
    }



    function getJobContract($jobcontract) {
        global $connections;

        $jobcontract = $connections->real_escape_string($jobcontract);

        $sql = "SELECT * FROM jobs WHERE Job_title = '$jobcontract'";
        $result = $connections->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["Job_contract"];
        }else {
            return "N/A";
        }
    }

    function getJobStatus($statusId) {
        global $connections;

        //statusId = Job_title
        $statusId = $connections->real_escape_string($statusId);

        $sql = "SELECT Job_status FROM jobs WHERE Job_title = '$statusId'";
        // echo $statusId;
        $result = $connections->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $jobStatus = $row["Job_status"];
    
            if ($jobStatus === "Active" || $jobStatus === "Reopened") {
                return "Under Review";
            } else if ($jobStatus === "Filled") {
                return "Hired";
            } else if ($jobStatus === "Interviewing") {
                return "For Interview";
            } else {
                return "Unknown";
            }
        } else {
            return "Unknown";
        }
    }

    // $rowsToDelete = array();

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $jobContract = getJobContract($row["Applicant_job"]);
    //         if ($jobContract === "N/A") {
    //             $rowsToDelete[] = $row["Applicant_id"]; // Assuming there's an ID column in the table
    //         }
    //     }
    // }

    // // Delete the rows
    // if (!empty($rowsToDelete)) {
    //     $ids = implode(",", $rowsToDelete);
    //     $deleteQuery = "DELETE FROM applicants WHERE Applicant_id IN ($ids)";
    //     $connections->query($deleteQuery);
    // }


    if(isset($_GET['search'])){
        $filtervalues = $_GET['search'];
        $sql = "SELECT * FROM applicants WHERE Applicant_name LIKE '%$filtervalues%'";
        $result = $connections->query($sql);

    }else{
        $sql = "SELECT * FROM applicants";
        $result = $connections->query($sql);
    }

    $name_query = "SELECT * FROM login WHERE id = '".$_SESSION['USER_ID']."'";
    $name_query_run = mysqli_query($connections, $name_query);
    if($name_query_run->num_rows > 0){
        $row = $name_query_run->fetch_assoc();

    ?>

    <!-- Rest of your HTML code -->






    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="..\css\applicants.css">
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
        <section class="main">
            <div class="content">
                <div class="total d-flex align-items-center justify-content-between">
                    <div class="search-container">
                        <form class="searchForm" action="" method ="GET">
                            <input class="searchInput" type="text" placeholder="Search" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                            <button class="searchButton" type="Search">🔍︎</button>
                        </form>
                    </div>
                
                    <!-- <input type="text" name="search" placeholder="🔍︎"> -->
                    <div class="d-flex">
                        <a class="addNew link-offset-2 link-offset-3-hover text-decoration-none text-black mx-2 fw-bold" href="applicantsnew.php">
                        <i class="bi bi-plus-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg></i>
                        Add New
                    </a>
                    </div>
                </div>
                <div >
                <table class="table table-bordered border-dark">
                    <thead class="custom-color">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Job</th>
                            <th scope="col">Date</th>
                            <th scope="col">Contract</th>
                            <th scope="col">Status</th>
                            <th scope="col">Resume</th>
                            <th class="tablink" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // $_SESSION['totalApplicants'] = $result->num_rows;
                            while ($row = $result->fetch_assoc()) {
                                
                        ?>
                                <tr>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["Applicant_id"]; ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["Applicant_name"]; ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["Applicant_email"]; ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["Applicant_job"]; ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["Date_applied"]; ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo getJobContract($row["Applicant_job"]); ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo getJobStatus($row["Applicant_job"]); ?></a></td>
                                    <td><a href="applicprofile.php?applicantid=<?php echo $row["Applicant_id"]; ?>"><?php echo $row["fileInput"]; ?><</a>/td>
                                    <td class="tablink">
                                        <a href="updateapplicants.php?updateid=<?php echo $row["Applicant_id"]; ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a href="deleteapplicants.php?deleteid=<?php echo $row["Applicant_id"]; ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                        var totalApplicantsElement = document.getElementById('totalApplicants');
                                        totalApplicantsElement.textContent = <?php echo $counter; ?>;
                                        });
                                        
                                </script>
                        <?php
                            }
                        }else {
                            echo "<tr><td colspan='8'>No applicants found.</td></tr>";
                        }
                        ?>
                    </tbody>
        <tfoot>
        </tfoot>
    </table>

                </div>

            </div>


        </section>
        <!-- <script>function redirectToPage(url) {
        window.location.href = url;
    }</script> -->
        
        <!-- Javascript -->
        <script src="../js/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
    </html>