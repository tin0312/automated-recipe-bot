<?php
use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($email, $subject, $recipient, $message, $altBody)
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
        $mail->addAddress($email, $recipient);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $altBody;
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}