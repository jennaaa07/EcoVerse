<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$underperformResult = mysqli_query($conn, "
    SELECT
        a.challenge_id,
        a.challenge_name,
        a.total_participation,
        a.growth_trend,
        p.green_points
    FROM activity_log a
    LEFT JOIN point_allocation p
        ON a.challenge_id = p.challenge_id
    WHERE a.growth_trend = 'Declining'
       OR a.total_participation < (
            SELECT AVG(total_participation)
            FROM activity_log
       )
    ORDER BY a.total_participation ASC
    LIMIT 5
");

$underperforming = [];

while ($row = mysqli_fetch_assoc($underperformResult)) {

    $currentPoints = $row['green_points'] ?? 0;

    $suggestedPoints = $currentPoints > 0
        ? ceil(($currentPoints * 1.5) / 5) * 5
        : null;

    $row['suggested_points'] = $suggestedPoints;

    $underperforming[] = $row;
}

$topPickResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        total_participation,
        growth_trend
    FROM activity_log
    ORDER BY total_participation ASC
    LIMIT 1
");

$topPick = mysqli_fetch_assoc($topPickResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainability Recommendation Engine</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/recommendation.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h2 class="page-title">
                Sustainability Recommendation Engine
            </h2>

            <div class="recommend-card">

                <div class="card-header">
                    <img src="icons/recommend.svg" alt="Recommend">
                    Priority Recommendation
                </div>

                <div class="card-body">

                    <?php if ($topPick) { ?>

                        <div class="prediction-grid">

                            <div class="prediction-label">
                                Lowest-Performing Challenge
                            </div>

                            <div class="prediction-value">
                                <?php echo htmlspecialchars($topPick['challenge_name']); ?>
                            </div>


                            <div class="prediction-label">
                                Current Participation
                            </div>

                            <div class="prediction-value">
                                <?php echo $topPick['total_participation']; ?> participants
                            </div>


                            <div class="prediction-label">
                                Growth Trend
                            </div>

                            <div class="prediction-value">
                                <?php echo htmlspecialchars($topPick['growth_trend']); ?>
                            </div>

                        </div>

                    <?php } else { ?>

                        <p>
                            No challenge data available yet.
                        </p>

                    <?php } ?>

                </div>

            </div>

            <div class="recommend-card">

                <div class="card-header">
                    <img src="icons/optimize.svg" alt="Optimize">
                    Challenge Optimization & Incentive Suggestions
                </div>

                <div class="card-body">

                    <?php if (count($underperforming) === 0) { ?>

                        <p>
                            No underperforming challenges detected —
                            all challenges are performing at or above average.
                        </p>

                    <?php } else { ?>

                        <table class="recommend-table">

                            <thead>

                                <tr>
                                    <th>Flagged Low-Perform Challenge</th>
                                    <th>Current Base Points</th>
                                    <th>Participation</th>
                                    <th>Suggested Point Adjustment</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($underperforming as $row) { ?>

                                    <tr>

                                        <td>
                                            <?php echo htmlspecialchars($row['challenge_id']); ?><br>
                                            <?php echo htmlspecialchars($row['challenge_name']); ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $row['green_points']
                                                ? $row['green_points'] . ' pts'
                                                : 'No rule assigned';
                                            ?>
                                        </td>

                                        <td>
                                            <?php echo $row['total_participation']; ?> participants<br>
                                            Trend:
                                            <?php echo htmlspecialchars($row['growth_trend']); ?>
                                        </td>

                                        <td>

                                            <?php if ($row['suggested_points']) { ?>

                                                Boost to
                                                <?php echo $row['suggested_points']; ?> pts<br>

                                                (+<?php echo $row['suggested_points'] - $row['green_points']; ?>
                                                pts suggested)

                                            <?php } else { ?>

                                                Assign a point rule first

                                            <?php } ?>

                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>


                        <div class="center-btn">

                            <a href="point_policy_edit.php" class="primary-btn">
                                Review & Adjust Point Rules
                            </a>

                        </div>

                    <?php } ?>

                </div>

            </div>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>

    <script src="../js/recommendation.js"></script>

</body>

</html>