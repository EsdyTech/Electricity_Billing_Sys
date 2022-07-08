<?php
include('includes/dbconnection.php');

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'Save')
	{
        extract($_POST);
        $que=mysqli_query($con,"select * from complaint_tbl where userId ='$user_id' and billId = '$billId' and complaintTypeId = '$complaintTypeId'");
        $ret=mysqli_fetch_array($que);
        if($ret > 0){
            $message = '<div style="color:red">The Complaint for the selected bill and complaint Type Already Exists!</div>';
        }
        else{

            $query=mysqli_query($con,"insert into complaint_tbl(userId,billId,complaintTypeId,complaint,status,dateCreated,dateTreated) 
            value('$user_id','$billId','$complaintTypeId','$complaint','Pending','$currentDate','')");
            if ($query) {
                $message ='<div style="color:green">Complaint Created Successfully!</div>';
            }
            else
            {
                $message = '<div style="color:red">An Error Occured!</div>';
            }
        }
    }
}

if(isset($_GET["delid"]))
{
	$delid = $_GET['delid'];
    $que=mysqli_query($con,"select * from complaint_tbl where id ='$delid'");
    $ret=mysqli_fetch_array($que);
    if($ret > 0){

        $query = mysqli_query($con,"DELETE FROM complaint_tbl WHERE id ='$delid'");
        if ($query) {
            $message ='<div style="color:green">Complaint Deleted Successfully!</div>';
        }
    }
}

?>