import { updateMain } from "./general.js";

export async function searchInput() {
    const html = `
        <section class="prompt-container">
            <h1 id="prompt-title">What should we eat today?</h1>
            <form>
                <input id ="user-input" type="text" name="user-input" placeholder="Search for recipes..." />
                <input type="submit" value="Send" disabled />
            </form>
        </section>
        <div id="results"></div>
    `;

    await updateMain(html);

    const promptContainer = document.querySelector(".prompt-container");
    const promptTitle = document.getElementById("prompt-title");
    const userInput = document.querySelector('#main-content input[type="text"]');
    const submitBtn = document.querySelector('#main-content input[type="submit"]');
    const form = document.querySelector('#main-content form');
    const resultsContainer = document.querySelector("#main-content #results");
    userInput.addEventListener("input", () => {
        submitBtn.disabled = userInput.value.trim() === "";
    });

    const mainIngredientsSet = new Set(["beef", "chicken", "pork", "fish", "rice", "pasta", "vegetables"]);
    const cuisinesSet = new Set(["vietnamese", "japanese", "italian", "mexican", "american"]);
    const mealTypesSet = new Set(["breakfast", "lunch", "dinner", "snack", "dessert"]);
    const dietsSet = new Set(["vegan", "vegetarian", "gluten-free", "dairy-free", "keto"]);

    function getSearchInput(userInput) {
        const cleaned = userInput.toLowerCase().replace(/[^a-z0-9\s-]/gi, "");
        const words = cleaned.split(/\s+/);

        let result = {
            mainIngredient: null,
            cuisine: null,
            mealType: null,
            diet: null,
            keywords: []
        };

        for (const word of words) {
            if (!result.mainIngredient && mainIngredientsSet.has(word)) {
                result.mainIngredient = word;
                continue;
            }
            if (!result.cuisine && cuisinesSet.has(word)) {
                result.cuisine = word;
                continue;
            }
            if (!result.mealType && mealTypesSet.has(word)) {
                result.mealType = word;
                continue;
            }
            if (!result.diet && dietsSet.has(word)) {
                result.diet = word;
                continue;
            }
            result.keywords.push(word);
        }
        return result;
    }


    const request = new XMLHttpRequest();
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const userInput = document.getElementById("user-input");
        const searchInput = getSearchInput(userInput.value);
        request.open("POST", "../automated-recipe-bot/api/recipes/searchRecipes.api.php", true);
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const response = JSON.parse(this.responseText);
                if (!Array.isArray(response)) {
                    resultsContainer.innerHTML = "<p>No recipes found.</p>";
                    return;
                }
                promptContainer.classList.add("remove-top");
                promptTitle.classList.add("hidden");
                form.classList.add("search-form-change");
                let output = `<div class="recipes-wrapper"><h2>Recipes - Results</h2>`;
                response.forEach(recipe => {
                    output += `
                        <div class="recipe-container">
                            <h4>${recipe.name}</h4>
                            <p><strong>Description:</strong> ${recipe.description}</p>
                            <p><strong>Main ingredient:</strong> ${recipe.main_ingredient}</p>
                            <p><strong>Instructions:</strong> ${recipe.instructions}</p>
                            <p><a href="${recipe.video_url}" target="_blank">Watch Video</a></p>
                        </div>
                    `;
                });
                output += `</div>`;
                resultsContainer.innerHTML = output;
            }
        }

        const formData = new FormData();
        formData.append("searchInput", JSON.stringify(searchInput));

        request.send(formData)
    });
};

