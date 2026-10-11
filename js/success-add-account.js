function openErrorModal(message) {
  const modal = document.getElementById("errorModal");
  if (message) {
    // The <p> inside the error modal — give it an id if it doesn't have one
    const msgEl = modal.querySelector("p");
    if (msgEl) msgEl.textContent = message;
  }
  modal.classList.remove("hidden");
}

function closeErrorModal() {
  document.getElementById("errorModal").classList.add("hidden");
}

function openSuccessModal(message) {
  const modal = document.getElementById("successModal");
  if (message) {
    document.getElementById("successModalMessage").textContent = message;
  }
  modal.classList.remove("hidden");
}

function closeSuccessModal() {
  document.getElementById("successModal").classList.add("hidden");
}
