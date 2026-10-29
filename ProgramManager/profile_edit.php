<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$userCode = $_SESSION['user_code'];

if (isset($_POST['save'])) {

    $fullName = $_POST['full_name'];
    $contactNumber = $_POST['contact_number'];

    $stmt = mysqli_prepare($conn, "
        UPDATE user_profile
        SET full_name = ?, contact_number = ?
        WHERE user_code = ?
    ");

    mysqli_stmt_bind_param($stmt, "sss", $fullName, $contactNumber, $userCode);
    mysqli_stmt_execute($stmt);

    header("Location: profile.php");
    exit();
}

$stmt = mysqli_prepare($conn, "
    SELECT full_name, email, role, join_date, green_points,
           activity_logged, status, contact_number, last_active, mfa_method
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

    <title>Edit Profile</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/profile.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Edit Profile
            </h1>

            <p class="page-subtitle">
                Only your Full Name and Contact Number can be updated.
                Other fields are system-managed.
            </p>

            <div class="profile-card">

                <div class="card-header">
                    <img src="icons/profile.svg" alt="Profile">
                    <h2>Edit Profile Information</h2>
                </div>

                <form method="POST" class="profile-details">

                    <div class="details-columns">

                        <div class="details-col">

                            <label>Full Name</label>

                            <input
                                type="text"
                                name="full_name"
                                value="<?php echo htmlspecialchars($profile['full_name']); ?>"
                                required
                            >

                            <label>Contact Number</label>

                            <input
                                type="text"
                                name="contact_number"
                                value="<?php echo htmlspecialchars($profile['contact_number']); ?>"
                                required
                            >

                            <label>Email (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['email']); ?>"
                                disabled
                            >

                            <label>Role (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['role']); ?>"
                                disabled
                            >

                        </div>


                        <div class="details-col">

                            <label>Join Date (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['join_date']); ?>"
                                disabled
                            >

                            <label>Green Points (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['green_points']); ?>"
                                disabled
                            >

                            <label>Activity Logged (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['activity_logged']); ?>"
                                disabled
                            >

                        </div>


                        <div class="details-col">

                            <label>Status (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['status']); ?>"
                                disabled
                            >

                            <label>Last Active (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['last_active']); ?>"
                                disabled
                            >

                            <label>MFA Method (cannot edit)</label>

                            <input
                                type="text"
                                value="<?php echo htmlspecialchars($profile['mfa_method']); ?>"
                                disabled
                            >

                        </div>

                    </div>


                    <div class="button-group">

                        <button
                            type="submit"
                            name="save"
                            class="edit-btn"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>


            <a href="profile.php" class="back-btn">

                <img src="icons/back.svg" alt="Back">

                Back to Profile

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>

    <script src="../js/profile.js"></script>

</body>

</html>