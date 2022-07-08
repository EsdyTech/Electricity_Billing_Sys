<?php
include('includes/dbconnection.php');
include('mailer.php');

date_default_timezone_set('Africa/Lagos');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'Generate Bills')
	{
        extract($_POST);
        $countarr = count($userId);
        $yearAndMonthGenerated = date('Y-m', strtotime($currentDate));
        
        for($i = 0; $i < $countarr; $i++){

            $queRate=mysqli_query($con,"select * from rate_tbl where id ='1'");
            $retyRt=mysqli_fetch_array($queRate);

            $tariffRate = $retyRt['rate']; //defined tariff rate for elcetricity consumption
            $amount = $consumption[$i] * $tariffRate; //amount to be paid by the user/consumer

            $dayReg = date('d', strtotime($dateReg[$i]));  //date user registers
            $curYr = date('Y'); //current year
            $curMnth = date('m');  //current month
            $billdate = $curYr.'-'.$curMnth.'-'.$dayReg; //concantenate the current year month and the day the user registers to get when the billing day will start

            $billdate = date('Y-m-d', strtotime($billdate));
            $dueDate = date('Y-m-d', strtotime($billdate. ' 1 months')); //add one month to calculate for the due date
            $description = "This Bill is for the energy used in ".date('F', strtotime($billdate))." ".date('Y', strtotime($billdate));

            $quess=mysqli_query($con,"select * from bill_tbl where userId ='$userId[$i]' and billDate = '$billdate'");
            $retss=mysqli_fetch_array($quess);
            if($retss > 0){
                
                $quy=mysqli_query($con,"update bill_tbl set userId = '$userId[$i]',description = '$description',consumption = '$consumption[$i]',tariffRate = '$tariffRate',
                amount = '$amount',status = 'Pending',billDate = '$billdate',dueDate = '$dueDate', dateCreated = '$currentDate' 
                where userId ='$userId[$i]' and billDate = '$billdate' and status = 'Pending'");
                if ($quy) {
                    $message ='<div style="color:green">Electricity Bills For this Month Were generated Successfully!</div>';
                }
                else
                {
                    $message = '<div style="color:red">An Error Occured!</div>';
                }
            }
            else{

                $query1=mysqli_query($con,"insert into bill_tbl(userId,description,consumption,tariffRate,amount,status,billDate,dueDate,dateCreated) 
                value('$userId[$i]','$description','$consumption[$i]','$tariffRate','$amount','Pending','$billdate','$dueDate','$currentDate')");
                if ($query1) {
                    //send mail to user for electricity bill goes here
                    $subject = "ELECTRICITY BILLING MANAGEMENT SYSTEM";
                    $body = 'Dear '.$userFullName[$i].', <br><br>';
                    $body .= $description.'<br><br>';
                    $body .= 'Consumption : '.$consumption[$i].' KWH. <br>';
                    $body .= 'Tarrif Rate : '.$tariffRate.'. <br>';
                    $body .= 'Amount : '.$amount.'. <br>';
                    $body .= 'Bill Date : '.$billdate.'. <br>';
                    $body .= 'Due Date : '.$dueDate.'. <br><br>';
                    $body .= 'Warm Regards';
                    $resp = sendMail($subject,$body,$emailAddress[$i]);
                    if($resp){
                        $message ='<div style="color:green">Electricity Bills For this Month Were generated Successfully, and Notification Mail was Sent to Users!!</div>';   
                    }
                    else{
                        $message ='<div style="color:green">Electricity Bills For this Month Were generated Successfully!</div>';
                    }
                }
                else
                {
                    $message = '<div style="color:red">An Error Occured!</div>';
                }
            }

            //echo $units[$i]."<br>";
        }
        

        //echo date('d', strtotime($dateReg[1]));
        $newTime = $dateReg[1];
        $dayReg = date('d', strtotime($dateReg[1]));
        //echo $dayReg.'<br>';

        $curYr = date('Y');
        $curMnth = date('m');

        $billdate = $curYr.'-'.$curMnth.'-'.$dayReg;

        $from = date('Y-m-d', strtotime($billdate));
        $to = date('Y-m-d', strtotime($from. ' 1 months'));

        // echo  $from.'<br>';
        // echo  $to.'<br>';

        //$from = date('Y-m-d', strtotime($dateReg[1]. ' - 3 months'));

       

         $date = "2021-11-01";
        $newDate = date('Y-m-d', strtotime($dateReg[1]. ' - 3 months'));
  
        //echo $newDate;
    }
}

if(isset($_GET["delid"]))
{
	$delid = $_GET['delid'];
    $quea=mysqli_query($con,"select * from bill_tbl where id ='$delid'");
    $retr=mysqli_fetch_array($quea);
    if($retr > 0){

        $qdlt = mysqli_query($con,"DELETE FROM bill_tbl WHERE id ='$delid'");
        if ($qdlt) {
            $message ='<div style="color:green">Electricity Bill Deleted Successfully!</div>';
        }
    }
}


?>