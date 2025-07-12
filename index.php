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
        <a href="http://localhost/automated-recipe-bot/signup.php">Get started</a>
        <a href="http://localhost/automated-recipe-bot/login.php">Sign In</a>
    </header>
    <main>
        <section class="prompt-container">
            <h1>What should we eat today?</h1>
            <form>
                <label>
                    <input type="text" name="user-input" />
                </label>
                <input type="submit" value="Send" />
            </form>
        </section>
        <section class="result-display-wrapper">
            <div class="result-display-container">
                <p id="not-found-message"></p>
            </div>
        </section>
    </main>
    <script>
        document.querySelector('form').addEventListener('submit', async function (e) {
            e.preventDefault();
            const userInput = this.querySelector('input[name="user-input"]').value;
            try{
                 const response = await fetch('http://localhost/automated-recipe-bot/api/queryRecipes.php', {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 'user-input': userInput })
            })
            const data = await response.json();

            const container = document.querySelector('.result-display-container');
            let notFoundMessage = document.getElementById("not-found-message")
            container.innerHTML = ''; 
                if (data.status === 'success' && Array.isArray(data.results)) {
                    data.results.forEach(recipe => {
                        // Create elements
                        const h1 = document.createElement('h1');
                        h1.textContent = recipe.name;
                        h1.style.cursor = 'pointer';
                
                        const authorName = document.createElement('p');
                        authorName.textContent = `By: ${recipe.by_who}`;

                        const recipeLocation = document.createElement('p');
                        recipeLocation.textContent = `Location: ${recipe.location}`;

                        container.appendChild(h1);
                        container.appendChild(authorName);
                        container.appendChild(recipeLocation);
                    });
                } else if (data.status === 'not_found') {
                   notFoundMessage.textContent = data.message;
                } else {
                    not_found.textContent = 'Internal Server Error';
                }

            } catch (error) {
                console.error('Fetch error:', error);
                alert('Failed to fetch recipes. Please try again.');
            }
        }); 
    </script>
</body>

</html>