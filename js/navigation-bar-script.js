window.addEventListener("popstate", function () {
  const params = new URLSearchParams(window.location.search);
  const page = params.get("page") || "dashboard";

  const pages = {
    dashboard: "dashboard.php",
    "issue-number": "issue-number.php",
    settings: "settings.php",
  };

  const file = pages[page];

  if (!file) {
    return;
  }

  fetch(`../pages/${file}`)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("page-content").innerHTML = html;
    })
    .catch((error) => {
      console.error(error);
    });
});
