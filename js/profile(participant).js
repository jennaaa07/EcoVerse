// profile.js

function handleLogout() {
    const confirmLogout = confirm("Are you sure you want to log out of EcoRewards?");
    if (confirmLogout) {
        // Redirect logic to login page can go here
        alert("You have been successfully logged out.");
        window.location.href = "login.php";
    }
}