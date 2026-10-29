<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

if (isset($_POST['save'])) {

    $id = $_POST['challenge_id'];
    $name = $_POST['challenge_name'];
    $objective = $_POST['objective'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $points = $_POST['points'];
    $max = $_POST['max_participants'];
    $status = $_POST['status'];

    $sql = "
        INSERT INTO challenge
        (
            challenge_id,
            challenge_name,
            objective,
            start_date,
            end_date,
            points,
            max_participants,
            status
        )
        VALUES
        (
            '$id',
            '$name',
            '$objective',
            '$start',
            '$end',
            '$points',
            '$max',
            '$status'
        )
    ";

    mysqli_query($conn, $sql);
    header("Location: challenge.php");
    exit();
}

if (isset($_POST['delete'])) {

    $deleteID = $_POST['delete_id'];

    mysqli_query($conn, "
        DELETE FROM challenge
        WHERE challenge_id='$deleteID'
    ");

    header("Location: challenge.php");
    exit();
}

$list = mysqli_query($conn, "
    SELECT challenge_id, challenge_name
    FROM challenge
    ORDER BY challenge_name
");

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Challenge Configuration Console</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/challenge.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <div class="edit-card">

                <div class="create-section-header">
                    <img src="icons/create_challenge.svg" alt="Create">
                    <h2>Create Sustainability Challenge</h2>
                </div>


                <form method="POST" enctype="multipart/form-data">

                    <div class="form-row">

                        <div class="form-group">

                            <label>Challenge ID</label>

                            <input
                                type="text"
                                name="challenge_id"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Challenge Name</label>

                            <input
                                type="text"
                                name="challenge_name"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Challenge Objective</label>

                            <textarea
                                rows="4"
                                name="objective"
                                required
                            ></textarea>

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Start Date</label>

                            <input
                                type="date"
                                name="start_date"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>End Date</label>

                            <input
                                type="date"
                                name="end_date"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Reward Points</label>

                            <input
                                type="number"
                                name="reward_points"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>Maximum Participants</label>

                            <input
                                type="number"
                                name="max_participants"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status">

                                <option value="Draft">
                                    Draft
                                </option>

                                <option value="Active">
                                    Active
                                </option>

                                <option value="Ended">
                                    Ended
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="button-group">

                        <button
                            type="submit"
                            name="save"
                            class="save-btn"
                        >
                            Save Challenge
                        </button>

                    </div>

                </form>

            </div>

            <div class="edit-card">

                <div class="create-section-header">

                    <img src="icons/delete.svg" alt="Delete">

                    <h2>Delete Existing Challenge</h2>

                </div>


                <form method="POST">

                    <div class="form-group">

                        <label>Select Challenge</label>

                        <select name="delete_id">

                            <?php while ($row = mysqli_fetch_assoc($list)) { ?>

                                <option value="<?php echo $row['challenge_id']; ?>">

                                    <?php echo $row['challenge_id']; ?>

                                    -

                                    <?php echo $row['challenge_name']; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <div class="challenge-warning-box">

                        <h3>System Integrity Safety Check</h3>

                        <p>
                            Deleting this challenge permanently removes it from the system.
                        </p>

                        <label class="delete-confirm-check">

                            <input
                                type="checkbox"
                                id="confirmDelete"
                            >

                            <span>
                                I understand this action is
                                <strong>permanent</strong>
                                and the selected challenge will be removed immediately.
                            </span>

                        </label>

                    </div>


                    <div class="button-group">

                        <button
                            type="submit"
                            name="delete"
                            class="delete-btn"
                            onclick="return confirm('Delete this challenge?');"
                        >
                            Delete Challenge
                        </button>

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


    <script>

        document
            .getElementById('confirmDelete')
            .addEventListener('change', function() {

                document.getElementById('deleteBtn').disabled = !this.checked;

            });

    </script>

</body>

</html>