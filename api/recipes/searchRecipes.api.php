<?php
ini_set('log_errors', 1);
error_reporting(E_ALL);

require_once "../../classes/dbconnect.class.php";

$db = new DbConnect("automated_recipe_bot");

$pdo = $db->connect();


$search_input = $_POST["searchInput"];

$search_input = json_decode($_POST["searchInput"], true);



$mainIngredient = $search_input["mainIngredient"] ?? null;
$cuisine = $search_input["cuisine"] ?? null;
$mealType = $search_input["mealType"] ?? null;
$diet = $search_input["diet"] ?? null;
$keywords = $search_input["keywords"] ?? [];


// create query with placeholder
$sql = "SELECT * from categories WHERE name = :name";

// create statement and use pdo to prepare
$stmt = $pdo->prepare($sql);

//execute by binding with parameters
$stmt->execute(['name' => $mainIngredient]);

// fetch all rows as associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$category_id = $row["id"];

// Join categories and recipe_to_category on c.id = rc.category_id
// get recipe id

$sql = "SELECT recipe_to_category.recipe_id from recipe_to_category WHERE category_id = :category_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['category_id' => $category_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// get recipe details with recipe id 

$recipe_id = $row["recipe_id"];

$sql = "SELECT * from recipes WHERE id = :recipe_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['recipe_id' => $recipe_id]);
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($row);

exit();










