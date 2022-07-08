<?php
include('includes/dbconnection.php');

if(isset($_GET["upid"]))
{
	$upid = $_GET['upid'];
    $que=mysqli_query($con,"select * from complaint_tbl where id ='$upid'");
    $ret=mysqli_fetch_array($que);
    if($ret > 0){

        $query = mysqli_query($con,"update complaint_tbl set status = 'Treated', dateTreated = '$currentDate' WHERE id ='$upid'");
        if ($query) {
            $message ='<div style="color:green">Complaint Updated Successfully!</div>';
        }
    }
}

?>