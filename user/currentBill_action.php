<?php
include('includes/dbconnection.php');

$ret=mysqli_query($con,"SELECT users_tbl.accountNo,users_tbl.firstName,users_tbl.lastName,users_tbl.emailAddress,
bill_tbl.userId,bill_tbl.description,bill_tbl.consumption,bill_tbl.tariffRate,bill_tbl.amount,bill_tbl.status,
bill_tbl.id,bill_tbl.billDate,bill_tbl.dueDate,bill_tbl.dateCreated
from bill_tbl
INNER JOIN users_tbl ON users_tbl.id = bill_tbl.userId
where userId = '$user_id'and status = 'Pending'");
$row=mysqli_fetch_array($ret);

?>