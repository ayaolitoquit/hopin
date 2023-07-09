<?php 
include("check_session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("../connections.php");

// $sql = "SELECT * FROM jobs";
// $result = $connections->query($sql);

// $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filtervalues = "";
if(isset($_GET['search'])){
    $filtervalues = $_GET['search'];
    $sql = "SELECT * FROM jobs WHERE Job_title LIKE '%$filtervalues%'";
    $result = $connections->query($sql);

}else{
    $sql = "SELECT * FROM jobs";
    $result = $connections->query($sql);
}
    if ($result->num_rows > 0) {
        $firstRow = true;
        
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
    <link rel="stylesheet" href="..\css\jobs.css">
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
    <section class="main container">
        <div class="content">
            <div class="total d-flex align-items-center">
                <div class="jo">
                    <p class="jobs fs-5">Total Jobs: <span id="totaljobs"></span></p>
                </div>
                <div class="vac">
                    <p class="vacant fs-5">Vacant: <span id="vacant"></span></p>
                </div>
                <form class="searchForm" action="" method ="GET">
                    <div class="search-container">
                        <input class="searchInput" type="text" placeholder="Search" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                        <button class="searchButton" type="Search">🔍︎</button>
                    </div>
                    
                </form>
                <!-- <input type="text" id="search" name="search" placeholder="🔍︎"> -->
                <a class="addNew link-offset-2 link-offset-3-hover text-decoration-none text-black fw-bold" href="jobnew.php">
                    <i class="bi bi-plus-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg></i>
                    Add New
                </a>
            </div>
            <div >
                <table class="table table-bordered border-dark ">
                    <thead class="custom-color">
                        <tr >
                            <th scope="col">No.</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Contract</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col">Requirements</th>
                            <th class="tablink" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        $counter = 0;
                        $countActiveJobs = 0; //vacant
                        while ($row = $result->fetch_assoc()) {
                            $counter++;
                            if ($row["Job_status"] === "Active" || $row["Job_status"] === "Reopened") {
                                $countActiveJobs++;
                            }
                            if ($firstRow) {
                                $id = $row['Job_id'];
                                $firstRow = false;
                            }

                                
                            
                        
                            ?>
                            <!-- onclick="redirectToPage('jobdesc.php')" -->
                            <tr id="<?php echo $row["Job_id"];?>">
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_id"]; ?></a>  </td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_title"]; ?></a>  </td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_salary"]; ?></a></td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_contract"]; ?><a></td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_status"]; ?></a></td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_desc"]; ?></a></td>
                                <td><a href="jobdesc.php?jobdescid=<?php echo $row["Job_id"]; ?>"><?php echo $row["Job_reqs"]; ?></a></td>
                                
                                <td class="tablink">
                                
                                <a href="updatejobs.php?updateid=<?php echo $row["Job_id"]; ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-black" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg></a>
                                

                                <a href="deletejobs.php?deleteid=<?php echo $row["Job_id"]; ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-danger" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg></a></td>
                            </tr>
                            
                            <?php
                            
                        
                        }

                        }
                        echo "<script>document.getElementById('vacant').textContent = $countActiveJobs;</script>";
                        echo "<script>document.getElementById('vacant').textContent = $countActiveJobs;</script>";
                    } else {
                        echo "<tr><td colspan='8'>No jobs found.</td></tr>";
                    }
                    mysqli_free_result($result);    
                    

                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        var totalJobsElement = document.getElementById('totaljobs');
                        totalJobsElement.textContent = <?php echo $counter; ?>;
                        });
                        </script>
                    </tbody> 
                </table>     
            </div>
        </div>


    </section>
    

    
    <!-- Javascript -->
    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</php>