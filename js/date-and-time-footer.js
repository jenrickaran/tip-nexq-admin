function updateDateTime() {
  const now = new Date();

  document.getElementById("current-date").textContent = now.toLocaleDateString(
    "en-PH",
    {
      year: "numeric",
      month: "long",
      day: "numeric",
    },
  );

  document.getElementById("current-time").textContent = now.toLocaleTimeString(
    "en-PH",
    {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      hour12: true,
    },
  );
}

updateDateTime();
setInterval(updateDateTime, 1000);
