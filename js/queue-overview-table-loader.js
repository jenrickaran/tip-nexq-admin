document.addEventListener("click", async function (event) {
  const button = event.target.closest(".queue-page-btn");

  if (!button) return;

  event.preventDefault();

  const page = button.dataset.page;

  const queueContainer = document.getElementById("queueOverview");
  const loader = document.getElementById("queueOverviewLoader");

  if (!queueContainer || !loader) {
    return;
  }

  // Show loading
  loader.classList.remove("hidden");
  loader.classList.add("flex");

  // Disable pagination buttons while loading
  document
    .querySelectorAll(".queue-page-btn")
    .forEach((btn) => (btn.disabled = true));

  try {
    const response = await fetch(
      `/admin/pages/queue-overview-content.php?queue_page=${page}`,
      {
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      },
    );

    if (!response.ok) {
      throw new Error(`Failed to load queue page: ${response.status}`);
    }

    const html = await response.text();

    queueContainer.innerHTML = html;
  } catch (error) {
    console.error("Queue pagination error:", error);
  } finally {
    // Hide loading
    loader.classList.add("hidden");
    loader.classList.remove("flex");

    // Re-enable buttons
    document
      .querySelectorAll(".queue-page-btn")
      .forEach((btn) => (btn.disabled = false));
  }
});
