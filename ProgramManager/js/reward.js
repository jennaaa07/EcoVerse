document.addEventListener("DOMContentLoaded", function () {
  console.log("Reward Module Loaded");

  const searchInput = document.getElementById("rewardSearch");
  const categoryFilter = document.getElementById("rewardCategory");
  const rewardGrid = document.getElementById("rewardGrid");

  if (searchInput && rewardGrid) {
    const cards = rewardGrid.querySelectorAll(".reward-card");

    function filterRewards() {
      const keyword = searchInput.value.toLowerCase();
      const selectedCategory = categoryFilter ? categoryFilter.value : "All Rewards";

      cards.forEach(function (card) {
        const cardText = card.textContent.toLowerCase();
        const matchesSearch = cardText.includes(keyword);
        const matchesCategory = selectedCategory === "All Rewards" || cardText.includes(selectedCategory.toLowerCase());

        if (matchesSearch && matchesCategory) {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    }

    searchInput.addEventListener("keyup", filterRewards);

    if (categoryFilter) {
      categoryFilter.addEventListener("change", filterRewards);
    }
  }

  const confirmBox = document.getElementById("confirmDelete");
  const deleteBtn = document.getElementById("deleteBtn");

  if (confirmBox && deleteBtn) {
    confirmBox.addEventListener("change", function () {
      deleteBtn.disabled = !this.checked;
    });
  }
});

const imageInput = document.querySelector('input[type="file"]');
const uploadBox = document.querySelector(".upload-box");

if (imageInput && uploadBox) {
  imageInput.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        uploadBox.innerHTML = `
          <img src="${e.target.result}" style="width:100%; height:100%; object-fit:contain; border-radius:15px;">
        `;
      };

      reader.readAsDataURL(file);
    }
  });
}

const saveButtons = document.querySelectorAll(".save-btn");

saveButtons.forEach((button) => {
  button.addEventListener("click", function (e) {
    e.preventDefault();
    alert("Information saved successfully.");
  });
});


const deleteButtons = document.querySelectorAll(".delete-btn");

deleteButtons.forEach((button) => {
  button.addEventListener("click", function (e) {
    e.preventDefault();

    let confirmDelete = confirm("Are you sure you want to permanently delete this item?");

    if (confirmDelete) {
      alert("Item removed successfully.");
    }
  });
});

const buttons = document.querySelectorAll("button");

buttons.forEach((button) => {
  button.addEventListener("mouseenter", function () {
    button.style.transform = "scale(1.03)";
  });

  button.addEventListener("mouseleave", function () {
    button.style.transform = "scale(1)";
  });
});

const terminalButtons = document.querySelectorAll(".big-btn");

terminalButtons.forEach((btn) => {
  btn.addEventListener("mouseenter", () => {
    btn.style.transition = ".3s";
  });
});