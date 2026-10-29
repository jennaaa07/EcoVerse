<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

if (isset($_POST['assign'])) {

    $challengeId = $_POST['challenge_id'];
    $greenPoints = $_POST['green_points'];
    $eligibility = $_POST['eligibility'];

    $stmt = mysqli_prepare($conn, "
        INSERT INTO point_allocation
            (challenge_id, challenge_name, green_points, eligibility)
        SELECT
            challenge_id,
            challenge_name,
            ?,
            ?
        FROM challenge
        WHERE challenge_id = ?
    ");

    mysqli_stmt_bind_param(
        $stmt,
        "iss",
        $greenPoints,
        $eligibility,
        $challengeId
    );

    mysqli_stmt_execute($stmt);

    header("Location: point_rule.php");
    exit();

}

if (isset($_POST['remove'])) {

    $challengeId = $_POST['challenge_id'];

    $stmt = mysqli_prepare($conn, "
        DELETE FROM point_allocation
        WHERE challenge_id = ?
    ");

    mysqli_stmt_bind_param($stmt, "s", $challengeId);
    mysqli_stmt_execute($stmt);

    header("Location: point_rule.php");
    exit();

}

$newRuleList = mysqli_query($conn, "
    SELECT
        challenge_id,
        challenge_name
    FROM challenge
    WHERE challenge_id NOT IN (
        SELECT challenge_id
        FROM point_allocation
    )
    ORDER BY challenge_name
");


$removeList = mysqli_query($conn, "
    SELECT
        challenge_id,
        challenge_name
    FROM point_allocation
    ORDER BY challenge_name
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assign & Remove Point Allocation</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/point_rule.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <div class="policy-card">

                <div class="policy-header">

                    <img
                        src="icons/create_challenge.svg"
                        alt="Assign"
                    >

                    <h2>
                        Assign & Bind NEW Rules to an Existing Challenge
                    </h2>

                </div>


                <form method="POST" action="point_policy_assign.php">

                    <label>
                        Select Existing Challenge
                    </label>

                    <select name="challenge_id" required>

                        <option value="">
                            -- Select a challenge --
                        </option>


                        <?php while ($item = mysqli_fetch_assoc($newRuleList)) { ?>

                            <option
                                value="<?php echo htmlspecialchars($item['challenge_id']); ?>"
                            >

                                <?php echo htmlspecialchars($item['challenge_id']); ?>

                                -

                                <?php echo htmlspecialchars($item['challenge_name']); ?>

                            </option>

                        <?php } ?>

                    </select>


                    <div class="hint">

                        *Note: dropdown only displays challenges that don't
                        already have a point rule assigned.*

                    </div>


                    <label>
                        Green Points
                    </label>

                    <input
                        type="number"
                        name="green_points"
                        placeholder="Enter Points"
                        required
                    >


                    <label>
                        Eligibility Criteria
                    </label>

                    <input
                        type="text"
                        name="eligibility"
                        placeholder="e.g. Complete 5 carpool trips in a month"
                        required
                    >


                    <div class="save-section">

                        <button
                            type="submit"
                            name="assign"
                            class="save-btn"
                        >
                            Bind Point Structure & Activate Challenge
                        </button>

                    </div>

                </form>

            </div>

            <div class="policy-card">

                <div class="policy-header">

                    <img
                        src="icons/delete.svg"
                        alt="Delete"
                    >

                    <h2>
                        Remove Point Allocation & Deactivate Scheme
                    </h2>

                </div>


                <form method="POST" action="point_policy_assign.php">

                    <label>
                        Select Configured Challenge
                    </label>

                    <select name="challenge_id" required>

                        <option value="">
                            -- Select a challenge --
                        </option>


                        <?php while ($item = mysqli_fetch_assoc($removeList)) { ?>

                            <option
                                value="<?php echo htmlspecialchars($item['challenge_id']); ?>"
                            >

                                <?php echo htmlspecialchars($item['challenge_id']); ?>

                                -

                                <?php echo htmlspecialchars($item['challenge_name']); ?>

                            </option>

                        <?php } ?>

                    </select>


                    <div class="warning-box">

                        <strong>
                            Warning
                        </strong>

                        <p>
                            Removing this will void the point payout scheme
                            for this challenge.
                        </p>

                        <label>

                            <input
                                type="checkbox"
                                id="confirmRemove"
                            >

                            I confirm to remove this allocation framework.

                        </label>

                    </div>


                    <div class="save-section">

                        <button
                            type="submit"
                            name="remove"
                            class="danger-btn"
                            id="removeBtn"
                            disabled
                        >
                            Permanently Erase Allocation Scheme
                        </button>

                    </div>

                </form>

            </div>


            <a href="point_rule.php" class="back-btn">

                <img
                    src="icons/back.svg"
                    alt="Back"
                >

                Back to Green Point Allocation Management

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="../js/point_rule.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const confirmBox =
                document.getElementById('confirmRemove');

            const removeBtn =
                document.getElementById('removeBtn');


            if (confirmBox && removeBtn) {

                confirmBox.addEventListener('change', function () {

                    removeBtn.disabled = !this.checked;

                });

            }

        });

    </script>

</body>

</html>