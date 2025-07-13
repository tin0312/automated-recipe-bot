<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>CookGPT</title>
</head>

<body>
    <header class="buttons-container">
        <a href="/">Get started</a>
        <a href="/">Sign In</a>
    </header>
    <main>
        <section class="prompt-container">
            <h1>What should we eat today?</h1>
            <form action="recipes_details.php" method="GET">
                <label>
                    <input type="text" name="user-input" placeholder="Search for recipes..."/>
                </label>
                <input type="submit" value="Send" />
            </form>
        </section>
    </main>
    <script>
    </script>
</body>

</html>