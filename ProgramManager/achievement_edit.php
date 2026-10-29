<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

if (isset($_POST['update'])) {

    $achievement_id = $_POST['achievement_id'];
    $achievement_name = $_POST['achievement_name'];
    $requirement = $_POST['requirement'];
    $reward = $_POST['reward'];
    $status = $_POST['status'];

    $stmt = mysqli_prepare($conn, "
        UPDATE achievement
        SET
            achievement_name = ?,
            requirement = ?,
            reward = ?,
            status = ?
        WHERE achievement_id = ?
    ");

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $achievement_name,
        $requirement,
        $reward,
        $status,
        $achievement_id
    );

    mysqli_stmt_execute($stmt);

    header("Location: achievement_list.php");
    exit();
}

$id = "";

$achievement = [];

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = mysqli_prepare($conn, "
        SELECT *
        FROM achievement
        WHERE achievement_id = ?
    ");

    mysqli_stmt_bind_param($stmt, "s", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $achievement = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Achievement Badge</title>

    <link
        rel="stylesheet"
        href="../css/manager.css"
    >

    <link
        rel="stylesheet"
        href="css/reward.css"
    >

</head>


<body>


<?php include("../includes/manager_header.php"); ?>


<div class="container">


<?php include("../includes/manager_sidebar.php"); ?>


<main class="main-content">

<div class="terminal-card">


    <div class="terminal-header">

        <div class="terminal-title">

            <img
                src="icons/edit_challenge.svg"
                alt="Edit"
            >

            <h2>
                Edit Achievement Badge
            </h2>

        </div>

    </div>


    <form method="POST">


        <div class="terminal-grid">

            <div class="left-panel">


                <h3>
                    Achievement Information
                </h3>

                <label>
                    Achievement ID
                </label>

                <input
                    type="text"
                    name="achievement_id"
                    value="<?php
                        echo htmlspecialchars(
                            $achievement['achievement_id']
                        );
                    ?>"
                    readonly
                >

                <label>
                    Achievement Name
                </label>

                <input
                    type="text"
                    name="achievement_name"
                    value="<?php
                        echo htmlspecialchars(
                            $achievement['achievement_name']
                        );
                    ?>"
                    required
                >

                <label>
                    Requirement
                </label>

                <input
                    type="text"
                    name="requirement"
                    value="<?php
                        echo htmlspecialchars(
                            $achievement['requirement']
                        );
                    ?>"
                    required
                >


            </div>

            <div class="right-panel">


                <h3>
                    Achievement Controls
                </h3>

                <label>
                    Reward
                </label>

                <input
                    type="text"
                    name="reward"
                    value="<?php
                        echo htmlspecialchars(
                            $achievement['reward']
                        );
                    ?>"
                    required
                >

                <label>
                    Status
                </label>

                <select
                    name="status"
                    required
                >

                    <option
                        value="Active"
                        <?php
                        if (
                            isset($achievement['status']) &&
                            $achievement['status'] == 'Active'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Active
                    </option>


                    <option
                        value="Inactive"
                        <?php
                        if (
                            isset($achievement['status']) &&
                            $achievement['status'] == 'Inactive'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Inactive
                    </option>


                </select>

                <div class="save-section">

                    <button
                        type="submit"
                        name="update"
                        class="save-btn"
                    >
                        Save Achievement Changes
                    </button>

                </div>


            </div>


        </div>


    </form>


</div>

<a
    href="achievement_list.php"
    class="back-btn"
>

    <img
        src="icons/back.svg"
        alt="Back"
    >

    Back to Achievement Badges

</a>


<?php include("../includes/manager_footer.php"); ?>


</main>


</div>


<script src="../js/reward.js"></script>


</body>

</html>