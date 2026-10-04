function togglePassword() {
  const password = document.getElementById("password");
  const eyeIcon = document.getElementById("eyeIcon");

  if (password.type === "password") {
    // Show password → normal eye
    password.type = "text";

    eyeIcon.innerHTML = `
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-3.057-9.542-7z"
            />
            <circle
                cx="12"
                cy="12"
                r="3"
                stroke-width="2"
            />
        `;
  } else {
    // Hide password → eye with slash
    password.type = "password";

    eyeIcon.innerHTML = `
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 3l18 18M10.584 10.587a2 2 0 002.829 2.828M9.88 4.09A9.77 9.77 0 0112 4c4.477 0 8.268 2.943 9.542 7a10.08 10.08 0 01-4.132 5.411M6.228 6.228C4.54 7.45 3.245 9.124 2.458 12c1.274 4.057 5.065 7 9.542 7 1.02 0 2.005-.16 2.923-.46"
            />
        `;
  }
}
