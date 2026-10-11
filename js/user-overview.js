(function () {
  const view = document.getElementById("userManagementView");

  function closeMenus(exceptMenu) {
    view.querySelectorAll("[data-action-menu]").forEach((menu) => {
      if (menu !== exceptMenu) menu.classList.add("hidden");
    });
    view.querySelectorAll("[data-action-toggle]").forEach((btn) => {
      if (!exceptMenu || btn.nextElementSibling !== exceptMenu) {
        btn.setAttribute("aria-expanded", "false");
      }
    });
  }

  view.addEventListener("click", (e) => {
    /* --- Action (three dots) toggle --- */
    const toggle = e.target.closest("[data-action-toggle]");
    if (toggle) {
      const menu = toggle.nextElementSibling;
      const isOpen = !menu.classList.contains("hidden");
      closeMenus();
      if (!isOpen) {
        menu.classList.remove("hidden");
        toggle.setAttribute("aria-expanded", "true");
      }
      return;
    }

    /* --- Password show/hide --- */
    const pwToggle = e.target.closest("[data-password-toggle]");
    if (pwToggle) {
      const span = pwToggle.closest("td").querySelector("[data-password]");
      const shown = span.dataset.shown === "true";
      span.textContent = shown ? "••••••••" : span.dataset.value;
      span.dataset.shown = String(!shown);
      return;
    }

    /* --- Menu item clicked --- */
    const item = e.target.closest("[data-action-menu] button");
    if (item) {
      const action = item.dataset.action;
      const row = item.closest("tr");
      const username = row.children[3].textContent.trim();
      console.log(action, username); // <-- replace with real logic
      closeMenus();
      return;
    }

    closeMenus();
  });

  document.addEventListener("click", (e) => {
    if (!view.contains(e.target)) closeMenus();
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMenus();
  });
})();
