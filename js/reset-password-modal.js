(function () {
  const modal = document.getElementById("resetPasswordModal");
  const form = document.getElementById("resetPasswordForm");
  const userIdInput = document.getElementById("resetUserId");
  const usernameEl = document.getElementById("resetUsername");
  const feedback = document.getElementById("resetFeedback");
  const submitBtn = document.getElementById("resetSubmitBtn");

  function openModal(userId, username) {
    userIdInput.value = userId;
    usernameEl.textContent = username;
    form.reset();
    feedback.classList.add("hidden");
    feedback.textContent = "";
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    setTimeout(() => document.getElementById("newPassword").focus(), 50);
  }

  function closeModal() {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  }

  // Open modal when a "Reset Password" action is clicked
  document.addEventListener("click", (e) => {
    const resetBtn = e.target.closest('[data-action="reset"]');
    if (!resetBtn) return;
    openModal(resetBtn.dataset.userId, resetBtn.dataset.username);
  });

  // Close modal via Cancel or X
  modal.addEventListener("click", (e) => {
    if (e.target.closest("[data-modal-close]") || e.target === modal) {
      closeModal();
    }
  });

  // Escape key closes modal
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !modal.classList.contains("hidden")) closeModal();
  });

  // Toggle password visibility inside the modal
  modal.querySelectorAll("[data-toggle-pw]").forEach((btn) => {
    btn.addEventListener("click", () => {
      const input = document.getElementById(btn.dataset.togglePw);
      input.type = input.type === "password" ? "text" : "password";
    });
  });

  // Submit via fetch
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    console.log("=== SUBMIT START ===");

    const newPw = document.getElementById("newPassword").value;
    const confirmPw = document.getElementById("confirmPassword").value;

    if (newPw !== confirmPw) {
      showFeedback(false, "Passwords do not match.");
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = "Saving...";

    const RESET_URL = "../app/controller/resetPassword.php";
    console.log("Fetching:", RESET_URL);

    try {
      const fd = new FormData(form);
      console.log("FormData entries:", [...fd.entries()]);

      const res = await fetch(RESET_URL, {
        method: "POST",
        body: fd,
      });

      console.log("Response status:", res.status, res.statusText);
      console.log("Response URL:", res.url);
      console.log("Content-Type:", res.headers.get("content-type"));

      const raw = await res.text();
      console.log("RAW RESPONSE:", raw);

      let data;
      try {
        data = JSON.parse(raw);
      } catch (parseErr) {
        console.error("JSON parse failed:", parseErr);
        showFeedback(false, "Server returned non-JSON: " + raw.slice(0, 200));
        return;
      }

      if (data.success) {
        showFeedback(true, data.message);
        setTimeout(closeModal, 1200);
      } else {
        showFeedback(false, data.message || "Something went wrong.");
      }
    } catch (err) {
      console.error("=== FETCH FAILED ===");
      console.error("Error name:", err.name);
      console.error("Error message:", err.message);
      console.error("Full error:", err);
      showFeedback(false, "Error: " + err.message);
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = "Save New Password";
    }
  });

  function showFeedback(success, message) {
    feedback.textContent = message;
    feedback.classList.remove(
      "hidden",
      "bg-green-50",
      "text-green-700",
      "bg-red-50",
      "text-red-700",
    );
    if (success) {
      feedback.classList.add("bg-green-50", "text-green-700");
    } else {
      feedback.classList.add("bg-red-50", "text-red-700");
    }
  }
})();
