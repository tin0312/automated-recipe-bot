async function updateMain(htmlContent) {
    const main = document.getElementById("main-content");
    main.style.opacity = '0';
    await new Promise(r => setTimeout(r, 200)); // fade out
    main.innerHTML = htmlContent;
    main.style.opacity = '1'; // fade in
}
