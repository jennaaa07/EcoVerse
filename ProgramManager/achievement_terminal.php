<?php

session_start();

if (!isset($_SESSION['user_code'])) {
    header("Location: ../index.php");
    exit();
}

include("../includes/db_connect.php");

if (isset($_POST['create_badge'])) {

    $achievementId = $_POST['achievement_id'];
    $achievementName = $_POST['achievement_name'];
    $requirement = $_POST['requirement'];
    $reward = $_POST['reward'];
    $status = $_POST['status'];
    $image = '';

    if (
        isset($_FILES['achievement_image']) &&
        $_FILES['achievement_image']['error'] === 0
    ) {

        $image = basename(
            $_FILES['achievement_image']['name']
        );

        move_uploaded_file(
            $_FILES['achievement_image']['tmp_name'],
            "images/" . $image
        );
    }

    $stmt = mysqli_prepare($conn, "

        INSERT INTO achievement
        (
            achievement_id,
            achievement_name,
            requirement,
            reward,
            status,
            image
        )

        VALUES (?, ?, ?, ?, ?, ?)

    ");

    mysqli_stmt_bind_param(
        $stmt,
        "ssssss",
        $achievementId,
        $achievementName,
        $requirement,
        $reward,
        $status,
        $image
    );

    mysqli_stmt_execute($stmt);


    header("Location: achievement_list.php");
    exit();
}


if (isset($_POST['remove'])) {

    $achievementId = $_POST['achievement_id'];

    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM achievement WHERE achievement_id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $achievementId
    );

    mysqli_stmt_execute($stmt);


    header("Location: achievement_list.php");
    exit();
}

$list = mysqli_query(
    $conn,
    "
    SELECT achievement_id, achievement_name
    FROM achievement
    ORDER BY achievement_name
    "
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Achievement Badge</title>

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
                        src="icons/add_badge.svg"
                        alt="Add Badge"
                    >

                    <h2>
                        Add New Achievement Badge
                    </h2>

                </div>

            </div>


            <form
                method="POST"
                enctype="multipart/form-data"
            >


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
                            placeholder="e.g. A001"
                            required
                        >


                        <label>
                            Achievement Name
                        </label>

                        <input
                            type="text"
                            name="achievement_name"
                            placeholder="Enter achievement name"
                            required
                        >


                        <label>
                            Requirement
                        </label>

                        <input
                            type="text"
                            name="requirement"
                            placeholder="e.g. 50"
                            required
                        >


                        <h3>
                            Achievement Image
                        </h3>


                        <label
                            class="upload-box"
                            for="achievementImageInput"
                        >

                            <span id="uploadText">
                                Upload Achievement Image
                            </span>

                        </label>


                        <input
                            type="file"
                            name="achievement_image"
                            id="achievementImageInput"
                            accept="image/*"
                            style="display:none;"
                        >


                    </div>

                    <div class="right-panel">


                        <h3>
                            Achievement Reward
                        </h3>


                        <label>
                            Reward
                        </label>

                        <input
                            type="number"
                            name="reward"
                            placeholder="e.g. 200"
                            required
                        >


                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            required
                        >

                            <option value="Active">
                                Active
                            </option>

                            <option value="Inactive">
                                Inactive
                            </option>

                        </select>


                        <div class="save-section">

                            <button
                                type="submit"
                                name="create_badge"
                                class="save-btn"
                            >

                                Save Achievement Badge

                            </button>

                        </div>


                    </div>


                </div>


            </form>


        </div>

        <div class="terminal-card">


            <div class="terminal-header">

                <div class="terminal-title">

                    <img
                        src="icons/delete.svg"
                        alt="Delete"
                    >

                    <h2>
                        Remove Achievement Badge
                    </h2>

                </div>

            </div>


            <form method="POST">


                <label>
                    Select Achievement
                </label>


                <select name="achievement_id">


                    <?php while ($row = mysqli_fetch_assoc($list)) { ?>


                        <option
                            value="<?php echo htmlspecialchars($row['achievement_id']); ?>"
                        >

                            <?php echo htmlspecialchars($row['achievement_id']); ?>

                            -

                            <?php echo htmlspecialchars($row['achievement_name']); ?>

                        </option>


                    <?php } ?>


                </select>


                <div class="warning-box">


                    <h3>
                        Achievement Removal Confirmation
                    </h3>


                    <p>
                        Deleting this achievement permanently removes it from the system.
                    </p>


                    <label>

                        <input
                            type="checkbox"
                            id="confirmDelete"
                        >

                        I understand that this action cannot be undone.

                    </label>


                </div>


                <div class="delete-section">


                    <button
                        type="submit"
                        name="remove"
                        class="delete-btn"
                        id="deleteBtn"
                        disabled
                    >

                        Delete Achievement Badge

                    </button>


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


<script>

document.addEventListener(
    'DOMContentLoaded',
    function() {

        const imageInput =
            document.getElementById(
                'achievementImageInput'
            );

        const uploadBox =
            document.querySelector(
                'label.upload-box'
            );


        if (imageInput && uploadBox) {

            imageInput.addEventListener(
                'change',
                function() {

                    const file =
                        this.files[0];

                    if (file) {

                        const reader =
                            new FileReader();

                        reader.onload =
                            function(e) {

                                uploadBox.innerHTML =
                                    `<img
                                        src="${e.target.result}"
                                        style="
                                            width:100%;
                                            height:100%;
                                            object-fit:contain;
                                            border-radius:15px;
                                        "
                                    >`;

                            };

                        reader.readAsDataURL(file);

                    }

                }
            );

        }

        const confirmBox =
            document.getElementById(
                'confirmDelete'
            );

        const deleteBtn =
            document.getElementById(
                'deleteBtn'
            );


        if (confirmBox && deleteBtn) {

            confirmBox.addEventListener(
                'change',
                function() {

                    deleteBtn.disabled =
                        !this.checked;

                }
            );

        }

    }
);

</script>


</body>

</html>

