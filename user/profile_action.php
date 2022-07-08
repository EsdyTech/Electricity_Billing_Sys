<?php
include('includes/dbconnection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'Update Profile')
	{
        extract($_POST);
    
        $query=mysqli_query($con,"select * from users_tbl where id='$user_id'");
        $row=mysqli_fetch_array($query);
        if($row > 0){

            $ret=mysqli_query($con,"update users_tbl set firstName='$firstName',lastName='$lastName',phoneNo='$phoneNo',address='$address' where id='$user_id'");
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
        extract($_POST);
        $query=mysqli_query($con,"select * from users_tbl where id='$user_id' and password='$currentPassword'");
        $row=mysqli_fetch_array($query);
        if($row > 0){

            if($newPassword == $conPassword){
                
                $rett=mysqli_query($con,"update users_tbl set password='$newPassword' where id='$user_id'");
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

$que=mysqli_query($con,"select * from users_tbl where id ='$user_id'");
$retsss=mysqli_fetch_array($que);;    
//all branch

?>