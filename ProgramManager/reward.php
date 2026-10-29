<?php

session_start();

if(!isset($_SESSION['user_code'])){

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';


$sql = "
    SELECT
        reward.rewardid,
        reward.rewardname,
        reward.pointsrequired,
        reward.quantity,
        reward.popularity,
        reward.status,
        reward.category,
        reward.image
    FROM reward
    WHERE reward.rewardname LIKE '%$search%'
";

if($category != '' && $category != 'All Rewards'){

    $sql .= " AND reward.category = '$category'";

}

$sql .= " ORDER BY reward.rewardid";

$result = mysqli_query($conn, $sql);

$lastResult = mysqli_query($conn, "
    SELECT rewardid
    FROM reward
    ORDER BY rewardid DESC
    LIMIT 1
");

$lastRow = mysqli_fetch_assoc($lastResult);

if($lastRow){

    $number = intval(substr($lastRow['rewardid'], 1)) + 1;

}else{

    $number = 1;

}

$rewardid = "R" . str_pad($number, 3, "0", STR_PAD_LEFT);

$achievementSql = "
    SELECT
        achievement_id,
        achievement_name,
        requirement,
        reward,
        status,
        image
    FROM achievement
    ORDER BY achievement_id
";

$achievementResult = mysqli_query($conn, $achievementSql);

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Green Reward Management</title>

<link rel="stylesheet" href="../css/manager.css">
<link rel="stylesheet" href="css/reward.css">

</head>

<body>

<?php include("../includes/manager_header.php"); ?>

<div class="container">

    <?php include("../includes/manager_sidebar.php"); ?>

    <main class="main-content">

        <h1 class="page-title">
            Green Reward Management
        </h1>

        <div class="reward-toolbar">

            <div class="search-box">

                <img src="icons/reward_search.svg" alt="Search">

                <input
                    type="text"
                    id="rewardSearch"
                    placeholder="Search rewards"
                >

            </div>

            <select id="rewardCategory">

                <option value="All Rewards">All Rewards</option>

                <option value="Product">
                    Eco Product
                </option>

                <option value="Voucher">
                    Voucher
                </option>

                <option value="Merchandise">
                    Merchandise
                </option>

            </select>

        </div>

        <div class="section-card">

            <div class="section-title">

                <div class="title-left">

                    <img src="icons/marketplace.svg" alt="Marketplace">

                    <h2>Green Reward Marketplace</h2>

                </div>

                <a href="reward_list.php" class="more-btn">

                    More

                    <img src="icons/more.svg" alt="More">

                </a>

            </div>


            <div class="reward-grid" id="rewardGrid">

                <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <div class="reward-card">

                    <div class="reward-image-wrap">

                        <img
                            src="images/<?php echo htmlspecialchars($row['image']); ?>"
                            alt="<?php echo htmlspecialchars($row['rewardname']); ?>"
                        >

                        <p class="greenreward-id">
                            <?php echo htmlspecialchars($row['rewardid']); ?>
                        </p>

                    </div>


                    <div class="reward-info">

                        <h3>
                            <?php echo htmlspecialchars($row['rewardname']); ?>
                        </h3>

                        <p>
                            <strong>Cost:</strong>
                            <?php echo htmlspecialchars($row['pointsrequired']); ?> pts
                        </p>

                        <p>
                            <strong>Stock:</strong>
                            <?php echo htmlspecialchars($row['quantity']); ?>
                        </p>

                        <p>
                            <strong>Popularity:</strong>
                            <?php echo htmlspecialchars($row['popularity']); ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <?php echo htmlspecialchars($row['status']); ?>
                        </p>

                        <p>
                            <strong>Category:</strong>
                            <?php echo htmlspecialchars($row['category']); ?>
                        </p>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>

        <div class="section-card">

            <div class="section-title">

                <div class="title-left">

                    <img src="icons/achievement.svg" alt="Achievement">

                    <h2>Environmental Achievement System</h2>

                </div>

                <a href="achievement_list.php" class="more-btn">

                    More

                    <img src="icons/more.svg" alt="More">

                </a>

            </div>


            <div class="badge-grid">

                <?php while($achievement = mysqli_fetch_assoc($achievementResult)){ ?>

                <div class="badge-card">

                    <div class="achievement-image-wrap">

                        <img
                            src="images/<?php echo htmlspecialchars($achievement['image']); ?>"
                            alt="<?php echo htmlspecialchars($achievement['achievement_name']); ?>"
                        >

                        <p class="achievement-id">
                            <?php echo htmlspecialchars($achievement['achievement_id']); ?>
                        </p>

                    </div>


                    <div class="reward-info">

                        <h3>
                            <?php echo htmlspecialchars($achievement['achievement_name']); ?>
                        </h3>

                        <p>
                            <strong>Requirement:</strong>
                            <?php echo htmlspecialchars($achievement['requirement']); ?> pts
                        </p>

                        <p>
                            <strong>Reward:</strong>
                            <?php echo htmlspecialchars($achievement['reward']); ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <?php echo htmlspecialchars($achievement['status']); ?>
                        </p>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>
        
        <div class="reward-buttons">

            <a href="reward_terminal.php" class="big-btn">

                <img src="icons/add_reward.svg" alt="Add">

                Add New Reward

            </a>

            <a href="achievement_terminal.php" class="big-btn">

                <img src="icons/add_badge.svg" alt="Add Badge">

                Add New Achievement

            </a>

        </div>

        <?php include("../includes/manager_footer.php"); ?>

    </main>

</div>

<script src="js/reward.js"></script>

</body>

</html>