<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");


if(isset($_POST['save_policy'])){

    $challengeId = $_POST['challenge_id'];
    $greenPoints = $_POST['green_points'];
    $eligibility = $_POST['eligibility'];

    $stmt = mysqli_prepare($conn, "
        UPDATE point_allocation
        SET green_points = ?, eligibility = ?
        WHERE challenge_id = ?
    ");
    mysqli_stmt_bind_param($stmt, "sss", $greenPoints, $eligibility, $challengeId);
    mysqli_stmt_execute($stmt);

    header("Location: point_rule.php");
    exit();

}

$id = isset($_GET['id']) ? $_GET['id'] : '';

$listResult = mysqli_query($conn, "
    SELECT
        challenge_id,
        challenge_name
    FROM point_allocation
    ORDER BY challenge_name
");

$challenge = null;

if ($id !== '') {

    $stmt = mysqli_prepare($conn, "
        SELECT
            challenge_id,
            challenge_name,
            green_points,
            eligibility
        FROM point_allocation
        WHERE challenge_id = ?
    ");

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $challengeResult = mysqli_stmt_get_result($stmt);
    $challenge = mysqli_fetch_assoc($challengeResult);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Challenge Point Rule</title>

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
                        src="icons/edit_challenge.svg"
                        alt="Edit"
                    >

                    <h2>
                        Modify Active Challenge Rule Parameters
                    </h2>

                </div>


                <form method="POST">

                    <label>
                        Select Configured Challenge
                    </label>

                    <select
                        name="challenge_id"
                        onchange="window.location.href='point_policy_edit.php?id=' + this.value"
                    >

                        <?php while ($item = mysqli_fetch_assoc($listResult)) { ?>

                            <option
                                value="<?php echo htmlspecialchars($item['challenge_id']); ?>"
                                <?php if ($item['challenge_id'] == $id) echo 'selected'; ?>
                            >

                                <?php echo htmlspecialchars($item['challenge_id']); ?>

                                -

                                <?php echo htmlspecialchars($item['challenge_name']); ?>

                            </option>

                        <?php } ?>

                    </select>


                    <label>
                        Green Points
                    </label>

                    <input
                        type="number"
                        name="green_points"
                        placeholder="Enter Points"
                        value="<?php echo $challenge ? htmlspecialchars($challenge['green_points']) : ''; ?>"
                        required
                    >


                    <label>
                        Eligibility Criteria
                    </label>

                    <input
                        type="text"
                        name="eligibility"
                        placeholder="e.g. Complete 5 carpool trips in a month"
                        value="<?php echo $challenge ? htmlspecialchars($challenge['eligibility']) : ''; ?>"
                        required
                    >


                    <div class="save-section">

                        <button
                            type="submit"
                            name="save_policy"
                            class="save-btn"
                        >
                            Save Policy Changes
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

</body>

</html>