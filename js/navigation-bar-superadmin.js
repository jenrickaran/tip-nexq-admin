window.addEventListener("popstate", function () {
  const params = new URLSearchParams(window.location.search);
  const page = params.get("page") || "dashboard";

  const pages = {
    dashboard: "superadmin-dashboard.php",
    user: "superadmin-user.php",
  };

  const file = pages[page];

  if (!file) {
    return;
  }

  fetch(`../pages/${file}`)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("page-content-superadmin").innerHTML = html;
    })
    .catch((error) => {
      console.error(error);
    });
});
