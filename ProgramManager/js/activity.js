document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchActivity");
  const categoryFilter = document.getElementById("categoryFilter");
  const rows = document.querySelectorAll(".activity-table tbody tr");

  function applyFilters() {
    const keyword = searchInput ? searchInput.value.toLowerCase() : "";
    const selectedCategory = categoryFilter
      ? categoryFilter.value.toLowerCase()
      : "all category";

    rows.forEach(function (row) {
      const rowText = row.innerText.toLowerCase();

      const matchesSearch = rowText.includes(keyword);
      const matchesCategory =
        selectedCategory === "all category" ||
        rowText.includes(selectedCategory);

      if (matchesSearch && matchesCategory) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  if (searchInput) {
    searchInput.addEventListener("keyup", applyFilters);
  }

  if (categoryFilter) {
    categoryFilter.addEventListener("change", applyFilters);
  }

  const challenge = document.querySelector(".challenge-select");

  if (challenge) {
    challenge.addEventListener("change", function () {
      console.log("Selected Challenge:", this.value);
    });
  }

  const textarea = document.querySelector("textarea");

  if (textarea) {
    textarea.addEventListener("keyup", function () {
      console.log("Notification Preview:");
      console.log(this.value);
    });
  }

  const checks = document.querySelectorAll(
    ".monitor-grid input[type='checkbox']",
  );

  checks.forEach(function (box) {
    box.addEventListener("change", function () {
      console.log(this.parentElement.innerText.trim(), this.checked);
    });
  });

  const leaderboardBtn = document.querySelector(".primary-btn");

  if (leaderboardBtn) {
    leaderboardBtn.addEventListener("click", function () {
      console.log("Opening Sustainability Leaderboard...");
    });
  }

  const reportBtn = document.querySelector(".secondary-btn");

  if (reportBtn) {
    reportBtn.addEventListener("click", function () {
      console.log("Generating Sustainability Report...");
    });
  }
});
