document
  .getElementById("createUserForm")
  .addEventListener("submit", async (e) => {
    e.preventDefault();

    const form = e.target;
    const submitBtn = document.getElementById("createAccountBtn");
    const formMsg = document.getElementById("formMessage");

    // Clear old errors
    form.querySelectorAll(".error-msg").forEach((el) => (el.textContent = ""));
    formMsg.textContent = "";

    submitBtn.disabled = true;
    submitBtn.textContent = "Creating...";

    try {
      const res = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
      });
      const data = await res.json();

      if (data.success) {
        formMsg.textContent = data.message || "Account created successfully.";
        formMsg.className = "text-sm text-green-600";
        form.reset();

        // Optional: hide form / refresh list after a moment
        // setTimeout(() => {
        //     document.getElementById('addAccountForm').classList.add('hidden');
        //     document.getElementById('userManagementView').classList.remove('hidden');
        // }, 1200);
      } else if (data.errors) {
        // Show each error under its field
        Object.entries(data.errors).forEach(([field, message]) => {
          const slot = form.querySelector(`[data-error-for="${field}"]`);
          if (slot) slot.textContent = message;
        });
        formMsg.textContent = "Please fix the highlighted fields.";
        formMsg.className = "text-sm text-red-500";
      } else {
        formMsg.textContent = data.message || "Something went wrong.";
        formMsg.className = "text-sm text-red-500";
      }
    } catch (err) {
      console.error(err);
      formMsg.textContent = "Network error. Please try again.";
      formMsg.className = "text-sm text-red-500";
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = "Create Account";
    }
  });
