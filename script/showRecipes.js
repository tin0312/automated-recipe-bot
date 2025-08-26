import { updateMain } from "../functions/general.js";

export async function showRecipes() {
    const html = `<div>
        <h1>List of recipes</h1>
   </div>`;

    await updateMain(html)
}

