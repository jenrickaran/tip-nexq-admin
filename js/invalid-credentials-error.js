const errorModal = document.getElementById("errorModal");
const errorModalContent = document.getElementById("errorModalContent");

const urlParams = new URLSearchParams(window.location.search);

// Show modal if login failed
if (urlParams.get("error") === "invalid") {
  errorModal.classList.remove("hidden");
}

// Close modal
function closeErrorModal() {
  errorModal.classList.add("hidden");

  // Remove ?error=invalid from URL
  window.history.replaceState({}, document.title, window.location.pathname);
}

// Close when clicking outside the popup
errorModal.addEventListener("click", function (event) {
  if (event.target === errorModal) {
    closeErrorModal();
  }
});
