<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");


$sql = "
    SELECT
        users.user_code,
        users.full_name,
        users.role,
        user_profile.join_date,
        user_profile.green_points,
        user_profile.activity_logged,
        user_profile.status,
        user_profile.last_active
    FROM `users`
    INNER JOIN user_profile
        ON users.user_code = user_profile.user_code
    ORDER BY users.user_code
";

$result = mysqli_query($conn, $sql);


$flaggedResult = mysqli_query($conn, "
    SELECT
        users.user_code,
        users.full_name,
        user_profile.green_points,
        user_profile.last_active
    FROM `users`
    INNER JOIN user_profile
        ON users.user_code = user_profile.user_code
    WHERE user_profile.status = 'Flagged'
    ORDER BY user_profile.last_active DESC
");


$inactiveResult = mysqli_query($conn, "
    SELECT
        users.user_code,
        users.full_name,
        user_profile.last_active
    FROM `users`
    INNER JOIN user_profile
        ON users.user_code = user_profile.user_code
    WHERE user_profile.status = 'Inactive'
    ORDER BY user_profile.last_active DESC
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Community Member Management</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/member.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">


            <h1 class="page-title">
                Community Member Management
            </h1>

            <div class="member-toolbar">

                <div class="search-box">

                    <img
                        src="icons/user_search.svg"
                        alt="Search"
                    >

                    <input
                        type="text"
                        id="memberSearch"
                        placeholder="Search by Name or User ID"
                    >

                </div>


                <select id="role">

                    <option value="All">
                        All Users
                    </option>

                    <option value="Participant">
                        Participant
                    </option>

                    <option value="Reviewer">
                        Reviewer
                    </option>

                    <option value="Manager">
                        Manager
                    </option>

                </select>

            </div>

            <div class="section-card">

                <div class="section-header">

                    <h2>
                        Community Members
                    </h2>

                </div>


                <div class="table-card">

                    <table class="member-table">

                        <thead>

                            <tr>

                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Date Joined</th>
                                <th>Points</th>
                                <th>Activities</th>
                                <th>Status</th>
                                <th>Last Active</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                                <tr class="member-row">

                                    <td>
                                        <?php echo $row['user_code']; ?>
                                    </td>

                                    <td>
                                        <?php echo $row['full_name']; ?>
                                    </td>

                                    <td>
                                        <?php echo $row['role']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo date(
                                            "d/m/Y",
                                            strtotime($row['join_date'])
                                        );
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $row['green_points']; ?>
                                    </td>

                                    <td>
                                        <?php echo $row['activity_logged']; ?>
                                        Logged
                                    </td>

                                    <td>

                                        <span class="status <?php echo strtolower($row['status']); ?>">

                                            <?php echo $row['status']; ?>

                                        </span>

                                    </td>

                                    <td>
                                        <?php echo $row['last_active']; ?>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="section-card">

                <div class="section-header">

                    <img
                        src="icons/pending.svg"
                        alt="Pending"
                    >

                    <h2>
                        Pending Administrative Actions
                    </h2>

                </div>


                <div class="admin-card">

                    <?php

                    $hasPending = false;

                    while ($flag = mysqli_fetch_assoc($flaggedResult)) {

                        $hasPending = true;

                    ?>

                        <div class="pending-card">

                            <div class="pending-header">

                                <img
                                    src="icons/freeze.svg"
                                    alt="Freeze"
                                    class="pending-icon"
                                >


                                <div>

                                    <h3>
                                        Account Freeze (System Integrity Audit)
                                    </h3>

                                    <p>

                                        User

                                        <strong>
                                            <?php echo htmlspecialchars($flag['user_code']); ?>
                                        </strong>

                                        (<?php echo htmlspecialchars($flag['full_name']); ?>)
                                        has been flagged —

                                        <strong>
                                            <?php echo number_format($flag['green_points']); ?>
                                            Green Points
                                        </strong>

                                        accumulated.

                                        Last active
                                        <?php echo htmlspecialchars($flag['last_active']); ?>.

                                    </p>

                                </div>

                            </div>


                            <a
                                href="member_action.php?id=<?php echo urlencode($flag['user_code']); ?>&action=freeze"
                                class="detail-btn"
                            >
                                View Details
                            </a>

                        </div>


                    <?php } ?>


                    <?php

                    while ($inactive = mysqli_fetch_assoc($inactiveResult)) {

                        $hasPending = true;

                    ?>

                        <div class="pending-card">

                            <div class="pending-header">

                                <img
                                    src="icons/reactivate.svg"
                                    alt="Reactivate"
                                    class="pending-icon"
                                >


                                <div>

                                    <h3>
                                        User Reactivation Request
                                    </h3>

                                    <p>

                                        User

                                        <strong>
                                            <?php echo htmlspecialchars($inactive['user_code']); ?>
                                        </strong>

                                        (<?php echo htmlspecialchars($inactive['full_name']); ?>)
                                        is currently inactive.

                                        Last active
                                        <?php echo htmlspecialchars($inactive['last_active']); ?>.

                                    </p>

                                </div>

                            </div>


                            <a
                                href="member_action.php?id=<?php echo urlencode($inactive['user_code']); ?>&action=reactivate"
                                class="detail-btn"
                            >
                                View Details
                            </a>

                        </div>


                    <?php } ?>


                    <?php if (!$hasPending) { ?>

                        <p class="no-pending">
                            No pending administrative actions at this time.
                        </p>

                    <?php } ?>

                </div>

            </div>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script>

        const searchBox = document.getElementById("memberSearch");
        const role = document.getElementById("role");
        const rows = document.querySelectorAll(".member-row");

        function filterMembers() {
            let keyword = searchBox.value.toLowerCase();
            let selectedRole = role.value;

            rows.forEach(function(row) {
                let userID = row.cells[0].textContent.toLowerCase();
                let userName = row.cells[1].textContent.toLowerCase();
                let role = row.cells[2].textContent;
                let matchSearch =
                    userID.includes(keyword) ||
                    userName.includes(keyword);
                let matchRole =
                    selectedRole === "All" ||
                    role === selectedRole;

                if (matchSearch && matchRole) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }

            });

        }


        searchBox.addEventListener("keyup", filterMembers);

        role.addEventListener("change", filterMembers);

    </script>

</body>

</html>
