<?php
include('includes/dbconnection.php');

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'Save')
	{
        extract($_POST);
        $que=mysqli_query($con,"select * from complainttype_tbl where typeName ='$typeName'");
        $ret=mysqli_fetch_array($que);
        if($ret > 0){
            $message = '<div style="color:red">This Complaint Type "'.$typeName.'" Already Exists!</div>';
        }
        else{

            $query=mysqli_query($con,"insert into complainttype_tbl(typeName,dateCreated) 
            value('$typeName','$currentDate')");
            if ($query) {
                $message ='<div style="color:green">Complaint Added Successfully!</div>';
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
    $que=mysqli_query($con,"select * from complainttype_tbl where id ='$delid'");
    $ret=mysqli_fetch_array($que);
    if($ret > 0){

        $query = mysqli_query($con,"DELETE FROM complainttype_tbl WHERE id ='$delid'");
        if ($query) {
            $message ='<div style="color:green">Complaint Type Deleted Successfully!</div>';
        }
    }
}

?>