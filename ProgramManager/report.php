<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$focusTypes = isset($_GET['focus']) ? $_GET['focus'] : [];
$scope = isset($_GET['scope']) ? $_GET['scope'] : '';
$format = isset($_GET['format']) ? $_GET['format'] : 'PDF';

$report = null;

if (isset($_GET['generate'])) {

    $dateCondition = "1=1"; 

    if ($scope === 'Current Semester') {

        $dateCondition = "start_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";

    } elseif ($scope === 'Past 24 Hours') {

        $dateCondition = "start_date >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";

    }

    $report = [];

    if (in_array('Participation', $focusTypes)) {

        $userResult = mysqli_query($conn, "
            SELECT COUNT(*) AS total_users
            FROM user_profile
        ");

        $report['total_users'] = mysqli_fetch_assoc($userResult)['total_users'];

        $activeResult = mysqli_query($conn, "
            SELECT COUNT(*) AS active_users
            FROM user_profile
            WHERE status = 'Active'
        ");

        $report['active_users'] = mysqli_fetch_assoc($activeResult)['active_users'];

        $submissionResult = mysqli_query($conn, "
            SELECT SUM(total_participation) AS total_submissions
            FROM activity_log
            WHERE $dateCondition
        ");

        $report['total_submissions'] = mysqli_fetch_assoc($submissionResult)['total_submissions'];

    }

    if (in_array('Points', $focusTypes)) {

        $pointsResult = mysqli_query($conn, "
            SELECT SUM(total_greenpoints) AS total_points
            FROM activity_log
            WHERE $dateCondition
        ");

        $report['total_points'] = mysqli_fetch_assoc($pointsResult)['total_points'];

        $avgResult = mysqli_query($conn, "
            SELECT AVG(green_points) AS avg_points
            FROM user_profile
        ");

        $report['avg_points'] = mysqli_fetch_assoc($avgResult)['avg_points'];

        $topEarnerResult = mysqli_query($conn, "
            SELECT challenge_name, total_greenpoints
            FROM activity_log
            WHERE $dateCondition
            ORDER BY total_greenpoints DESC
            LIMIT 1
        ");

        $report['top_earner'] = mysqli_fetch_assoc($topEarnerResult);

    }

    if (in_array('Performance', $focusTypes)) {

        $perfResult = mysqli_query($conn, "
            SELECT challenge_name, total_participation, growth_trend
            FROM activity_log
            WHERE $dateCondition
            ORDER BY total_participation DESC
            LIMIT 5
        ");

        $report['performance'] = [];

        while ($row = mysqli_fetch_assoc($perfResult)) {

            $report['performance'][] = $row;

        }

    }

    if (in_array('Redemption', $focusTypes)) {

        $report['redemption_available'] = false; 

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainability Intelligence Reporting</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/activity.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">

                <img src="icons/report.svg" alt="Report">

                Sustainability Intelligence Reporting

            </h1>

            <div class="section-card">

                <div class="terminal-header">

                    <h2>

                        <img src="icons/specification.svg" alt="Specification">

                        Choose Report Specifications

                    </h2>

                </div>

                <form method="GET" class="report-spec-form">

                    <div class="spec-row">

                        <label class="spec-label">
                            Report Focus Type:
                        </label>

                        <label class="check-inline">
                            <input
                                type="checkbox"
                                name="focus[]"
                                value="Participation"
                                <?php if (in_array('Participation', $focusTypes)) echo 'checked'; ?>>
                            User Participation
                        </label>

                        <label class="check-inline">
                            <input
                                type="checkbox"
                                name="focus[]"
                                value="Points"
                                <?php if (in_array('Points', $focusTypes)) echo 'checked'; ?>>
                            Point Distribution
                        </label>

                        <label class="check-inline">
                            <input
                                type="checkbox"
                                name="focus[]"
                                value="Performance"
                                <?php if (in_array('Performance', $focusTypes)) echo 'checked'; ?>>
                            Challenge Performance
                        </label>

                        <label class="check-inline">
                            <input
                                type="checkbox"
                                name="focus[]"
                                value="Redemption"
                                <?php if (in_array('Redemption', $focusTypes)) echo 'checked'; ?>>
                            Reward Redemption
                        </label>

                    </div>


                    <div class="spec-row">

                        <label class="spec-label">
                            Output File Format:
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="format"
                                value="PDF"
                                <?php if ($format == 'PDF') echo 'checked'; ?>>
                            Adobe PDF (.pdf)
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="format"
                                value="Excel"
                                <?php if ($format == 'Excel') echo 'checked'; ?>>
                            Microsoft Excel (.xlsx)
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="format"
                                value="CSV"
                                <?php if ($format == 'CSV') echo 'checked'; ?>>
                            CSV (.csv)
                        </label>

                    </div>


                    <div class="spec-row">

                        <label class="spec-label">
                            Temporal Date Scope:
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="scope"
                                value="Current Semester"
                                <?php if ($scope == 'Current Semester') echo 'checked'; ?>>
                            Current Semester Year-To-Date
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="scope"
                                value="Past 24 Hours"
                                <?php if ($scope == 'Past 24 Hours') echo 'checked'; ?>>
                            Past 24-hour Active Window
                        </label>

                        <label class="check-inline">
                            <input
                                type="radio"
                                name="scope"
                                value=""
                                <?php if ($scope == '') echo 'checked'; ?>>
                            All Time
                        </label>

                    </div>


                    <div class="save-section">

                        <button
                            type="submit"
                            name="generate"
                            value="1"
                            class="primary-btn">

                            Generate System Report

                        </button>

                    </div>

                </form>

            </div>

            <div class="section-card">

                <div class="terminal-header">

                    <h2>

                        <img src="icons/generated_report.svg" alt="Generated Report">

                        Generated Report

                    </h2>

                </div>

                <p class="section-note">

                    <em>
                        This area populates dynamically below upon clicking the generation button above.
                    </em>

                </p>


                <?php if ($report !== null) { ?>

                    <div class="ledger-box">

                        ========================================================================================================================================

                        EcoVerse Sustainability Compliance Report<br>

                        Scope Period:
                        <?php echo $scope !== '' ? htmlspecialchars($scope) : 'All Time'; ?><br>

                        Timestamp:
                        <?php echo date('Y-m-d | H:i'); ?><br>

                        ========================================================================================================================================


                        <?php if (isset($report['total_users'])) { ?>

                            <br>

                            SECTION: USER PARTICIPATION BREAKDOWN<br>

                            Total Registered Platform Accounts:
                            <?php echo number_format($report['total_users']); ?><br>

                            Active Users:
                            <?php echo number_format($report['active_users']); ?><br>

                            Total Logged Submissions:
                            <?php echo number_format($report['total_submissions']); ?><br>

                        <?php } ?>


                        <?php if (isset($report['total_points'])) { ?>

                            <br>

                            SECTION: GREEN POINT DISTRIBUTION LEDGER<br>

                            Total Green Points Issued:
                            <?php echo number_format($report['total_points']); ?> pts<br>

                            Average Points Per Account:
                            <?php echo round($report['avg_points'], 1); ?> pts<br>


                            <?php if ($report['top_earner']) { ?>

                                Highest Earning Challenge:
                                <?php echo htmlspecialchars($report['top_earner']['challenge_name']); ?>

                                (<?php echo number_format($report['top_earner']['total_greenpoints']); ?> pts)<br>

                            <?php } ?>

                        <?php } ?>


                        <?php if (isset($report['performance'])) { ?>

                            <br>

                            SECTION: CHALLENGE PERFORMANCE<br>


                            <?php foreach ($report['performance'] as $p) { ?>

                                <?php echo htmlspecialchars($p['challenge_name']); ?>

                                —

                                <?php echo $p['total_participation']; ?> participants,

                                trend:

                                <?php echo htmlspecialchars($p['growth_trend']); ?><br>

                            <?php } ?>

                        <?php } ?>


                        <?php if (isset($report['redemption_available']) && !$report['redemption_available']) { ?>

                            <br>

                            SECTION: REWARD REDEMPTION<br>

                            Not available — redemption tracking not yet set up.<br>

                        <?php } ?>

                    </div>

                <?php } else { ?>

                    <p>
                        No report generated yet. Choose your specifications above and click "Generate System Report."
                    </p>

                <?php } ?>

            </div>


            <a href="activity.php" class="back-btn">

                <img src="icons/back.svg" alt="Back">

                Back to Sustainability Activity Oversight

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>

    <script src="../js/activity.js"></script>

</body>

</html>