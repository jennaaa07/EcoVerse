<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

$userId = isset($_GET['id'])
    ? $_GET['id']
    : (isset($_POST['user_code']) ? $_POST['user_code'] : '');

$action = isset($_GET['action']) ? $_GET['action'] : '';


if (isset($_POST['freeze'])) {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user_profile
         SET status = 'Freeze'
         WHERE user_code = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    header("Location: member.php");
    exit();

}


if (isset($_POST['dismiss'])) {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user_profile
         SET status = 'Active'
         WHERE user_code = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    header("Location: member.php");
    exit();

}


if (isset($_POST['reactivate'])) {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user_profile
         SET status = 'Active'
         WHERE user_code = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    header("Location: member.php");
    exit();

}


if (isset($_POST['deny'])) {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user_profile
         SET status = 'Inactive'
         WHERE user_code = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    header("Location: member.php");
    exit();

}


$user = null;
$suspiciousLogs = [];

if ($userId !== '') {

    $stmt = mysqli_prepare($conn, "
        SELECT
            users.user_code,
            users.full_name,
            user_profile.status,
            user_profile.green_points,
            user_profile.last_active
        FROM `users`
        INNER JOIN user_profile
            ON users.user_code = user_profile.user_code
        WHERE users.user_code = ?
    ");

    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);

    $userResult = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($userResult);


    if ($action === 'freeze') {

        $logStmt = mysqli_prepare($conn, "
            SELECT
                suspicious_activity.audit_id,
                user_profile.user_id,
                suspicious_activity.activity_name,
                suspicious_activity.points_claimed,
                suspicious_activity.device_ip,
                suspicious_activity.verifier,
                suspicious_activity.activity_time
            FROM suspicious_activity
            INNER JOIN user_profile
                ON user_profile.user_id = suspicious_activity.user_id
            WHERE user_profile.user_id = ?
            ORDER BY suspicious_activity.activity_time DESC
        ");

        mysqli_stmt_bind_param($logStmt, "s", $userId);
        mysqli_stmt_execute($logStmt);

        $logResult = mysqli_stmt_get_result($logStmt);

        while ($row = mysqli_fetch_assoc($logResult)) {

            $suspiciousLogs[] = $row;

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pending Administrative Actions</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/member.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Pending Administrative Actions
            </h1>

            <hr>


            <?php if (!$user) { ?>

                <p>
                    No user specified. Please return to Community Member Management
                    and select a pending action.
                </p>


            <?php } elseif ($action === 'freeze') { ?>

                <div class="action-card">

                    <div class="action-title">

                        <img
                            src="icons/freeze.svg"
                            alt="Warning"
                        >

                        <h2>
                            Account Freeze (System Integrity Audit)
                        </h2>

                    </div>


                    <p class="action-description">

                        User
                        <strong>
                            [<?php echo htmlspecialchars($user['user_code']); ?>]
                        </strong>

                        (<?php echo htmlspecialchars($user['full_name']); ?>)
                        currently holds

                        <strong>
                            <?php echo number_format($user['green_points']); ?> points
                        </strong>

                        and has been flagged for review.

                    </p>


                    <div class="info-box">

                        <h3>
                            High-Frequency Submission Audit Logs
                        </h3>


                        <?php if (count($suspiciousLogs) === 0) { ?>

                            <p>
                                No suspicious activity logs found for this user.
                            </p>


                        <?php } else { ?>


                            <table class="log-table">

                                <thead>

                                    <tr>

                                        <th>Audit ID</th>
                                        <th>User ID</th>
                                        <th>Activity</th>
                                        <th>Claimed Points</th>
                                        <th>Device IP</th>
                                        <th>Verifier</th>
                                        <th>Timestamp</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php foreach ($suspiciousLogs as $row) { ?>

                                        <tr>

                                            <td>
                                                <?php echo htmlspecialchars($row['audit_id']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['user_id']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['activity_name']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['points_claimed']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['device_ip']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['verifier']); ?>
                                            </td>

                                            <td>
                                                <?php echo htmlspecialchars($row['activity_time']); ?>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>


                        <?php } ?>

                    </div>


                    <form method="POST">

                        <input
                            type="hidden"
                            name="user_code"
                            value="<?php echo htmlspecialchars($user['user_code']); ?>"
                        >


                        <div class="action-buttons">

                            <button
                                type="submit"
                                name="freeze"
                                class="danger-btn"
                            >
                                Freeze and Suspend Account
                            </button>


                            <button
                                type="submit"
                                name="dismiss"
                                class="secondary-btn"
                            >
                                Dismiss Alert
                            </button>

                        </div>

                    </form>

                </div>


            <?php } elseif ($action === 'reactivate') { ?>

                <div class="action-card">

                    <div class="action-title">

                        <img
                            src="icons/reactivate.svg"
                            alt="Reactivate"
                        >

                        <h2>
                            User-triggered Account Reactivation Request
                        </h2>

                    </div>


                    <p class="action-description">

                        Inactivity Alert:

                        User
                        <strong>
                            [<?php echo htmlspecialchars($user['user_code']); ?>]
                        </strong>

                        (<?php echo htmlspecialchars($user['full_name']); ?>)
                        has been inactive since

                        <strong>
                            <?php echo htmlspecialchars($user['last_active']); ?>
                        </strong>.

                    </p>


                    <div class="info-box">

                        <h3>
                            Inactive Profile Parameters
                        </h3>


                        <p>

                            Requested User:

                            <strong>
                                <?php echo htmlspecialchars($user['full_name']); ?>

                                [

                                <?php echo htmlspecialchars($user['user_code']); ?>

                                ]

                            </strong>

                            |

                            Last Active:

                            <strong>
                                <?php echo htmlspecialchars($user['last_active']); ?>
                            </strong>

                        </p>

                    </div>


                    <form method="POST">

                        <input
                            type="hidden"
                            name="user_code"
                            value="<?php echo htmlspecialchars($user['user_code']); ?>"
                        >


                        <div class="action-buttons">

                            <button
                                type="submit"
                                name="reactivate"
                                class="success-btn"
                            >
                                Approve and Reactivate Account
                            </button>


                            <button
                                type="submit"
                                name="deny"
                                class="danger-btn"
                            >
                                Deny Request
                            </button>

                        </div>

                    </form>

                </div>


            <?php } ?>


            <a href="member.php" class="back-btn">

                <img
                    src="icons/back.svg"
                    alt="Back"
                >

                Back to Community Member Management

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="../js/member.js"></script>

</body>

</html>
