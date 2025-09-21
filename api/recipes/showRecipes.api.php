<?php

require_once "../../classes/dbconnect.class.php";


try {
    $db = new DbConnect("automated_recipe_bot");
    $pdo = $db->connect();

    $sql = "SELECT * FROM recipes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            "success" => true,
            "message" => "Recipes retrieved successfully",
            "data" => $row
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "No recipes found",
            "data" => []
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Internal Server Error" . $e->getMessage(),
        "data" => []
    ]);
}
