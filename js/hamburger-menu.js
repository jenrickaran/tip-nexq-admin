const menuButton = document.getElementById("menuButton");
const mobileNav = document.getElementById("mobileNav");

if (menuButton && mobileNav) {
  function closeMenu() {
    mobileNav.classList.add("-translate-x-[250px]");
    mobileNav.classList.remove("translate-x-0");
    menuButton.setAttribute("aria-expanded", "false");
  }

  function openMenu() {
    mobileNav.classList.remove("-translate-x-[250px]");
    mobileNav.classList.add("translate-x-0");
    menuButton.setAttribute("aria-expanded", "true");
  }

  // Hamburger button
  menuButton.addEventListener("click", function (event) {
    event.stopPropagation();

    const isOpen = !mobileNav.classList.contains("-translate-x-[250px]");

    if (isOpen) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  // Clicking inside the navigation should NOT close it
  mobileNav.addEventListener("click", function (event) {
    event.stopPropagation();
  });

  // Clicking anywhere outside the navigation closes it
  document.addEventListener("click", function (event) {
    if (
      !mobileNav.contains(event.target) &&
      !menuButton.contains(event.target)
    ) {
      closeMenu();
    }
  });
}
