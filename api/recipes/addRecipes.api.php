<?php

require_once "../../classes/dbconnect.class.php";

$db = new DbConnect("automated_recipe_bot");
$pdo = $db->connect();

$sql = "INSERT INTO recipes (name, description, main_ingredient, instructions, video_url) 
VALUES (:name, :description, :main_ingredient, :instructions, :video_url)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":name" => $_POST["recipe-name"],
    ":description" => $_POST["recipe-description"],
    ":main_ingredient" => $_POST["main-ingredient"],
    ":instructions" => $_POST["recipe-instructions"],
    ":video_url" => $_POST["recipe-video-url"],
]);



// Get the ID of the newly inserted recipe
$recipeId = $pdo->lastInsertId();

// 2️⃣ Insert into `recipe_to_category`
$categories = [
    $_POST["meal-type"] ?? null,
    $_POST["cuisine"] ?? null,
    $_POST["main-ingredient"] ?? null,
    $_POST["dietary-preference"] ?? null
];

// Filter out any empty/null selections
$categories = array_filter($categories);

if (!empty($categories)) {
    $sql = "INSERT INTO recipe_to_category (recipe_id, category_id) VALUES ";
    $placeholders = [];
    $params = [];

    foreach ($categories as $index => $catId) {
        $placeholders[] = "(:recipe_id, :cat$index)";
        $params[":cat$index"] = $catId;
    }
    $params[":recipe_id"] = $recipeId;

    $sql .= implode(", ", $placeholders);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

echo json_encode(["status" => "success", "recipe_id" => $recipeId]);
?>