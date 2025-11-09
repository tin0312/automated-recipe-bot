async function updateMain(htmlContent) {
    const main = document.getElementById("main-content");
    main.style.opacity = '0';
    await new Promise(r => setTimeout(r, 200));
    main.innerHTML = htmlContent;
    main.style.opacity = '1';
}

function toggleField(id, showOff, showOn) {
    let field = document.getElementById(id);
    let iconId = id + 'Icon';
    let icon = document.getElementById(iconId);
    const colorOn = getComputedStyle(document.documentElement).getPropertyValue('--show-icon-color').trim();
    const colorOff = getComputedStyle(document.documentElement).getPropertyValue('--hide-icon-color').trim();

    if (field.type === "password") {
        field.type = "text";
        icon.classList.add(showOff);
        icon.classList.remove(showOn);
        icon.style.color = colorOn;
    } else {
        field.type = "password";
        icon.classList.add(showOn);
        icon.classList.remove(showOff);
        icon.style.color = colorOff;
    }
}



