import { updateMain } from "../functions/general.js";


export async function searchInput() {
    const html = `
        <section class="prompt-container">
            <h1>What should we eat today?</h1>
            <form>
                <input type="text" name="user-input" placeholder="Search for recipes..." />
                <input type="submit" value="Send" disabled />
            </form>
        </section>
    `;

    await updateMain(html);

    const userInput = document.querySelector('#main-content input[type="text"]');
    const submitBtn = document.querySelector('#main-content input[type="submit"]');
    const form = document.querySelector('#main-content form');
    userInput.addEventListener("input", () => {
        submitBtn.disabled = userInput.value.trim() === "";
    });
    const request = new XMLHttpRequest();

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        request.open("POST", "../automated-recipe-bot/api/recipes/queryRecipes.api.php", true);
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const response = JSON.parse(this.responseText);
                console.log(response);
            }
        }

        const formData = new FormData();
        formData.append("searchInput", userInput.value);

        request.send(formData)
    })
};

