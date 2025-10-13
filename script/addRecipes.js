import { updateMain } from "./general.js";


export async function addRecipes() {
  const html = `
       <a href="#">Home</a>
       <form id="add_recipes_form">
  <input id="recipe-name" type="text" name="name" placeholder="Recipe Name" required>
  <input id="recipe-video-url" type="text" name="name" placeholder="Video Instruction URL" required>
  <textarea id="recipe-description" name="description" placeholder="Description"></textarea>
  <input id= "recipe-main-ingredient" type="text" name="main_ingredient" placeholder="Main Ingredient">
  <textarea id="recipe-instruction" name="instructions" placeholder="Instructions" required></textarea>
  

  <label>Meal Type</label>
  <select id="meal-type" required>
    <<option value="">Select an option</option>
    <option value="1">Breakfast</option>
    <option value="2">Lunch</option>
    <option value="3">Dinner</option>
    <option value="4">Snack</option>
    <option value="5">Dessert</option>
  </select>

  <label>Cuisine</label>
  <select id="cuisine" required>
    <option value="">Select an option</option>
    <option value="6">Vietnamese</option>
    <option value="7">Japanese</option>
    <option value="8">Italian</option>
    <option value="9">Mexican</option>
    <option value="10">American</option>
  </select>

  <label>Main Ingredient (Category)</label>
  <select id="main-ingredient" required>
    <option value="">Select an option</option>
    <option value="11">Beef</option>
    <option value="12">Chicken</option>
    <option value="13">Pork</option>
    <option value="14">Fish</option>
    <option value="15">Vegetables</option>
  </select>

  <label>Dietary Preference</label>
  <select id="dietary-preference">
    <option value="">Select an option</option>
    <option value="20">Keto</option>
    <option value="21">Vegan</option>
    <option value="22">Vegetarian</option>
    <option value="23">Gluten-Free</option>
  </select>

  <button type="submit">Add Recipe</button>
</form>

    `;

  await updateMain(html);

  const form = document.getElementById('add_recipes_form');


  const request = new XMLHttpRequest();

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const recipeName = document.getElementById('recipe-name')?.value.trim() || '';
    const recipDescription = document.getElementById('recipe-description')?.value.trim() || '';
    const recipeMainIngredient = document.getElementById('recipe-main-ingredient')?.value.trim() || '';
    const recipeInstructions = document.getElementById('recipe-instruction')?.value.trim() || '';
    const recipeVideoUrl = document.getElementById('recipe-video-url')?.value.trim() || '';
    const mealType = document.getElementById('meal-type')?.value.trim() || '';
    const cuisine = document.getElementById('cuisine')?.value.trim() || '';
    const mainIngredient = document.getElementById('main-ingredient')?.value.trim() || '';
    const dietaryPreference = document.getElementById('dietary-preference')?.value.trim() || '';

    request.open("POST", "/automated-recipe-bot/api/recipes/addRecipes.api.php", true);
    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        //  const response = JSON.parse(this.responseText);
        console.log(this.responseText); // "Hello from the API!"              
      }
    }

    const formData = new FormData();
    formData.append("recipe-name", recipeName);
    formData.append("recipe-description", recipDescription);
    formData.append("recipe-main-ingredient", recipeMainIngredient);
    formData.append("recipe-instructions", recipeInstructions);
    formData.append("recipe-video-url", recipeVideoUrl);
    formData.append("meal-type", mealType);
    formData.append("cuisine", cuisine);
    formData.append("main-ingredient", mainIngredient);
    formData.append("dietary-preference", dietaryPreference);

    request.send(formData)
  })
}
