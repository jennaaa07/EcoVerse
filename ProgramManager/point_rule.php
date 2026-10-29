<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");


$sql = "
    SELECT
        point_allocation.challenge_id,
        point_allocation.challenge_name,
        point_allocation.green_points,
        point_allocation.eligibility
    FROM point_allocation
";

$result = mysqli_query($conn, $sql);


$topResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        green_points
    FROM point_allocation
    ORDER BY green_points DESC
    LIMIT 5
");


$eligibilityResult = mysqli_query($conn, "
    SELECT
        eligibility,
        COUNT(*) AS total_challenges,
        SUM(green_points) AS total_points
    FROM point_allocation
    GROUP BY eligibility
    ORDER BY total_points DESC
");


$summaryResult = mysqli_query($conn, "
    SELECT
        COUNT(*) AS total_challenges,
        SUM(green_points) AS total_points,
        AVG(green_points) AS avg_points
    FROM point_allocation
");

$summary = mysqli_fetch_assoc($summaryResult);


$healthResult = mysqli_query($conn, "
    SELECT
        MIN(green_points) AS min_points,
        MAX(green_points) AS max_points
    FROM point_allocation
");

$health = mysqli_fetch_assoc($healthResult);


$highestChallengeResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        green_points
    FROM point_allocation
    ORDER BY green_points DESC
    LIMIT 1
");

$highestChallenge = mysqli_fetch_assoc($highestChallengeResult);


$lowestChallengeResult = mysqli_query($conn, "
    SELECT
        challenge_name,
        green_points
    FROM point_allocation
    ORDER BY green_points ASC
    LIMIT 1
");

$lowestChallenge = mysqli_fetch_assoc($lowestChallengeResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Green Point Allocation Management</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/point_rule.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">


            <h1 class="page-title">
                Green Point Allocation Management
            </h1>

            <div class="point-toolbar">

                <div class="search-box">

                    <img
                        src="icons/activity_search.svg"
                        alt="Search"
                    >

                    <input
                        type="text"
                        id="activitySearch"
                        placeholder="Search Activity"
                    >

                </div>

            </div>

            <div class="table-card">

                <h2 class="section-title">

                    <img
                        src="icons/rules.svg"
                        alt="Rules"
                    >

                    Active Allocation Rules

                </h2>


                <table class="allocation-table">

                    <thead>

                        <tr>

                            <th>Challenge ID</th>
                            <th>Challenge Name</th>
                            <th>Green Points</th>
                            <th>Eligibility</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr
                                onclick="window.location.href='point_policy_edit.php?id=<?php echo $row['challenge_id']; ?>'"
                                style="cursor:pointer;"
                            >

                                <td>
                                    <?php echo $row['challenge_id']; ?>
                                </td>

                                <td>
                                    <?php echo $row['challenge_name']; ?>
                                </td>

                                <td>
                                    <?php echo $row['green_points']; ?>
                                </td>

                                <td>
                                    <?php echo $row['eligibility']; ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

            <div class="table-card">

                <h2 class="card-header">

                    <img
                        src="icons/breakdown.svg"
                        alt="Breakdown"
                    >

                    Point Distribution Breakdown

                </h2>


                <div class="metric-grid">


                    <div class="metric-card">

                        <h3>
                            Top Point-Earning Challenges
                        </h3>


                        <?php

                        $rank = 1;

                        while ($top = mysqli_fetch_assoc($topResult)) {

                        ?>

                            <p>

                                <strong>
                                    #<?php echo $rank; ?>
                                    <?php echo htmlspecialchars($top['challenge_name']); ?>:
                                </strong>

                                <?php echo htmlspecialchars($top['green_points']); ?> pts

                            </p>

                        <?php

                            $rank++;

                        }

                        ?>

                    </div>


                    <div class="metric-card">

                        <h3>
                            Allocation Summary
                        </h3>


                        <p>
                            <strong>Total Challenges:</strong>
                            <?php echo $summary['total_challenges']; ?>
                        </p>


                        <p>
                            <strong>Total Points Allocated:</strong>
                            <?php echo number_format($summary['total_points']); ?> pts
                        </p>


                        <p>
                            <strong>Average Points / Challenge:</strong>
                            <?php echo round($summary['avg_points'], 1); ?> pts
                        </p>

                    </div>


                    <div class="metric-card">

                        <h3>
                            Economy Health Indicators
                        </h3>


                        <p>

                            <strong>
                                Highest Value Challenge:
                            </strong>

                            <?php echo htmlspecialchars($highestChallenge['challenge_name']); ?>

                            (<?php echo htmlspecialchars($highestChallenge['green_points']); ?> pts)

                        </p>


                        <p>

                            <strong>
                                Lowest Value Challenge:
                            </strong>

                            <?php echo htmlspecialchars($lowestChallenge['challenge_name']); ?>

                            (<?php echo htmlspecialchars($lowestChallenge['green_points']); ?> pts)

                        </p>


                        <p>

                            <strong>
                                Point Range:
                            </strong>

                            <?php echo $health['min_points']; ?>
                            –
                            <?php echo $health['max_points']; ?>
                            pts

                        </p>


                        <p>

                            <strong>
                                Range Spread:
                            </strong>

                            <?php echo $health['max_points'] - $health['min_points']; ?>
                            pts

                        </p>

                    </div>

                </div>

            </div>

            <div class="center-btn">

                <a
                    href="point_policy_assign.php"
                    class="manage-btn"
                >
                    Configure Point Values and Eligibility Laws
                </a>

            </div>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="../js/point_rule.js"></script>

    <script>

        const activitySearch =
            document.getElementById("activitySearch");


        activitySearch.addEventListener("input", function () {

            const searchValue =
                this.value.toLowerCase().trim();


            const rows =
                document.querySelectorAll(
                    ".allocation-table tbody tr"
                );


            rows.forEach(function (row) {

                const rowText =
                    row.textContent.toLowerCase();


                if (rowText.includes(searchValue)) {

                    row.style.display = "";

                } else {

                    row.style.display = "none";

                }

            });

        });

    </script>

</body>

</html>