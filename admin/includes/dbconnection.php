<?php
$con=mysqli_connect("localhost", "root", "", "electricity_billing");
if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error(); 
}

?>