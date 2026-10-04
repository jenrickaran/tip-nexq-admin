document.getElementById("username").addEventListener("input", function () {
  if (this.value.trim() !== "") {
    this.classList.remove("border-red-500");
    document.getElementById("usernameError").classList.add("hidden");
  }
});

document.getElementById("password").addEventListener("input", function () {
  if (this.value.trim() !== "") {
    this.classList.remove("border-red-500");
    document.getElementById("passwordError").classList.add("hidden");
  }
});
