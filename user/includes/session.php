
<?php
include('dbconnection.php');
session_start(); 
date_default_timezone_set('Africa/Lagos');
$currentDate = date("Y-m-d H:i:s",  STRTOTIME(date('h:i:sa')));

if (isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];

    $que=mysqli_query($con,"select * from users_tbl where id ='$user_id'");
    $ret=mysqli_fetch_array($que);
}
else{
  echo "<script type = \"text/javascript\">
  window.location = (\"../index.php\");
  </script>";

}
// $expiry = 1800 ;//session expiry required after 30 mins
// if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {

//     session_unset();
//     session_destroy();
//     echo "<script type = \"text/javascript\">
//           window.location = (\"../index.php\");
//           </script>";

// }
// $_SESSION['LAST'] = time();
    
?>
