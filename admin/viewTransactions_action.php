<?php
include('includes/dbconnection.php');

if(isset($_GET["vid"]))
{
	$vid = $_GET["vid"];
}
else{

    echo "<script type = \"text/javascript\">
    window.location = (\"userTransactions.php\");
    </script>";
}

?>