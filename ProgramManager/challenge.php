<?php

session_start();

if (!isset($_SESSION['user_code'])) {

    header("Location: ../index.php");
    exit();

}

include("../includes/db_connect.php");

$currentPage = basename($_SERVER['PHP_SELF']);

$sql = "
    SELECT
        challenge.challenge_id,
        challenge.challenge_name,
        challenge.objective,
        challenge.start_date,
        challenge.end_date,
        challenge.status
    FROM challenge
";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sustainability Challenge Management</title>

    <link rel="stylesheet" href="../css/manager.css">
    <link rel="stylesheet" href="css/challenge.css">

</head>

<body>

    <?php include("../includes/manager_header.php"); ?>

    <div class="container">

        <?php include("../includes/manager_sidebar.php"); ?>

        <main class="main-content">

            <h1 class="page-title">
                Sustainability Challenge Management
            </h1>

            <div class="challenge-toolbar">

                <div class="search-box">

                    <img src="icons/challenge.svg" alt="Challenge">

                    <input
                        type="text"
                        id="challengeSearch"
                        placeholder="Search by Challenge ID or Name">

                </div>

            </div>

            <div class="challenge-table-card">

                <table class="challenge-table">

                    <thead>

                        <tr>

                            <th>Challenge ID</th>
                            <th>Challenge Name</th>
                            <th>Objective</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr
                                class="challenge-row"
                                onclick="window.location='challenge_edit.php?id=<?php echo $row['challenge_id']; ?>'"
                            >

                                <td>
                                    <?php echo $row['challenge_id']; ?>
                                </td>

                                <td>
                                    <?php echo $row['challenge_name']; ?>
                                </td>

                                <td>
                                    <?php echo $row['objective']; ?>
                                </td>

                                <td>
                                    <?php echo date("d/m/Y", strtotime($row['start_date'])); ?>
                                </td>

                                <td>
                                    <?php echo date("d/m/Y", strtotime($row['end_date'])); ?>
                                </td>

                                <td>

                                    <span class="status <?php echo strtolower($row['status']); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>


            <div class="challenge-create-card">

                <div class="create-icon">

                    <img src="images/challenge.png" alt="Create">

                </div>


                <div class="create-content">

                    <h2>
                        System Administrative Control Terminal
                    </h2>

                    <p>
                        Modify existing campaigns or structure a new challenge launch event.
                    </p>

                    <a href="challenge_create.php" class="create-btn">
                        Challenge Configuration Console
                    </a>

                </div>

            </div>

            <?php include("../includes/manager_footer.php"); ?>

        </main>

    </div>


    <script src="js/challenge.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){

            const searchInput = document.getElementById('challengeSearch');
            const rows = document.querySelectorAll('.challenge-row');

            if(searchInput){

                searchInput.addEventListener('keyup', function(){

                    const keyword = this.value.toLowerCase();

                    rows.forEach(function(row){

                        const rowText = row.textContent.toLowerCase();

                        if(rowText.includes(keyword)){
                            row.style.display = '';
                        }else{
                            row.style.display = 'none';
                        }

                    });

                });

            }

        });

    </script>

</body>

</html>