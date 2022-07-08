<?php
include('includes/dbconnection.php');

if(isset($_GET["vid"]))
{
	$vid = $_GET["vid"];
}
else{

    echo "<script type = \"text/javascript\">
    window.location = (\"usersConsumptions.php\");
    </script>";
}

if(isset($_POST["action"]))
{
    if($_POST["action"] == 'Save')
	{
        extract($_POST);
        $query=mysqli_query($con,"update users_tbl set consumption = '$consumption' where id = '$vid'");
        if ($query) {
            $message ='<div style="color:green">User electricity Consumption Updated Successfully!</div>';
        }
        else
        {
            $message = '<div style="color:red">An Error Occured!</div>';
        }
    }
}

    $querr=mysqli_query($con,"select * from users_tbl where id ='$vid'");
    $consump=mysqli_fetch_array($querr);
    
?>