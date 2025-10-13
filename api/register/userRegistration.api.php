<?php


include_once "../../includes/session.inc.php";
include_once "../../functions/validations.func.php";


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
}

