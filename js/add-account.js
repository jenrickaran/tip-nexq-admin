const btn = document.getElementById("addAccountBtn");
const form = document.getElementById("addAccountForm");
const userManagementView = document.getElementById("userManagementView");

btn.addEventListener("click", () => {
  form.classList.remove("hidden");
  userManagementView.classList.add("hidden");
});
