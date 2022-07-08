<?php
include('includes/dbconnection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'Update Profile')
	{
        
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
    
        $query=mysqli_query($con,"select * from admin_tbl where id='$admin_id'");
        $row=mysqli_fetch_array($query);
        if($row > 0){

            $ret=mysqli_query($con,"update admin_tbl set firstName='$firstName',lastName='$lastName' where id='$admin_id'");
            if($ret){
                $profileMsg = '<div style="color:green">Profile Updated Successfully!</div>';
            }
            else{
                $profileMsg = '<div style="color:red">An Error Occured!</div>';
            }
        }
        else{
            $profileMsg = '<div style="color:red">An Error Occured!</div>';
        }
    }

    if($_POST["action"] == 'Update Password')
	{
        $currentPassword=$_POST['currentPassword'];
        $newpassword=$_POST['newPassword'];
        $conPassword=$_POST['conPassword'];
    
        $query=mysqli_query($con,"select * from admin_tbl where id='$admin_id' and password='$currentPassword'");
        $row=mysqli_fetch_array($query);
        if($row > 0){

            if($newpassword == $conPassword){
                
                $rett=mysqli_query($con,"update admin_tbl set password='$newpassword' where id='$admin_id'");
                if($rett){
                    $message = '<div style="color:green">Password Changed Successfully!</div>';
                }
                else{
                    $message = '<div style="color:red">An Error Occured!</div>';
                }
            }
            else{
                $message = '<div style="color:red">Password MisMatch!</div>';
            }
        }
        else{
            $message = '<div style="color:red">Incorrect Password!</div>';
        }
    }
}

$que=mysqli_query($con,"select * from admin_tbl where id ='$admin_id'");
$retsss=mysqli_fetch_array($que);    
//all branch

?>