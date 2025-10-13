import { updateMain } from "./general.js";


// this route would show user's specific recipes 
function getRecipes() {
    const request = new XMLHttpRequest();
    request.open("POST", "/automated-recipe-bot/api/recipes/showRecipes.api.php");
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            const recipes = response.data
            let output = `<div class="recipes-wrapper"><h2>Recipes</h2>`;

            recipes.forEach(recipe => {
                output += `<div class="recipes-wrapper">
                            <div class="recipe-container">
                                <h4>Name: ${recipe.name}</h4>
                                <p>Description: ${recipe.description}</p>
                                <p>Main ingredient: ${recipe.main_ingredient}</p>
                                <p>Instruction: ${recipe.instructions}</p>
                                <p>Video URL: ${recipe.video_url}</p>
                            </div>
                        </div>`
            })
            output += `</div>`;
            updateMain(output);
        }
    }
    const formData = new FormData();
    request.send(formData);
}



export async function showRecipes() {
    getRecipes();
}