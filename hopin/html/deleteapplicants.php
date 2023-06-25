<?php 
include("../connections.php");
// echo $deleteid;
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM applicants WHERE Applicant_id=$id";
    $result=mysqli_query($connections,$sql);

    if($result){
        header("Location:applicants.php");
    } else {
        die(mysqli_error($connections));
    }
}

?>