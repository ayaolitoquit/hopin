<?php 
include("../connections.php");
// echo $deleteid;
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM jobs WHERE Job_id=$id";
    $result=mysqli_query($connections,$sql);

    if($result){
        header("Location:jobs.php");
    } else {
        die(mysqli_error($connections));
    }
}

?>