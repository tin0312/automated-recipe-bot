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
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required minlength="3" maxlength="30">
          </div>
          
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">
          </div>

          <div class="form-group">
            <label for="confirm_password">Re-type Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
          </div>
          
          <input class="hny" id="mobilenumber" type="text" name="random_field"  autocomplete="off">
		      <input type="hidden" name="timestamp" value= '${Date.now()}'>


          <button type="submit" class="btn-submit">Sign Up</button>  
        </form>  
          `;
  modal.insertAdjacentHTML('beforeend', registrationForm);
  return registrationForm;
}
