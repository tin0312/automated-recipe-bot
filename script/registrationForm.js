function registrationForm() {
  //open the modal
  document.getElementById('modalOverlay').classList.add('active');

  const modal = document.getElementById("modal");

  const closeBtn = document.getElementById('closeModal');
  modal.innerHTML = '';
  modal.appendChild(closeBtn);

  // create sign up form
  const registrationForm = `
        <form id="sign-up" action="http://localhost/automated-recipe-bot/api/register/userRegistration.api.php" method="POST">
          <input type="hidden" name="csrf_token" value= '${csrfToken}'/> 
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
          </div>
          
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" required minlength="5" maxlength="30"
                   oninput="this.value = this.value.replace(/[^\p{L}\p{M}\s.,''-]/gu, '').replace(/\s{2,}/g, ' ').replace(/^[.,''\s-]+/, '')"
                   >
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required minlength="5" maxlength="30"
                  oninput="this.value = this.value.replace(/[^\p{L}\p{M}\s.,''-]/gu, '').replace(/\s{2,}/g, ' ').replace(/^[.,''\s-]+/, '')"
            >
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required minlength="8">
            <i id="passwordIcon" class="fa-regular fa-eye toggle-icon" onclick="toggleField('password','fa-eye-slash','fa-eye')"></i>
            <ul id="passwordRequirements" style="list-style: none; padding: 0; font-size: 12px;">
              <li id="lengthCheck" style="color:  var(--password-strength-weak);"><i class="fa-solid fa-square-xmark"></i> <span>At least 8 characters</span></li>
              <li id="capitalCheck" style="color:  var(--password-strength-weak);"><i class="fa-solid fa-square-xmark"></i> <span>One uppercase letter</span></li>
              <li id="numberCheck" style="color:  var(--password-strength-weak);"><i class="fa-solid fa-square-xmark"></i> <span>One number</span></li>
              <li id="specialCheck" style="color:  var(--password-strength-weak);"><i class="fa-solid fa-square-xmark"></i> <span>One special character</span></li>
            </ul>
          </div>

          <div class="form-group">
            <label for="confirm_password">Re-type Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
            <i id="confirm_passwordIcon" class="fa-regular fa-eye toggle-icon" onclick="toggleField('confirm_password','fa-eye-slash','fa-eye')"></i>
          </div>
          
          <input class="hny" id="mobilenumber" type="text" name="random_field"  autocomplete="off">
		      <input type="hidden" name="timestamp" value= '${Date.now()}'>


          <button type="submit" class="btn-submit">Sign Up</button>  
        </form>  
          `;
  modal.insertAdjacentHTML('beforeend', registrationForm);
  return registrationForm;
}
