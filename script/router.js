import { searchInput } from "./searchInput.js";
import { addRecipes } from "./addRecipes.js";
import { showRecipes } from "./showRecipes.js"; // optional

function handleRoute() {
    const hash = window.location.hash.slice(1);
    switch (hash) {
        case "add-recipes":
            addRecipes();
            break;
        case "view-recipes":
            showRecipes();
            break;
        default:
            searchInput();
    }
}

window.addEventListener("load", handleRoute);
window.addEventListener("hashchange", handleRoute);
