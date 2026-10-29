<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$role = $_SESSION['role'] ?? "Sustainability Program Manager";
$name = $_SESSION['full_name'] ?? "Jieyu";
$status = $_SESSION['status'] ?? "Active";
?>

<header class="top-header">
    <div class="header-left">
        <div class="logo">
            <img src="../images/ecoverse.png" alt="EcoVerse Logo">
            <div class="logo-text">
                <h2>EcoVerse</h2>
                <p>A World Where<br>Every Green Action Matters</p>
            </div>
        </div>

        <div class="user-info">

            <span><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></span>

            <span class="divider"></span>

            <span><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></span>

            <span class="divider"></span>

            <span>
                <strong>Status:</strong>
                <span class="status-active"><?php echo htmlspecialchars($status); ?></span>
            </span>

        </div>

    </div>

    <div class="header-right">
        <div class="header-search">
            <input
                type="text"
                id="searchInput"
                placeholder="Search..."
                autocompleted="off">
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>

    </header>

    <script>

    const sidebarFunctions = [

        {
            name: "Dashboard",
            url: "dashboard.php"
        },

        {
            name: "Community Member Management",
            url: "member.php"
        },

        {
            name: "Pending Administrative Actions",
            url: "member_action.php"
        },

        {
            name: "Sustainability Challenge Management",
            url: "challenge.php"
        },

        {
            name: "Edit Sustainability Challenge",
            url: "challenge_edit.php"
        },

        {
            name: "Create Sustainability Challenge",
            url: "challenge_create.php"
        },

        {
            name: "Green Reward Management",
            url: "reward.php"
        },

        {
            name: "Reward Marketplace",
            url: "reward_list.php"
        },

        {
            name: "Add New Reward",
            url: "reward_terminal.php"
        },

        {
            name: "Environmental Achievement Badge",
            url: "achievement_list.php"
        },

        {
            name: "Green Point Allocation Management",
            url: "point_rule.php"
        },
        

        {
            name: "Sustainability Activity Oversight",
            url: "activity.php"
        },

        {
            name: "Sustainability Leaderboard Overview",
            url: "leaderboard.php"
        },

        {
            name: "Sustainability Intelligence Reporting",
            url: "report.php"
        },

        {
            name: "Sustainability Recommendation Engine",
            url: "recommendation.php"
        },

        {
            name: "Profile",
            url: "profile.php"
        }

    ];

    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");

    searchInput.addEventListener("input", function(){
        const keyword = this.value.toLowerCase().trim();
        searchResults.innerHTML = "";

        if(keyword === ""){
            searchResults.style.display = "none";
            return;
        }


        const results = sidebarFunctions.filter(function(item){

            return item.name.toLowerCase().includes(keyword);

        });


        if(results.length === 0){

            searchResults.innerHTML =
                '<div class="no-results">No matching function</div>';

            searchResults.style.display = "block";

            return;
        }


        results.forEach(function(item){

            const result = document.createElement("a");

            result.href = item.url;

            result.textContent = item.name;

            result.classList.add("search-result-item");

            searchResults.appendChild(result);

        });


        searchResults.style.display = "block";

    });

    document.addEventListener("click", function(event){

        if(!event.target.closest(".header-search")){

            searchResults.style.display = "none";

        }

    });

    </script>
    