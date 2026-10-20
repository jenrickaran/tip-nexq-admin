document.addEventListener("click", async function (event) {
  const button = event.target.closest('[data-action="suspend"]');

  if (!button) return;

  const userId = button.dataset.userId;
  const username = button.dataset.username;

  if (!confirm(`Are you sure you want to suspend "${username}"?`)) {
    return;
  }

  button.disabled = true;

  try {
    const response = await fetch("../app/model/suspend-user.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        user_id: userId,
      }),
    });

    const result = await response.json();

    if (!response.ok || !result.success) {
      throw new Error(result.message || "Failed to suspend user.");
    }

    alert(result.message);

    // Refresh the table to show the updated status.
    window.location.reload();
  } catch (error) {
    alert(error.message || "An unexpected error occurred.");
    button.disabled = false;
  }
});
