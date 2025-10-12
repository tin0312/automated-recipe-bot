function registrationForm() {
  // get the modal
  const modal = document.getElementById("modal");
  modal.classList.add("modal-open");
  document.getElementById("modal-overlay").classList.toggle("hidden");

  // create sign up form
  const registrationForm = `
        <form id="sign-up" action="http://localhost/automated-recipe-bot/api/register/userRegistration.api.php" method="POST">
          <input type="hidden" name="csrf_token" value= '${csrfToken}'/> 
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" required><br><br>
          
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" required minlength="3" maxlength="30"><br><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password" required minlength="8"><br><br>

          <label for="confirm_password">Re-type Password:</label><br>
          <input type="password" id="confirm_password" name="confirm_password" required minlength="8"><br><br>

          <button type="submit">Sign Up</button>  
        </form>  
          `;
  modal.innerHTML = registrationForm;
  return registrationForm;

}
