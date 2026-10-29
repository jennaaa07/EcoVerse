<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

$sql = "
    SELECT
        user_code,
        full_name,
        green_points,
        activity_logged,
        status
    FROM user_profile
    ORDER BY green_points DESC
";

$result = mysqli_query($conn, $sql);

$trendResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        total_participation,
        growth_trend
    FROM activity_log
    ORDER BY total_participation DESC
    LIMIT 5
");

$trends = [];
$maxParticipation = 1;

while ($t = mysqli_fetch_assoc($trendResult)) {

    $trends[] = $t;

    if ($t['total_participation'] > $maxParticipation) {
        $maxParticipation = $t['total_participation'];
    }

}


$growthGroupResult = mysqli_query($conn, "
    SELECT
        growth_trend,
        COUNT(*) AS total
    FROM activity_log
    GROUP BY growth_trend
");


$topChallengeResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        total_participation
    FROM activity_log
    ORDER BY total_participation DESC
    LIMIT 1
");

$topChallenge = mysqli_fetch_assoc($topChallengeResult);


$lowChallengeResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        total_participation
    FROM activity_log
    ORDER BY total_participation ASC
    LIMIT 1
");

$lowChallenge = mysqli_fetch_assoc($lowChallengeResult);


$totalPointsResult = mysqli_query($conn, "
    SELECT
        SUM(total_greenpoints) AS total_points
    FROM activity_log
");

$totalPoints = mysqli_fetch_assoc($totalPointsResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainability Leaderboard Overview</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/activity.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">


            <h1 class="page-title">

                <img
                    src="icons/leaderboard.svg"
                    alt="Leaderboard"
                >

                Sustainability Leaderboard Overview

            </h1>

            <div class="leaderboard-card">

                <div class="card-header">

                    <h2>

                        <img
                            src="icons/podium.svg"
                            alt="Podium"
                        >

                        Eco-Champions Podium

                    </h2>

                </div>


                <?php

                $users = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }

                ?>


                <div class="podium">

                    <?php if (isset($users[1])) { ?>

                        <div class="podium-box second">

                            <h3>
                                🥈 Rank 2
                            </h3>

                            <p>

                                <strong>User:</strong>

                                <?php echo htmlspecialchars($users[1]['full_name']); ?>

                            </p>

                            <p>

                                <strong>Challenges:</strong>

                                <?php echo $users[1]['activity_logged']; ?>

                                Tasks

                            </p>

                            <p>

                                <strong>Points:</strong>

                                <?php echo number_format($users[1]['green_points']); ?>

                                pts

                            </p>

                            <p>

                                <strong>Status:</strong>

                                <?php echo htmlspecialchars($users[1]['status']); ?>

                            </p>

                        </div>

                    <?php } ?>

                    <?php if (isset($users[0])) { ?>

                        <div class="podium-box first">

                            <h3>
                                🥇 Rank 1
                            </h3>

                            <p>

                                <strong>User:</strong>

                                <?php echo htmlspecialchars($users[0]['full_name']); ?>

                            </p>

                            <p>

                                <strong>Challenges:</strong>

                                <?php echo $users[0]['activity_logged']; ?>

                                Tasks

                            </p>

                            <p>

                                <strong>Points:</strong>

                                <?php echo number_format($users[0]['green_points']); ?>

                                pts

                            </p>

                            <p>

                                <strong>Status:</strong>

                                <?php echo htmlspecialchars($users[0]['status']); ?>

                            </p>

                        </div>

                    <?php } ?>

                    <?php if (isset($users[2])) { ?>

                        <div class="podium-box third">

                            <h3>
                                🥉 Rank 3
                            </h3>

                            <p>

                                <strong>User:</strong>

                                <?php echo htmlspecialchars($users[2]['full_name']); ?>

                            </p>

                            <p>

                                <strong>Challenges:</strong>

                                <?php echo $users[2]['activity_logged']; ?>

                                Tasks

                            </p>

                            <p>

                                <strong>Points:</strong>

                                <?php echo number_format($users[2]['green_points']); ?>

                                pts

                            </p>

                            <p>

                                <strong>Status:</strong>

                                <?php echo htmlspecialchars($users[2]['status']); ?>

                            </p>

                        </div>

                    <?php } ?>


                </div>

                <table class="leaderboard-table">

                    <thead>

                        <tr>

                            <th>Rank</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Points Earned</th>
                            <th>Weekly Velocity</th>
                            <th>Integrity Health</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        for ($i = 3; $i < count($users); $i++) {

                            $rank = $i + 1;

                        ?>

                            <tr>

                                <td>
                                    <?php echo $rank; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($users[$i]['user_code']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($users[$i]['full_name']); ?>
                                </td>

                                <td>
                                    <?php echo number_format($users[$i]['green_points']); ?>

                                    pts
                                </td>

                                <td>
                                    <?php echo $users[$i]['activity_logged']; ?>

                                    activities
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($users[$i]['status']); ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

            <div class="hub-card">

                <div class="card-header">

                    <h2>

                        <img
                            src="icons/intelligence.svg"
                            alt="Intelligence"
                        >

                        Sustainability Intelligence Hub

                    </h2>

                </div>


                <div class="hub-grid">


                    <div class="hub-box">

                        <h3>
                            Popular Sustainability Activities
                        </h3>


                        <?php foreach ($trends as $t): ?>

                            <div class="trend-row">

                                <span class="trend-label">

                                    <?php echo htmlspecialchars($t['challenge_name']); ?>

                                </span>


                                <div class="trend-bar-track">

                                    <div
                                        class="trend-bar-fill"
                                        style="width:<?php echo round(($t['total_participation'] / $maxParticipation) * 100); ?>%;"
                                    ></div>

                                </div>


                                <span class="trend-value">

                                    <?php echo $t['total_participation']; ?>

                                </span>

                            </div>

                        <?php endforeach; ?>

                    </div>


                    <div class="hub-box">

                        <h3>
                            Participation Trend Identifier
                        </h3>


                        <p>

                            Top Engagement:

                            <strong>
                                <?php echo htmlspecialchars($topChallenge['challenge_name']); ?>
                            </strong>

                            (<?php echo $topChallenge['total_participation']; ?> participants)

                        </p>


                        <p>

                            Lowest Engagement:

                            <strong>
                                <?php echo htmlspecialchars($lowChallenge['challenge_name']); ?>
                            </strong>

                            (<?php echo $lowChallenge['total_participation']; ?> participants)

                        </p>


                        <?php while ($g = mysqli_fetch_assoc($growthGroupResult)) { ?>

                            <p>

                                <?php echo htmlspecialchars($g['growth_trend']); ?>:

                                <strong>
                                    <?php echo $g['total']; ?> challenges
                                </strong>

                            </p>

                        <?php } ?>

                    </div>


                    <div class="hub-box">

                        <h3>
                            Green Points Overview
                        </h3>


                        <p>

                            Total Points Distributed:

                            <strong>

                                <?php echo number_format($totalPoints['total_points']); ?>

                                pts

                            </strong>

                        </p>


                        <p>

                            Across

                            <strong>
                                <?php echo count($trends); ?>+ Active Challenges
                            </strong>

                        </p>

                    </div>


                </div>

            </div>


            <a href="activity.php" class="back-btn">

                <img
                    src="icons/back.svg"
                    alt="Back"
                >

                Back to Sustainability Activity Oversight

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="../js/activity.js"></script>

</body>

</html>