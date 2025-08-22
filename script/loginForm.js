function changeForm() {
    document.querySelector('.cont').classList.toggle('s-signup')
}


function loginForm() {
    const login = `<form id="companyForm" onsubmit="return false; checkCompany()">
                <label for="code">
                    <span data-translate="Customer Code"></span>
                </label>
                <input type="text" class="text-upper text-center" maxlength="8" name="code" id="code" onkeyup="countChars('code');" style="width: 180px; font-size: 1.8em; text-align: center; font-weight: bold;" /><br>
                <button type="submit" id="nextButton" class="next text-capital boxShadow2" style="margin-top: 20px;" onclick="checkCompany();">
                    <span style="flex: 1; text-align: center;" data-translate="Next"></span>
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </form>

            <p class="forgot-pass" data-translate="If you can't remember your customer code, please email us at <a href='mailto:info@expattaxtools.com'>info@expattaxtools.com</a>"></p>`;
    updateText('loginForm', login, "code");
}
