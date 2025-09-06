import { updateMain } from "../functions/general.js";


// this route would show user's specific recipes 
let recipes = null;

function getRecipes() {
    const request = new XMLHttpRequest();
    request.open("POST", "/automated-recipe-bot/api/recipes/showRecipes.api.php");
    console.log("Gettinf the recipes...")
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            recipes = JSON.parse(this.responseText);

            const html = `<div class="recipes-wrapper">
            <div class="recipe-container">
                 <h1>List of recipes</h1>
        <h4>Name: ${recipes.name}</h4>
        <p>Description: ${recipes.description}</p>
        <p>Main ingredient: ${recipes.main_ingredient}</p>
        <p>Instruction: ${recipes.instructions}</p>
        <p>Video URL: ${recipes.video_url}</p>
            </div>
    </div>`
            updateMain(html)
        }
    }
    const formData = new FormData();
    formData.append("searchInput", "beef");
    request.send(formData);
}



export async function showRecipes() {
    getRecipes();
}