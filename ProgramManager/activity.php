<?php

session_start();

if(!isset($_SESSION['user_code'])){
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$sql = "

SELECT 
    activity_log.challenge_id,
    activity_log.challenge_name,
    activity_log.total_participation,
    activity_log.total_greenpoints,
    activity_log.start_date,
    activity_log.growth_trend
FROM activity_log
";

$result = mysqli_query($conn,$sql);

$monitorListResult = mysqli_query($conn, "
    SELECT challenge_id, challenge_name
    FROM challenge
    ORDER BY challenge_name
");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainability Activity Oversight</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/activity.css">
</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Sustainability Activity Oversight
            </h1>

            <div class="activity-toolbar">

                <div class="search-box">

                    <img src="icons/activity_search.svg" alt="Search">

                    <input
                        type="text"
                        id="activitySearch"
                        placeholder="Search Activity">

                </div>

            </div>

            <div class="section-card">

                <h2>
                    <img src="icons/active.svg" alt="Active">
                    Active Participation Entries
                </h2>

                <div class="table-card">

                    <table class="activity-table" id="activityTable">

                        <thead>

                            <tr>

                                <th>Challenge ID</th>
                                <th>Challenge Name</th>
                                <th>Total Participation</th>
                                <th>Total Green Points Distributed</th>
                                <th>Launch Date</th>
                                <th>Popularity & Growth Trend</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                            <tr>

                            <td><?php echo $row['challenge_id']; ?></td>
                            <td><?php echo $row['challenge_name']; ?></td>
                            <td><?php echo $row['total_participation']; ?></td>
                            <td><?php echo $row['total_greenpoints']; ?></td>
                            <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $row['growth_trend']; ?></td>
                            
                            </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="section-card">
                <div class="terminal-header">
                    <h2>
                        <img src="icons/monitor.svg" alt="Monitor">
                        Participation Monitoring & Engagement
                    </h2>
                </div>

                <p class="section-note">
                    <strong>
                        Select a Low-performing challenge to inject engagement incentives directly to user app.
                    </strong>
                </p>

                <select class="challenge-select" id="monitorChallengeSelect">

                    <option value="">-- Select a challenge --</option>

                    <?php while($item = mysqli_fetch_assoc($monitorListResult)){ ?>

                        <option value="<?php echo htmlspecialchars($item['challenge_id']); ?>">
                            <?php echo htmlspecialchars($item['challenge_id']); ?> - <?php echo htmlspecialchars($item['challenge_name']); ?>
                        </option>

                    <?php } ?>

                </select>

            <div class="monitor-grid">

            <div>

                <label>

                    <input type="checkbox">

                        Broadcast Instantly

                </label>

                <label>

                    <input type="checkbox">

                        Schedule for Weekly Digest

                </label>

                <label>

                    <input type="checkbox">

                        Auto-fire if Trend Drops to Stagnant

                </label>

            </div>

            <div>

                <label>

                    <input type="checkbox">

                        Send Push Notification Reminders

                </label>

                <label>

                    <input type="checkbox">

                        Email Digest Highlight

                </label>

                <label>

                    <input type="checkbox">

                        Allocate 50 Free Points Code

                </label>

            </div>

        </div>

            <label class="notification-label">

            Notification Preview Text

            </label>

            <textarea
            rows="4"
            placeholder="Type notification message here..."></textarea>

            <div class="save-section">
                <button type="submit" class="save-btn" id="sendNotificationBtn">
                    Send Engagement Notification
                </button>
            </div>

            </div>

        <div class="activity-buttons">

            <a href="leaderboard.php"
               class="primary-btn">

                    View Sustainability Leaderboard Overview

            </a>

            <a href="report.php"
               class="secondary-btn">

                    Generate Report

            </a>

        </div>
        <?php include("../includes/manager_footer.php"); ?>

</main>

</div>

<script src="../js/activity.js"></script>

<script>

const activitySearch = document.getElementById("activitySearch");

activitySearch.addEventListener("input", function(){

    const searchValue = this.value.toLowerCase();

    const rows = document.querySelectorAll("tbody tr");

    rows.forEach(function(row){

        const rowText = row.textContent.toLowerCase();

        if(rowText.includes(searchValue)){

            row.style.display = "";

        }else{

            row.style.display = "none";

        }

    });

});

</script>

</body>

</html>