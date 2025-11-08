<?php
use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($email, $fullName, $ranCode)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = /** @lang text */
            'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['USER_EMAIL'];
        $mail->Password = $_ENV['USER_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // recipient
        $mail->setFrom('automatedrecipebot@gmail.com', 'CookGPT');
        $mail->addAddress($email, $fullName);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'CookGPT - Verify Email';
        $mail->Body = "Hello $fullName, \n\n Your verification code is $ranCode";
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}