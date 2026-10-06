const menuButton = document.getElementById("menuButton");
const mobileNav = document.getElementById("mobileNav");

menuButton.addEventListener("click", () => {
  mobileNav.classList.toggle("hidden");

  const isOpen = !mobileNav.classList.contains("hidden");

  menuButton.setAttribute("aria-expanded", isOpen);
});
