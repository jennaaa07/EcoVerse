// ==============================
// Dashboard JavaScript
// ==============================

// Welcome message
window.addEventListener("load", function () {
    console.log("Manager Dashboard Loaded");
});

// Logout confirmation
function confirmLogout() {

    let confirmAction = confirm("Are you sure you want to logout?");

    if (confirmAction) {
        window.location = "../logout.php";
    }

}

// Highlight active sidebar menu
const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".sidebar a").forEach(link => {

    if(link.getAttribute("href") === currentPage){

        link.parentElement.classList.add("active");

    }

});


// =====================================
// Header Search
// =====================================

const searchInput = document.getElementById("searchInput");

if(searchInput){

    searchInput.addEventListener("keyup",function(){

        console.log("Searching:",this.value);

        // Search functionality will be added later

    });

}

