<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

if (isset($_POST['update'])) {

    $rewardid = $_POST['rewardid'];
    $rewardname = $_POST['rewardname'];
    $category = $_POST['category'];
    $pointsrequired = $_POST['pointsrequired'];
    $quantity = $_POST['quantity'];
    $popularity = $_POST['popularity'];
    $status = $_POST['status'];

    $stmt = mysqli_prepare($conn, "
        UPDATE reward
        SET
            rewardname = ?,
            category = ?,
            pointsrequired = ?,
            quantity = ?,
            popularity = ?,
            status = ?
        WHERE rewardid = ?
    ");

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $rewardname,
        $category,
        $pointsrequired,
        $quantity,
        $popularity,
        $status,
        $rewardid
    );

    mysqli_stmt_execute($stmt);

    header("Location: reward_list.php");
    exit();
}

$id = "";

$reward = [];

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = mysqli_prepare($conn, "
        SELECT *
        FROM reward
        WHERE rewardid = ?
    ");

    mysqli_stmt_bind_param($stmt, "s", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $reward = mysqli_fetch_assoc($result);
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

    <title>Edit Reward</title>

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
                Edit Reward Details
            </h2>

        </div>

    </div>


    <form method="POST">


        <div class="terminal-grid">

            <div class="left-panel">


                <h3>
                    Basic Information
                </h3>

                <label>
                    Reward ID
                </label>

                <input
                    type="text"
                    name="rewardid"
                    value="<?php
                        echo htmlspecialchars(
                            $reward['rewardid']
                        );
                    ?>"
                    readonly
                >

                <label>
                    Reward Name
                </label>

                <input
                    type="text"
                    name="rewardname"
                    value="<?php
                        echo htmlspecialchars(
                            $reward['rewardname']
                        );
                    ?>"
                    required
                >

                <label>
                    Category
                </label>

                <select
                    name="category"
                    required
                >

                    <option
                        value="Product"
                        <?php
                        if (
                            isset($reward['category']) &&
                            $reward['category'] == 'Product'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Eco Product
                    </option>


                    <option
                        value="Voucher"
                        <?php
                        if (
                            isset($reward['category']) &&
                            $reward['category'] == 'Voucher'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Voucher
                    </option>


                    <option
                        value="Merchandise"
                        <?php
                        if (
                            isset($reward['category']) &&
                            $reward['category'] == 'Merchandise'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Merchandise
                    </option>

                </select>


            </div>

            <div class="right-panel">


                <h3>
                    Reward Controls
                </h3>

                <label>
                    Point Cost
                </label>

                <input
                    type="number"
                    name="pointsrequired"
                    value="<?php
                        echo htmlspecialchars(
                            $reward['pointsrequired']
                        );
                    ?>"
                    required
                >

                <label>
                    Stock Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    value="<?php
                        echo htmlspecialchars(
                            $reward['quantity']
                        );
                    ?>"
                    required
                >

                <label>
                    Popularity
                </label>

                <select
                    name="popularity"
                    required
                >

                    <option
                        value="Low"
                        <?php
                        if (
                            isset($reward['popularity']) &&
                            $reward['popularity'] == 'Low'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Low
                    </option>


                    <option
                        value="Regular"
                        <?php
                        if (
                            isset($reward['popularity']) &&
                            $reward['popularity'] == 'Regular'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Regular
                    </option>


                    <option
                        value="High"
                        <?php
                        if (
                            isset($reward['popularity']) &&
                            $reward['popularity'] == 'High'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        High
                    </option>

                </select>

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
                            isset($reward['status']) &&
                            $reward['status'] == 'Active'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Active
                    </option>


                    <option
                        value="Out of Stock"
                        <?php
                        if (
                            isset($reward['status']) &&
                            $reward['status'] == 'Out of Stock'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Out of Stock
                    </option>


                    <option
                        value="Draft"
                        <?php
                        if (
                            isset($reward['status']) &&
                            $reward['status'] == 'Draft'
                        ) {
                            echo 'selected';
                        }
                        ?>
                    >
                        Draft
                    </option>

                </select>

                <div class="save-section">

                    <button
                        type="submit"
                        name="update"
                        class="save-btn"
                    >
                        Save Reward Changes
                    </button>

                </div>


            </div>


        </div>


    </form>


</div>

<a
    href="reward_list.php"
    class="back-btn"
>

    <img
        src="icons/back.svg"
        alt="Back"
    >

    Back to Reward Marketplace

</a>


<?php include("../includes/manager_footer.php"); ?>


</main>


</div>


<script src="../js/reward.js"></script>


</body>

</html>