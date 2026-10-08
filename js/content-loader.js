window.addEventListener("load", function () {
  const loader = document.getElementById("pageLoader");

  if (!loader) return;

  loader.classList.add("opacity-0");

  setTimeout(() => {
    loader.remove();
  }, 300);
});
