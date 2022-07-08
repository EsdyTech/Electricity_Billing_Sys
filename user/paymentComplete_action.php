<?php
include('includes/dbconnection.php');

if(isset($_GET["reference"]) && isset($_GET["amount"]) && isset($_GET["billId"]))
{
	$reference = $_GET["reference"];$amount = $_GET["amount"];$billId = $_GET["billId"];

    $qurre=mysqli_query($con,"select * from transaction_tbl where userId ='$user_id' and billId = '$billId' and referenceNo = '$reference'");
    $redsdt=mysqli_fetch_array($qurre);
    if($redsdt == 0){
        
        $quertTran=mysqli_query($con,"insert into transaction_tbl(userId,billId,referenceNo,amount,datePaid,status,dateCreated) 
        value('$user_id','$billId','$reference','$amount','$currentDate','Paid','$currentDate')");
        if ($quertTran) {

            $qyuryupd=mysqli_query($con,"update bill_tbl set status = 'Paid' where id = '$billId'");
            if ($qyuryupd) {
                $message ='<div style="color:green">Electricity Payment Was Successful</div>';
            }
            else
            {
                $message = '<div style="color:red">An Error Occured!</div>';
            }
        }
        else
        {
            $message = '<div style="color:red">An Error Occured!</div>';
        }
    }

    //pull the records from the transactions table
    $retsss=mysqli_query($con,"SELECT users_tbl.accountNo,users_tbl.firstName,users_tbl.lastName,users_tbl.emailAddress,
    bill_tbl.description,bill_tbl.consumption,bill_tbl.tariffRate,bill_tbl.amount as billAmount,bill_tbl.status as billStatus,
    bill_tbl.id,bill_tbl.billDate,bill_tbl.dueDate,bill_tbl.dateCreated,
    transaction_tbl.userId,transaction_tbl.billId,transaction_tbl.referenceNo,transaction_tbl.amount as tranAmount,transaction_tbl.datePaid,
    transaction_tbl.status as tranStatus, transaction_tbl.dateCreated as tranDateCreated
    from transaction_tbl
    INNER JOIN users_tbl ON users_tbl.id = transaction_tbl.userId
    INNER JOIN bill_tbl ON bill_tbl.id = transaction_tbl.billId
    where billId = '$billId' and transaction_tbl.userId = '$user_id'");
    $row=mysqli_fetch_array($retsss);
}
else{

    echo "<script type = \"text/javascript\">
    window.location = (\"currentBill.php\");
    </script>";
}

?>