<?php

session_start();

if(!isset($_SESSION['user_code'])){
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

$sql = "

    SELECT *
    FROM achievement
    ORDER BY achievement_id

";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Environmental Achievement Badges</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/reward.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">
            <div class="section-card">
                <h2 class="page-title">
                    <img src="icons/achievement.svg" alt="Achievement">
                    Environmental Achievement Badges

                </h2>
            
                <div class="reward-grid-list">

                    <?php while($row=mysqli_fetch_assoc($result)){ ?>
                        <div class="reward-card-large">
                            <div class="achievement-list-card">
                                <div class="achievement-list-image-wrap">

                                    <img
                                    src="images/<?php echo htmlspecialchars($row['image']); ?>"
                                    alt="<?php echo htmlspecialchars($row['achievement_name']); ?>">

                                    <p class="achievement-id">
                                        <?php echo htmlspecialchars($row['achievement_id']); ?>
                                    </p>

                                </div>

                                <div class="reward-info">

                                    <h3>
                                        <?php echo $row['achievement_name']; ?>
                                    </h3>

                                    <p>
                                        <strong>Requirement :</strong>
                                        <?php echo $row['requirement']; ?>
                                    </p>

                                    <p>
                                        <strong>Reward :</strong>
                                        <?php echo $row['reward']; ?>
                                    </p>

                                    <p>
                                        <strong>Status :</strong>
                                        <?php echo $row['status']; ?>
                                    </p>

                                </div>
                            </div>

                            <div class="reward-action">

                                <a href="achievement_edit.php?id=<?php echo $row['achievement_id']; ?>"
                                class="edit-btn">
                                    Edit
                                </a>

                                <a href="achievement_terminal.php?delete=<?php echo $row['achievement_id']; ?>"
                                class="delete-btn"
                                onclick="return confirm('Delete this badge?');">
                                    Delete
                                </a>

                            </div>

                        </div>

                <?php } ?>

            </div>

            <div class="center-btn">

                <a href="achievement_terminal.php" class="manage-btn">
                    <img src="icons/add_badge.svg" alt="Add Badge">
                    Add New Badge

                </a>
            </div>
        </div>
                <a href="reward.php" class="back-btn">
                    <img src="icons/back.svg" alt="Back">
                    Back to Green Reward Management

                </a>

        <?php include("../includes/manager_footer.php"); ?>
        </main>

    </div>

</body>

</html>