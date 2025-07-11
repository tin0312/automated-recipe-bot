<!DOCTYPE html>
<html lang="eng">
<head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="./assets/css/style.css"/>
        <title>CookGPT</title>
</head>
        <body>
            <header class="buttons-container">
                <a href="http://localhost/automated-recipe-bot/signup.php">Get started</a>
                <a href="http://localhost/automated-recipe-bot/login.php">Sign In</a>
            </header>
            <main>
                <section class="prompt-container">
                    <h1>What should we eat today?</h1>
                     <form method="POST" action="http://localhost/automated-recipe-bot/api/queryRecipes.php">
                         <label>
                             <input type="text" name="user-input"/>
                         </label>
                         <input type="submit" value="Send"/>
                     </form>
                </section>
            </main>
        </body>
</html>