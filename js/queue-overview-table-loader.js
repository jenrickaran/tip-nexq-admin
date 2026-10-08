function showQueueLoading() {
  const tbody = document.getElementById("queueTableBody");

  if (!tbody) return;

  tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-4 py-10">
                    <div class="flex items-center justify-center gap-3 text-gray-400">
                        <div class="h-5 w-5 animate-spin rounded-full border-2 border-gray-600 border-t-[#FED201]"></div>
                        <span>Loading queue...</span>
                    </div>
                </td>
            </tr>
        `;
}

// Pagination
document.querySelectorAll('a[href*="queue_page"]').forEach((link) => {
  link.addEventListener("click", function () {
    showQueueLoading();
  });
});

// NEXT button
document
  .querySelector('form[action*="nextController.php"]')
  ?.addEventListener("submit", function () {
    showQueueLoading();
  });