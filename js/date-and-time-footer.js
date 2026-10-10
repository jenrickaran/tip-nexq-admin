function setText(id, value) {
  const el = document.getElementById(id);
  if (el) el.textContent = value; // silently skip if element isn't on this page
}

function updateDateTime() {
  const now = new Date();
  setText(
    "current-date",
    now.toLocaleDateString("en-PH", {
      year: "numeric",
      month: "long",
      day: "numeric",
    }),
  );
  setText(
    "current-time",
    now.toLocaleTimeString("en-PH", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      hour12: true,
    }),
  );
}

function updateDateTimeMobile() {
  const now = new Date();
  setText(
    "current-date-mobile",
    now.toLocaleDateString("en-PH", {
      year: "numeric",
      month: "long",
      day: "numeric",
    }),
  );
  setText(
    "current-time-mobile",
    now.toLocaleTimeString("en-PH", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      hour12: true,
    }),
  );
}

function updateDateTimeSuperAdmin() {
  const now = new Date();
  setText(
    "current-date-superadmin",
    now.toLocaleDateString("en-PH", {
      year: "numeric",
      month: "long",
      day: "numeric",
    }),
  );
  setText(
    "current-time-superadmin",
    now.toLocaleTimeString("en-PH", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      hour12: true,
    }),
  );
}

function updateDateTimeSuperAdminMobile() {
  const now = new Date();
  setText(
    "current-date-mobile-superadmin",
    now.toLocaleDateString("en-PH", {
      year: "numeric",
      month: "long",
      day: "numeric",
    }),
  );
  setText(
    "current-time-mobile-superadmin",
    now.toLocaleTimeString("en-PH", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
      hour12: true,
    }),
  );
}

// Run once on load and every second
[
  updateDateTime,
  updateDateTimeMobile,
  updateDateTimeSuperAdmin,
  updateDateTimeSuperAdminMobile,
].forEach((fn) => {
  fn();
  setInterval(fn, 1000);
});
