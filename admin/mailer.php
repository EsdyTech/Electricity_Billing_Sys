<?php
require_once ('../php-mailer/PHPMailerAutoload.php');

function sendMail($subject,$body,$emailAddress){

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.elasticemail.com';
    $mail->Port = '2525';
    $mail->isHTML(true);
    $mail->Username ='Ahmedsodiq7@gmail.com';
    $mail->Password ='2D945A6DC2401D9D25477EA6BED0F7D323E9';
    $mail->SetFrom('no-reply@howcode.org');
    $mail->Subject = $subject;
    $mail->WordWrap = 50;
    $mail->Body = $body;
    $mail->AddAddress($emailAddress); //delivery email Address
    //$mail->AddAddress('michealakinkuotu73@gmail.com');
    // $mail->AddAddress('michealakinkuotu73@gmail.com');

    if($mail->Send()) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}
    
?>