<!DOCTYPE html>
<html lang="eng">
<head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
        <title>CookGPT - Login</title>
</head>
        <body>
        <header class="back-to-home">
            <p><a href="http://localhost/automated-recipe-bot"><span class="material-symbols-outlined">
arrow_back
</span> CookGPT</a></p>
        </header>
            <main>
                <section class="login-container">
                    <h1>Log in</h1>
                     <form method="POST" action="http://localhost/automated-recipe-bot/api/queryRecipes.php">
                         <label>Username or Email<br/>
                             <input type="text" name="user-id"/>
                         </label>
                         <label>
                             Password<br/>
                             <input type="password" name="password"/>
                         </label>
                         <input type="submit" value="Submit"/>
                     </form>
                    <p>Don't have an account yet? <span><a href="http://localhost/automated-recipe-bot/signup.php">Sign up here</a></span></p>
                </section>
            </main>
        </body>

</html>

