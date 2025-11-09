<?php

include_once "../../includes/session.inc.php";
include_once "../../functions/validations.func.php";
require_once "../../classes/dbconnect.class.php";
include_once "../../functions/emailSender.func.php";
include_once "../../includes/constant.inc.php";
include_once "../../functions/functions.func.php";

$db = new DbConnect("automated_recipe_bot");
$pdo = $db->connect();


$currentTime = round(microtime(true) * 1000);

// Error message array
$error = [];

// DATA EXTRACTION LOOP 
foreach ($_POST as $key => $value) {
    $$key = $value;
}

// CHECK CSFR 
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
    $response = [
        'code' => 105,
        'message' => 'Invalid form',
        'data' => ''
    ];

    echo json_encode($response);
}

// PREVENT BOT SPAM BY HONEY POT
if ((strlen($random_field) >= 1) || ($currentTime - $timestamp) < 10) {
    $response = [
        'code' => 105,
        'message' => 'Invalid form',
        'data' => ''
    ];

    echo json_encode($response);
} else {
    // VALIDATE EMAIL
    emailValidation($email);

    //VALIDATE USERNAME IF AVAILABLE
    if ($username) {
        usernameValidation($username);
    }

    // VALIDATE PASSWORD
    passwordValidation($password);
    if ($password !== $confirm_password) {
        $error[] = 'Second Password did not match the First Password';
    } else {
        $password = password_hash(md5($password), PASSWORD_DEFAULT);
    }
}

if (count($error) > 0) {
    $response = [
        'code' => 104,
        'message' => 'Registration error occurred!',
        'data' => $error
    ];

    echo json_encode($response);
} else {
    // AFTER SUCESSFUL REGISTRATION
    // 1: Encrypt user data
    [$encrypted_username, $encrypted_username_hash] = encrypt($username);
    [$encrypted_email, $email_hash] = encrypt($email);

    $stmt = $pdo->prepare("SELECT count(*) AS `rows` from `user` WHERE `email_hash` = :email_hash");
    $stmt->execute(['email_hash' => $email_hash]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['rows'] > 0) {
        $response = [
            'code' => '105',
            'message' => 'Email already exists',
            'data' => ''
        ];

        echo json_encode($response);
        exit();
    }

    // Get user data to save as a JSON in the database
    $user_data = [
        'username' => $encrypted_username,
        'email' => $encrypted_email,
        'password' => $password
    ];

    $user_data = json_encode($user_data);

    try {
        // create verification code
        $activation_code = mt_rand(10000, 99999);

        $stmt = $pdo->prepare("INSERT INTO `temp_registration` (`activation_code`, `timestamp`, `user_data`) VALUES (:activation_code, current_timestamp(), :user_data)");
        $stmt->bindParam(":activation_code", $activation_code);
        $stmt->bindParam(":user_data", $user_data);

        $stmt->execute();
        $temp_id = $pdo->lastInsertId();

        // CREATE EMAIL TEMPLATE TO SEND REGISTRATION ACTIVATION CODE
        $subject = "CookGPT - Verify Email";
        $recipient = $username;
        $message = '
            <!DOCTYPE html>
            <html lang="en">
                <body>
                <div style="max-width: 40rem; margin: 0 auto;">
                    <p style="text-align: center;"><img src="" width="260" height="120" alt="logo"></p>
                    <br>
                    <p>Hello ' . $recipient . '</p>
                    <br>
                    <h1 style="text-align: center;">Activation code</h1>
                    <p style="text-align: center;"> Please use this code to complete the registration.</p>
                    <div style="text-align: center; font-size: 300%; font-weight: bold; margin-bottom: 20px;">' . $temp_id . $activation_code . '</div>
                </div>
                
                </body>    
            </html>';

        $altBody = "Hello " . $recipient . ",\n\nYour verification code is " . $temp_id . $activation_code . ".";

        if (sendEmail($email, $subject, $recipient, $message, $altBody)) {
            $response = [
                'code' => SUCCESS_CODE,
                'message' => 'Activation code has been sent to your email',
                'data' => ''
            ];
        } else {
            $response = [
                'code' => EMAIL_ERROR_CODE,
                'message' => 'There was an error sending activation code',
                'data' => ''
            ];
        }
        echo json_encode($response);
    } catch (Exception $e) {
        $response = [
            'code' => DATABASE_ERROR,
            'message' => 'Database error occured',
            'data' => ''
        ];
        echo json_encode($response);
    }
}