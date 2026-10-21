(function () {
  document.querySelectorAll("[data-select]").forEach(function (root) {
    var trigger = root.querySelector("[data-select-trigger]");
    var menu = root.querySelector("[data-select-menu]");
    var valueEl = root.querySelector("[data-select-value]");
    var native = root.querySelector("select");
    var options = Array.prototype.slice.call(
      menu.querySelectorAll("[data-select-option]"),
    );
    var activeIndex = -1;

    function syncUI() {
      options.forEach(function (o) {
        o.dataset.selected =
          o.dataset.selectOption === native.value ? "true" : "false";
      });
      var current = options.find(function (o) {
        return o.dataset.selectOption === native.value;
      });
      if (current)
        valueEl.textContent = current.querySelector("span").textContent;
    }

    function highlight() {
      options.forEach(function (o, i) {
        o.dataset.active = i === activeIndex ? "true" : "false";
      });
    }

    function open() {
      menu.classList.remove("hidden");
      trigger.setAttribute("aria-expanded", "true");
      activeIndex = options.findIndex(function (o) {
        return o.dataset.selected === "true";
      });
      if (activeIndex < 0) activeIndex = 0;
      highlight();
    }

    function close() {
      menu.classList.add("hidden");
      trigger.setAttribute("aria-expanded", "false");
    }

    function choose(opt) {
      native.value = opt.dataset.selectOption;
      native.dispatchEvent(
        new Event("change", {
          bubbles: true,
        }),
      );
      syncUI();
      close();
      trigger.focus();
    }

    trigger.addEventListener("click", function (e) {
      e.stopPropagation();
      menu.classList.contains("hidden") ? open() : close();
    });

    trigger.addEventListener("keydown", function (e) {
      if (e.key === "ArrowDown" || e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        open();
      }
    });

    options.forEach(function (opt, i) {
      opt.addEventListener("click", function () {
        choose(opt);
      });
      opt.addEventListener("mouseenter", function () {
        activeIndex = i;
        highlight();
      });
    });

    menu.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        close();
        trigger.focus();
        return;
      }
      if (e.key === "ArrowDown") {
        e.preventDefault();
        activeIndex = (activeIndex + 1) % options.length;
        highlight();
      }
      if (e.key === "ArrowUp") {
        e.preventDefault();
        activeIndex = (activeIndex - 1 + options.length) % options.length;
        highlight();
      }
      if (e.key === "Enter") {
        e.preventDefault();
        choose(options[activeIndex]);
      }
    });

    document.addEventListener("click", function (e) {
      if (!root.contains(e.target)) close();
    });

    native.addEventListener("change", syncUI);
    syncUI();
  });
})();
