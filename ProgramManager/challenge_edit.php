<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

if(isset($_POST['update'])){

    $challengeId = $_POST['challenge_id'];
    $challengeName = $_POST['challenge_name'];
    $objective = $_POST['objective'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $rewardPoints = $_POST['reward_points'];
    $maxParticipants = $_POST['max_participants'];
    $status = $_POST['status'];

    $stmt = mysqli_prepare($conn, "
        UPDATE challenge
        SET challenge_name = ?, objective = ?, start_date = ?, end_date = ?, points = ?, max_participants = ?, status = ?
        WHERE challenge_id = ?
    ");
    mysqli_stmt_bind_param($stmt, "ssssssss", $challengeName, $objective, $startDate, $endDate, $rewardPoints, $maxParticipants, $status, $challengeId);
    mysqli_stmt_execute($stmt);

    header("Location: challenge.php");
    exit();

}


$id = "";
$challenge = [];
$isEdit = false;

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM challenge WHERE challenge_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $challenge = mysqli_fetch_assoc($result);

    $isEdit = true;
}

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Sustainability Challenge</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/challenge.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <div class="edit-card">

                <div class="edit-section-header">

                    <img src="icons/edit_challenge.svg" alt="Edit">

                    <h2>

                        <?php

                        if ($isEdit) {

                            echo "Edit Sustainability Challenge";

                        } else {

                            echo "Create Sustainability Challenge";

                        }

                        ?>

                    </h2>

                </div>


                <form method="POST">


                    <div class="form-row">

                        <div class="form-group">

                            <label>Challenge ID</label>

                            <input
                                type="text"
                                name="challenge_id"
                                value="<?php echo isset($challenge['challenge_id']) ? htmlspecialchars($challenge['challenge_id']) : 'Auto Generated'; ?>"
                                readonly
                            >

                        </div>


                        <div class="form-group">

                            <label>Challenge Name</label>

                            <input
                                type="text"
                                name="challenge_name"
                                value="<?php echo isset($challenge['challenge_name']) ? htmlspecialchars($challenge['challenge_name']) : ''; ?>"
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Challenge Objective</label>

                            <textarea
                                rows="4"
                                name="objective"
                            ><?php echo isset($challenge['objective']) ? htmlspecialchars($challenge['objective']) : ''; ?></textarea>

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Start Date</label>

                            <input
                                type="date"
                                name="start_date"
                                value="<?php echo isset($challenge['start_date']) ? htmlspecialchars($challenge['start_date']) : ''; ?>"
                            >

                        </div>


                        <div class="form-group">

                            <label>End Date</label>

                            <input
                                type="date"
                                name="end_date"
                                value="<?php echo isset($challenge['end_date']) ? htmlspecialchars($challenge['end_date']) : ''; ?>"
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Reward Points</label>

                            <input
                                type="number"
                                name="reward_points"
                                value="<?php echo isset($challenge['points']) ? htmlspecialchars($challenge['points']) : ''; ?>"
                            >

                        </div>


                        <div class="form-group">

                            <label>Maximum Participants</label>

                            <input
                                type="number"
                                name="max_participants"
                                value="<?php echo isset($challenge['max_participants']) ? htmlspecialchars($challenge['max_participants']) : ''; ?>"
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status">

                                <option
                                    value="Active"
                                    <?php
                                    if (
                                        isset($challenge['status']) &&
                                        $challenge['status'] == "Active"
                                    ) {
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Active
                                </option>


                                <option
                                    value="Draft"
                                    <?php
                                    if (
                                        isset($challenge['status']) &&
                                        $challenge['status'] == "Draft"
                                    ) {
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Draft
                                </option>


                                <option
                                    value="Ended"
                                    <?php
                                    if (
                                        isset($challenge['status']) &&
                                        $challenge['status'] == "Ended"
                                    ) {
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    Ended
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="button-group">

                        <?php if ($isEdit) { ?>

                            <button
                                type="submit"
                                name="update"
                                class="update-btn"
                            >
                                Update Challenge
                            </button>


                        <?php } else { ?>

                            <button
                                type="submit"
                                name="save"
                                class="save-btn"
                            >
                                Save Challenge
                            </button>

                        <?php } ?>

                    </div>

                </form>

            </div>

            <a href="challenge.php" class="challenge-page-back">

                <img src="icons/back.svg" alt="Back">

                Back to Sustainability Challenge Management

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="js/challenge.js"></script>

</body>

</html>