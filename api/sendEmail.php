<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
 function sendEmail($email, $fullName, $ranCode){
     $mail = new PHPMailer(true);
     try{
         $mail->isSMTP();
         $mail->Host = /** @lang text */
             'smtp.gmail.com';
         $mail->SMTPAuth = true;
         $mail->Username='justinhoang0312@gmail.com';
         $mail->Password='jrliycvzeqdsgggw';
         $mail->SMTPSecure = 'tls';
         $mail->Port = 587;

         // recipient
         $mail->setFrom('justinhoang0312@gmail.com', 'CookGPT');
         $mail->addAddress($email, $fullName);

         // Content
         $mail->isHTML(false);
         $mail->Subject = 'CookGPT - Verify Email';
         $mail->Body    = "Hello $fullName, \n\n Your verification code is $ranCode";
         $mail->send();
         echo "Message has been sent";
         return true;
     } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     }
 }