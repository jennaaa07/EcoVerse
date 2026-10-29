<?php

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<nav class="sidebar">

    <ul>

        <li class="<?= ($currentPage == 'dashboard.php') ? 'active' : ''; ?>">
            <a href="dashboard.php">
                <img src="icons/dashboard.svg" alt="Dashboard">
                <span>Dashboard</span>
            </a>
        </li>

        <li class="<?= in_array($currentPage, [
            'member.php',
            'member_action.php'
        ]) ? 'active' : ''; ?>">
            <a href="member.php">
                <img src="icons/members.svg" alt="Member">
                <span>Community Member Management</span>
            </a>
        </li>

        <li class="<?= in_array($currentPage, [
            'challenge.php',
            'challenge_edit.php',
            'challenge_create.php'
        ]) ? 'active' : ''; ?>">
            <a href="challenge.php">
                <img src="icons/challenge.svg" alt="Challenge">
                <span>Sustainability Challenge Management</span>
            </a>
        </li>

        <li class="<?= in_array($currentPage, [
            'reward.php',
            'reward_list.php',
            'reward_terminal.php',
            'reward_edit.php',
            'achievement_terminal.php',
            'achievement_edit.php',
            'achievement_list.php'
        ]) ? 'active' : ''; ?>">
            <a href="reward.php">
                <img src="icons/reward.svg" alt="Reward">
                <span>Green Reward Management</span>
            </a>
        </li>

        <li class="<?= in_array($currentPage, [
            'point_rule.php',
            'point_policy.php',
            'point_policy_assign.php',
            'point_policy_edit.php'
        ]) ? 'active' : ''; ?>">
            <a href="point_rule.php">
                <img src="icons/point.svg" alt="Point">
                <span>Green Point Allocation Management</span>
            </a>
        </li>

        <li class="<?= in_array($currentPage, [
             'activity.php',
             'leaderboard.php',
             'report.php'
        ]) ? 'active' : ''; ?>">
            <a href="activity.php">
                <img src="icons/activity.svg" alt="Activity">
                <span>Sustainability Activity Oversight</span>
            </a>
        </li>

        <li class="<?= ($currentPage == 'recommendation.php') ? 'active' : ''; ?>">
            <a href="recommendation.php">
                <img src="icons/recommendation.svg" alt="Recommendation">
                <span>Sustainability Recommendation Engine</span>
            </a>
        </li>

        <li class="<?= ($currentPage == 'profile.php') ? 'active' : ''; ?>">
            <a href="profile.php">
                <img src="icons/profile.svg" alt="Profile">
                <span>Profile</span>
            </a>
        </li>

    <div class="sidebar-footer">
        <a href="../logout.php" 
           class="logout-btn"
           onclick="return confirm('Are you sure you want to logout?')">
            
           <img src="icons/logout.svg" alt="Logout">
                
           <span>Logout</span>
        </a>
    </div>



    </ul>

</nav>
