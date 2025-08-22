<?php
ini_set('log_errors', 1);
error_reporting(E_ALL);

require_once "../classes/dbconnect.class.php";

$db = new DbConnect("automated_recipe_bot");

$search_input = $_POST['searchInput'];
