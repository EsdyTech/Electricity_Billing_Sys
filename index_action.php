<?php
include('admin/includes/dbconnection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'Sign in')
	{
        extract($_POST);
        
        $que=mysqli_query($con,"select * from admin_tbl where emailAddress ='$emailAddress' and password = '$password'");
        $ret=mysqli_fetch_array($que);
        if($ret > 0){
            session_start();
            $_SESSION['admin_id'] = $ret['id'];
            $_SESSION['admin_emailAddress'] = $ret['emailAddress'];
            $_SESSION['admin_fullname'] = $ret['firstName'].' '. $ret['lastName'];

            echo "<script type = \"text/javascript\">
            window.location = (\"admin/index.php\");
            </script>";
        }
        else{

            $quea=mysqli_query($con,"select * from users_tbl where emailAddress ='$emailAddress' and password = '$password'");
            $reta=mysqli_fetch_array($quea);
            if($reta > 0){

                session_start();
                $_SESSION['user_id'] = $reta['id'];
                $_SESSION['user_emailAddress'] = $reta['emailAddress'];
                $_SESSION['user_fullname'] = $reta['firstName'].' '. $reta['lastName'];
    
                echo "<script type = \"text/javascript\">
                window.location = (\"user/index.php\");
                </script>";
            }
            else{

                $message ='<br><div style="color:red;" class="text-center font-weight-light">Invalid Username/Password!</div>';
            }
        }
    }

    if($_POST["action"] == 'Register')
	{
        extract($_POST);
        date_default_timezone_set('Africa/Lagos');
        $currentDate = date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));

        if($password == $confirmPassword){

            $que=mysqli_query($con,"select * from users_tbl where emailAddress ='$emailAddress'");
            $ret=mysqli_fetch_array($que);
            if($ret > 0){
                $signUpMsg = '<div style="color:red">This Email Address"'.$emailAddress.'" Already Exists!</div>';
            }
            else{
    
                $accountNo = rand(10,100).'/'.rand(10,100).'/'.rand(10,100).'/'.rand(10,100).'-'.rand(10,10000);
                $query=mysqli_query($con,"insert into users_tbl(accountNo,firstName,lastName,emailAddress,password,phoneNo,address,consumption,dateRegistered) 
                value('$accountNo','$firstName','$lastName','$emailAddress','$password','$phoneNo','$address','0','$currentDate')");
                if ($query) {
                    $signUpMsg ='<div style="color:green">Registered Successfully, Please kindly Login!</div>';
                }
                else
                {
                    $signUpMsg = '<div style="color:red">An Error Occured!</div>';
                }
            }
        }
        else{
            $signUpMsg = '<div style="color:red">Password does not Macth!</div>';
        }
        
    }
}

?>