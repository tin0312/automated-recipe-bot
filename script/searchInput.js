async function updateMain(htmlContent) {
    const main = document.getElementById("main-content");
    main.style.opacity = '0';
    await new Promise(r => setTimeout(r, 200)); // fade out
    main.innerHTML = htmlContent;
    main.style.opacity = '1'; // fade in
}


async function searchInput() {
    const html = `
        <section class="prompt-container">
            <h1>What should we eat today?</h1>
            <form>
                <label>
                    <input type="text" name="user-input" placeholder="Search for recipes..." />
                </label>
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
        request.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            const response = JSON.parse(this.responseText);
            console.log(response);
        }  
    }
    
    const formData = new FormData(); 
    formData.append("searchInput", userInput.value);

    request.send(formData)
    })
}
