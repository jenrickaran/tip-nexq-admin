const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function (event) {
  const username = document.getElementById("username");
  const password = document.getElementById("password");

  const usernameError = document.getElementById("usernameError");
  const passwordError = document.getElementById("passwordError");

  const loginButton = document.getElementById("loginButton");
  const loginIcon = document.getElementById("loginIcon");
  const loginText = document.getElementById("loginText");
  const loginSpinner = document.getElementById("loginSpinner");

  let valid = true;

  // Reset errors
  username.classList.remove("border-red-500");
  password.classList.remove("border-red-500");

  usernameError.classList.add("hidden");
  passwordError.classList.add("hidden");

  // Validate username
  if (username.value.trim() === "") {
    username.classList.add("border-red-500");
    usernameError.classList.remove("hidden");
    valid = false;
  }

  // Validate password
  if (password.value.trim() === "") {
    password.classList.add("border-red-500");
    passwordError.classList.remove("hidden");
    valid = false;
  }

  // Stop form submission if invalid
  if (!valid) {
    event.preventDefault();

    // Make sure button remains clickable
    loginButton.disabled = false;

    return;
  }

  // Everything is valid
  loginButton.disabled = true;

  loginIcon.classList.add("hidden");
  loginText.textContent = "Logging in...";
  loginSpinner.classList.remove("hidden");
});
