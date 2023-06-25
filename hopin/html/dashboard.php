<?php 
include("../connections.php");
// session_start();
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
  $result = $connections->query($sql);

  // if ($result && $result->num_rows > 0) {
  //     $row = $result->fetch_assoc();
  //     return $row["Job_status"];
  // }

  return "Unknown";
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="..\css\dashboard.css " />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Hopin</title>
  </head>

  <body>
    <!-- sidebar -->
    <div
      class="sidebar d-flex flex-column flex-shrink-0 p-3"
      style="width: 280px"
    >
      <img class="logo-sidebar" src="..\images\Logo.png" alt="" />

      <ul class="nav nav-pills flex-column mb-auto mt-1 fw-bold">
        <li class="nav-item my-3">
          <a
            href="..\html\dashboard.php"
            class="nav-link active d-flex align-items-center justify-content-center"
            aria-current="page"
          >
            Dashboard
          </a>
        </li>
        <li class="nav-item my-3">
          <a href="..\html\applicants.php" class="nav-link link-dark">
            Applicants
          </a>
        </li>
        <li class="nav-item my-3">
          <a href="..\html\jobs.php" class="nav-link link-dark"> Jobs </a>
        </li>
        <li class="nav-item my-3">
          <a href="..\html\account.php" class="nav-link link-dark">
            Account
          </a>
        </li>
      </ul>

      <div class="custom-div row">
        <div class="col-4 iconUser-container">
          <img
            class="iconUser d-flex justify-content-center align-items-center mt-2"
            src="..\images\svg\icnUser.png"
            alt=""
          />
        </div>
        <div
          class="col-8 d-flex justify-content-center flex-column flex-grow-1 mt-2 userDetails"
        >
          <h6>Sample Name</h6>
          <p>Role</p>
        </div>
      </div>
    </div>

      <!-- content -->
      <div class="content">
        <div class="d-flex flex-row">
          <div class="bg-success">
            <h5 class="text-white fw-bold text-center mt-2">TOTAL APPLICANTS</h5>
            <div class="applicants-overview d-flex justify-content-center text-white pt-2" id="totalApplicants">
              <?php 
              // echo isset($_SESSION['totalApplicants']) ? $_SESSION['totalApplicants'] : 0; 
              $dash_applicants_query = "SELECT * FROM applicants";
              $dash_applicants_query_run = mysqli_query($connections,$dash_applicants_query);
              if(mysqli_num_rows($dash_applicants_query_run)){
                echo mysqli_num_rows($dash_applicants_query_run);
              }else{
                echo 'No data';
              }


              ?>
          </div>
          </div>
          <div class="bg-success">
            <h5 class="text-white text-center fw-bold mt-2">INTERVIEWING</h5>
            <div class="applicants-overview d-flex justify-content-center text-white pt-2" id="totalInterviewing">
            <?php
              $dash_interviewing_query = "SELECT * FROM jobs WHERE Job_status = 'Interviewing'";
              $dash_interviewing_query_run = mysqli_query($connections,$dash_interviewing_query);
              if(mysqli_num_rows($dash_interviewing_query_run)){
                echo mysqli_num_rows($dash_interviewing_query_run);
              }else{
                echo 'No data';
              }
              ?>
            </div>
          </div>
          <div class="bg-success">
            <h5 class="text-white text-center fw-bold mt-2">HIRED</h5>
            <div class="applicants-overview d-flex justify-content-center text-white pt-2">
            <?php
              $dash_filled_query = "SELECT * FROM jobs WHERE Job_status = 'Filled'";
              $dash_filled_query_run = mysqli_query($connections,$dash_filled_query);
              if(mysqli_num_rows($dash_filled_query_run)){
                echo mysqli_num_rows($dash_filled_query_run);
              }else{
                echo 'No data';
              }
              ?>
            </div>
            
          </div>
        </div>
        <div class="process">
          <div class="d-flex flex-row">
            <div class="recent-applications">
              <h5 class="text-center fw-bold mt-3">RECENT APPLICATIONS</h5>
              <div class="d-flex flex-row text-center m-2 justify-content-center">
                <table>
                <thead class="custom-color">
                  <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Job</th>
                      <th scope="col">Date</th>
                      <th scope="col">Contract</th>
                      <th scope="col">Status</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM applicants ORDER BY Applicant_id DESC LIMIT 2";
                $result = $connections->query($sql);
                

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr onclick="redirectToPage('applicprofile.php')">
                            <td><?php echo $row["Applicant_name"]; ?></td>
                            <td><?php echo $row["Applicant_email"]; ?></td>
                            <td><?php echo $row["Applicant_job"]; ?></td>
                            <td><?php echo date("Y-m-d"); ?></td>
                            <td><?php echo getJobContract($row["Applicant_job"]); ?></td>
                            <td><?php echo getJobStatus($row["Applicant_job"]); ?></td>
                            
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No applicants found.</td></tr>";
                }
                ?>
                </tbody>

                </table>
              </div>
            </div>
            <div class="job-opening">
              <h5 class="text-center fw-bold mt-2">JOB OPENINGS</h5>
              <div class="job-openings-container d-flex flex-column text-center justify-content-center">
                <div class="full-time d-flex flex-column text-center justify-content-center">
                  <p>Full-Time</p>
                  <div class="job-openings-overview">
                  <?php
                    $dash_fulltime_query = "SELECT * FROM jobs WHERE Job_contract = 'Full-time'";
                    $dash_fulltime_query_run = mysqli_query($connections,$dash_fulltime_query);
                    $fulltime_count = mysqli_num_rows($dash_fulltime_query_run);
                    if(mysqli_num_rows($dash_fulltime_query_run)){
                      echo mysqli_num_rows($dash_fulltime_query_run);
                    }else{
                      echo 'No data';
                    }
                  ?>
                  </div>
                </div>
                <div class="part-time d-flex flex-column text-center justify-content-center">
                  <p>Part-Time</p>
                  <div class="job-openings-overview d-flex justify-content-center align-items-center">
                  <?php
                    $dash_parttime_query = "SELECT * FROM jobs WHERE Job_contract = 'Part-time'";
                    $dash_parttime_query_run = mysqli_query($connections,$dash_parttime_query);
                    $parttime_count = mysqli_num_rows($dash_parttime_query_run);
                    if(mysqli_num_rows($dash_parttime_query_run)){
                      echo mysqli_num_rows($dash_parttime_query_run);
                    }else{
                      echo '0';
                    }
                  ?>
                  </div>
                </div>
                <div class="internship d-flex flex-column text-center justify-content-center">
                  <p>Internship</p>
                  <div class="job-openings-overview">
                  <?php
                    $dash_internship_query = "SELECT * FROM jobs WHERE Job_contract = 'Internship'";
                    $dash_internship_query_run = mysqli_query($connections,$dash_internship_query);
                    $internship_count = mysqli_num_rows($dash_internship_query_run);
                    if(mysqli_num_rows($dash_internship_query_run)){
                      echo mysqli_num_rows($dash_internship_query_run);
                    }else{
                      echo '0';
                    }

                    $data = [
                      'labels' => ["Full-time", "Part-time", "Internship"],
                      'datasets' => [
                          [
                              'data' => [$fulltime_count, $parttime_count, $internship_count],
                              'backgroundColor' => ["#617A55", "#A4D0A4", "#F7E1AE"],
                          ],
                      ],
                  ];
                  
                  // Convert the PHP array to a JSON string
                  $json_data = json_encode($data);
                  ?>
                  </div>
                </div>
                

                
                
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Donut Chart Starts here -->
      <div class="donutChart position-absolute">
        <div class="container">
          <h3 class="fw-bold text-center text-muted">Type of Employees</h3>
        <canvas id="donutChart"></canvas>
        </div>
        <script>
    var data = <?php echo $json_data; ?>;

    // Create a donut chart
    var ctx = document.getElementById("donutChart").getContext("2d");
    var donutChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: "bottom",
                    align: 'start',
                },
            },
            animation: {
                animateRotate: true,
                animateScale: true,
            },
        },
    });
</script>
      </div>
      <!-- Donut Chart Ends Here -->

      <!-- Bar Graph Starts Here -->
      <div class="barGraph position-absolute">
        <div class="container">
          <div class="chart-container">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
        <script>
          // Data for the bar graph
          var labels = ['Accounting', 'Admin', 'Customer Service', 'Customer Support', 'Finance', 'HR', 'IT', 'Marketing', 'R&D', 'Sales'];
          var data = [30, 50, 70, 40, 90, 20, 80, 60, 10, 50];
      
          // Create the bar graph
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Data',
                data: data,
                backgroundColor: 'rgba(164, 208, 164, 1)',
                borderColor: 'rgba(97, 122, 85, 1)',
                borderWidth: 2
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 10,
                    max: 100
                  }
                }
              }
            }
          });
        </script>
      </div>
      <!-- Bar Graph Ends Here -->

    <!-- Javascript -->
    <script src="../js/index.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    >
  </script>
  </body>
</html>
