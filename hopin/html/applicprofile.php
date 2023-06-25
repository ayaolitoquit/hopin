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
                    <h6>Sample Name</h6>
                    <p>Role</p>
            </div>
                
        </div>
    </div>
    
    <!-- content -->
            <section class="main container">
                <div class="content">
                    <div class="edit">
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-black" href="#"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-danger" href="#"><i class="fa-regular fa-trash-can"></i></a>                    
                    </div>
                    <div class="headd">
                    <div class="profile">
                        <img src="..\images\blankprofile.png" class="rounded-circle" alt="#">
                    </div>
                    <div class="name">
                        <p class="text-align-start fs-4">Marc Justin Olimverio Olimverio</p>
                    </div>
                    <div class="status ">
                        <h2>Status</h2>
                        <p class="fs-2">Applicant</p>
                    </div>
                    <div class="current ">
                        <h2>Current Job</h2>
                        <p class="fs-2">---------</p>
                    </div>
                </div>
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
                        <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quos cumque molestias porro maxime veritatis eaque neque eligendi necessitatibus odit, commodi qui ex dicta quaerat vero rem, aspernatur impedit numquam, ipsa possimus voluptatem voluptates. Consequuntur cumque, fuga doloribus laudantium eligendi blanditiis quas mollitia enim aperiam perferendis, harum sapiente impedit sequi.</p>
                    </div>

                </div>

            </section>

    
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>