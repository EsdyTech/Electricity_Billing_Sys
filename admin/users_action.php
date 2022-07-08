<?php
include('includes/dbconnection.php');

if(isset($_GET["delid"]))
{
	$delid = $_GET['delid'];
    $que=mysqli_query($con,"select * from users_tbl where id ='$delid'");
    $ret=mysqli_fetch_array($que);
    if($ret > 0){

        $query = mysqli_query($con,"DELETE FROM users_tbl WHERE id ='$delid'");
        if ($query) {
            $message ='<div style="color:green">User Deleted Successfully!</div>';
        }
    }
}

?>