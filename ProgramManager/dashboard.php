<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

if (($_SESSION['role'] ?? '') !== 'Manager') {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$userQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total_users
    FROM `users`
");

$totalUsers = mysqli_fetch_assoc($userQuery)['total_users'];

$challengeQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total_challenges
    FROM challenge
");

$challengeData = mysqli_fetch_assoc($challengeQuery);
$totalChallenges = $challengeData['total_challenges'];

$pointQuery = mysqli_query($conn, "
    SELECT SUM(green_points) AS total_points
    FROM point_allocation
");

$pointData = mysqli_fetch_assoc($pointQuery);

$totalPoints = $pointData['total_points'];

if (!$totalPoints) {
    $totalPoints = 0;
}

$activeChallenge = mysqli_query($conn, "
    SELECT challenge_name, start_date, end_date
    FROM challenge
    ORDER BY start_date DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manager Dashboard</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/dashboard.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Dashboard
            </h1>


            <div class="dashboard-grid">

                <div class="dashboard-left">

                    <div class="dashboard-card">

                        <div class="card-header">

                            <img
                                src="icons/points_distributed.svg"
                                alt="Distributed"
                            >

                            <h2>
                                Total Points Distributed
                            </h2>

                        </div>


                        <div class="card-body">

                            <div class="point-info">

                                <h1>
                                    <?php echo number_format($totalPoints); ?>
                                </h1>

                                <p>
                                    Total Green Points Distributed
                                </p>

                            </div>


                            <div class="progress-bar">

                                <div
                                    class="progress-fill"
                                    style="width:70%"
                                ></div>

                            </div>

                        </div>

                    </div>

                    <div class="dashboard-card">

                        <div class="card-header">

                            <img
                                src="icons/reminders.svg"
                                alt="Reminders"
                            >

                            <h2>
                                Reminders
                            </h2>

                        </div>


                        <div class="card-body">

                            <p>
                                • Review newly submitted sustainability activities.
                            </p>

                            <p>
                                • Monitor inactive community members.
                            </p>

                            <p>
                                • Check upcoming challenge deadlines.
                            </p>

                        </div>

                    </div>

                    <div class="dashboard-card">

                        <div class="card-header">

                            <img
                                src="icons/quick.svg"
                                alt="Quick"
                            >

                            <h2>
                                Quick Action Shortcuts
                            </h2>

                        </div>


                        <div class="quick-grid">

                            <a
                                href="challenge_create.php"
                                class="quick-btn"
                            >
                                Add New Challenge
                            </a>


                            <a
                                href="reward_terminal.php"
                                class="quick-btn"
                            >
                                Create New Reward
                            </a>


                            <a
                                href="leaderboard.php"
                                class="quick-btn"
                            >
                                Show Leaderboard
                            </a>


                            <a
                                href="point_policy_edit.php"
                                class="quick-btn"
                            >
                                Modify Points
                            </a>

                        </div>

                    </div>


                </div>

                <div class="dashboard-right">

                    <div class="dashboard-card">

                        <div class="card-header">

                            <img
                                src="icons/now.svg"
                                alt="Happening"
                            >

                            <h2>
                                Happening Now
                            </h2>

                        </div>


                        <div class="card-body">

                            <?php while ($row = mysqli_fetch_assoc($activeChallenge)) {

                                $start = strtotime($row['start_date']);
                                $end = strtotime($row['end_date']);
                                $today = time();

                                $total = $end - $start;
                                $current = $today - $start;


                                if ($current < 0) {

                                    $progress = 0;

                                } else if ($current > $total) {

                                    $progress = 100;

                                } else {

                                    $progress = ($current / $total) * 100;

                                }

                            ?>


                                <div class="challenge-item">
                                    <h3>
                                        <?php echo $row['challenge_name']; ?>
                                    </h3>

                                    <p>
                                        <?php
                                        echo date(
                                            "d/m/Y",
                                            strtotime($row['start_date'])
                                        );
                                        ?>
                                        -
                                        <?php
                                        echo date(
                                            "d/m/Y",
                                            strtotime($row['end_date'])
                                        );
                                        ?>
                                    </p>


                                    <div class="progress-bar">
                                        <div
                                            class="progress-fill"
                                            style="width:<?php echo $progress; ?>%"
                                        ></div>
                                    </div>

                                </div>


                            <?php } ?>

                        </div>

                    </div>

                </div>


            </div>
            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="../js/dashboard.js"></script>

</body>

</html>
