<?php


include_once "../../includes/session.inc.php";


// DATA EXTRACTION LOOP 
foreach ($_POST as $key => $value) {
    $$key = $value;
}

// check CSFR 
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
    $response = [
        'code' => 404,
        'message' => 'Invalid form',
        'data' => ''
    ];

    echo json_encode($response);
}

echo "VALID FORM";