<?php


include_once "../../includes/session.inc.php";


$currentTime = round(microtime(true) * 1000);

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

// Honey pot - prevent bot spam
if ((strlen($random_field) >= 1) || ($currentTime - $timestamp) < 10) {
    $response = [
        'code' => 105,
        'message' => 'Invalid form',
        'data' => ''
    ];

    echo json_encode($response);
}