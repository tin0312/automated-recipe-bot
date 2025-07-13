<?php 

$userSearchInput = isset($_GET['user-input']) ? trim($_GET['user-input']) : '';

$apiUrl = 'http://localhost/automated-recipe-bot/api/queryRecipes.php';

$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(['user-input' => $userSearchInput])
    ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    // Log the raw response from the API
error_log("Raw API response: " . $response);

// Decode JSON
$data = json_decode($response, true);

// Log decoded array (pretty print)
error_log("Decoded API data: " . print_r($data, true));

?>

<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="./asset/css/style.css"/>
    </head>
    <header>
        <a href="index.php">Back to Home</a>
    </header>
    <main>
        <h1>Result for "<?php echo htmlspecialchars($userSearchInput)?>"</h1>
        <div class="result-display-container">
            <?php if($data['status'] === 'success' && !empty($data['results'])): ?>
                <?php foreach($data['results'] as $recipe) : ?>
                        <h2><?php echo htmlspecialchars($recipe['name']); ?></h2>
                        <p><strong>By:</strong> <?php echo htmlspecialchars($recipe['author']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($recipe['location']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($recipe['category']); ?></p>
                <?php endforeach; ?>         
            <?php else: ?>
                <p>No result found for "<?php echo htmlspecialchars($userSearchInput); ?>"</p>
            <?php endif; ?>        
        </div>
    </main>
</html>

