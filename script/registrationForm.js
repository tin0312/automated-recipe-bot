<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
    <title>CookGPT - Sign up</title>
</head>
<body>
<header class="back-to-home">
    <p><a href="http://localhost/automated-recipe-bot"><span class="material-symbols-outlined">
arrow_back
</span> CookGPT</a></p>
</header>
<main>
    <section class="signup-container">
        <h1>Sign up</h1>
        <form method="POST" action="http://localhost/automated-recipe-bot/api/signup.php">
            <label>
                Username <br/>
                <input type="text" name="username" required/>
            </label>
            <label>
                Full name <br/>
                <input type="text" name="full-name"/>
            </label>
            <label>
                Email<br/>
                <input type="email" name="email" required/>
            </label>~
            <label>
                Password<br/>
                <input type="password" name="password" required/>
            </label>
            <label>
                Confirm password<br/>
                <input type="password" name="password-confirm" required/>
            </label>
            <input type="submit" value="Submit"/>
        </form>
        <p>Have an account? <span><a href="http://localhost/automated-recipe-bot/login.php">Sign in here</a></span></p>
    </section>
</main>
</body>

</html>

