<?php

session_start();

if(!isset($_SESSION['user_code'])){
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

if(isset($_POST['create_reward'])){

    $rewardId = $_POST['reward_id'];
    $rewardName = $_POST['reward_name'];
    $pointsRequired = $_POST['point_cost'];
    $quantity = $_POST['stock_quantity'];
    $popularity = $_POST['popularity'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $image = '';

    if(isset($_FILES['reward_image']) && $_FILES['reward_image']['error'] === 0){
        $image = basename($_FILES['reward_image']['name']);
        move_uploaded_file($_FILES['reward_image']['tmp_name'], "images/" . $image);
    }

    $stmt = mysqli_prepare($conn, "
        INSERT INTO reward (rewardid, rewardname, pointsrequired, quantity, popularity, status, category, image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt, "ssssssss", $rewardId, $rewardName, $pointsRequired, $quantity, $popularity, $status, $category, $image);
    mysqli_stmt_execute($stmt);

    header("Location: reward.php");
    exit();

}

if(isset($_POST['remove'])){

    $rewardId = $_POST['rewardid'];

    $stmt = mysqli_prepare($conn, "DELETE FROM reward WHERE rewardid = ?");
    mysqli_stmt_bind_param($stmt, "s", $rewardId);
    mysqli_stmt_execute($stmt);

    header("Location: reward.php");
    exit();

}

$result = mysqli_query($conn, "
    SELECT rewardid
    FROM reward
    ORDER BY rewardid DESC
    LIMIT 1
");

$row = mysqli_fetch_assoc($result);

if($row && !empty($row['rewardid'])){
    $lastNumber = intval(substr($row['rewardid'], 1));
    $nextNumber = $lastNumber + 1;
}else{
    $nextNumber = 1;
}

$rewardid = "R" . str_pad($nextNumber, 3, "0", STR_PAD_LEFT);

$listResult = mysqli_query($conn, "SELECT rewardid, rewardname FROM reward ORDER BY rewardname");

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add / Delete Reward</title>

<link rel="stylesheet" href="../css/manager.css">
<link rel="stylesheet" href="css/reward.css">

</head>

<body>

<?php include("../includes/manager_header.php"); ?>

<div class="container">

    <?php include("../includes/manager_sidebar.php"); ?>

    <main class="main-content">

        <div class="terminal-card">

            <div class="terminal-header">

                <div class="terminal-title">

                    <img src="icons/add_reward.svg" alt="Create">

                    <h2>Add NEW Reward Merchandise or Voucher</h2>

                </div>

            </div>

            <form method="POST" enctype="multipart/form-data">

                <div class="terminal-grid">

                    <div class="left-panel">

                        <h3>Basic Information</h3>

                        <label>Reward ID</label>

                        <input
                            type="text"
                            name="reward_id"
                            placeholder="e.g. <?php echo htmlspecialchars($rewardid); ?>"
                            required
                        >

                        <label>Reward Name</label>

                        <input
                            type="text"
                            name="reward_name"
                            placeholder="Enter reward name"
                            required
                        >

                        <label>Category</label>

                        <select name="category" required>
                            <option value="Product">Eco Product</option>
                            <option value="Voucher">Voucher</option>
                            <option value="Merchandise">Merchandise</option>
                        </select>

                        <h3>Media & Display Asset</h3>

                        <label class="upload-box" for="rewardImageInput">
                            <span id="uploadText">Upload Product Image</span>
                        </label>
                        <input type="file" name="reward_image" id="rewardImageInput" accept="image/*" style="display:none;">

                    </div>

                    <div class="right-panel">

                        <h3>Logistics & Inventory Controls</h3>

                        <label>Point Cost</label>

                        <input
                            type="number"
                            name="point_cost"
                            placeholder="500"
                            required
                        >

                        <label>Stock Quantity</label>

                        <input
                            type="number"
                            name="stock_quantity"
                            placeholder="10"
                            required
                        >

                        <label>Popularity</label>

                        <select name="popularity" required>
                            <option value="Low">Low</option>
                            <option value="Regular">Regular</option>
                            <option value="High">High</option>
                        </select>

                        <label>Status</label>

                        <select name="status" required>
                            <option value="Active">Active</option>
                            <option value="Out of Stock">Out of Stock</option>
                            <option value="Draft">Draft</option>
                        </select>

                        <div class="save-section">

                            <button type="submit" name="create_reward" class="save-btn">
                                Save and Release Reward
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class="terminal-card">

            <div class="terminal-header">

                <div class="terminal-title">

                    <img src="icons/delete.svg" alt="Delete">

                    <h2>Remove Discounted Reward from Marketplace</h2>

                </div>

            </div>

            <form method="POST">

                <label>Select Reward</label>

                <select name="rewardid">

                    <?php while($item = mysqli_fetch_assoc($listResult)){ ?>
                        <option value="<?php echo htmlspecialchars($item['rewardid']); ?>">
                            <?php echo htmlspecialchars($item['rewardid']); ?> - <?php echo htmlspecialchars($item['rewardname']); ?>
                        </option>
                    <?php } ?>

                </select>

                <div class="warning-box">

                    <h3>System Integrity Safety Check</h3>

                    <p>
                        Deleting this reward permanently removes it from the marketplace.
                    </p>

                    <label>

                        <input type="checkbox" id="confirmDelete">

                        I confirm this reward is permanently out of stock and contract with vendor has ended.

                    </label>

                </div>

                <div class="delete-section">

                    <button type="submit" name="remove" class="delete-btn" id="deleteBtn" disabled>
                        Permanently Delete Reward
                    </button>

                </div>

            </form>

        </div>


        <a href="reward.php" class="back-btn">

            <img src="icons/back.svg" alt="Back">

            Back to Green Reward Management

        </a>

        <?php include("../includes/manager_footer.php"); ?>

    </main>

</div>

<script src="../js/reward.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        const rewardInput = document.getElementById('rewardImageInput');
        const uploadBox = document.querySelector('label.upload-box');

        if(rewardInput && uploadBox){
            rewardInput.addEventListener('change', function(){
                const file = this.files[0];
                if(file){
                    const reader = new FileReader();
                    reader.onload = function(e){
                        uploadBox.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:contain; border-radius:15px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        const confirmBox = document.getElementById('confirmDelete');
        const deleteBtn = document.getElementById('deleteBtn');

        if(confirmBox && deleteBtn){
            confirmBox.addEventListener('change', function(){
                deleteBtn.disabled = !this.checked;
            });
        }

    });
</script>

</body>

</html>