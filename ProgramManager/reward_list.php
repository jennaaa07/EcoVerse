<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$sql = "
    SELECT *
    FROM reward
    ORDER BY rewardid
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reward Marketplace</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/reward.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <div class="section-card">

                <div class="section-title">

                    <div class="title-left">

                        <img src="icons/marketplace.svg" alt="Marketplace">

                        <h2>
                            Reward Marketplace
                        </h2>

                    </div>

                </div>


                <div class="reward-list-grid">

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="reward-list-card">

                            <div class="reward-list-image-wrap">

                                <img
                                    src="images/<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="<?php echo htmlspecialchars($row['rewardname']); ?>">

                                <p class="greenreward-id">
                                    <?php echo htmlspecialchars($row['rewardid']); ?>
                                </p>

                            </div>


                            <div class="reward-list-info">

                                <h3>
                                    <?php echo $row['rewardname']; ?>
                                </h3>

                                <p>
                                    <strong>Cost:</strong>
                                    <?php echo $row['pointsrequired']; ?> pts
                                </p>

                                <p>
                                    <strong>Stock:</strong>
                                    <?php echo $row['quantity']; ?>
                                </p>

                                <p>
                                    <strong>Popularity:</strong>
                                    <?php echo $row['popularity']; ?>
                                </p>

                                <p>
                                    <strong>Status:</strong>
                                    <?php echo $row['status']; ?>
                                </p>

                            </div>


                            <div class="reward-list-actions">

                                <a
                                    href="reward_edit.php?id=<?php echo $row['rewardid']; ?>"
                                    class="edit-btn">

                                    Edit

                                </a>

                                <a
                                    href="reward_terminal.php?id=<?php echo $row['rewardid']; ?>"
                                    class="delete-btn"
                                    onclick="return confirm('Delete this reward?');">

                                    Delete

                                </a>

                            </div>

                        </div>

                    <?php } ?>

                </div>


                <div class="reward-list-bottom-buttons">

                    <a href="reward_terminal.php" class="add-reward-btn">

                        <img src="icons/add_reward.svg" alt="Add Reward">

                        Add New Reward

                    </a>

                </div>

            </div>


            <a href="reward.php" class="back-reward-btn">

                <img src="icons/back.svg" alt="Back">

                Back to Green Reward Management

            </a>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>

</body>

</html>