document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("nextCustomerForm");
  const button = document.getElementById("nextCustomerButton");
  const loader = document.getElementById("nextCustomerLoader");

  if (!form || !button || !loader) {
    console.error("NEXT customer elements not found.");
    return;
  }

  form.addEventListener("submit", async (event) => {
    // IMPORTANT: Prevent the browser from navigating
    event.preventDefault();

    loader.classList.remove("hidden");
    loader.classList.add("flex");

    button.disabled = true;
    button.classList.add("opacity-50", "cursor-not-allowed");

    try {
      // Call next customer controller
      const response = await fetch(form.action, {
        method: "POST",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          Accept: "application/json",
        },
      });

      if (!response.ok) {
        throw new Error("Failed to call next customer.");
      }

      const data = await response.json();

      console.log("NEXT response:", data);

      if (!data.success) {
        alert(data.message);
        return;
      }

      // Refresh dashboard data
      await refreshDashboard();

      // Refresh queue overview if the function exists
      if (typeof refreshQueueOverview === "function") {
        await refreshQueueOverview();
      }
    } catch (error) {
      console.error("NEXT customer error:", error);
      alert("Unable to call the next customer.");
    } finally {
      loader.classList.add("hidden");
      loader.classList.remove("flex");

      button.disabled = false;
      button.classList.remove("opacity-50", "cursor-not-allowed");
    }
  });
});

async function refreshDashboard() {
  const response = await fetch(
    "../app/controller/dashboardDataController.php",
    {
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        Accept: "application/json",
      },
    },
  );

  if (!response.ok) {
    throw new Error("Failed to refresh dashboard.");
  }

  const data = await response.json();

  document.getElementById("ticketNo").textContent = data.ticketNo;

  document.getElementById("waitingCount").textContent = data.waitingCount;

  document.getElementById("totalIssued").textContent = data.totalIssued;

  document.getElementById("totalServed").textContent = data.totalServed;

  document.getElementById("stillWaiting").textContent = data.stillWaiting;

  document.getElementById("averageWaitTime").textContent =
    data.averageMinutes + " min";
}
