<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail(
    string $to,
    string $subject,
    string $body
): bool {
    $mail = new PHPMailer();

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your Gmail
        $mail->Password = 'your-app-password';      // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom('your-email@gmail.com', 'Your Name');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->isHTML(false);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
