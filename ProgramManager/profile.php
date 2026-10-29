<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$userCode = $_SESSION['user_code'];

$stmt = mysqli_prepare($conn, "
    SELECT
        full_name,
        email,
        role,
        join_date,
        green_points,
        activity_logged,
        status,
        contact_number,
        last_active,
        mfa_method
    FROM user_profile
    WHERE user_code = ?
");

mysqli_stmt_bind_param($stmt, "s", $userCode);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$profile = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manager Profile</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/profile.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Manager Profile
            </h1>

            <p class="page-subtitle">
                View and manage your profile information and account security.
            </p>

            <div class="profile-stack">

                <div class="profile-card">

                    <div class="card-header">
                        <img src="icons/profile.svg" alt="Profile">
                        <h2>Profile Information</h2>
                    </div>

                    <div class="profile-details">

                        <div class="details-columns">

                            <div class="details-col">

                                <div class="row">
                                    <strong>Full Name:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['full_name']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Email:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['email']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Role:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['role']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Join Date:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['join_date']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Green Points:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['green_points']); ?>
                                    </span>
                                </div>

                            </div>


                            <div class="details-col">

                                <div class="row">
                                    <strong>Activity Logged:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['activity_logged']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Contact Number:</strong>
                                    <span>
                                        +60<?php echo htmlspecialchars($profile['contact_number']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Last Active:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['last_active']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>MFA Method:</strong>
                                    <span>
                                        <?php echo htmlspecialchars($profile['mfa_method']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <strong>Status:</strong>
                                    <span class="status <?php echo strtolower($profile['status']); ?>">
                                        <?php echo htmlspecialchars($profile['status']); ?>
                                    </span>
                                </div>

                            </div>

                        </div>


                        <div class="button-group">

                            <a href="profile_edit.php"
                               class="edit-btn">
                                Edit Button
                            </a>

                        </div>

                    </div>

                </div>

                <div class="profile-card">

                    <div class="card-header">
                        <img src="icons/admin_audit.svg" alt="Audit">
                        <h2>Admin Audit Ledger</h2>
                    </div>

                    <p class="section-note">
                        Recent actions performed by this manager account.
                    </p>

                    <div class="audit-table-wrap">

                        <table class="audit-table">

                            <thead>

                                <tr>
                                    <th>Action</th>
                                    <th>Target</th>
                                    <th>Timestamp</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $auditRows = [
                                    [
                                        'action' => 'Created Challenge',
                                        'target' => 'EcoDrive Carpool Initiative',
                                        'time' => '2026-07-20 14:32'
                                    ],
                                    [
                                        'action' => 'Deleted Reward',
                                        'target' => 'RM5 Cafe Voucher',
                                        'time' => '2026-07-18 09:10'
                                    ],
                                    [
                                        'action' => 'Updated Point Rule',
                                        'target' => 'SmartSort Waste Challenge',
                                        'time' => '2026-07-15 16:47'
                                    ],
                                ];

                                foreach ($auditRows as $entry) {
                                ?>

                                    <tr>

                                        <td>
                                            <?php echo htmlspecialchars($entry['action']); ?>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($entry['target']); ?>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($entry['time']); ?>
                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>

    <script src="../js/profile.js"></script>

</body>

</html>