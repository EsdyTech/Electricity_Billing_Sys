<?php
include('includes/dbconnection.php');

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'Save')
	{
        extract($_POST);
        $query=mysqli_query($con,"update rate_tbl set rate = '$rate',dateModified = '$currentDate' where id = 1");
        if ($query) {
            $message ='<div style="color:green">Electricity Rate Updated Successfully!</div>';
        }
        else
        {
            $message = '<div style="color:red">An Error Occured!</div>';
        }
    }
}

    $querr=mysqli_query($con,"select * from rate_tbl where id ='1'");
    $ratee=mysqli_fetch_array($querr);
    
?>