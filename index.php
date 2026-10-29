<?php

session_start();

include("includes/db_connect.php");

if(isset($_POST['login'])){

    $user_code = trim($_POST['user_code']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM `users` WHERE user_code = ? AND status = 'Active' LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $user_code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    if($user && (password_verify($password, $user['password']) || hash_equals((string)$user['password'], (string)$password))){

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_code'] = $user['user_code'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['full_name'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['status'] = $user['status'];

        if($user['role']=="Manager"){

            header("Location: ProgramManager/dashboard.php");

        }

        elseif($user['role']=="Reviewer"){

            header("Location: GreenReviewer/viewerdashboard.php");

        }

        elseif(in_array($user['role'], ["Participant", "Member"], true)){

            header("Location: Participant/dashboard.php");

        } else {

            session_unset();
            echo "<script>alert('Your account does not have a recognised role.');</script>";

        }

        exit();

    }

    else{

        echo "<script>alert('Invalid Staff ID or Password.');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVerse | Login</title>

    <link rel="stylesheet" href="css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="js/script.js" defer></script>
</head>

<body>

    <main class="login-container">

        <section class="left-panel">

            <div class="logo-box">
                <img src="images/ecoverse.png" alt="EcoVerse Logo">
            </div>

            <h1>EcoVerse</h1>

            <p>
                A World Where Every Green Action Matters.<br>
                Log in to track your green impact.
            </p>

        </section>

        <section class="right-panel">

            <div class="login-form">

                <h2>Welcome Back</h2>

                <p class="subtitle">
                    Please log in into your account.
                </p>

                <form action="" method="POST">

                    <div class="input-group">

                        <label for="user_code">
                            User ID
                        </label>

                        <div class="input-box">
                            <span class="icon">👤</span>
                            <input 
                                type="text"
                                id="user_code"
                                name="user_code"
                                placeholder="e.g. U001"
                                required
                            >
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">
                            Password
                        </label>

                        <div class="input-box">
                        <span class="icon">🔒</span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required>
                        <span
                        class="show-password"
                        id="togglePassword">
                        👁
                        </span>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        name="login"
                        class="login-btn">
                        Log In
                    </button>

                </form>

                <div class="forgot-password">

                    <a href="#">
                        Forgot Password?
                    </a>

                </div>

                <div class="divider">

                    <span></span>

                    <p>OR</p>

                    <span></span>

                </div>

                <a class="guest-btn" href="Guest/guest_hub.php">
                    Enter as Guest
                </a>

                <div class="register">

                    <p>
                        Don't have an account?

                        <a href="#">
                            Register Here
                        </a>
                    </p>

                </div>

            </div>

        </section>


    </main>

</body>
</html>
