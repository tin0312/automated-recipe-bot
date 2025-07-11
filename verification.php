<?php
session_start();
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
    <title>CookGPT || 2-factor verification</title>
</head>
<body>
    <main>
        <section class="verification-container">
            <h1>Enter the code sent to <strong><?php echo $email?></strong></h1>
            <form method="POST" action="http://localhost/automated-recipe-bot/api/verifyUser.php">
                <label>
                    <input type="number" name="verification-code"/>
                </label>
                <input type="submit"/>
            </form>
        </section>
    </main>
</body>
</html>